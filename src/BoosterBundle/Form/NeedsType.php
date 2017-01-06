<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NeedsType extends AbstractType
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
                ->add('description', null, [
                    "label" => "Description"
                ])
                ->add('activity', null, [
                    "label" => "Domaine d'activité"
                ])
                ->add('users', null, [
                    "label" => ""
                ])
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
