<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CitizenRegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('Lastname', null, [
                "label" => "Nom"
            ])
            ->add('Firstname', null, [
                "label" => "Prénom"
            ])
        ;
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'boosterrural_citizenregister';
    }
}
