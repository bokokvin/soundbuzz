<?php

namespace AppBundle\Controller;
 
use FOS\CommentBundle\Controller\ThreadController as BaseThreadController;// le controlleur que je vais surcharger
 
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
 
use BeSimple\I18nRoutingBundle\Routing\Annotation\I18nRoute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
 
class ThreadController extends BaseThreadController
{

}