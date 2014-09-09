<?php

namespace Pepe\PepeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PepeBundle:Default:index.html.twig', array('name' => $name));
    }
}
