<?php

namespace BoosterBundle\Controller;

use BoosterBundle\Entity\Partners;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Partner controller.
 *
 */
class PartnersController extends Controller
{
    /**
     * Lists all partner entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partners = $em->getRepository('BoosterBundle:Partners')->findAll();

        return $this->render('BoosterBundle:partners:index.html.twig', array(
            'partners' => $partners,
        ));
    }

    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partners = $em->getRepository('BoosterBundle:Partners')->findAll();

        return $this->render('BoosterBundle:partners:admin.html.twig', array(
            'partners' => $partners,
        ));
    }

    /**
     * Creates a new partner entity.
     *
     */
    public function newAction(Request $request)
    {
        $partner = new Partners();
        $form = $this->createForm('BoosterBundle\Form\PartnersType', $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush($partner);

            return $this->redirectToRoute('partners_show', array('id' => $partner->getId()));
        }

        return $this->render('BoosterBundle:partners:new.html.twig', array(
            'partner' => $partner,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a partner entity.
     *
     */
    public function showAction(Partners $partner)
    {


        return $this->render('BoosterBundle:partners:show.html.twig', array(
            'partner' => $partner,

        ));
    }

    /**
     * Displays a form to edit an existing partner entity.
     *
     */
    public function editAction(Request $request, Partners $partner)
    {

        $editForm = $this->createForm('BoosterBundle\Form\PartnersType', $partner);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partners_edit', array('id' => $partner->getId()));
        }

        return $this->render('BoosterBundle:partners:edit.html.twig', array(
            'partner' => $partner,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a partner entity.
     *
     */


    public function deleteAction(Partners $partner){
        $em = $this->getDoctrine()->getManager();
        $em->remove($partner);
        $em->flush($partner);


        return $this->redirectToRoute('partners_admin');


    }
}
