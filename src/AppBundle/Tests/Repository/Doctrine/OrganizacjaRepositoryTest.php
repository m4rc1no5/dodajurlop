<?php
/**
 * What can I do? What can't I do!
 * User: Ivan
 * Date: 03.12.15
 */

namespace AppBundle\Tests\Repository\Doctrine;

use AppBundle\Repository\Doctrine\OrganizacjaRepository;
use AppBundle\Entity\Organizacja;
use AppBundle\Entity\User;
use Mockery as M;

class OrganizacjaRepositoryTest extends TestowanieRepository
{

    /** @var  OrganizacjaRepository */
    protected $repository;

    protected $zmienaAdd;

    protected function setUp()
    {
        parent::setUp();
        $this->repository = new OrganizacjaRepository($this->entityManager);
        $this->zmienaAdd = new Organizacja(new User(), 'organizacja', 'pełna nazwa');
    }

}
