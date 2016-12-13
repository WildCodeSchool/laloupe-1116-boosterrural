<?php

namespace BoosterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function actorAction()
    {
        return $this->render('BoosterBundle::actor.html.twig');
    }
}
