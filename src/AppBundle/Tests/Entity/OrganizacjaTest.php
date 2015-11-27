<?php
/**
 * What can I do? what can't I do!
 * User: mistrzJoda
 * Date: 27.11.15
 */
namespace AppBundle\Tests\Entity;


use AppBundle\Entity\Organizacja;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class OrganizacjaTest extends TestCase
{
    /** @var  Organizacja */
    private $organizacja;

    /** @var  User */
    private $user;

    protected function setUp()
    {
        $this->user = new User();
        $this->organizacja = new Organizacja($this->user, 'Jakaś organizacja', 'Pełna nazwa organizacji');
    }

    public function testGetDanych()
    {
        $this->assertEquals($this->user, $this->organizacja->getUser());
        $this->assertEquals('Jakaś organizacja', $this->organizacja->getNazwa());
        $this->assertEquals('Pełna nazwa organizacji', $this->organizacja->getPnazwa());
    }

    public function testSetDanych()
    {
        $this->organizacja->setNazwa('Inna nazwa');
        $this->organizacja->setPnazwa('Zupełnie inna nazwa');

        $this->assertEquals('Inna nazwa', $this->organizacja->getNazwa());
        $this->assertEquals('Zupełnie inna nazwa', $this->organizacja->getPnazwa());

        $this->assertNotEquals('Jakaś organizacja', $this->organizacja->getNazwa());
        $this->assertNotEquals('Pełna nazwa organizacji', $this->organizacja->getPnazwa());
    }
}
