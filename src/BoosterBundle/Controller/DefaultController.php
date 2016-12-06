<?php

namespace BoosterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function mayorAction()
    {
        return $this->render('BoosterBundle::mayor.html.twig');
    }
}
