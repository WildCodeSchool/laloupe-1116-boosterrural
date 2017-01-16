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


        return $this->render('BoosterBundle:Mayor:index.html.twig', array(
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
        $form = $this->createForm('BoosterBundle\Form\MayorOfferType', $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cp = $offer->getCp();
            $town = $offer->getTown();
            $plainAddress = $cp . '%20' . $town;


            $url = "https://maps.google.com/maps/api/geocode/json?address=" . $plainAddress . "&key=AIzaSyBSFjZGurwwEtOnMOg1mKgJgS3WcP8ucrk";


// get the json response
            $resp_json = file_get_contents($url);

// decode the json
            $resp = json_decode($resp_json, true);

// response status will be 'OK', if able to geocode given address
            if ($resp['status'] == 'OK') {

                // get the important data
                $lat = $resp['results'][0]['geometry']['location']['lat'];
                $lgt = $resp['results'][0]['geometry']['location']['lng'];


                // verify if data is complete
                if ($lat && $lgt) {
                    $offer->setLat($lat);
                    $offer->setLgt($lgt);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($offer);
                    $em->flush($offer);

                }

                return $this->redirectToRoute('mayor_showOffer', array('id' => $offer->getId(
                    array($offer->getUsers()
                    ))));

            }

            return $this->render('BoosterBundle:Mayor:newOffer.html.twig', array(
                'offer' => $offer,
                'form' => $form->createView(),
            ));
        }
    }
    /**
     * Finds and displays a offer entity.
     *
     */
    public function showOfferAction(Offer $offer)
    {

        return $this->render('BoosterBundle:Mayor:showOffer.html.twig', array(
            'offer' => $offer,

        ));
    }
    /**
     * Displays a form to edit an existing offer entity.
     *
     */
    public function editOfferAction(Request $request, Offer $offer)
    {

        $form = $this->createForm('BoosterBundle\Form\OfferType', $offer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mayor_editOffer', array('id' => $offer->getId()));
        }

        return $this->render('BoosterBundle:Mayor:editOffer.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView(),


        ));
    }


    public function listOfferMayorAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('BoosterBundle:Offer')->createQueryBuilder('n')->join('n.users','u');
        $offers = $offers->where($offers->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_MAYOR";}']))->getQuery()->getResult();
        return $this->render('BoosterBundle:Mayor:listOfferMayor.html.twig', array(
            'offers' => $offers,
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
        $form = $this->createForm('BoosterBundle\Form\MayorNeedsType', $needs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($needs);
            $em->flush($needs);

            return $this->redirectToRoute('mayor_showNeeds', array('id' => $needs->getId(
                array($needs->getUsers()
                ))));

        }

        return $this->render('BoosterBundle:Mayor:newNeeds.html.twig', array(
            'needs' => $needs,
            'form' => $form->createView(),
        ));
    }

    public function showNeedAction(Needs $need)
    {
        return $this->render('BoosterBundle:Mayor:showNeeds.html.twig', array(
            'need' => $need,

        ));
    }

    /**
     * Displays a form to edit an existing need entity.
     *
     */
    public function editNeedAction(Request $request, Needs $need)
    {

        $form = $this->createForm('BoosterBundle\Form\MayorNeedsType', $need);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('mayor_editNeeds', array('id' => $need->getId()));
        }

        return $this->render('BoosterBundle:Mayor:editNeeds.html.twig', array(
            'need' => $need,
            'form' => $form->createView(),

        ));
    }

    public function listNeedsMayorAction()
    {
        $em = $this->getDoctrine()->getManager();

        $needs = $em->getRepository('BoosterBundle:Needs')->findAll();

        return $this->render('BoosterBundle:Mayor:listNeedsMayor.html.twig', array(
            'needs' => $needs,
        ));
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

    public function editDescriptionAction(Request $request, User $user)
    {

        $form = $this->createForm('BoosterBundle\Form\DescriptionType', $user);
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


        $form = $this->createForm('BoosterBundle\Form\MayorRegistrationType', $user);
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


        $needs = $em->getRepository('BoosterBundle:Needs')->createQueryBuilder('n')->join('n.users','u');
        $needs = $needs->where($needs->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_MAYOR";}']))->getQuery()->getResult();
        return $this->render('BoosterBundle:Mayor:listNeedsMayor.html.twig', array(
            'needs' => $needs,
        ));
    }

    public function listMayorAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('BoosterBundle:User')->createQueryBuilder('u');
        $user = $user->where($user->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_MAYOR";}']))->getQuery()->getResult();
        return $this->render('BoosterBundle:Mayor:listMayor.html.twig', array(
            'user' => $user,
        ));
    }
}




