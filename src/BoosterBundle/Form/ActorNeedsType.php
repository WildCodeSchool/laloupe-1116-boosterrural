<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ActorNeedsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('title', null, [
            "label" => "Titre"
        ])
            ->add('cp', null, [
                "label" => "Code postal"
            ])
            ->add('town', null, [
                "label" => "Ville"
            ])
            ->add('activity', choiceType::class, array(
                'choices' => array(
                    'Choisir' => 'Choisir',
                    'agriculture, maraîchage, circuit court,...' => 'agriculture, maraîchage, circuit court,...',
                    'agro-alimentaire, transformation,...'=> 'agro-alimentaire, transformation,...',
                    'art et culture, bio-diversité, éco-conception... '=> 'art et culture, bio-diversité, éco-conception... ',
                    'éducation, énergie et eau, formation innovante,...'=>'éducation, énergie et eau, formation innovante,...',
                    'habillement, habitat, gouvernance et participation, gastronomie locale, patrimoine, recyclage,...'=>'habillement, habitat, gouvernance et participation, gastronomie locale, patrimoine, recyclage,...',
                    'rénovation, savoirs et transmissions, santé, tourisme alternatif, transport alternatif, web numérique, ...'=>'rénovation, savoirs et transmissions, santé, tourisme alternatif, transport alternatif, web numérique, ...'
                ),
                'label'=>"Domaine d'activité"
            ))
            ->add('description', null, [
                "label" => "Description"
            ])
            ->add('fileNeeds','file', [
                "label" => "Photo"],
                array( 'required'=>false))
        ;
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BoosterBundle\Entity\Needs'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'boosterbundle_needs';
    }


}
