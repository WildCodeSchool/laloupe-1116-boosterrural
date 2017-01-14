<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MayorOfferType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array(
                'label'=>'Titre de l\'offre'
            ))
            ->add('cp', null, array(
                'label'=>'Code postal'
            ))
            ->add('town', null, array(
                'label'=>'Ville'
            ))
            ->add('activity', choiceType::class, array(
                'choices' => array(
                    'hobby' => 'Loisirs',
                    'craftsman'=> 'Artisan',
                    'benevolat'=> 'Bénévolats',
                    'communication'=>'Communication'
                ),
                'label'=>'Categorie'))

            ->add('description','textarea', array(
                'label'=>'Description de l\'offre'
            ))

            ->add('wish', choiceType::class, array(
                'choices' => array(
                    'dupliquate' => 'Dupliquer ce projet',
                    'formation'=> 'Former sur ce projet',
                    'help'=> 'Appuyer un projet similaire',
                    'tell'=>'Echanger sur ce projet'
                ),
                'label'=>'Souhaits'))

            ->add('file3', 'file', array('required' => false,
                'label'=>'fichier image'
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BoosterBundle\Entity\Offer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'boosterbundle_offer';
    }


}
