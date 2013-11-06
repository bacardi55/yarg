<?php

namespace B55\Bundle\YargWebSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render(
            'B55YargWebSiteBundle:Index:index.html.twig', array()
        );
    }
}
