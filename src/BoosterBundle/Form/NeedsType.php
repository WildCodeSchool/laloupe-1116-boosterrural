<?php

namespace BoosterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('activity', ChoiceType::class, array (
                "label" => "Domaine d'activité",
                'choices'  => array(
                    'hobbies' => "Loisirs",
                    'artisan' => "Artisan",
                    'voluntary' => "Bénévolat",
                    'communication' => "Communication")))
            ->add('description', null, [
                "label" => "Description"
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
