<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class DescriptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('description', 'textarea', [
            "label" => "Pourquoi nous sommes dynamiques ?"
        ])
            ->add('fileDescription1','file', [
                "label" => "Photo 1"],
                array( 'required'=>false))
            ->add('fileDescription2','file', [
                "label" => "Photo 2"],
                array( 'required'=>false))
            ->add('fileDescription3','file', [
                "label" => "Photo 3"],
                array( 'required'=>false));





        ;
    }



    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BoosterBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'boosterbundle_description';
    }


}
