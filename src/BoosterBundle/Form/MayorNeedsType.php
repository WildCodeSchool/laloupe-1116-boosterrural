<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MayorNeedsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', null, array(
                'label'=>'titre du besoin'
            ))
            ->add('cp', 'text', array(
                'label'=>'code postal'
            ))
            ->add('town', null, array(
                'label'=>'nom de la commune'
            ))
            ->add('description', null, array(
                'label'=>'description du besoin'
            ))
            //->add('image3', null, array(
                //'label'=>'ajouter une image'
            //))
            ->add('fileNeeds', 'file', array('required' => false,
                'label'=>'Photo'
            ));
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
