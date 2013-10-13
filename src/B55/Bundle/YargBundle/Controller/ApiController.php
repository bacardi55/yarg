<?php

namespace B55\Bundle\YargBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use B55\YargBundle\Model\Cv;
use B55\YargBundle\Repository\CvRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends Controller
{
    private $cvRepository;

    /**
     * @Rest\View
     */
    public function getCvsAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $cvRepository = $entityManager->getRepository('B55YargBundle:Cv');
        $cvs = $cvRepository->findAll();
        return array('cvs' => $cvs);

        //$view = new View($cvs);
        //return $this->get('fos_rest.view_handler')->handle($view);
    }

    /**
     * @Rest\View
     */
    public function getCvAction($slug)
    {
      die('here');
    }
}

