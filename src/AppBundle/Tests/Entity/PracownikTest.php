<?php
/**
 * What can I do? what can't I do!
 * User: mistrzJoda
 * Date: 27.11.15
 */
namespace AppBundle\Tests\Entity;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use AppBundle\Entity\Pracownik;
use Mockery as M;
use AppBundle\Entity\Organizacja;

class PracownikTest extends TestCase
{
    /** @var Pracownik */
    private $pracownik;

    /** @var  User */
    private $user;

    protected function setUp()
    {
        $this->user = new User();
        $this->pracownik = new Pracownik($this->user, 'Imie Test', 'Nazwisko Test', 'Test@mail.com', 40, M::mock(Organizacja::class));
    }

    public function testGetDanych()
    {
        $this->assertEquals($this->user, $this->pracownik->getUser());
        $this->assertEquals('Imie Test', $this->pracownik->getImie());
        $this->assertEquals('Nazwisko Test', $this->pracownik->getNazw());
        $this->assertEquals('Test@mail.com', $this->pracownik->getEmail());
        $this->assertEquals(40, $this->pracownik->getIloscDniWolnych());
        $this->assertEquals('Imie Test Nazwisko Test', $this->pracownik->getImieNazw());
        $this->assertEquals(M::mock(Organizacja::class), $this->pracownik->getOrganizacja());
        $this->assertEquals('Imie Test Nazwisko Test', $this->pracownik);
    }

    public function testSetDanych()
    {
        $this->pracownik->setImie('Imie Test Drugie');
        $this->pracownik->setNazw('Nazwisko Test Drugie');
        $this->pracownik->setEmail('Test_inny@mail.com');
        $this->pracownik->setIloscDniWolnych(30);
        $this->pracownik->setOrganizacja(M::mock(Organizacja::class));

        $this->assertEquals('Imie Test Drugie', $this->pracownik->getImie());
        $this->assertEquals('Nazwisko Test Drugie', $this->pracownik->getNazw());
        $this->assertEquals('Test_inny@mail.com', $this->pracownik->getEmail());
        $this->assertEquals(30, $this->pracownik->getIloscDniWolnych());
        $this->assertEquals(M::mock(Organizacja::class), $this->pracownik->getOrganizacja());

        $this->assertNotEquals('Imie Test', $this->pracownik->getImie());
        $this->assertNotEquals('Nazwisko Test', $this->pracownik->getNazw());
        $this->assertNotEquals('Test@mail.com', $this->pracownik->getEmail());
        $this->assertNotEquals(40, $this->pracownik->getIloscDniWolnych());
        $this->assertNotEquals(M::mock(Pracownik::class), $this->pracownik->getOrganizacja());

    }

}