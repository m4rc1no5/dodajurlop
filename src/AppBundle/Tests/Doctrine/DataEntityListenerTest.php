<?php
/**
 * Niedługo nazwiesz mnie… mistrzem…(Imperator)
 * User: Ivan
 * Date: 04.12.15
 */

namespace AppBundle\Tests\Doctrine;


use AppBundle\Doctrine\DataEntityListener;
use AppBundle\Entity\Entity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;

class DataEntityListenerTest extends TestCase
{
    /** @var  DataEntityListener */
    private $listener;

    /** @var  M\Mock */
    private $eventArgs;

    /** @var  M\Mock */
    private $em;

    protected function setUp()
    {
        $this->listener = new DataEntityListener();
        $this->eventArgs = M::mock(PreUpdateEventArgs::class);
        $this->em = M::mock(EntityManager::class);
        $this->eventArgs->shouldReceive('getEntityManager')->andReturn($this->em);
    }

    public function testPreUpdate()
    {
        $this->eventArgs->shouldReceive('getEntity');
        $this->listener->preUpdate($this->eventArgs);
    }

    public function testPrePersist()
    {
        $this->eventArgs->shouldReceive('getEntity')->andReturn($this->getMockForAbstractClass(Entity::class));
        $this->listener->prePersist($this->eventArgs);
    }

}
