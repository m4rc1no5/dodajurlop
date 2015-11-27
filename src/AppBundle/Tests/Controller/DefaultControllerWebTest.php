<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\AppWebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\DomCrawler\Crawler;

class DefaultControllerWebTest extends AppWebTestCase
{

    /** @var  Client */
    private $client;

    /** @var  Crawler */
    private $crawler;

    protected function setUp()
    {
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');
    }

    public function testIndex(){
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testLogIn()
    {
        $link = $this->crawler->filter('a:contains("Zaloguj się")')->link();
        $log = $this->client->click($link);

        $this->assertContains("Formularz logowania", $log->filter('.container h1')->text());
    }
}
