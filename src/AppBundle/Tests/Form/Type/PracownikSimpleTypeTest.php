<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 29.11.15
 * Time: 13:12
 */

namespace AppBundle\Tests\Form\Type;


use AppBundle\Entity\User;
use AppBundle\Form\Type\PracownikSimpleType;
use AppBundle\Repository\Doctrine\PracownikRepository;
use Symfony\Component\Form\Test\TypeTestCase;
use Mockery as M;
use Symfony\Component\OptionsResolver\OptionsResolver;
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

    public function testConfigureOptions()
    {
        $o = $this->getPracownikSimpleType();
        $resolver = M::mock(OptionsResolver::class);
        $resolver->shouldReceive('setDefaults')->with(['class' => 'AppBundle\Entity\Pracownik', 'choices' => 'choices']);
        $o->configureOptions($resolver);
    }

    private function getPracownikSimpleType()
    {
        $this->token->shouldReceive('getUser')->once()->andReturn(new User());
        $this->tokenStorage->shouldReceive('getToken')->once()->andReturn($this->token);
        $this->pracownikRepository->shouldReceive('findAllByUser')->with(User::class)->andReturn('choices');
        return new PracownikSimpleType($this->pracownikRepository, $this->tokenStorage);
    }
}