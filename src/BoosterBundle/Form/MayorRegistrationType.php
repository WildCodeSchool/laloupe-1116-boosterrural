<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MayorRegistrationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('address', null, array(
                'label'=>'Adresse'
            ))
            -> add('cp', null, array(
                'label'=>'Code postal'
            ))
            -> add('town', Null, array(
                'label'=>'Ville'
            ));
    }

    public function getParent(){
        return 'fos_user_registration';
    }

    public function getName() {
        return 'booster_mayor_registration';
    }
}