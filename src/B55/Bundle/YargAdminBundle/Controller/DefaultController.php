<?php

namespace B55\Bundle\YargAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('B55YargAdminBundle:Default:index.html.twig', array('name' => $name));
    }
}
