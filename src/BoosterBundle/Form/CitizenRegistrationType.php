<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CitizenRegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('lastname', null, [
                "label" => "Nom et Prénom"
            ])

            -> add('status_citizen', ChoiceType::class, array(
                'choices' => array(

                    'actif' => 'actif',
                    'retraité' => 'retraité',
                    'en recherche d\'emploi' => 'en recherche d\'emploi'),
                'placeholder'=>'Choisir',
                'label'=>'statut'

            ));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'booster_citizen_registration';
    }
}
