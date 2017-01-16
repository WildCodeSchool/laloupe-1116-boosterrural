<?php

namespace BoosterBundle\Controller;

use BoosterBundle\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BoosterBundle\Entity\User;
use BoosterBundle\Entity\Needs;

/**
 *
 *
 */
class ProfActorController extends Controller
{

    public function indexAction()
    {
        $user = $this->getUser();


        $user=$this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('BoosterBundle:User')->findAll();

        $offers = $em->getRepository('BoosterBundle:Offer')->findBy(
            array('users'=>$user
            ));

        $needs = $em->getRepository('BoosterBundle:Needs')->findBy(
            array('users'=>$user
            ));


        return $this->render('BoosterBundle:Actor:index.html.twig', array(
            'user'=>$user,
            'users'=>$users,
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
        return $this->render('BoosterBundle:Actor:showOffer.html.twig', array(
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

            return $this->redirectToRoute('actor_editOffer', array('id' => $offer->getId()));
        }

        return $this->render('BoosterBundle:Actor:editOffer.html.twig', array(
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

        return $this->render('BoosterBundle:Actor:showNeeds.html.twig', array(
            'need' => $need,

        ));
    }

    /**
     * Displays a form to edit an existing need entity.
     *
     */
    public function editNeedAction(Request $request, Needs $need)
    {

        $editForm = $this->createForm('BoosterBundle\Form\ActorNeedsType', $need);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actor_editNeeds', array('id' => $need->getId()));
        }

        return $this->render('BoosterBundle:Actor:editNeeds.html.twig', array(
            'need' => $need,
            'edit_form' => $editForm->createView(),
        ));
    }


    public function listNeedsActorAction()
    {
        $em = $this->getDoctrine()->getManager();

        $needs = $em->getRepository('BoosterBundle:Needs')->findAll();

        return $this->render('BoosterBundle:Actor:listNeedsActor.html.twig', array(
            'needs' => $needs,
        ));
    }


    /************************DELETE OFFER OR NEEDS *************************/

    public function deleteOfferAction(Offer $offer){
        $em = $this->getDoctrine()->getManager();
        $em->remove($offer);
        $em->flush($offer);

        return $this->redirectToRoute('actor_index');

    }
    public function deleteNeedsAction(Needs $needs){
        $em = $this->getDoctrine()->getManager();
        $em->remove($needs);
        $em->flush($needs);

        return $this->redirectToRoute('actor_index');

    }
}
