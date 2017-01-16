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


    /************************NEW OFFER OR NEEDS *************************/
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


    public function newOfferAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $offer = new Offer();
        $offer->setUsers($user);
        $form = $this->createForm('BoosterBundle\Form\ActorOfferType', $offer);
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
    /************************SHOW OFFER OR NEEDS *************************/
    public function showOfferAction(Offer $offer)
    {

        return $this->render('BoosterBundle:Actor:showOffer.html.twig', array(
            'offer' => $offer,

        ));
    }

    public function showNeedAction(Needs $need)
    {

        return $this->render('BoosterBundle:Actor:showNeeds.html.twig', array(
            'need' => $need,

        ));
    }


    /************************EDIT OFFER OR NEEDS *************************/

    public function editOfferAction(Request $request, Offer $offer)
    {


        $form = $this->createForm('BoosterBundle\Form\ActorOfferType', $offer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actor_editOffer', array('id' => $offer->getId()));
        }

        return $this->render('BoosterBundle:Actor:editOffer.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView(),
        ));
    }

    public function editNeedAction(Request $request, Needs $need)
    {

        $form = $this->createForm('BoosterBundle\Form\ActorNeedsType', $need);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actor_editNeeds', array('id' => $need->getId()));
        }

        return $this->render('BoosterBundle:Actor:editNeeds.html.twig', array(
            'need' => $need,
            'form' => $form->createView(),

        ));
    }

    public function editDescriptionAction(Request $request, User $user)
    {

        $form = $this->createForm('BoosterBundle\Form\DescriptionType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actor_index', array('id' => $user->getId()));
        }

        return $this->render('BoosterBundle:Actor:editDescription.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),

        ));
    }
    public function editUserAction(Request $request, User $user)
    {

        $form = $this->createForm('BoosterBundle\Form\ActorRegistrationType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actor_index', array('id' => $user->getId()));
        }

        return $this->render('BoosterBundle:Actor:editDescription.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),


        ));
    }


    /************************LIST OFFER OR NEEDS *************************/

    public function listOfferActorAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('BoosterBundle:Offer')->createQueryBuilder('n')->join('n.users','u');
        $offers = $offers->where($offers->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_ACTOR";}']))->getQuery()->getResult();
        return $this->render('BoosterBundle:Actor:listOfferActor.html.twig', array(
            'offers' => $offers,
        ));
    }

    public function listNeedsActorAction()
    {
        $em = $this->getDoctrine()->getManager();
        $needs = $em->getRepository('BoosterBundle:Needs')->createQueryBuilder('n')->join('n.users','u');
        $needs = $needs->where($needs->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_ACTOR";}']))->getQuery()->getResult();
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
