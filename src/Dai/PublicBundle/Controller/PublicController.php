<?php

namespace Dai\PublicBundle\Controller;

use Dai\PortfolioBundle\Entity\Work;
use Dai\PortfolioBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PublicController extends Controller
{

    public function indexAction()
    {
    

        return $this->render('DaiPublicBundle:Public:index.html.twig', array());

    }
}
