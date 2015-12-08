<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 05.12.15
 * Time: 21:34
 */

namespace AppBundle\Tests\CommandBus\Urlop;


use AppBundle\CommandBus\Urlop\DodajUrlopCommand;
use AppBundle\CommandBus\Urlop\DodajUrlopCommandHandler;
use AppBundle\Entity\Organizacja;
use AppBundle\Entity\Pracownik;
use AppBundle\Entity\UrlopRodzaj;
use AppBundle\Entity\User;
use AppBundle\Repository\Doctrine\UrlopRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class DodajUrlopCommandHandlerTest extends TestCase
{
    public function testHandle()
    {
        $user = new User;
        $urlopRodzaj = new UrlopRodzaj();
        $pracownik = new Pracownik($user, 'Marcin', 'Zaremba', 'marcin.zaremba@gmail.com', 20, M::mock(Organizacja::class));
        $orgarnizacja = new Organizacja($user, 'ABC', 'ABC Sp. z. o.o.');
        $date = new \DateTime();

        $urlopRepository = M::mock(UrlopRepository::class);
        $handler = new DodajUrlopCommandHandler($urlopRepository);

        $tokenStorage = M::mock(TokenStorage::class);
        $tokenInterface = M::mock(TokenInterface::class);
        $tokenInterface->shouldReceive('getUser')->once()->andReturn($user);
        $tokenStorage->shouldReceive('getToken')->once()->andReturn($tokenInterface);

        $dodajUrlopCommand = new DodajUrlopCommand($tokenStorage);
        $dodajUrlopCommand->setUrlopRodzaj($urlopRodzaj);
        $dodajUrlopCommand->setPracownik($pracownik);
        $dodajUrlopCommand->setOrganizacja($orgarnizacja);
        $dodajUrlopCommand->setDataOd($date);
        $dodajUrlopCommand->setDataDo($date);

        $urlopRepository->shouldReceive('add');

        $handler->handle($dodajUrlopCommand);
    }
}