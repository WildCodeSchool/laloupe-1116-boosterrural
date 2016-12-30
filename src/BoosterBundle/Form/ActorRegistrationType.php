<?php
namespace BoosterBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
            -> add('status_actor', null, array(
                'label'=>'statut'
            ))
            -> add('category', null, array(
                'label'=>'categorie'
            ))
            -> add('town', null, array(
                'label'=>'nom de la commune'
            ))
            -> add('cp', null, array(
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