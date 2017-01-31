<?php

namespace BoosterBundle\Controller;

use BoosterBundle\Entity\Expert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Expert controller.
 *
 */
class ExpertController extends Controller
{
    /**
     * Lists all expert entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $experts = $em->getRepository('BoosterBundle:Expert')->findAll();

        return $this->render('BoosterBundle:expert:index.html.twig', array(
            'experts' => $experts,
        ));
    }

    /**
     * Creates a new expert entity.
     *
     */
    public function newAction(Request $request)
    {
        $expert = new Expert();
        $form = $this->createForm('BoosterBundle\Form\ExpertType', $expert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expert);
            $em->flush($expert);

            return $this->redirectToRoute('expert_show', array('id' => $expert->getId()));
        }

        return $this->render('BoosterBundle:expert:new.html.twig', array(
            'expert' => $expert,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a expert entity.
     *
     */
    public function showAction(Expert $expert)
    {
        $deleteForm = $this->createDeleteForm($expert);

        return $this->render('BoosterBundle:expert:show.html.twig', array(
            'expert' => $expert,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing expert entity.
     *
     */
    public function editAction(Request $request, Expert $expert)
    {
        $deleteForm = $this->createDeleteForm($expert);
        $editForm = $this->createForm('BoosterBundle\Form\ExpertType', $expert);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expert_edit', array('id' => $expert->getId()));
        }

        return $this->render('BoosterBundle:expert:edit.html.twig', array(
            'expert' => $expert,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a expert entity.
     *
     */
    public function deleteAction(Expert $expert){
        $em = $this->getDoctrine()->getManager();
        $em->remove($expert);
        $em->flush($expert);


        return $this->redirectToRoute('expert_admin');


    }
}
