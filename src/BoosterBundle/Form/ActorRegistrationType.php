<?php
namespace BoosterBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class ActorRegistrationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('organization', null, array(
                'label'=>'nom de la structure'
            ))
            -> add('lastname', null, array(
                'label'=>'nom du responsable'
            ))
            -> add('firstname', null, array(
                'label'=>'prénom du responsable'
            ))
            -> add('status_actor', ChoiceType::class, array(
                'choices' => array(
                    'Réseaux ' => 'Réseaux ',
                    'Acteur individuel' => 'Acteur individuel',
                    'TPE/Artisans' => 'TPE/Artisans'),
                'label'=>'statut'
            ))
            -> add('category', ChoiceType::class, array(
                'choices' => array(
                    'Développement durable' => 'Développement durable',
                    'Habitat' => 'Habitat',
                    'Agriculture/Agroalimentaire' => 'Agriculture/Agroalimentaire',
                    'Culture/Patrimoine' => 'Culture/Patrimoine',
                    'Mobilité' => 'Mobilité'),
                'label'=>'categorie'
            ))
            -> add('town', null, array(
                'label'=>'nom de la commune'
            ))
            -> add('cp', 'text', array(
                'label'=>'code postal'
            ))
            -> add('address', null, array(
                'label'=>'adresse postale'
            ));
    }
    public function getParent(){
        return 'fos_user_registration';
    }
    public function getName() {
        return 'booster_actor_registration';
    }
}