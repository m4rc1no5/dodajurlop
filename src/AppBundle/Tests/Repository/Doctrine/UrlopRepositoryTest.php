<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 05.12.15
 * Time: 23:05
 */

namespace AppBundle\Tests\Repository\Doctrine;


use AppBundle\Entity\Organizacja;
use AppBundle\Entity\Pracownik;
use AppBundle\Entity\Urlop;
use AppBundle\Entity\UrlopRodzaj;
use AppBundle\Entity\User;
use AppBundle\Repository\Doctrine\UrlopRepository;
use AppBundle\Tests\AppTestCase;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Mockery as M;

class UrlopRepositoryTest extends AppTestCase
{

    /** @var string */
    private $entity_class_name = 'AppBundle\Entity\Urlop';

    /** @var M\Mock */
    private $em;

    protected function setUp()
    {
        $this->em = M::mock(EntityManager::class);
    }

    /**
     * Test dodania urlopu do repo
     */
    public function testAddUrlop()
    {
        $urlopRepository = $this->getUrlopRepository();

        $urlop = new Urlop(
            M::mock(User::class),
            M::mock(UrlopRodzaj::class),
            M::mock(Pracownik::class),
            M::mock(Organizacja::class),
            new \DateTime(),
            new \DateTime(),
            '26',
            '2015'
        );

        $this->em->shouldReceive('persist')->once();
        $urlopRepository->add($urlop);
    }

    public function testEntityClassName()
    {
        $urlopRepository = $this->getUrlopRepository();

        $this->assertEquals($this->entity_class_name, $this->invokeMethod($urlopRepository, 'getEntityClassName'));
    }

    private function getUrlopRepository()
    {
        $this->em->shouldReceive('getClassMetadata')->with($this->entity_class_name)->andReturn(M::mock(ClassMetadata::class));
        return new UrlopRepository($this->em);
    }
}