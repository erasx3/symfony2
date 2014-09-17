<?php

namespace Pepe\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PepeUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
