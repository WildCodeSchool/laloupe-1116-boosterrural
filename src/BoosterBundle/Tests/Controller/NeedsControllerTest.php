<?php

namespace BoosterBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NeedsControllerTest extends WebTestCase
{

    public function testHomePage()
    {

        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/');

        $this->assertEquals('BoosterBundle\Controller\DefaultController::home_page_no_connectAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());


        //Test du bouton inscription
        $link = $crawler
            ->filter('a:contains("Connexion")')
            ->eq(0)
            ->link();

        $crawler = $client->click($link);

        $this->assertEquals('FOS\UserBundle\Controller\SecurityController::loginAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
        /*$crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'boosterbundle_needs[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'boosterbundle_needs[field_name]'  => 'Foo',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());*/
    }


}
