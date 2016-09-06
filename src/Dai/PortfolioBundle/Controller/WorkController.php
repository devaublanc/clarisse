<?php

namespace Dai\PortfolioBundle\Controller;

use Dai\PortfolioBundle\Entity\Work;
use Dai\PortfolioBundle\Form\WorkType;
use Dai\PortfolioBundle\Form\WorkEditType;
use Dai\PortfolioBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class WorkController extends Controller
{

    public function indexAction($page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $nbPerPage = 50;

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


    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function addAction(Request $request)
    {

        $work = new Work();
        $form = $this->get('form.factory')->create(new WorkType(), $work);

        if ($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($work);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Peinture sauvegardé');

            return $this->redirect($this->generateUrl('dai_work_index', array('id' => $work->getId())));
        }

        return $this->render('DaiPortfolioBundle:Work:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // On récupère l'annonce $id
        $work = $em->getRepository('DaiPortfolioBundle:Work')->find($id);

        if (null === $work) {
            throw new NotFoundHttpException("La peinture d'id ".$id." n'existe pas.");
        }

        $form = $this->createForm(new WorkEditType(), $work);

        if ($form->handleRequest($request)->isValid()) {
            // Inutile de persister ici, Doctrine connait déjà notre annonce
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Peinture mise à jour');

            return $this->redirect($this->generateUrl('dai_work_index', array('id' => $work->getId())));
        }

        return $this->render('DaiPortfolioBundle:Work:edit.html.twig', array(
            'form'   => $form->createView(),
            'work' => $work // Je passe également l'annonce à la vue si jamais elle veut l'afficher
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $work = $em->getRepository('DaiPortfolioBundle:Work')->find($id);

        if (null === $work) {
            throw new NotFoundHttpException("Work id ".$id." n'existe pas.");
        }

        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $em->remove($work);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "La peinture a bien été supprimé");

            return $this->redirect($this->generateUrl('dai_work_index'));
        }

        return $this->render('DaiPortfolioBundle:Work:delete.html.twig', array(
            'work' => $work,
            'form'   => $form->createView()
        ));
    }
}
