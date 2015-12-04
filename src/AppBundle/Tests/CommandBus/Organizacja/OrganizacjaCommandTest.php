<?php
/**
 * What can I do? What can't I do!
 * User: mistrzJoda
 * Date: 04.12.15
 */

namespace AppBundle\Tests\CommandBus\Organizacja;


use AppBundle\CommandBus\Organizacja\OrganizacjaCommand;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class OrganizacjaCommandTest extends TestCase
{

    public function testUser(){
        $command = $this->getCommand();
        $command->setUser('Jakiś user');
        $this->assertEquals('Jakiś user', $command->getUser());
    }

    /**
     * @return OrganizacjaCommand
     */
    private function getCommand()
    {
        return $this->getMockForAbstractClass(OrganizacjaCommand::class);
    }



}
