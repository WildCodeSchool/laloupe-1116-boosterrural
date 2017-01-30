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
        $users = $em->getRepository('BoosterBundle:User')->findAll();

        $offers = $em->getRepository('BoosterBundle:Offer')->findBy(
            array('users'=>$user
            ));

        $needs = $em->getRepository('BoosterBundle:Needs')->findBy(
            array('users'=>$user
            ));


        $offersall = $em->getRepository('BoosterBundle:Offer')->createQueryBuilder('n')->join('n.users','u');
        $offersall = $offersall->where($offersall->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_ACTOR";}','a:1:{i:0;s:10:"ROLE_MAYOR";}']))->            getQuery()->getResult(); //Trier toutes les offres (acteurs et maires) dans la page back


        $needsall = $em->getRepository('BoosterBundle:Needs')->createQueryBuilder('n')->join('n.users','u');
        $needsall = $needsall->where($needsall->expr()->in('u.roles', ['a:1:{i:0;s:10:"ROLE_ACTOR";}','a:1:{i:0;s:10:"ROLE_MAYOR";}']))->                getQuery()->getResult(); //Trier touts les besoins (acteurs et maires) dans la page back


        return $this->render('BoosterBundle:Citizen:index.html.twig', array(
            'user'=>$user,
            'users'=>$users,
            'offers' => $offers,
            'needs' => $needs,
            'offersall' => $offersall,
            'needsall' => $needsall,
        ));
    }

   /*********************************NEW OFFER AND NEEDS************************************************/
    public function newOfferAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $offer = new Offer();
        $offer->setUsers($user);
        $form = $this->createForm('BoosterBundle\Form\CitizenOfferType', $offer, array(
            'attr'=>array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush($offer);

            return $this->redirectToRoute('citizen_index', array('id' => $offer->getId(
                array($offer->getUsers()
                ))));

        }

        return $this->render('BoosterBundle:Citizen:newOffer.html.twig', array(
            'offer' => $offer,
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    public function newNeedAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $needs = new Needs();
        $needs->setUsers($user);
        $form = $this->createForm('BoosterBundle\Form\CitizenNeedsType', $needs, array(
            'attr'=>array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($needs);
            $em->flush($needs);

            return $this->redirectToRoute('citizen_index', array('id' => $needs->getId(
                array($needs->getUsers()
                ))));

        }

        return $this->render('BoosterBundle:Citizen:newNeeds.html.twig', array(
            'needs' => $needs,
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /*****************SHOW OFFER AND NEEDS ***************************************************/
    public function showOfferAction(Offer $offer)
    {

        return $this->render('BoosterBundle:Citizen:showOffer.html.twig', array(
            'offer' => $offer,

        ));
    }

    public function showNeedAction(Needs $need)
    {
        return $this->render('BoosterBundle:Citizen:showNeeds.html.twig', array(
            'need' => $need,

        ));
    }
  /*****************************************EDIT OFFER AND NEEDS******************************************************/
    public function editOfferAction(Request $request, Offer $offer)
    {


        $form = $this->createForm('BoosterBundle\Form\CitizenOfferType', $offer,  array(
            'attr'=>array('novalidate'=>'novalidate')
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('citizen_index', array('id' => $offer->getId()));
        }

        return $this->render('BoosterBundle:Citizen:editOffer.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView()
        ));

    }
    public function editNeedAction(Request $request, Needs $need)
    {

        $form = $this->createForm('BoosterBundle\Form\CitizenNeedsType', $need,  array(
            'attr'=>array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('citizen_index', array('id' => $need->getId()));
        }

        return $this->render('BoosterBundle:Citizen:editNeeds.html.twig', array(
            'need' => $need,
            'form' => $form->createView(),

        ));
    }


    public function editDescriptionAction(Request $request, User $user)
    {

        $form = $this->createForm('BoosterBundle\Form\DescriptionType', $user,  array(
            'attr'=>array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('citizen_index', array('id' => $user->getId()));
        }


        return $this->render('BoosterBundle:Citizen:editDescription.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),

        ));
    }


    public function editUserAction(Request $request, User $user)
    {

        $form = $this->createForm('BoosterBundle\Form\EditCitizenRegistrationType', $user,  array(
            'attr'=>array('novalidate'=>'novalidate')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $plainAddress = $user->getCp() . '%20' . str_replace(' ', '%20', $user->getTown());
            $result = $this->geocodeAction($plainAddress);
            $lat = $result[0];
            $lgt = $result[1];
            $user->setLat($lat);
            $user->setLgt($lgt);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush($user);



            /*$this->getDoctrine()->getManager()->flush();*/



            return $this->redirectToRoute('citizen_index', array('id' => $user->getId()));
        }

        return $this->render('BoosterBundle:Citizen:editUser.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),


        ));
    }
/*****************************************LIST OFFER AND NEEDS ***************************************************/
    public function listOfferCitizenAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('BoosterBundle:Offer')->createQueryBuilder('n')->join('n.users','u');
        $offers = $offers->where($offers->expr()->in('u.roles', ['a:1:{i:0;s:12:"ROLE_CITIZEN";}']))->getQuery()->getResult();
        return $this->render('BoosterBundle:Citizen:listOfferCitizen.html.twig', array(
            'offers' => $offers,
        ));
    }


    public function listNeedsCitizenAction(){
        $em = $this->getDoctrine()->getManager();
        $needs = $em->getRepository('BoosterBundle:Needs')->createQueryBuilder('n')->join('n.users','u');
        $needs = $needs->where($needs->expr()->in('u.roles', ['a:1:{i:0;s:12:"ROLE_CITIZEN";}']))->getQuery()->getResult();
        return $this->render('BoosterBundle:Citizen:listNeedsCitizen.html.twig', array(
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

    /**
     *
     * We use this API to recover latitude and longitude.
     *
     * */
    public function geocodeAction($plainAddress){
        $user = new User();


        $url = "https://maps.google.com/maps/api/geocode/json?address=". $plainAddress ."&key=AIzaSyBSFjZGurwwEtOnMOg1mKgJgS3WcP8ucrk";
// get the json response
        $resp_json = file_get_contents($url);
// decode the json
        $resp = json_decode($resp_json, true);
// response status will be 'OK', if able to geocode given address
        if ($resp['status'] == 'OK') {
            // get the important data

            //ici il récupére les données du fichier Json générer plus haut
            $lat = $resp['results'][0]['geometry']['location']['lat'];
            $lgt = $resp['results'][0]['geometry']['location']['lng'];
            // verify if data is complete
// je veux retourner la latitude et la longitude a mon mayorController
            return array($lat, $lgt);


        }
    }

}
