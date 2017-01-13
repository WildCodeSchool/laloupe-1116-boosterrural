<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ActorOfferType extends AbstractType
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
                    'Choisir' => 'Choisir',
                    'agriculture, maraîchage, circuit court,...' => 'agriculture, maraîchage, circuit court,...',
                    'Agro-alimentaire, transformation,...'=> 'Agro-alimentaire, transformation,...',
                    'Art et culture, bio-diversité, éco-conception... '=> 'Art et culture, bio-diversité, éco-conception... ',
                    'Education, énergie et eau, formation innovante,...'=>'Education, énergie et eau, formation innovante,...',
                    'Habillement, habitat, gouvernance et participation, gastronomie locale, patrimoine, recyclage,...'=>'Habillement, habitat, gouvernance et participation, gastronomie locale, patrimoine, recyclage,...',
                    'Rénovation, savoirs et transmissions, santé, tourisme alternatif, transport alternatif, web numérique, ...'=>'Rénovation, savoirs et transmissions, santé, tourisme alternatif, transport alternatif, web numérique, ...'
                ),
                'label'=>'Catégorie'
                ))
            ->add('description', null, array(
                'label'=>'Description'
            ))
            ->add('wish', choiceType::class, array(
                'choices' => array(
                    'Choisir' => 'Choisir',
                    'Dupliquer ce projet' => 'Dupliquer ce projet',
                    'Former sur ce projet'=> 'Former sur ce projet',
                    'Appuyer un projet similaire'=> 'Appuyer un projet similaire',
                    'Echanger sur ce projet'=>'Echanger sur ce projet',
                    'Rechercher un associé'=>'Rechercher un associé',
                    'co-créer'=>'co-créer'
                ),
                'label'=>'Souhaits'))
        ;
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
