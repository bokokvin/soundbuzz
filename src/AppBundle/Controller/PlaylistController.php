<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Playlist;

use AppBundle\Form\PlaylistType;


class PlaylistController extends Controller
{
    /**
     * @Route("playlist/list", name="playlist_list")
     */
    public function listAction()
    {
        $user = $this->getUser()->getId();  

        $em = $this->getDoctrine()->getManager();
        $playlistRepository = $em->getRepository('AppBundle:Playlist');

        $playlistList = $playlistRepository->findByUser($user);

        return $this->render('AppBundle:Playlist:list.html.twig', array(
            'playlistList' => $playlistList,
          ));
    }


     /**
     * @Route("playlist/add", name="playlist_add")
     */
    public function addAction(Request $request)
    {
    
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->getUser();

        // On crée un objet Playlist
        $playlist = new Playlist();  
        $form = $this->get('form.factory')->create(PlaylistType::class, $playlist);

        $playlist->setUser($user);

        if ($request->isMethod('POST')) 
        {
            $form->handleRequest($request);
      
            if ($form->isValid()) {
    
                $em = $this->getDoctrine()->getManager();
                $em->persist($playlist);
                $em->flush();
       
                return $this->redirectToRoute('playlist_list');
            }
        }

        return $this->render('AppBundle:Playlist:add.html.twig', array(
            'form' => $form->createView(),
          ));

    }


    /**
     * @Route("playlist/choix/{id_music}", name="playlist_choix")
     */
    public function choixAction($id_music, Request $request)
    {
        $user = $this->getUser()->getId();  

        $em = $this->getDoctrine()->getManager();
        $playlistRepository = $em->getRepository('AppBundle:Playlist');

        $playlistList = $playlistRepository->findByUser($user);

        return $this->render('AppBundle:Playlist:choix.html.twig', array(
            'playlistList' => $playlistList, "id_music" => $id_music,
          ));    

    }

    /**
     * @Route("playlist/add/song/{id_m}/{id_p}", name="playlist_add_song")
     */
    public function addSongAction($id_m, $id_p, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $musicRepository = $em->getRepository('AppBundle:Music');
        $playlistRepository = $em->getRepository('AppBundle:Playlist');

        $playlist1 = $playlistRepository->findOneById($id_p);
        $MusicToAdd = $musicRepository->findOneById($id_m);

        $playlist1->addMusic($MusicToAdd);

        //$em->persist($MusicToAdd);
        $em->flush();

        return $this->redirectToRoute('playlist_list');

    }


    /**
     * @Route("playlist/view/{id}", name="playlist_view")
     */
    public function viewAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $playlistRepository = $em->getRepository('AppBundle:Playlist');

        $list  = $playlistRepository->findOneById($id);

        $musics = $list->getMusics();

        return $this->render('AppBundle:Playlist:view.html.twig', array(
            'musics' => $musics,
          ));



    }



}
