<?php
/**
 * Niedługo nazwiesz mnie… mistrzem…(Imperator)
 * User: Ivan
 * Date: 01.12.15
 */

namespace AppBundle\Tests\Controller;


use AppBundle\CommandBus\Organizacja\DodajOrganizacjeCommand;
use AppBundle\Controller\OrganizacjaController;
use AppBundle\Entity\User;
use AppBundle\Repository\IOrganizacjaRepository;
use SimpleBus\Message\Bus\MessageBus;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

    protected function setUp()
    {
        $this->dodajOrganizacjeCommand = M::mock(DodajOrganizacjeCommand::class);
        $this->commandBus = M::mock(MessageBus::class);
        $this->organizacjaRepository = M::mock(IOrganizacjaRepository::class);
        $this->container = M::mock('Symfony\Component\DependencyInjection\ContainerInterface');
        $this->token_storage = M::mock(TokenStorageInterface::class);
        $this->token = M::mock();

        $this->controller = new OrganizacjaController($this->dodajOrganizacjeCommand, $this->commandBus, $this->organizacjaRepository);
        $this->controller->setContainer($this->container);

        $this->organizacjaRepository->shouldReceive('findAllByUser')
            ->once()
            ->andReturn('Jakaś organizacja');

        $this->container->shouldReceive('has')
            ->with('security.token_storage')
            ->once()
            ->andReturn(true);

        $this->token->shouldReceive('getUser')
            ->once()
            ->andReturn(new User());

        $this->token_storage->shouldReceive('getToken')
            ->once()
            ->andReturn($this->token);

        $this->container->shouldReceive('get')
            ->with('security.token_storage')
            ->once()
            ->andReturn($this->token_storage);
    }

    public function testIndex()
    {
        $index_return = $this->controller->indexAction();
        $this->assertEquals('Jakaś organizacja', $index_return['organizacje']);
    }
}
