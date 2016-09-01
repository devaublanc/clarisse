<?php

namespace Dai\PublicBundle\Controller;

use Dai\PortfolioBundle\Entity\Work;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PublicController extends Controller
{

    public function indexAction(Request $request)
    {

        $page = $request->query->get('page');

        if ($page < 1) {
            $page = 1;
        }

        $nbPerPage = 15;

        $works = $this->getDoctrine()
            ->getManager()
            ->getRepository('DaiPortfolioBundle:Work')
            ->getWorksPublished($page, $nbPerPage)
        ;


        $nbPages = ceil(count($works)/$nbPerPage);


        if($request->isXmlHttpRequest()) {

            if ($page > $nbPages) {
                $response = new Response('ko', 200);
            } else {

                $results = array();
                foreach ($works as $work) {
                    $results[] = $this->render('DaiPublicBundle:Public:item.html.twig', array('work' => $work))->getContent();
                }

                $response = new Response(json_encode($results), 200);
                $response->headers->set('Content-Type', 'application/json');
            }

            return $response;

        } else {

            if ($page > $nbPages) {
                throw $this->createNotFoundException("La page ".$page." n'existe pas.");
            }

            return $this->render('DaiPublicBundle:Public:index.html.twig', array(
                'works' => $works,
                'nbPages' => $nbPages,
                'page' => $page,
                'needPager' => $works->count() > $nbPerPage,
            ));

        }

    }

    public function contactAction(Request $request)
    {
        return $this->render('DaiPublicBundle:Public:contact.html.twig');
    }

    public function bioAction(Request $request)
    {
        return $this->render('DaiPublicBundle:Public:bio.html.twig');
    }

}
