<?php

namespace B55\Bundle\YargWebSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('B55YargWebSiteBundle:Default:index.html.twig', array('name' => $name));
    }
}
