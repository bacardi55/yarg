<?php

namespace B55\Bundle\YargBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use B55\Bundle\YargBundle\Entity\Cv;
use B55\Bundle\YargBundle\Form\CvForm;

class MyYargController extends Controller
{
    public function IndexAction()
    {
        return $this->render(
            'B55YargBundle:MyYarg:index.html.twig', array()
        );
    }
}
