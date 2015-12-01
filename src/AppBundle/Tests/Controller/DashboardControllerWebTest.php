<?php
/**
 * Niedługo nazwiesz mnie… mistrzem…(Imperator)
 * User: Ivan
 * Date: 01.12.15
 */
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
        $this->crawler = $this->client->request('GET', '/dashboard');
    }

    public function testIndex()
    {
        $this->assertEquals(301, $this->client->getResponse()->getStatusCode());
    }
}