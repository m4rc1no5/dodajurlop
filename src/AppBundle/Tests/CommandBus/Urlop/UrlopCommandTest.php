<?php
/**
 * What can I do? what can't I do!
 * User: Ivan
 * Date: 04.12.15
 */

namespace AppBundle\Tests\CommandBus\Urlop;


use AppBundle\CommandBus\Urlop\UrlopCommand;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class UrlopCommandTest extends TestCase
{

    /** @var  UrlopCommand */
    private $command;

    protected function setUp()
    {
        $this->command = $this->getMockForAbstractClass(UrlopCommand::class);
    }

    public function testDane()
    {
        $this->command->setRok(2015);
        $this->command->setDataOd(new \DateTime('2010-02-03 04:05:06 America/New_York'));
        $this->command->setDataDo(new \DateTime('2015-02-03 04:05:06 America/New_York'));
        $this->command->setUrlopRodzaj('Rodzaj Urlopu');
        $this->command->setOrganizacja('Jakaś organizaja');
        $this->command->setPracownik('Pracownik');
        $this->command->setIloscDni(40);

        $this->assertEquals(2015, $this->command->getRok());
        $this->assertEquals(new \DateTime('2010-02-03 04:05:06 America/New_York'), $this->command->getDataOd());
        $this->assertEquals(new \DateTime('2015-02-03 04:05:06 America/New_York'), $this->command->getDataDo());
        $this->assertEquals('Rodzaj Urlopu', $this->command->getUrlopRodzaj());
        $this->assertEquals('Jakaś organizaja', $this->command->getOrganizacja());
        $this->assertEquals('Pracownik', $this->command->getPracownik());
        $this->assertEquals(40, $this->command->getIloscDni());
    }

}
