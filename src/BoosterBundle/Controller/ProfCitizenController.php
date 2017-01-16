<?php

namespace BoosterBundle\Controller;

use BoosterBundle\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BoosterBundle\Entity\User;
use BoosterBundle\Entity\Needs;


class ProfCitizenController extends Controller
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


        return $this->render('BoosterBundle:Citizen:index.html.twig', array(
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

            return $this->redirectToRoute('citizen_showOffer', array('id' => $offer->getId(
                array($offer->getUsers()
            ))));

        }

        return $this->render('BoosterBundle:Citizen:newOffer.html.twig', array(
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
        return $this->render('BoosterBundle:Citizen:showOffer.html.twig', array(
            'offer' => $offer,

        ));
    }
    /**
     * Displays a form to edit an existing offer entity.
     *
     */
    public function editOfferAction(Request $request, Offer $offer)
    {

        $editForm = $this->createForm('BoosterBundle\Form\OfferType', $offer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('citizen_editOffer', array('id' => $offer->getId()));
        }

        return $this->render('BoosterBundle:Citizen:editNeeds.html.twig', array(
            'offer' => $offer,
            'edit_form' => $editForm->createView(),

        ));
    }



    /**
     * Lists all needs entities.
     */

    public function newNeedAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $needs = new Needs();
        $needs->setUsers($user);
        $form = $this->createForm('BoosterBundle\Form\CitizenRegistrationType', $needs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($needs);
            $em->flush($needs);

            return $this->redirectToRoute('citizen_showNeeds', array('id' => $needs->getId(
                array($needs->getUsers()
                ))));

        }

        return $this->render('BoosterBundle:Citizen:newNeeds.html.twig', array(
            'needs' => $needs,
            'form' => $form->createView(),
        ));
    }




    public function showNeedAction(Needs $need)
    {


        return $this->render('BoosterBundle:Citizen:showNeeds.html.twig', array(
            'need' => $need,

        ));
    }

    /**
     * Displays a form to edit an existing need entity.
     *
     */
    public function editNeedAction(Request $request, Needs $need)
    {

        $form = $this->createForm('BoosterBundle\Form\CitizenNeedsType', $need);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('citizen_editNeeds', array('id' => $need->getId()));
        }

        return $this->render('BoosterBundle:Citizen:editNeeds.html.twig', array(
            'need' => $need,
            'form' => $form->createView(),

        ));
    }

    public function listNeedsCitizenAction(){
        $em = $this->getDoctrine()->getManager();

        $needs = $em->getRepository('BoosterBundle:Needs')->findAll();

        return $this->render('BoosterBundle:Citizen:index.html.twig');
    }

    /************************DELETE OFFER OR NEEDS *************************/

    public function deleteOfferAction(Offer $offer){
        $em = $this->getDoctrine()->getManager();
        $em->remove($offer);
        $em->flush($offer);

        return $this->redirectToRoute('citizen_index');

    }
    public function deleteNeedsAction(Needs $needs){
        $em = $this->getDoctrine()->getManager();
        $em->remove($needs);
        $em->flush($needs);

        return $this->redirectToRoute('citizen_index');

    }
}
