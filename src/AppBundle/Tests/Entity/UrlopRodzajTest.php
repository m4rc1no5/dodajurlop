<?php
/**
 * What can I do? what can't I do!
 * User: mistrzJoda
 * Date: 27.11.15
 */
namespace AppBundle\Tests\Entity;


use AppBundle\Entity\UrlopRodzaj;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class UrlopRodzajTest extends TestCase
{
    /** @var  UrlopRodzaj */
    private $urlop_rodzaj;

    protected function setUp()
    {
        $this->urlop_rodzaj = new UrlopRodzaj();
    }

    public function testSetGetDanych()
    {
        $this->urlop_rodzaj->setNazwa('Urlop rodzaj');
        $this->assertEquals('Urlop rodzaj', $this->urlop_rodzaj->getNazwa());

        $this->assertNotEquals('Rodzaj urlop', $this->urlop_rodzaj->getNazwa());
    }

}