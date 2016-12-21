<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('town')
            -> add('cp')
            -> add('address');


    }

    public function getParent(){
        return 'fos_user_registration';
    }

    public function getName() {
        return 'booster_user_registration';
    }
}