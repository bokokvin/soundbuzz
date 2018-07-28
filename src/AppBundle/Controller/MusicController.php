<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Music;
use AppBundle\Entity\Morceau;
use AppBundle\Entity\Appreciation;
use AppBundle\Entity\Ecoute;

use AppBundle\Form\MusicType;



class MusicController extends Controller
{


    /**
    * @Route("music/all", name="music_all")
    */
    public function listAllAction()
    {  
        //$user = $this->getUser()->getId();  

        $em = $this->getDoctrine()->getManager();
        $musicRepository = $em->getRepository('AppBundle:Music');

        $listMusic = $musicRepository->findAll();

        return $this->render('AppBundle:Music:all.html.twig', array(
            'listMusic' => $listMusic,
          ));


    }


    /**
    * @Route("music/list", name="music_list")
    */
    public function listAction()
    {  
        $user = $this->getUser()->getId();  

        $em = $this->getDoctrine()->getManager();
        $musicRepository = $em->getRepository('AppBundle:Music');

        //$listMusic = $musicRepository->findByUser($user);
        $listMusic = $musicRepository->findAll();

        return $this->render('AppBundle:Music:list.html.twig', array(
            'listMusic' => $listMusic,
          ));


    }

    /**
    * @Route("music/add", name="music_add")
    */
    public function addAction(Request $request)
    {
    
    $em = $this->getDoctrine()->getManager();
    $morceauRepository = $em->getRepository('AppBundle:Morceau');
    
    $user = $this->getUser();
    
    // On crée un objet Music
    $music = new Music();  
    $form = $this->get('form.factory')->create(MusicType::class, $music);
    
    $music->setUser($user);


    if ($request->isMethod('POST')) {
        $form->handleRequest($request);
  
        if ($form->isValid()) {

            $music->getMorceau()->upload();
            $music->getPhoto()->upload();

            $em = $this->getDoctrine()->getManager();
            $em->persist($music);
            $em->flush();

            $manager = $this->get('mgilet.notification');
            $notif   = $manager->createNotification('New song','Vous venez d\'ajouter un nouveau morceau' ,'http://google.fr');
            $manager->addNotification(array($this->getUser()), $notif, true);

            return $this->redirectToRoute('music_list');
        }
      }


    

    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('AppBundle:Music:add.html.twig', array(
      'form' => $form->createView(),
    ));
    }



    /**
    * @Route("music/play/{id}", name="music_play")
    */
    public function playAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $musicRepository = $em->getRepository('AppBundle:Music');

        $listMusic = $musicRepository->findAll();

        $playMusic  = $musicRepository->findOneById($id);

        $name       = $playMusic->getMorceau()->getUrl();

        $urlMusic = $playMusic->getMorceau()->getUploadDir();

        return $this->render('AppBundle:Music:play.html.twig', 
        array(
            'urlMusic' => $urlMusic, "name" => $name, "playMusic" => $playMusic, 'listMusic' => $listMusic,
          ));
    }


    /**
    * @Route("music/delete/{id}", name="music_delete")
    */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $musicRepository = $em->getRepository('AppBundle:Music');

        $deleteMusic = $musicRepository->findOneById($id);

        $em->remove($deleteMusic);
        $em->flush();

        return $this->redirectToRoute('music_list');
    }


    /**
    * @Route("music/add/like/{id}", name="music_like")
    */
    public function likeAction(Request $request, $id)
    {

        if($request->request->get('some_var_name')){

        $em = $this->getDoctrine()->getManager();
        $musicRepository = $em->getRepository('AppBundle:Music');
        $appreciationRepository = $em->getRepository('AppBundle:Appreciation');

        $user = $this->getUser();
        $music = $musicRepository->findOneById($id);

        $appreciation = $appreciationRepository->findOneByLiker($user);
        
        if ($appreciation == null || $appreciation->getMusic()->getId() != $id )
        {

                $Appreciation = new Appreciation(); 
                $Appreciation->setLiker($user);
                $Appreciation->setMusic($music);
                $Appreciation->setDate(new \DateTime());
                $Appreciation->setValue(1);
                $Appreciation->getMusic()->incrementScore(1);
                $em->persist($Appreciation);
                $em->flush();

                $manager = $this->get('mgilet.notification');
                $notif   = $manager->createNotification('New song',"Une personne a aimé votre musique" ,'http://google.fr');
                $manager->addNotification(array($music->getUser()), $notif, true);

                $decremente = 1;        

                $nbLike = $Appreciation->getMusic()->getScore();
                $arrData = ['output' => $nbLike];

            
            return new JsonResponse($arrData);
            
        }
        else
        {

            $appreciation->getMusic()->incrementScore(-1);
            $em->remove($appreciation);

            $em->flush();

            $nbLike = $appreciation->getMusic()->getScore();
            $arrData = ['output' => $nbLike];
            return new JsonResponse($arrData);
        }


        
        }

    }




    /**
    * @Route("music/add/ecoute/{id}", name="music_ecoute")
    */
    public function ecouteAction(Request $request, $id)
    {

        if($request->request->get('some_var_name')){

        $em = $this->getDoctrine()->getManager();
        $musicRepository = $em->getRepository('AppBundle:Music');
        $ecouteRepository = $em->getRepository('AppBundle:Ecoute');

        $user = $this->getUser();
        $music = $musicRepository->findOneById($id);

        $ecoute = $ecouteRepository->findOneByEcouteur($user);
        
        if ($ecoute == null || $ecoute->getMusic()->getId() != $id )
        {

                $Ecoute = new Ecoute(); 
                $Ecoute->setEcouteur($user);
                $Ecoute->setMusic($music);
                $Ecoute->setDate(new \DateTime());
                $Ecoute->setValue(1);
                $Ecoute->getMusic()->incrementEcoute(1);
                $em->persist($Ecoute);
                $em->flush();      

                $nbEcoute = $Ecoute->getMusic()->getEcoute();
                $arrData = ['output' => $nbEcoute];

            
                return new JsonResponse($arrData);
            
        }
        else
        {
            $nbEcoute = $ecoute->getMusic()->getEcoute();
            $arrData = ['output' => $nbEcoute];
            return new JsonResponse($arrData);
        }}
    }


    /**
    * @Route("music/add/download/{id}", name="music_download")
    */
    public function downloadAction(Request $request, $id)
    {

        if($request->request->get('some_var_name')){

        $em = $this->getDoctrine()->getManager();
        $musicRepository = $em->getRepository('AppBundle:Music');
        $music = $musicRepository->findOneById($id);


        $music->incrementDownload(1);
        $em->flush();

        $nbDownload = $music->getDownload();

        $arrData = ['output' => $nbDownload];
        return new JsonResponse($arrData);
        }


        
        

    }

}