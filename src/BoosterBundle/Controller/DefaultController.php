<?php

namespace BoosterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function home_page_no_connectAction()
    {
        return $this->render('BoosterBundle::home_page_no_connect.html.twig');
    }
}
