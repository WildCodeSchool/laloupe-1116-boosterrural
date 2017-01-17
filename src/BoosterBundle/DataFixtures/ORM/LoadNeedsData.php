<?php
namespace BoosterBundle\DataFixtures\ORM;


use Doctrine\Common\Persistence\ObjectManager;
use BoosterBundle\Entity\Needs;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadNeedsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {




        //addition an offer for the mayor 1

        $needMayor1 = new Needs();
        $needMayor1->setTitle('Boulangerie cherche Boulanger');
        $needMayor1->setCp('48130');
        $needMayor1->setTown('Aumont-Aubrac');
        $needMayor1->setDescription('Boulanger H/F pour réaliser la préparation et la cuisson de la pâte à pain selon une méthode donnée. Préparation et mise en place de la Viennoiserie et des Sandwichs. Travail de jour, repos le samedi et un autre jour dans la semaine.
CAP Boulanger requis.');
        $needMayor1->setImageNeeds('');

        $manager->persist($needMayor1);
        $manager->flush();

        //addition an offer for the mayor 1

        $needActor1 = new Needs();
        $needActor1->setTitle('Recherche Boucher');
        $needActor1->setCp('48130');
        $needActor1->setTown('Aumont-Aubrac');
        $needActor1->setDescription('Recherche un boucher a former. Si tu es jeune beau et que aime la viande. Notre boucherie est faite pour toi !!!');
        $needActor1->setImageNeeds('');

        $manager->persist($needActor1);
        $manager->flush();

    }
    public function getOrder()
    {
        return 2;
    }
}