<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CitizenNeedsType extends AbstractType
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

            ->add('development', choiceType::class, array(
                'choices' => array(
                    //DD
                    'Biodiversité' => 'Biodiversité',
                    'Eco-conception' => 'Eco-conception',
                    'Economie circulaire' => 'Economie circulaire',
                    'Energie / eau optimisées' => 'Energie / eau optimisées',
                    'Gouvernance et participation' => 'Gouvernance et participation',
                    'Recyclage' => 'Recyclage',
                    'Ressourceries' => 'Ressourceries',
                    'Mode ou textile "éco"' => 'Mode ou textile "éco"',
                    'Santé alternative' => 'Santé alternative'
                ),
                'label'=>'Categorie',
                'placeholder'=>'Choisir'))

            ->add('habitation', choiceType::class, array(
                'choices' => array(
                    //habitat
                    'Rénovation thermique' => 'Rénovation thermique',
                    'Matériaux "éco" ou locaux' => 'Matériaux "éco" ou locaux'
                ),
                'label'=>'Categorie',
                'placeholder'=>'Choisir'))

            ->add('culture', choiceType::class, array(
                'choices' => array(
                    //Culture
                    'Education' => 'Education',
                    'Formation innovante' => 'Formation innovante',
                    'Gastronomie locale' => 'Gastronomie locale',
                    'Savoirs et transmissions' => 'Savoirs et transmissions',
                    'Tourisme alternatif' => 'Tourisme alternatif'
                ),
                'label'=>'Categorie',
                'placeholder'=>'Choisir'))

            ->add('agriculture', choiceType::class, array(
                'choices' => array(
                    //Agri
                    'Agriculture bio, maraîchage, circuits courts' => 'Agriculture bio, maraîchage, circuits courts',
                    'Agro-alimentaire, transformation' => 'Agro-alimentaire, transformation',
                    'Commerces innovants et locaux' => 'Commerces innovants et locaux'
                ),
                'label'=>'Categorie',
                'placeholder'=>'Choisir'))

            ->add('transportation', choiceType::class, array(
                'choices' => array(
                    //mobilité
                    'Transport alternatif, co-voiturage' => 'Transport alternatif, co-voiturage'
                ),
                'label'=>'Categorie',
                'placeholder'=>'Choisir'))

            ->add('wish', ChoiceType::class, array (
                "label" => "Je cherche",
                'placeholder'=>'Choisir',
                'choices'  => array(
                    "un stage" => "un stage",
                    "un environnement agricole, créatif..." => "un environnement agricole, créatif...",
                    "des personnes en phase avec mon projet" => "des personnes en phase avec mon projet",
                    "du coaching pour me lancer" => "du coaching pour me lancer")))
            ->add('availability', null, [
                "label" => "Disponibilité",

            ])
            ->add('description', null, [
                "label" => "Description"
            ])
            ->add('fileNeeds','file', [
                "label" => "Photo"],
                array( 'required'=>false));
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
        return 'boosterbundle_citizenNeeds';
    }
}
