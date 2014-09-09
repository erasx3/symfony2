<?php

namespace Pepe\PepeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PepeBundle:Default:index2.html.twig', array('name' => $name));
    }
}
