<?php
/**
 * What can I do? what can't I do!
 * User: Ivan
 * Date: 04.12.15
 */

namespace AppBundle\Tests\CommandBus\Urlop;


use AppBundle\CommandBus\Urlop\UrlopCommand;
Use AppBundle\Entity\UrlopRodzaj;
use AppBundle\Entity\Organizacja;
use AppBundle\Entity\Pracownik;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;

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
        $urlopRodzaj = M::mock(UrlopRodzaj::class);
        $organizacja = M::mock(Organizacja::class);
        $pracownik = M::mock(Pracownik::class);

        $this->command->setRok(2015);
        $this->command->setDataOd(new \DateTime('2010-02-03 04:05:06 America/New_York'));
        $this->command->setDataDo(new \DateTime('2015-02-03 04:05:06 America/New_York'));
        $this->command->setUrlopRodzaj($urlopRodzaj);
        $this->command->setOrganizacja($organizacja);
        $this->command->setPracownik($pracownik);
        $this->command->setIloscDni(40);

        $this->assertEquals(2015, $this->command->getRok());
        $this->assertEquals(new \DateTime('2010-02-03 04:05:06 America/New_York'), $this->command->getDataOd());
        $this->assertEquals(new \DateTime('2015-02-03 04:05:06 America/New_York'), $this->command->getDataDo());
        $this->assertEquals($urlopRodzaj, $this->command->getUrlopRodzaj());
        $this->assertEquals($organizacja, $this->command->getOrganizacja());
        $this->assertEquals($pracownik, $this->command->getPracownik());
        $this->assertEquals(40, $this->command->getIloscDni());
    }

}
