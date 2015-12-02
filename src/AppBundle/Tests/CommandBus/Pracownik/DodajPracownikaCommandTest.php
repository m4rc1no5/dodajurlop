<?php
/**
 * What can I do? what can't I do!
 * User: mistrzJoda
 * Date: 02.12.15
 */


namespace AppBundle\Tests\CommandBus\Pracownik;

use AppBundle\CommandBus\Pracownik\DodajPracownikaCommand;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use AppBundle\Entity\User;

class DodajPracownikaCommandTest extends TestCase
{
    /** @var  DodajPracownikaCommand */
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
        parent::setUp();
        $this->getCommand();
    }

    public function testConstruct()
    {
        $this->assertEquals('app.command.pracownik.dodaj', $this->command->messageName());
        $this->assertEquals('prawdziwy user', $this->command->getUser());
    }

    public function getCommand(){
        $this->tokenStorage->shouldReceive('getToken')->once()->andReturn($this->token);
        $this->token->shouldReceive('getUser')->once()->andReturn('prawdziwy user');
        $this->command = new DodajPracownikaCommand($this->tokenStorage);
    }

}
