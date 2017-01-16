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
            ->add('activity', ChoiceType::class, array (
                "label" => "Domaine d'activité",
                'choices'  => array(
                    "Choisir" => "Choisir",
                    "Loisirs" => "Loisirs",
                    "Artisan" => "Artisan",
                    "Bénévolat" => "Bénévolat",
                    "Communication" => "Communication")))
            ->add('description', null, [
                "label" => "Description"
            ])
            //->add('image2')
            ->add('file2','file', [
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
