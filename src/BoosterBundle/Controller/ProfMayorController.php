<?php

namespace BoosterBundle\Controller;

use BoosterBundle\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BoosterBundle\Entity\User;
use BoosterBundle\Entity\Needs;

/**
 * Offer controller.
 *
 */
class ProfMayorController extends Controller
{

    public function indexAction()
    {
        $user = $this->getUser();
        $user=$this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('BoosterBundle:Offer')->findBy(
            array('users'=>$user
            ));

        $needs = $em->getRepository('BoosterBundle:Needs')->findBy(
            array('users'=>$user
            ));


        return $this->render('BoosterBundle:Actor:index.html.twig', array(
            'user'=>$user,
            'offers' => $offers,
            'needs' => $needs,

        ));
    }

    /**
     * Lists all offer entities.
     *
     */

    /**
     * Creates a new offer entity.
     *
     */
    public function newOfferAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $offer = new Offer();
        $offer->setUsers($user);
        $form = $this->createForm('BoosterBundle\Form\OfferType', $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush($offer);

            return $this->redirectToRoute('actor_showOffer', array('id' => $offer->getId(
                array($offer->getUsers()
            ))));

        }

        return $this->render('BoosterBundle:Actor:newOffer.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a offer entity.
     *
     */
    public function showOfferAction(Offer $offer)
    {
        $deleteForm = $this->createDeleteForm($offer);

        return $this->render('BoosterBundle:Actor:showOffer.html.twig', array(
            'offer' => $offer,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing offer entity.
     *
     */
    public function editOfferAction(Request $request, Offer $offer)
    {
        $deleteForm = $this->createDeleteForm($offer);
        $editForm = $this->createForm('BoosterBundle\Form\OfferType', $offer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actor_editOffer', array('id' => $offer->getId()));
        }

        return $this->render('BoosterBundle:Actor:editNeeds.html.twig', array(
            'offer' => $offer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a offer entity.
     *
     */
    public function deleteOfferAction(Request $request, Offer $offer)
    {
        $form = $this->createDeleteForm($offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($offer);
            $em->flush($offer);
        }

        return $this->redirectToRoute('actor_index');
    }

    /**
     * Creates a form to delete a offer entity.
     *
     * @param Offer $offer The offer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Offer $offer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('actor_deleteOffer', array('id' => $offer->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * Lists all needs entities.
     */

    public function newNeedAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $needs = new Needs();
        $needs->setUsers($user);
        $form = $this->createForm('BoosterBundle\Form\ActorNeedsType', $needs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($needs);
            $em->flush($needs);

            return $this->redirectToRoute('actor_showNeeds', array('id' => $needs->getId(
                array($needs->getUsers()
                ))));

        }

        return $this->render('BoosterBundle:Actor:newNeeds.html.twig', array(
            'needs' => $needs,
            'form' => $form->createView(),
        ));
    }




    public function showNeedAction(Needs $need)
    {
        $deleteForm = $this->createNeedDeleteForm($need);

        return $this->render('BoosterBundle:Actor:showNeeds.html.twig', array(
            'need' => $need,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing need entity.
     *
     */
    public function editNeedAction(Request $request, Needs $need)
    {
        $deleteForm = $this->createNeedDeleteForm($need);
        $editForm = $this->createForm('BoosterBundle\Form\ActorNeedsType', $need);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actor_editNeeds', array('id' => $need->getId()));
        }

        return $this->render('BoosterBundle:Actor:editNeeds.html.twig', array(
            'need' => $need,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a need entity.
     *
     */
    public function deleteNeedAction(Request $request, Needs $need)
    {
        $form = $this->createDeleteForm($need);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($need);
            $em->flush($need);
        }

        return $this->redirectToRoute('actor_index');
    }

    /**
     * Creates a form to delete a need entity.
     *
     * @param Needs $need The need entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNeedDeleteForm(Needs $need)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('actor_deleteNeeds', array('id' => $need->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function listNeedsMayorAction()
    {
        $em = $this->getDoctrine()->getManager();

        $needs = $em->getRepository('BoosterBundle:Needs')->findAll();

        return $this->render('BoosterBundle:Mayor:listNeedsMayor.html.twig', array(
            'needs' => $needs,
        ));
    }
}
