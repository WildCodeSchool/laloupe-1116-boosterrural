<?php

namespace BoosterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function actorAction()
    {

        return $this->render('BoosterBundle::actor.html.twig');
    }
    public function home_page_no_connectAction()
    {
        return $this->render('BoosterBundle::home_page_no_connect.html.twig');
    }
    public function citizenAction()
    {

        return $this->render('BoosterBundle::citizen.html.twig');

    }

}
