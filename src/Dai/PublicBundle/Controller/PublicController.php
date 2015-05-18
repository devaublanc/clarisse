<?php

namespace Dai\PublicBundle\Controller;

use Dai\PortfolioBundle\Entity\Work;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PublicController extends Controller
{

    public function indexAction($page, Request $request)
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


        if($request->isXmlHttpRequest()) {
        
            $template = $this->render('DaiPublicBundle:Public:item.html.twig')->getContent();
            $json = json_encode($template);
            $response = new Response($json, 200);
            $response->headers->set('Content-Type', 'application/json');
            return $response;


        } else {

            return $this->render('DaiPublicBundle:Public:index.html.twig', array(
                'works' => $works,
                'nbPages' => $nbPages,
                'page' => $page
            ));

        }

    }

}
