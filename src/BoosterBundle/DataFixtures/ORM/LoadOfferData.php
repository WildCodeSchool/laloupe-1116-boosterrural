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

        $manager->persist($offerMayor1);
        $manager->flush();


        //addition an offer for the mayor 1

        $offerActor1 = new Offer();
        $offerActor1->setTitle('Locaux vacants');
        $offerActor1->setCp('48130');
        $offerActor1->setTown('Aumont-Aubrac');
        $offerActor1->setActivity('Communication');
        $offerActor1->setDescription('Loue locaux vacant pouvant profiter à des artisans. Locaux de 300m² au nombre de 5');
        $offerActor1->setWish('Echanger sur ce projet');
        $offerActor1->setImageOffer('');

        $manager->persist($offerActor1);
        $manager->flush();

    }
    public function getOrder()
    {
        return 3;
    }
}