<?php
/**
 * What can I do? what can't I do!
 * User: Ivan
 * Date: 04.12.15
 */

namespace AppBundle\Tests\CommandBus\Urlop;


use AppBundle\CommandBus\Urlop\DodajUrlopCommand;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DodajUrlopCommandTest extends TestCase
{
    /** @var  DodajUrlopCommand */
    private $command;

    /** @var M\Mock */
    private $tokenStorage;

    /** @var M\Mock */
    private $token;

    /** @var  M\Mock */
    private $user;

    protected function setUp()
    {
        $this->tokenStorage = M::mock(TokenStorage::class);
        $this->token = M::mock(UsernamePasswordToken::class);
        $this->user = M::mock(User::class);
        $this->tokenStorage->shouldReceive('getToken')->once()->andReturn($this->token);
        $this->token->shouldReceive('getUser')->once()->andReturn('prawdziwy user');
        $this->command = new DodajUrlopCommand($this->tokenStorage);
    }

    public function testConstruct()
    {
        $this->assertEquals('app.command.urlop.dodaj', $this->command->messageName());
        $this->assertEquals('prawdziwy user', $this->command->getUser());
    }

}
