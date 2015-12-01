<?php
/**
 * What can I do? what can't I do!
 * User: mistrzJoda
 * Date: 01.12.15
 */

namespace AppBundle\Tests\CommandBus\Organizacja;


use AppBundle\CommandBus\Organizacja\DodajOrganizacjeCommand;
use AppBundle\CommandBus\Organizacja\DodajOrganizacjeCommandHandler;
use AppBundle\Entity\User;
use AppBundle\Repository\IOrganizacjaRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;
class DodajOrganizacjeCommandHandlerTest extends TestCase
{
    /** @var  M\Mock */
    private $organizacjaRepository;

    /** @var  M\Mock */
    private $command;

    /** @var  DodajOrganizacjeCommandHandler */
    private $command_handler;

    protected function setUp()
    {
        $this->organizacjaRepository = M::mock(IOrganizacjaRepository::class);
        $this->command = M::mock(DodajOrganizacjeCommand::class);
        $this->command_handler = new DodajOrganizacjeCommandHandler($this->organizacjaRepository);
        $this->getHandler();
    }

    public function testHandle()
    {
        $this->command_handler->handle($this->command);
    }

    private function getHandler()
    {
        $this->organizacjaRepository->shouldReceive('add')->once()->andReturn();
        $this->command->shouldReceive('getUser')->once()->andReturn(new User());
        $this->command->shouldReceive('getNazwa')->once()->andReturn();
        $this->command->shouldReceive('getPnazwa')->once()->andReturn();
    }

}
