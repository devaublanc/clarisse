<?php

namespace Dai\PortfolioBundle\Controller;

use Dai\PortfolioBundle\Entity\Work;
use Dai\PortfolioBundle\Form\WorkType;
use Dai\PortfolioBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



class WorkController extends Controller
{

    public function indexAction($page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $nbPerPage = 2;

        $works = $this->getDoctrine()
            ->getManager()
            ->getRepository('DaiPortfolioBundle:Work')
            ->getWorks($page, $nbPerPage)
        ;

        // On calcule le nombre total de pages grâce au count($listAdverts) qui retourne le nombre total d'annonces
        $nbPages = ceil(count($works)/$nbPerPage);

        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('DaiPortfolioBundle:Work:index.html.twig', array(
            'works' => $works,
            'nbPages' => $nbPages,
            'page' => $page
        ));

    }

    public function viewAction($id)
    {
        return $this->render('DaiPortfolioBundle:Work:view.html.twig', array(
            'id' => $id
        ));
    }

    public function addAction(Request $request)
    {

        $work = new Work();
        $form = $this->get('form.factory')->create(new WorkType(), $work);

        if ($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($work);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Work saved');

            return $this->redirect($this->generateUrl('dai_portfolio_home', array('id' => $work->getId())));
        }

        return $this->render('DaiPortfolioBundle:Work:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {

        return new Response('edit!' . $id);
    }

    public function deleteAction($id)
    {
        return $this->render('DaiPortfolioBundle:Work:delete.html.twig');
    }
}
