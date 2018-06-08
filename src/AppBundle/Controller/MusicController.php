<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Music;
use AppBundle\Entity\Morceau;

use AppBundle\Form\MusicType;




class MusicController extends Controller
{
    /**
    * @Route("music/list", name="music_list")
    */
    public function listAction()
    {  
        $user = $this->getUser()->getId();  

        $em = $this->getDoctrine()->getManager();
        $musicRepository = $em->getRepository('AppBundle:Music');

        $listMusic = $musicRepository->findByUser($user);

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

        $playMusic  = $musicRepository->findOneById($id);

        $name       = $playMusic->getMorceau()->getUrl();

        $urlMusic = $playMusic->getMorceau()->getUploadDir();

        return $this->render('AppBundle:Music:play.html.twig', 
        array(
            'urlMusic' => $urlMusic, "name" => $name, "id" => $id,
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

}
