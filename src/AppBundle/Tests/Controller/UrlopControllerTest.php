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
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

    public function testDodaj()
    {
        $controller = $this->getUrlopController();

        $container = M::mock(ContainerInterface::class);
        $user_zalogowany = M::mock(User::class);
        $token = M::mock();
        $token_storage = M::mock(TokenStorageInterface::class);
        $token->shouldReceive('getUser')->once()->andReturn($user_zalogowany);
        $token_storage->shouldReceive('getToken')->once()->andReturn($token);
        $container->shouldReceive('has')->with('security.token_storage')->once()->andReturn(true);
        $container->shouldReceive('get')->with('security.token_storage')->once()->andReturn($token_storage);
        $form_factory = M::Mock(FormFactoryInterface::class);
        $form = M::Mock(Form::class);
        $form->shouldReceive('handleRequest')->once()->andReturn(true);
        $form->shouldReceive('createView')->once()->andReturn('stworzyła się jakaś forma');
        $form_factory->shouldReceive('create')->once()->andReturn($form);
        $container->shouldReceive('get')->with('form.factory')->once()->andReturn($form_factory);
        $controller->setContainer($container);

        $ar_dane = $controller->dodajAction(new Request());
        $this->assertEquals('stworzyła się jakaś forma', $ar_dane['form']);
    }

    private function getUrlopController()
    {
        return new UrlopController($this->dodajUrlopCommand);
    }

}