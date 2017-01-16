<?php
namespace BoosterBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BoosterBundle\Entity\User;
use BoosterBundle\Entity\Offer;
use BoosterBundle\Entity\Needs;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        //Create a new mayor

        $mayor1 = new User();
        $mayor1->setTown('Aumont-Aubrac');
        $mayor1->setCp('48130');
        $mayor1->setEmail('aumont@mail.fr');
        $mayor1->setEnabled('1');
        $mayor1->setUsername('Aumont');
        $mayor1->setPassword('123');
        $mayor1->setWebsite('www.aumontaubrac.com');
        $mayor1->setLastname('');
        $mayor1->setDescription('Aumont-Aubrac est une ancienne commune française située dans le département de la Lozère et la région Occitanie. En occitan, le village se nomme Autmont (prononcé [awmu] ou [zawmu] la deuxième forme étant celle en usage exclusif parmi les locuteurs occitans des communes environnantes (nom relevé sur place en 2000). L\'usage d\'un z prosthétique devant [a] ou [u] est typique des dialectes auvergnats de la région. En effet, le village se trouve à l\'extrême limite sud de l\'auvergnat. La commune d\'Aumont-Aubrac est labellisée Village étape depuis 2002.');
        $mayor1->setMessageMayor('Bienvenue en Terre de Peyre, C’est avec plaisir que nous vous accueillons à Aumont-Aubrac, commune de 1146 habitants située à 1050 d’altitude entre les pittoresques Monts Granitiques de la Margeride et les immenses plateaux basaltiques de l’Aubrac.
 
Notre commune premier village Etape Numérique de France, souhaite vous apporter via Internet le maximum d’informations sur la vie de notre cité, les principaux événements, l’activité économique et touristique, la dynamique des nos associations culturelles, sportives ou sociales autant d’atouts favorables et compatibles à notre réputation et vocation de terre d’accueil.
 
Alain Astruc, Maire d’Aumont-Aubrac.');
        $mayor1->setResident('1146');
        $mayor1->setPhone('04 66 42 80 02');


        $manager->persist($mayor1);
        $manager->flush();


        //addition an offer for the mayor 1

        $offerMayor1 = new Offer();
        $offerMayor1->setTitle('Raccordement gratuit à la fibre optique');
        $offerMayor1->setCp('48130');
        $offerMayor1->setTown('Aumont-Aubrac');
        $offerMayor1->setCategory('Communication');
        $offerMayor1->setDescription('prolongation de la fibre optique jusqu\’à la zone d\’activités du Pêcher.');
        $offerMayor1->setWish('Echanger sur ce projet');
        $offerMayor1->setImageOffer('');

        $manager->persist($offerMayor1);
        $manager->flush();


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


        //Create a new actor

        $actor1 = new User();
        $actor1->setOrganization('Gaillard Rondino');
        $actor1->setLastname('Gaillard Rondino');
        $actor1->setStatusActor('TPE/Artisans');
        $actor1->setCategory('Agriculture/Agroalimentaire');
        $actor1->setTown('Aumont-Aubrac');
        $actor1->setCp('48130');
        $actor1->setAddress(' Le Bouchet');
        $actor1->setEmail('boucherie@mail.fr');
        $actor1->setEnabled('1');
        $actor1->setUsername('Gaillard');
        $actor1->setPassword('123');
        $actor1->setDescription('Boucherie familiale depuis 1965 reputée');
        $actor1->setPhone('04 66 42 80 34');

        $manager->persist($actor1);
        $manager->flush();


        //addition an offer for the mayor 1

        $offerActor1 = new Offer();
        $offerActor1->setTitle('Locaux vacants');
        $offerActor1->setCp('48130');
        $offerActor1->setTown('Aumont-Aubrac');
        $offerActor1->setCategory('Communication');
        $offerActor1->setDescription('Loue locaux vacant pouvant profiter à des artisans. Locaux de 300m² au nombre de 5');
        $offerActor1->setWish('Echanger sur ce projet');
        $offerActor1->setImageOffer('');

        $manager->persist($offerActor1);
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

        //Create a new citizen

        $citizen1 = new User();
        $citizen1->setLastname('Albert Pomero');
        $citizen1->setEmail('pomero@mail.fr');
        $citizen1->setPassword('123');
        $citizen1->setEnabled('1');
        $citizen1->setUsername('Albert');
    }
}