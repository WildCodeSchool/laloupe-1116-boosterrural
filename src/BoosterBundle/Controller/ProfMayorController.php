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
        $users = $em->getRepository('BoosterBundle:User')->findAll();

        $offers = $em->getRepository('BoosterBundle:Offer')->findBy(
            array('users'=>$user
            ));

        $needs = $em->getRepository('BoosterBundle:Needs')->findBy(
            array('users'=>$user
            ));


        $offersall = $em->getRepository('BoosterBundle:Offer')->createQueryBuilder('n')->join('n.users','u');
        $offersall = $offersall->where($offersall->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_ACTOR";}','a:1:{i:0;s:12:"ROLE_CITIZEN";}']))->            getQuery()->getResult(); //Trier toutes les offres (acteurs et citoyens) dans la page back


        $needsall = $em->getRepository('BoosterBundle:Needs')->createQueryBuilder('n')->join('n.users','u');
        $needsall = $needsall->where($needsall->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_ACTOR";}','a:1:{i:0;s:12:"ROLE_CITIZEN";}']))->                getQuery()->getResult(); //Trier touts les besoins (acteurs et citoyens) dans la page back


        return $this->render('BoosterBundle:Mayor:index.html.twig', array(
            'user'=>$user,
            'users'=>$users,
            'offers' => $offers,
            'needs' => $needs,
            'offersall' => $offersall,
            'needsall' => $needsall,
        ));
    }

    /************************NEW OFFER OR NEEDS *************************/

    public function newOfferAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $offer = new Offer();
        $offer->setUsers($user);
        $form = $this->createForm('BoosterBundle\Form\MayorOfferType', $offer,  array(
            'attr'=>array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush($offer);

            return $this->redirectToRoute('mayor_index', array('id' => $offer->getId(
                array($offer->getUsers()
                ))));

        }

        return $this->render('BoosterBundle:Mayor:newOffer.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView(),
        ));
    }

    public function newNeedAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $needs = new Needs();
        $needs->setUsers($user);
        $form = $this->createForm('BoosterBundle\Form\MayorNeedsType', $needs,  array(
            'attr'=>array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($needs);
            $em->flush($needs);

            return $this->redirectToRoute('mayor_index', array('id' => $needs->getId(
                array($needs->getUsers()
                ))));

        }

        return $this->render('BoosterBundle:Mayor:newNeeds.html.twig', array(
            'needs' => $needs,
            'form' => $form->createView(),
        ));
    }


    /************************SHOW OFFER OR NEEDS *************************/
    public function showOfferAction(Offer $offer)
    {

        return $this->render('BoosterBundle:Mayor:showOffer.html.twig', array(
            'offer' => $offer,

        ));
    }

    public function showNeedAction(Needs $need)
    {
        return $this->render('BoosterBundle:Mayor:showNeeds.html.twig', array(
            'need' => $need,

        ));
    }


    /************************EDIT OFFER OR NEEDS *************************/
    public function editOfferAction(Request $request, Offer $offer)
    {
        $form = $this->createForm('BoosterBundle\Form\MayorOfferType', $offer,  array(
            'attr'=>array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mayor_index', array('id' => $offer->getId()));
        }

        return $this->render('BoosterBundle:Mayor:editOffer.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView(),
        ));
    }

    public function editNeedAction(Request $request, Needs $need)
    {
        $form = $this->createForm('BoosterBundle\Form\MayorNeedsType', $need,  array(
            'attr'=>array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('mayor_index', array('id' => $need->getId()));
        }

        return $this->render('BoosterBundle:Mayor:editNeeds.html.twig', array(
            'need' => $need,
            'form' => $form->createView(),
        ));
    }

    public function editDescriptionAction(Request $request, User $user)
    {

        $form = $this->createForm('BoosterBundle\Form\DescriptionType', $user, array(
            'attr'=>array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mayor_index', array('id' => $user->getId()));
        }

        return $this->render('BoosterBundle:Mayor:editDescription.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),


        ));
    }
    public function editUserAction(Request $request, User $user)
    {


        $form = $this->createForm('BoosterBundle\Form\EditMayorRegistrationType', $user, array(
            'attr'=> array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mayor_index', array('id' => $user->getId()));
        }


        return $this->render('BoosterBundle:Mayor:editDescription.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),


        ));
    }
    public function editWordMayorAction(Request $request, User $user)
    {


        $form = $this->createForm('BoosterBundle\Form\WordMayorType', $user,  array(
            'attr'=>array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mayor_index', array('id' => $user->getId()));
        }

        return $this->render('BoosterBundle:Mayor:editWordMayor.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),

        ));
    }

    /************************ LIST OFFER OR NEEDS *************************/

    public function listOfferMayorAction()
    {
        $em = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('BoosterBundle:Offer')->createQueryBuilder('n')->join('n.users','u');
        $offers = $offers->where($offers->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_MAYOR";}']))->getQuery()->getResult();
        return $this->render('BoosterBundle:Mayor:listOfferMayor.html.twig', array(
            'offers' => $offers,
        ));
    }

    public function listNeedsMayorAction()
    {
        $em = $this->getDoctrine()->getManager();
        $needs = $em->getRepository('BoosterBundle:Needs')->createQueryBuilder('n')->join('n.users','u');
        $needs = $needs->where($needs->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_MAYOR";}']))->getQuery()->getResult();
        return $this->render('BoosterBundle:Mayor:listNeedsMayor.html.twig', array(
            'needs' => $needs,
        ));
    }

    public function listMayorAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('BoosterBundle:User')->createQueryBuilder('u');
        $users = $users->where($users->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_MAYOR";}']))->getQuery()->getResult();
        return $this->render('BoosterBundle:Mayor:listMayor.html.twig', array(
            'users' => $users,

        ));
    }


    /************************ DELETE OFFER OR NEEDS *************************/


    public function deleteOfferAction(Offer $offer){
        $em = $this->getDoctrine()->getManager();
        $em->remove($offer);
        $em->flush($offer);

        return $this->redirectToRoute('mayor_index');

    }
    public function deleteNeedsAction(Needs $needs){
        $em = $this->getDoctrine()->getManager();
        $em->remove($needs);
        $em->flush($needs);

        return $this->redirectToRoute('mayor_index');
    }

}




