<?php
/**
 * What can I do? What can't I do!
 * User: Ivan
 * Date: 03.12.15
 */

namespace AppBundle\Tests\Repository\Doctrine;


use AppBundle\Entity\Pracownik;
use AppBundle\Repository\Doctrine\PracownikRepository;
use AppBundle\Entity\User;

class PracownikRepositoryTest extends TestowanieRepository
{
    /** @var  PracownikRepository */
    protected $repository;

    protected $zmienaAdd;

    protected function setUp()
    {
        parent::setUp();
        $this->repository = new PracownikRepository($this->entityManager);
        $this->zmienaAdd = new Pracownik(new User(), 'Imie', 'Nazw', 'Email', 12);
    }

}
