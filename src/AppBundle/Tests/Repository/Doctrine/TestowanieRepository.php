<?php
/**
 * What can I do? What can't I do!
 * User: Ivan
 * Date: 03.12.15
 */
namespace AppBundle\Tests\Repository\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;

class TestowanieRepository extends TestCase
{

    /** @var  M\Mock */
    protected $entityManager;

    protected $repository;

    /** @var  M\Mock */
    protected $mock;

    protected $zmienaAdd;

    protected function setUp()
    {
        $this->entityManager = M::mock(EntityManager::class);
        $classMetaData = new ClassMetadata('AppBundle\Entity\Organizacja');
        $this->entityManager->shouldReceive('getClassMetadata')->andReturn($classMetaData);
        $this->entityManager->shouldReceive('persist')->andReturn();
        $qbuilder = M::mock(QueryBuilder::class);
        $qbuilder->shouldReceive('select')->andReturn($qbuilder);
        $qbuilder->shouldReceive('from')->andReturn($qbuilder);
        $qbuilder->shouldReceive('where')->andReturn($qbuilder);
        $qbuilder->shouldReceive('setParameter')->andReturn($qbuilder);
        $qbuilder->shouldReceive('andWhere')->andReturn($qbuilder);
        $qbuilder->shouldReceive('getQuery')->andReturn($qbuilder);
        $qbuilder->shouldReceive('orderBy')->andReturn($qbuilder);
        $qbuilder->shouldReceive('addOrderBy')->andReturn($qbuilder);
        $qbuilder->shouldReceive('getResult')->andReturn('Zwraca rezultat');
        $this->entityManager->shouldReceive('createQueryBuilder')->andReturn($qbuilder);
    }

    public function testGetClassName()
    {
        $this->assertEquals('AppBundle\Entity\Organizacja', $this->repository->getClassName());
    }

    public function testAdd()
    {
        $this->repository->add($this->zmienaAdd);
    }

}