<?php

namespace Dai\PortfolioBundle\Controller;

use Dai\PortfolioBundle\Entity\Category;
use Dai\PortfolioBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



class CategoryController extends Controller
{

    public function addAction(Request $request)
    {

        $category = new Category();
        $form = $this->get('form.factory')->create(new CategoryType(), $category);

        if ($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Category sauvegardé');

            return $this->redirect($this->generateUrl('dai_work_index', array('id' => $category->getId())));
        }

        return $this->render('DaiPortfolioBundle:Category:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
