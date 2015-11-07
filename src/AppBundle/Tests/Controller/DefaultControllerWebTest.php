<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\AppWebTestCase;

class DefaultControllerWebTest extends AppWebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
        //$this->assertContains("What's next?", $crawler->filter('#container h2')->text());
    }
}
