<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('index.html.twig', []);
    }

    /**
     * @Route("/mon_compte", name="userhomepag")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home_page.html.twig', []);
    }


    /**
     * @Route("/send-notification", name="send_notification")
     */
    public function sendNotification(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('AppBundle:User');

        $user = $userRepository->findById(2);

        $user2 = $user[0]->getLastName();


        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Notification subject',"Some random text $user2",'http://google.fr');

       

        // you can add a notification to a list of entities
        // the third parameter ``$flush`` allows you to directly flush the entities
        $manager->addNotification($user, $notif, true);

        return $this->redirectToRoute('homepage');
    }

}
