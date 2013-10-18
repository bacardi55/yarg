<?php

namespace B55\Bundle\YargBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use B55\Bundle\YargBundle\Entity\User;
use B55\Bundle\YargBundle\Entity\Cv;
use B55\Bundle\YargBundle\Form\CvForm;

class CvsController extends Controller
{
    public function addAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $cv = new Cv();
        $cv->setUser($user);
        $cv->setCreated(new \Datetime());
        $cv->setUpdated(new \Datetime());

        $form = $this->createForm(new CvForm(), $cv);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cv);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
              'success', 'yarg.my_yarg.cv.created.success'
            );

            return $this->redirect(
                $this->generateUrl('yarg_myyarg_show_cv',
                array('slug' => $cv->getSlug()))
            );
        }

        return $this->render(
            'B55YargBundle:Cvs:add.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * ParamConverter("cv", class="B55YargBundle:Cv", options={"mapping:": {"slug": "slug"}})
     */
    public function showAction(Cv $cv)
    {
        return $this->render(
            'B55YargBundle:Cvs:show.html.twig',
            array('cv' => $cv)
        );
    }

    /**
     * @ParamConverter("cv", class="B55YargBundle:Cv", options={"mapping": {"slug": "slug"}})
     */
    public function deleteAction(Cv $cv)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($cv);
        $em->flush();

        return $this->redirect($this->generateUrl('yarg_myyarg'));
    }

    /**
     * @ParamConverter("user", class="B55YargBundle:User", options={"mapping": {"user_slug": "usernameCanonical"}})
     * @ParamConverter("cv", class="B55YargBundle:Cv", options={"mapping": {"cv_slug": "slug"}})
     */
    public function showPublicAction(User $user, Cv $cv)
    {
        if (!$cv->getPublished()) {
          throw $this->createNotFoundException('This Cv doesn\'t exist or is not published anymore');
        }

        return $this->render(
            'B55YargBundle:Cvs:show.html.twig', array('authenticated' => false)
        );
    }

    /**
     * @paramconverter("cv", class="B55YargBundle:Cv", options={"mapping": {"slug": "slug"}})
     */
    public function editAction(Request $request, Cv $cv)
    {
        //TODO: Fix

        $form = $this->createForm(new CvForm(), $cv);
        $user = $this->get('security.context')->getToken()->getUser();

        $bool = false;
        $message = '';
        if ($user->getId() == $cv->getUser()->getId() && $request->getMethod() == 'POST') {
            $request = $this->getRequest();

            $form->bind($request);
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cv);
                $em->flush();
                $bool = true;
            }
        }

        $json = array(
            'status' => ($bool ? 'success' : 'error'),
            'message' => $message,
        );
        $response = new Response(json_encode($json));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

