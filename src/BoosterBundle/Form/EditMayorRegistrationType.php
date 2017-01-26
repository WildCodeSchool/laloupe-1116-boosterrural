<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditMayorRegistrationType extends AbstractType {

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
            ))
            -> add('website', Null, array(
                'label'=>'Site internet'
            ))
            -> add('phone', Null, array(
                'label'=>'Téléphone'
            ))
            -> add('resident', Null, array(
                'label'=>'Nombre d\'habitants'
            ))
            -> add('lastname', Null, array(
                'label'=>'Nom et prénom du maire'
            ))
            ->add('fileIdentity','file', [
                "label" => "Photo"],
                array( 'required'=>false));



        ;
    }

    public function getParent(){
        return 'fos_user_registration';
    }

    public function getName() {
        return 'booster_mayor_registration';
    }
}