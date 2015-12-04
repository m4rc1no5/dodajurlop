<?php
/**
 * What can I do? What can't I do!
 * User: Ivan
 * Date: 03.12.15
 */

namespace AppBundle\Tests\Repository\Doctrine;


use AppBundle\Repository\Doctrine\UrlopRodzajRepository;
use Doctrine\ORM\QueryBuilder;
use Mockery as M;

class UrlopRodzajRepositoryTest extends TestowanieRepository
{
    /** @var  UrlopRodzajRepository */
    protected $repository;

    /** @var  M\Mock */
    protected $entityManager;

    protected function setUp()
    {
        parent::setUp();
        $this->repository = new UrlopRodzajRepository($this->entityManager);
    }

    public function testAdd()
    {
    }

    public function testGetAll()
    {
        $this->assertEquals('Zwraca rezultat', $this->repository->getAll());
    }
}
