<?php

namespace Dai\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class WorkController extends Controller
{
    
    public function indexAction($page)
    {
        if ($page < 1) {          
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }
        return $this->render('DaiPortfolioBundle:Work:index.html.twig');
    }

    public function viewAction($id)
    {
        return $this->render('DaiPortfolioBundle:Work:view.html.twig', array(
            'id' => $id
        ));
    }

    public function addAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirect($this->generateUrl('dai_portfolio_view', array('id' => 5)));
        }

        return $this->render('DaiPortfolioBundle:Work:add.html.twig');
    }

    public function editAction($id, Request $request)
    {

        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
            return $this->redirect($this->generateUrl('dai_portfolio_view', array('id' => 5)));
        }

        return $this->render('DaiPortfolioBundle:Work:edit.html.twig');
    }

    public function deleteAction($id)
    {
        return $this->render('DaiPortfolioBundle:Work:delete.html.twig');
    }
}
