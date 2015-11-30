<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 29.11.15
 * Time: 13:12
 */

namespace AppBundle\Tests\Form\Type;


use AppBundle\Form\Type\OrganizacjaSimpleType;
use AppBundle\Repository\Doctrine\OrganizacjaRepository;
use Symfony\Component\Form\Test\TypeTestCase;
use Mockery as M;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class OrganizacjaSimpleTypeTest extends TypeTestCase
{

    /** @var M\Mock */
    private $organizacjaRepository;

    /** @var M\Mock */
    private $tokenStorage;

    /** @var M\Mock */
    private $token;

    protected function setUp()
    {
        $this->organizacjaRepository = M::mock(OrganizacjaRepository::class);
        $this->tokenStorage = M::mock(TokenStorage::class);
        $this->token = M::mock(UsernamePasswordToken::class);
        parent::setUp();
    }


    public function testParentAndName()
    {
        $o = $this->getOrganizacjaSimpleType();

        // parent
        $this->assertEquals('entity', $o->getParent());

        // name
        $this->assertEquals('organizacja_simple', $o->getName());

        // class
        $this->assertEquals('AppBundle\Entity\Organizacja', $o::DATA_CLASS);
    }

    private function getOrganizacjaSimpleType()
    {
        $this->token->shouldReceive('getUser')->once();
        $this->tokenStorage->shouldReceive('getToken')->once()->andReturn($this->token);
        return new OrganizacjaSimpleType($this->organizacjaRepository, $this->tokenStorage);
    }
}