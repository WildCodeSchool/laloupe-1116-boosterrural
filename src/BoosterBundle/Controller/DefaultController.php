<?php
namespace BoosterBundle\Controller;

use BoosterBundle\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BoosterBundle\Entity\User;
use BoosterBundle\Entity\Needs;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

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

    public function actorAction(User $user)
    {

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

    public function citizenAction(User $user)
    {

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

    public function mayorAction(User $user)
    {

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

    public function adminAction()
    {
        return $this->render('BoosterBundle:SuperAdmin:index.html.twig');

    }

    public function userAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('BoosterBundle:User')->findAll();

        return $this->render('BoosterBundle:SuperAdmin:user.html.twig', array(
            'users' => $users,
        ));
    }

    public function deleteUserAction(User $user){

        $em = $this->getDoctrine()->getManager();
        $user->setEnabled(false);
        $em->persist($user);
        $em->flush($user);


        return $this->redirectToRoute('booster_user');


    }
}