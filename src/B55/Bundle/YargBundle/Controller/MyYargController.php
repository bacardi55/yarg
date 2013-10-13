<?php

namespace B55\Bundle\YargBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B55\Bundle\YargBundle\Entity\User;

class MyYargController extends Controller
{
    public function IndexAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();

        return $this->render(
            'B55YargBundle:MyYarg:index.html.twig', array()
        );
    }
}
