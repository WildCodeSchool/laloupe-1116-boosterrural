<?php
namespace BoosterBundle\Controller;

use BoosterBundle\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BoosterBundle\Entity\User;
use BoosterBundle\Entity\Needs;

class DefaultController extends Controller
{
    public function home_page_no_connectAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('BoosterBundle:User')->findAll();

        return $this->render('BoosterBundle::home_page_no_connect.html.twig', array(
            'users'=>$users,
            'user'=>$user,

        ));

    }

    public function actorAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('BoosterBundle:User')->findAll();
        $offers = $em->getRepository('BoosterBundle:Offer')->findBy(
            array('users'=>$user
            ));
        $needs = $em->getRepository('BoosterBundle:Needs')->findBy(
            array('users'=>$user
            ));
        return $this->render('BoosterBundle::actor.html.twig', array(
            'users'=>$users,
            'user'=>$user,
            'offers' => $offers,
            'needs' => $needs,
        ));
    }

    public function citizenAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('BoosterBundle:User')->findAll();
        $offers = $em->getRepository('BoosterBundle:Offer')->findBy(
            array('users'=>$user
            ));
        $needs = $em->getRepository('BoosterBundle:Needs')->findBy(
            array('users'=>$user
            ));
        return $this->render('BoosterBundle::citizen.html.twig', array(
            'users'=>$users,
            'user'=>$user,
            'offers' => $offers,
            'needs' => $needs,
        ));

    }

    public function mayorAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('BoosterBundle:User')->findAll();
        $offers = $em->getRepository('BoosterBundle:Offer')->findBy(
            array('users'=>$user
            ));
        $needs = $em->getRepository('BoosterBundle:Needs')->findBy(
            array('users'=>$user
            ));
        return $this->render('BoosterBundle::mayor.html.twig', array(
            'users'=>$users,
            'user'=>$user,
            'offers' => $offers,
            'needs' => $needs,
        ));
    }
}