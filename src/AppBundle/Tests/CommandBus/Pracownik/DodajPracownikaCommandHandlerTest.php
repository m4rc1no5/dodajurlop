<?php
/**
 * What can I do? what can't I do!
 * User: mistrzJoda
 * Date: 02.12.15
 */

namespace AppBundle\Tests\CommandBus\Pracownik;

use AppBundle\CommandBus\Pracownik\DodajPracownikaCommand;
use AppBundle\CommandBus\Pracownik\DodajPracownikaCommandHandler;
use AppBundle\Entity\Organizacja;
use AppBundle\Entity\User;
use AppBundle\Repository\IOrganizacjaRepository;
use AppBundle\Repository\IPracownikRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;

class DodajPracownikaCommandHandlerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  M\Mock */
    private $pracownikRepository;

    /** @var  M\Mock */
    private $command;

    /** @var  DodajPracownikaCommandHandler */
    private $command_handler;

    protected function setUp()
    {
        $this->pracownikRepository = M::mock(IPracownikRepository::class);
        $this->command = M::mock(DodajPracownikaCommand::class);
        $this->command_handler = new DodajPracownikaCommandHandler($this->pracownikRepository);
        $this->getHandler();
    }

    public function testHandle()
    {
        $this->command_handler->handle($this->command);
    }

    private function getHandler()
    {
        $this->pracownikRepository->shouldReceive('add')->once()->andReturn();
        $this->command->shouldReceive('getUser')->once()->andReturn(new User());
        $this->command->shouldReceive('getImie')->once()->andReturn();
        $this->command->shouldReceive('getNazw')->once()->andReturn();
        $this->command->shouldReceive('getEmail')->once()->andReturn();
        $this->command->shouldReceive('getIloscDniWolnych')->once()->andReturn();
        $this->command->shouldReceive('getOrganizacja');
    }
}
