<?php
namespace BoosterBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BoosterBundle\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadUserData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        //Create a new mayor
        $mayor1 = $userManager->createUser();
        $mayor1->setTown('Aumont-Aubrac');
        $mayor1->setCp('48130');
        $mayor1->setEmail('aumont@mail.fr');
        $mayor1->setEnabled('1');
        $mayor1->setUsername('Aumont');
        $mayor1->setPlainPassword('123');
        $mayor1->setWebsite('www.aumontaubrac.com');
        $mayor1->setLastname('');
        $mayor1->setDescription('Aumont-Aubrac est une ancienne commune française située dans le département de la Lozère et la région Occitanie. En occitan, le village se nomme Autmont (prononcé [awmu] ou [zawmu] la deuxième forme étant celle en usage exclusif parmi les locuteurs occitans des communes environnantes (nom relevé sur place en 2000). L\'usage d\'un z prosthétique devant [a] ou [u] est typique des dialectes auvergnats de la région. En effet, le village se trouve à l\'extrême limite sud de l\'auvergnat. La commune d\'Aumont-Aubrac est labellisée Village étape depuis 2002.');
        $mayor1->setMessageMayor('Bienvenue en Terre de Peyre, C’est avec plaisir que nous vous accueillons à Aumont-Aubrac, commune de 1146 habitants située à 1050 d’altitude entre les pittoresques Monts Granitiques de la Margeride et les immenses plateaux basaltiques de l’Aubrac.
 
Notre commune premier village Etape Numérique de France, souhaite vous apporter via Internet le maximum d’informations sur la vie de notre cité, les principaux événements, l’activité économique et touristique, la dynamique des nos associations culturelles, sportives ou sociales autant d’atouts favorables et compatibles à notre réputation et vocation de terre d’accueil.
 
Alain Astruc, Maire d’Aumont-Aubrac.');
        $mayor1->setResident('1146');
        $mayor1->setPhone('0466428002');
        $userManager->updateUser($mayor1);

        //Create a new actor
        $actor1 = $userManager->createUser();
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
        $actor1->setPhone('0466428034');
        $userManager->updateUser($mayor1);


        //Create a new citizen
        $citizen1 = new User();
        $citizen1->setLastname('Albert Pomero');
        $citizen1->setEmail('pomero@mail.fr');
        $citizen1->setPassword('123');
        $citizen1->setEnabled('1');
        $citizen1->setUsername('Albert');
        $citizen1->setPhone('0466428034');
        $userManager->updateUser($mayor1);
    }

    public function getOrder()
    {
        return 1;
    }
}