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
    public function showAction(Request $request, Cv $cv)
    {
        return $this->render(
            'B55YargBundle:Cvs:show.html.twig',
            array(
                'cv' => $cv,
                'authenticated' => ($request->query->get('preview') ? false : true),
                'user' => $this->get('security.context')->getToken()->getUser())
        );
    }

    /**
     * @ParamConverter("cv", class="B55YargBundle:Cv", options={"mapping": {"slug": "slug"}})
     */
    public function deleteAction(Request $request, Cv $cv)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($cv);
        $em->flush();

        $request->getSession()->getFlashBag()->add(
            'success', 'yarg.my_yarg.cv.deleted'
        );

        return $this->redirect($this->generateUrl('yarg_myyarg'));
    }

    /**
     * @ParamConverter("user", class="B55YargBundle:User", options={"mapping": {"user_slug": "usernameCanonical"}})
     * @ParamConverter("cv", class="B55YargBundle:Cv", options={"mapping": {"cv_slug": "slug"}})
     */
    public function showPublicAction(User $user, Cv $cv)
    {
        if (!$cv->getPublished()) {
          return new Response('This Cv doesn\'t exist or is not published anymore', 404);
        }

        $user = $this->get('security.context')->getToken()->getUser();
        return $this->render(
            'B55YargBundle:Cvs:show.html.twig',
            array('cv' => $cv, 'authenticated' => false, 'user' => $user)
        );
    }

    /**
     * @paramconverter("cv", class="B55YargBundle:Cv", options={"mapping": {"slug": "slug"}})
     */
    public function editAction(Request $request, Cv $cv)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new CvForm(), $cv, array(
            'action' => $this->generateUrl(
                'yarg_myyarg_edit_cv', array('slug' => $cv->getSlug())
            ),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cv);
                $em->flush();

                $request->getSession()->getFlashBag()->add(
                  'success', 'yarg.my_yarg.cv.edited.success'
                );

                return $this->redirect(
                    $this->generateUrl('yarg_myyarg_show_cv',
                    array('slug' => $cv->getSlug()))
                );
            }
        }

        return $this->render(
            'B55YargBundle:Cvs:add_content.html.twig',
            array('form' => $form->createView())
        );
    }
}

