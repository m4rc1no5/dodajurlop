<?php
/**
 * What can I do? what can't I do!
 * User: mistrzJoda
 * Date: 27.11.15
 */
namespace AppBundle\Tests\Entity;


use AppBundle\Entity\Entity;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class EntityTest extends TestCase
{
    /** @var  Entity */
    private $entity;

    protected function setUp()
    {
        $this->entity = $this->getMockForAbstractClass('AppBundle\Entity\Entity');
    }

    public function testSetGetDanych()
    {
        $date = new \DateTime('2015-11-14');

        $this->entity->setKomentarz('kom');
        $this->entity->setDel(true);
        $this->entity->setDodata($date);
        $this->entity->setLicznik(1);
        $this->entity->setModata($date);
        $this->entity->setOpis('normalny opis');
        $this->entity->setWysw(true);

        $this->assertEquals('kom', $this->entity->getKomentarz());
        $this->assertTrue($this->entity->isDel());
        $this->assertEquals($date, $this->entity->getDodata());
        $this->assertEquals(1, $this->entity->getLicznik());
        $this->assertEquals($date, $this->entity->getModata());
        $this->assertEquals('normalny opis', $this->entity->getOpis());
        $this->assertTrue($this->entity->isWysw());

        $date_new = new \DateTime('2014-11-14');

        $this->assertNotEquals('komqwe', $this->entity->getKomentarz());
        $this->assertNotEquals($date_new, $this->entity->getDodata());
        $this->assertNotEquals(12, $this->entity->getLicznik());
        $this->assertNotEquals($date_new, $this->entity->getModata());
        $this->assertNotEquals('normalny opisasdf', $this->entity->getOpis());

        $this->assertNull($this->entity->getId());
    }

}