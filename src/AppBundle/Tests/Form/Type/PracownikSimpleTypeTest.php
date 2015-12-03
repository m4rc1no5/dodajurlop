<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 29.11.15
 * Time: 13:12
 */

namespace AppBundle\Tests\Form\Type;


use AppBundle\Form\Type\PracownikSimpleType;
use AppBundle\Repository\Doctrine\PracownikRepository;
use Symfony\Component\Form\Test\TypeTestCase;
use Mockery as M;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class PracownikSimpleTypeTest extends TypeTestCase
{

    /** @var M\Mock */
    private $pracownikRepository;

    /** @var M\Mock */
    private $tokenStorage;

    /** @var M\Mock */
    private $token;

    protected function setUp()
    {
        $this->pracownikRepository = M::mock(PracownikRepository::class);
        $this->tokenStorage = M::mock(TokenStorage::class);
        $this->token = M::mock(UsernamePasswordToken::class);
        parent::setUp();
    }


    public function testParentAndName()
    {
        $p = $this->getPracownikSimpleType();

        // parent
        $this->assertEquals('entity', $p->getParent());

        // name
        $this->assertEquals('pracownik_simple', $p->getBlockPrefix());

        // class
        $this->assertEquals('AppBundle\Entity\Pracownik', $p::DATA_CLASS);
    }

    private function getPracownikSimpleType()
    {
        $this->token->shouldReceive('getUser')->once();
        $this->tokenStorage->shouldReceive('getToken')->once()->andReturn($this->token);
        return new PracownikSimpleType($this->pracownikRepository, $this->tokenStorage);
    }
}