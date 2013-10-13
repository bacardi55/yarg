<?php

namespace B55\Bundle\YargBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render(
            'B55YargBundle:Index:index.html.twig', array()
        );
    }
}
