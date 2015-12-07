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
use AppBundle\Repository\Doctrine\UrlopRepository;
use Component\UnitOfWork;
use SimpleBus\Message\Bus\MessageBus;
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
    private $urlopRepository;
    /** @var M\Mock */
    private $dodajUrlopCommand;
    /** @var M\Mock */
    private $messageBus;
    /** @var M\Mock */
    private $container;
    /** @var M\Mock */
    private $user_zalogowany;
    /** @var M\Mock */
    private $token;
    /** @var M\Mock */
    private $token_storage;
    /** @var M\Mock */
    private $form_factory;
    /** @var M\Mock */
    private $form;
    /** @var M\Mock */
    private $unit_of_work;

    public function setUp()
    {
        $this->urlopRepository = M::mock(UrlopRepository::class);
        $this->dodajUrlopCommand = M::mock(DodajUrlopCommand::class);
        $this->messageBus = M::mock(MessageBus::class);
        $this->container = M::mock(ContainerInterface::class);
        $this->user_zalogowany = M::mock(User::class);
        $this->token = M::mock();
        $this->token_storage = M::mock(TokenStorageInterface::class);
        $this->form_factory = M::Mock(FormFactoryInterface::class);
        $this->form = M::Mock(Form::class);
        $this->unit_of_work = M::mock(UnitOfWork::class);
    }

    public function testIndexAction()
    {
        $controller = $this->getUrlopController();

        $controller->setContainer($this->container);
        $controller->setUnitOfWork($this->unit_of_work);

        $this->container->shouldReceive('has')->with('security.token_storage')->once()->andReturn(true);
        $this->token->shouldReceive('getUser')->once()->andReturn($this->user_zalogowany);
        $this->token_storage->shouldReceive('getToken')->once()->andReturn($this->token);
        $this->container->shouldReceive('get')->with('security.token_storage')->once()->andReturn($this->token_storage);
        $this->urlopRepository->shouldReceive('findAllByUser');

        $ar_dane = $controller->indexAction();

        $this->assertArrayHasKey('urlopy', $ar_dane);
    }

    /**
     * Test formularza dopiero co otwartego lub takiego, który
     * nie został poprawnie wypełniony
     */
    public function testDodajFormNotValid()
    {
        $controller = $this->getUrlopController();

        $this->dodajUrlopCommand->shouldReceive('setIloscDni')->once();
        $this->dodajUrlopCommand->shouldReceive('setRok')->once();

        $this->token->shouldReceive('getUser')->once()->andReturn($this->user_zalogowany);
        $this->token_storage->shouldReceive('getToken')->once()->andReturn($this->token);
        $this->container->shouldReceive('has')->with('security.token_storage')->once()->andReturn(true);
        $this->container->shouldReceive('get')->with('security.token_storage')->once()->andReturn($this->token_storage);

        $this->form->shouldReceive('handleRequest')->once()->andReturn(true);
        $this->form->shouldReceive('isValid')->once()->andReturn(false);
        $this->form->shouldReceive('createView')->once()->andReturn('formularz urlopu');
        $this->form_factory->shouldReceive('create')->once()->andReturn($this->form);
        $this->container->shouldReceive('get')->with('form.factory')->once()->andReturn($this->form_factory);
        $controller->setContainer($this->container);

        $ar_dane = $controller->dodajAction(new Request());
        $this->assertEquals('formularz urlopu', $ar_dane['form']);
    }

    /**
     * Test poprawnie wypełnionego formularza - powinien zakończyć się wyjątkiem,
     * który występuje przy redirect'cie - poprawić w wolnej chwili
     */
    public function testDodajFormValid()
    {
        $exceptionClass = get_class(new \InvalidArgumentException());
        $this->setExpectedException($exceptionClass);

        $controller = $this->getUrlopController();

        $this->dodajUrlopCommand->shouldReceive('setIloscDni')->once();
        $this->dodajUrlopCommand->shouldReceive('setRok')->once();

        $this->token->shouldReceive('getUser')->once()->andReturn($this->user_zalogowany);
        $this->token_storage->shouldReceive('getToken')->once()->andReturn($this->token);
        $this->container->shouldReceive('has')->with('security.token_storage')->once()->andReturn(true);
        $this->container->shouldReceive('get')->with('security.token_storage')->once()->andReturn($this->token_storage);

        $this->form->shouldReceive('handleRequest')->once()->andReturn(true);
        $this->form->shouldReceive('isValid')->once()->andReturn(true);

        $this->messageBus->shouldReceive('handle')->once();

        $this->form_factory->shouldReceive('create')->once()->andReturn($this->form);
        $this->container->shouldReceive('get')->with('form.factory')->once()->andReturn($this->form_factory);
        $controller->setContainer($this->container);

        $controller->setUnitOfWork($this->unit_of_work);

        $this->unit_of_work->shouldReceive('commit')->once();

        $controller->dodajAction(new Request());
    }

    private function getUrlopController()
    {
        return new UrlopController($this->urlopRepository, $this->dodajUrlopCommand, $this->messageBus);
    }

}