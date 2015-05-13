<?php

namespace Dai\PublicBundle\Controller;

use Dai\PortfolioBundle\Entity\Work;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PublicController extends Controller
{

    public function indexAction($page)
    {

    	if ($page < 1) {
    	    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    	}

    	$nbPerPage = 5;

    	$works = $this->getDoctrine()
    	    ->getManager()
    	    ->getRepository('DaiPortfolioBundle:Work')
    	    ->getWorks($page, $nbPerPage)
    	;

    	
    	$nbPages = ceil(count($works)/$nbPerPage);
    	
    	if ($page > $nbPages) {
    	    throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    	}

    	return $this->render('DaiPublicBundle:Public:index.html.twig', array(
    	    'works' => $works,
    	    'nbPages' => $nbPages,
    	    'page' => $page
    	));
    
        return $this->render('DaiPublicBundle:Public:index.html.twig', array());

    }
}
