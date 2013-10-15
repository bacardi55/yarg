<?php

namespace B55\Bundle\YargBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function addCvAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $cv = new Cv();
        $cv->setUser($user);

        $form = $this->createForm(new CvForm(), $cv);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cv);
            $em->flush();

            // For now, redirect to the my yarg page
            return $this->redirect($this->generateUrl('yarg_myyarg'));
        }

        return $this->render(
            'B55YargBundle:MyYarg:add_cv.html.twig',
            array('form' => $form->createView())
        );
    }
}
