<?php

namespace B55\Bundle\YargBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use B55\YargBundle\Model\Cv;
use B55\YargBundle\Repository\CvRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CvsController extends Controller
{
    private $cvRepository;

    public function __construct()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $this->cvRepository = $entityManager->getRepository('B55YardBundle:Cv');
    }

    /**
     * @Rest\View
     */
    public function allAction()
    {
        $cvs = $this->cvRepository->findAll();
        return array('cvs' => $cvs);
    }

    /**
     * @Rest\View
     */
    public function getAction()
    {
    }
}

