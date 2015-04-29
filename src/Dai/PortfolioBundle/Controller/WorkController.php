<?php

namespace Dai\PortfolioBundle\Controller;

use Dai\PortfolioBundle\Entity\Work;
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

        $em = $this->getDoctrine()->getManager();

        // Création de l'entité Image
        $image = new Image();
        $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
        $image->setAlt('Job de rêve');

        // On lie l'image à l'annonce
        $work->setImage($image);

        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // Étape 1 : On « persiste » l'entité
        $em->persist($work);

        // Étape 1 bis : si on n'avait pas défini le cascade={"persist"},
        // on devrait persister à la main l'entité $image
        // $em->persist($image);

        // Étape 2 : On déclenche l'enregistrement
        $em->flush();

        // Reste de la méthode qu'on avait déjà écrit
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Travail bien enregistrée.');
            return $this->redirect($this->generateUrl('dai_portfolio_view', array('id' => $work->getId())));
        }

        return $this->render('DaiPortfolioBundle:Work:add.html.twig');
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
