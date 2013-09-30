<?php

namespace B55\Bundle\YargBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class YargController extends Controller
{
    public function indexAction($name)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $resumes = $entityManager->getRepository('B55YardBundle:Yard')
            ->findAll();

        return $this->render(
          'B55YargBundle:Default:index.html.twig',
          array('resumes' => $resumes)
        );
    }
}

