<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 05.12.15
 * Time: 23:05
 */

namespace AppBundle\Tests\Repository\Doctrine;


use AppBundle\Repository\Doctrine\UrlopRepository;
use AppBundle\Tests\AppTestCase;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Mockery as M;

class UrlopRepositoryTest extends AppTestCase
{
    private $entity_class_name = 'AppBundle\Entity\Urlop';

    public function testAdd()
    {
        $urlopRepository = $this->getUrlopRepository();

    }

    public function testEntityClassName()
    {
        $urlopRepository = $this->getUrlopRepository();

        $this->assertEquals($this->entity_class_name, $this->invokeMethod($urlopRepository, 'getEntityClassName'));
    }

    private function getUrlopRepository()
    {
        $em = M::mock(EntityManager::class);
        $em->shouldReceive('getClassMetadata')->with($this->entity_class_name)->andReturn(M::mock(ClassMetadata::class));
        return new UrlopRepository($em);
    }
}