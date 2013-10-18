<?php

namespace B55\Bundle\YargBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use B55\Bundle\YargBundle\Entity\Cv;
use B55\Bundle\YargBundle\Entity\Category;
use B55\Bundle\YargBundle\Form\CategoryForm;

class CategoriesController extends Controller
{
    /**
     * ParamConverter("cv", class="B55YargBundle:Cv", options={"mapping": {"slug": "slug"}})
     */
    public function addAction(Request $request, Cv $cv, $parent = null)
    {
        $category = new Category();
        $category->setCv($cv);

        $form = $this->createForm(
            new CategoryForm(), $category,
            array(
                'action' => $this->generateUrl(
                    'yarg_myyarg_add_category',
                    array('slug' => $cv->getSlug(), 'parent' => $parent)
                )
            )
        );

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            $state = 'error';
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                if ($parent) {
                    $repository = $em->getRepository('B55YargBundle:Category');
                    $category_parent = $repository->find($parent);
                    if ($category_parent instanceof Category) {
                        $category->setParent($category_parent);
                        $em->persist($category);
                    }
                }
                else {
                    $cv->addCategorie($category);
                    $em->persist($cv);
                }

                $em->flush();
                $state = 'success';
            }

            $request->getSession()->getFlashBag()->add(
                $state, 'yarg.my_yarg.cv.category.created.' . $state
            );
            return $this->redirect(
                $this->generateUrl(
                    'yarg_myyarg_show_cv',
                    array('slug' => $cv->getSlug())
                )
            );
        }

        return $this->render(
            'B55YargBundle:Categories:add_content.html.twig',
            array('form' => $form->createView())
        );
    }
}
