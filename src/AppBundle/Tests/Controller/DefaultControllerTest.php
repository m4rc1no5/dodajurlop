<?php
/**
 * Niedługo nazwiesz mnie… mistrzem…(Imperator)
 * User: Ivan
 * Date: 01.12.15
 */
namespace AppBundle\Tests\Controller;

use AppBundle\Controller\DefaultController;
use AppBundle\Tests\AppWebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DomCrawler\Crawler;
use Mockery as M;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


class DefaultControllerTest extends AppWebTestCase
{
    /** @var  M\Mock */
    private $container;

    /** @var  M\Mock */
    private $checker;

    /** @var  DefaultController */
    private $controller;

    protected function setUp()
    {
        $this->container = M::mock('Symfony\Component\DependencyInjection\ContainerInterface');
        $this->checker = M::mock('Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface');

        $this->checker->shouldReceive('generate')
            ->once()
            ->andReturn('test_url');

        $this->container->shouldReceive('get')
            ->with('security.authorization_checker')
            ->once()
            ->andReturn($this->checker);

        $this->container->shouldReceive('get')
            ->with('router')
            ->once()
            ->andReturn($this->checker);

        $this->controller = new DefaultController();
        $this->controller->setContainer($this->container);
    }

    public function testIndex()
    {
        $this->checker->shouldReceive('isGranted')
            ->with('ROLE_USER')
            ->once()
            ->andReturn(true);

        $this->assertEquals(302, $this->controller->indexAction()->getStatusCode());
        $this->assertEquals('test_url', $this->controller->indexAction()->getTargetUrl());
    }

    public function testNieZalogowany()
    {
        $this->checker->shouldReceive('isGranted')
            ->with('ROLE_USER')
            ->once()
            ->andReturn(false);

        $this->assertEmpty($this->controller->indexAction());
    }
}