<?php
/**
 * What can I do? What can't I do!
 * User: Ivan
 * Date: 04.12.15
 */

namespace AppBundle\Tests\Component;


use Component\UnitOfWork;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;

class UnitOfWorkTest extends TestCase
{
    /** @var  UnitOfWork */
    private $unit;

    /** @var  M\Mock */
    private $manager;

    protected function setUp()
    {
        $this->manager = M::mock(EntityManager::class);
        $this->manager->shouldReceive('flush');
        $this->unit = new UnitOfWork($this->manager);
    }

    public function testCommit()
    {
        $this->unit->commit();
    }

}
