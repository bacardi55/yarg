<?php

namespace B55\Bundle\YargBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use B55\Bundle\YargBundle\Entity\Cv;
use B55\Bundle\YargBundle\Entity\Category;
use B55\Bundle\YargBundle\Entity\Information;
use B55\Bundle\YargBundle\Form\InformationForm;

class InformationsController extends Controller
{
    /**
     * ParamConverter("cv", class="B55YargBundle:Cv", options={"mapping": {"slug": "slug"}})
     */
    public function addToCategoryAction(Request $request, Cv $cv, $category_id)
    {
        $em = $this->getDoctrine()->getManager();

        $catRepo = $em->getRepository('B55YargBundle:Category');
        $category = $catRepo->find($category_id);

        $info = new Information();
        $info->setCategory($category);

        $form = $this->createForm(
            new InformationForm(),
            $info,
            array(
                'action' => $this->generateUrl(
                    'yarg_myyarg_add_category_info',
                    array(
                        'slug' => $cv->getSlug(),
                        'category_id' => $category->getId(),
                    )
                ),
            )
        );

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            $state = 'error';

            if ($form->isValid()) {
                $category->addInformation($info);
                $em->persist($category);
                $em->flush();

                $state = 'success';
            }

            $request->getSession()->getFlashBag()->add(
                $state,
                'yarg.my_yarg.cv.category.information.created.' . $state
            );

            return $this->redirect(
                $this->generateUrl(
                    'yarg_myyarg_show_cv',
                    array('slug' => $cv->getSlug())
                )
            );
        }

        return $this->render(
            'B55YargBundle:Informations:add_content.html.twig',
            array('form' => $form->createView())
        );
    }

    public function addToUser() {}
}
