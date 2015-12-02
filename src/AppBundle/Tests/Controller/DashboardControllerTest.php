<?php
/**
 * Niedługo nazwiesz mnie… mistrzem…(Imperator)
 * User: Ivan
 * Date: 01.12.15
 */

namespace AppBundle\Tests\Controller;


use AppBundle\Controller\DashboardController;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    /** @var  DashboardController */
    private $controller;

    protected function setUp()
    {
        $this->controller = new DashboardController();
    }

    public function testIndex()
    {
        $this->assertEquals(['user' => ''], $this->controller->indexAction());
    }

}
