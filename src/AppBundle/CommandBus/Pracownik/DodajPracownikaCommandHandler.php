<?php
/**
 * What can I do? what can't I do!
 * User: mistrzJoda
 * Date: 25.11.15
 */
namespace AppBundle\CommandBus\Pracownik;


use AppBundle\CommandBus\Pracownik\DodajPracownikaCommand;
use AppBundle\Entity\Organizacja;
use AppBundle\Entity\Pracownik;
use AppBundle\Repository\Doctrine\PracownikRepository;
use AppBundle\Repository\IPracownikRepository;

class DodajPracownikaCommandHandler
{
    /** @var PracownikRepository */
    protected $pracownikRepository;

    /**
     * DodajOrganizacjeCommandHandler constructor.
     * @param IPracownikRepository $pracownikRepository
     */
    public function __construct(IPracownikRepository $pracownikRepository)
    {
        $this->pracownikRepository = $pracownikRepository;
    }

    public function handle(DodajPracownikaCommand $command)
    {
        $organizacja = new Pracownik($command->getUser(), $command->getImie(), $command->getNazw(), $command->getEmail(), $command->getIloscDniWolnych());
        $this->pracownikRepository->add($organizacja);
    }
}