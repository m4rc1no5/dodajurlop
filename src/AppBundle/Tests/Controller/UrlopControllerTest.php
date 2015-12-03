<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 03.12.15
 * Time: 17:54
 */

namespace AppBundle\Tests\Controller;


use AppBundle\CommandBus\Urlop\DodajUrlopCommand;
use AppBundle\Controller\UrlopController;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;

class UrlopControllerTest extends TestCase
{

    /** @var M\Mock */
    private $dodajUrlopCommand;

    public function setUp()
    {
        $this->dodajUrlopCommand = M::mock(DodajUrlopCommand::class);
    }

    public function testIndexAction()
    {
        $controller = $this->getUrlopController();

        $ar_dane = $controller->indexAction();

        $this->assertArrayHasKey('urlopy', $ar_dane);
    }

    private function getUrlopController()
    {
        return new UrlopController($this->dodajUrlopCommand);
    }

}