<?php
namespace BoosterBundle\DataFixtures\ORM;


use Doctrine\Common\Persistence\ObjectManager;
use BoosterBundle\Entity\Offer;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;


class LoadOfferData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {


        //addition an offer for the mayor 1

        $offerMayor1 = new Offer();
        $offerMayor1->setTitle('Raccordement gratuit à la fibre optique');
        $offerMayor1->setCp('48130');
        $offerMayor1->setTown('Aumont-Aubrac');
        $offerMayor1->setActivity('Communication');
        $offerMayor1->setDescription('prolongation de la fibre optique jusqu\’à la zone d\’activités du Pêcher.');
        $offerMayor1->setWish('Echanger sur ce projet');
        $offerMayor1->setImageOffer('');
        $offerMayor1->setUsers($this->getReference("mayor"));
        $manager->persist($offerMayor1);


        //addition an offer for the actor 1

        $offerActor1 = new Offer();
        $offerActor1->setTitle('Locaux vacants');
        $offerActor1->setCp('48130');
        $offerActor1->setTown('Aumont-Aubrac');
        $offerActor1->setActivity('Communication');
        $offerActor1->setDescription('Loue locaux vacant pouvant profiter à des artisans. Locaux de 300m² au nombre de 5');
        $offerActor1->setWish('Echanger sur ce projet');
        $offerActor1->setImageOffer('');
        $offerActor1->setUsers($this->getReference("actor"));
        $manager->persist($offerActor1);

        $offerCitizen1 = new Offer();
        $offerCitizen1->setTitle('Raccordement gratuit à la fibre optique');
        $offerCitizen1->setCp('48130');
        $offerCitizen1->setTown('Aumont-Aubrac');
        $offerCitizen1->setActivity('Communication');
        $offerCitizen1->setDescription('prolongation de la fibre optique jusqu\’à la zone d\’activités du Pêcher.');
        $offerCitizen1->setWish('Echanger sur ce projet');
        $offerCitizen1->setImageOffer('');
        $offerCitizen1->setUsers($this->getReference("citizen"));
        $manager->persist($offerCitizen1);

        $manager->flush();

    }
    public function getOrder()
    {
        return 3;
    }
}