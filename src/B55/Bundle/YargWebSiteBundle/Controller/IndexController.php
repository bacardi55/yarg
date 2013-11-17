<?php

namespace B55\Bundle\YargWebSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $lastPublishedCvs = $this->getDoctrine()->getManager()
            ->getRepository('B55YargBundle:Cv')
            ->getLastPublishedCvs();

        return $this->render(
            'B55YargWebSiteBundle:Index:index.html.twig',
            array('lastPublishedCvs' => $lastPublishedCvs)
        );
    }
}
