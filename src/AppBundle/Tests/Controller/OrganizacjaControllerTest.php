<?php
/**
 * Niedługo nazwiesz mnie… mistrzem…(Imperator)
 * User: Ivan
 * Date: 01.12.15
 */

namespace AppBundle\Tests\Controller;


use AppBundle\CommandBus\Organizacja\DodajOrganizacjeCommand;
use AppBundle\Controller\OrganizacjaController;
use AppBundle\Entity\Organizacja;
use AppBundle\Entity\User;
use AppBundle\Repository\IOrganizacjaRepository;
use Component\UnitOfWork;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\HeaderBag;

class OrganizacjaControllerTest extends TestCase
{
    /** @var M\Mock */
    protected $dodajOrganizacjeCommand;

    /** @var M\Mock */
    protected $commandBus;

    /** @var M\Mock */
    protected $organizacjaRepository;

    /** @var  OrganizacjaController */
    protected $controller;

    /** @var  M\Mock */
    private $container;

    /** @var  M\Mock */
    private $token_storage;

    /** @var  M\Mock */
    private $token;

    /** @var  M\Mock */
    private $unitOfWork;

    /** @var  M\Mock */
    private $request;

    /** @var  M\Mock */
    private $form;

    /** @var  M\Mock */
    private $organizacja;

    /** @var  M\Mock */
    private $user;

    /** @var  M\Mock */
    private $user_zalogowany;

    protected function setUp()
    {
        $this->dodajOrganizacjeCommand = M::mock(DodajOrganizacjeCommand::class);
        $this->commandBus = M::mock(MessageBus::class);
        $this->organizacjaRepository = M::mock(IOrganizacjaRepository::class);
        $this->container = M::mock('Symfony\Component\DependencyInjection\ContainerInterface');
        $this->token_storage = M::mock(TokenStorageInterface::class);
        $this->token = M::mock();
        $this->unitOfWork = M::mock(UnitOfWork::class);
        $this->request = new Request();
        $this->organizacja = M::mock(Organizacja::class);
        $this->user = M::mock(User::class);
        $this->user_zalogowany = M::mock(User::class);

        $this->controller = new OrganizacjaController($this->dodajOrganizacjeCommand, $this->commandBus, $this->organizacjaRepository);
        $this->controller->setContainer($this->container);
        $this->controller->setUnitOfWork($this->unitOfWork);

        $this->request->headers = M::Mock(HeaderBag::class);
        $this->request->headers->shouldReceive('get')
            ->with('referer')
            ->once()
            ->andReturn('http://localhost');

        $this->unitOfWork->shouldReceive('commit')
            ->once()
            ->andReturn();

        $this->organizacjaRepository->shouldReceive('findAllByUser')
            ->once()
            ->andReturn('Jakaś organizacja');

        $this->container->shouldReceive('has')
            ->with('security.token_storage')
            ->once()
            ->andReturn(true);

        $this->token->shouldReceive('getUser')
            ->once()
            ->andReturn($this->user_zalogowany);

        $this->token_storage->shouldReceive('getToken')
            ->once()
            ->andReturn($this->token);

        $this->container->shouldReceive('get')
            ->with('security.token_storage')
            ->once()
            ->andReturn($this->token_storage);

        $form_factory = M::Mock(FormFactoryInterface::class);

        $this->form = M::Mock(Form::class);
        $this->form->shouldReceive('handleRequest')
            ->once()
            ->andReturn(true);

        $this->form->shouldReceive('createView')
            ->once()
            ->andReturn('stworzyła się jakaś forma');

        $this->commandBus->shouldReceive('handle')
            ->once()
            ->andReturn();

        $form_factory->shouldReceive('create')
            ->once()
            ->andReturn($this->form);

        $this->container->shouldReceive('get')
            ->with('form.factory')
            ->once()
            ->andReturn($form_factory);

        $this->organizacja->shouldReceive('getUser')
            ->once()
            ->andReturn($this->user);

        $this->organizacja->shouldReceive('setDel')
            ->once()
            ->andReturn();
    }

    public function testIndex()
    {
        $this->request_arr($this->controller->indexAction(), 'organizacje', 'Jakaś organizacja');
    }

    public function testDodajIsValidTrue()
    {
        $this->form->shouldReceive('isValid')
            ->once()
            ->andReturn(true);

        $this->request($this->controller->dodajAction($this->request));
    }

    public function testDodajIsValidFalse()
    {
        $this->form->shouldReceive('isValid')
            ->once()
            ->andReturn(false);

        $this->request_arr($this->controller->dodajAction($this->request));
    }
    
    public function testEdytujInnyUser()
    {
        $this->user->shouldReceive('getId')
            ->once()
            ->andReturn(123);

        $this->user_zalogowany->shouldReceive('getId')
            ->once()
            ->andReturn(132);

        $this->request($this->controller->edytujAction($this->request, $this->organizacja));
    }

    public function testEdytujTenSamUserIsValidFalse()
    {
        $this->user->shouldReceive('getId')
            ->once()
            ->andReturn(123);

        $this->user_zalogowany->shouldReceive('getId')
            ->once()
            ->andReturn(123);

        $this->form->shouldReceive('isValid')
            ->once()
            ->andReturn(false);

        $this->request_arr($this->controller->edytujAction($this->request, $this->organizacja));
    }

    public function testEdytujTenSamUserIsValidTrue()
    {
        $this->user->shouldReceive('getId')
            ->once()
            ->andReturn(123);

        $this->user_zalogowany->shouldReceive('getId')
            ->once()
            ->andReturn(123);

        $this->form->shouldReceive('isValid')
            ->once()
            ->andReturn(true);

        $this->request($this->controller->edytujAction($this->request, $this->organizacja));
    }

    public function testDeleteTenSamUser()
    {
        $this->user->shouldReceive('getId')
            ->once()
            ->andReturn(123);

        $this->user_zalogowany->shouldReceive('getId')
            ->once()
            ->andReturn(123);

        $this->request($this->controller->deleteAction($this->request, $this->organizacja));
    }
    
    private function request($dane)
    {
        $this->assertEquals(302, $dane->getStatusCode());
        $this->assertEquals('http://localhost', $dane->getTargetUrl());
    }

    private function request_arr($dane, $param = 'form', $expected = 'stworzyła się jakaś forma')
    {
        $this->assertEquals($expected, $dane[$param]);
    }
}