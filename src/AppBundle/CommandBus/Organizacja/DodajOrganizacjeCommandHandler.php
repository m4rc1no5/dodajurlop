<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 18.11.15
 * Time: 21:36
 */

namespace AppBundle\CommandBus\Organizacja;


use AppBundle\Entity\Organizacja;
use AppBundle\Repository\IOrganizacjaRepository;

class DodajOrganizacjeCommandHandler
{
    /** @var IOrganizacjaRepository */
    protected $organizacjaRepository;

    /**
     * DodajOrganizacjeCommandHandler constructor.
     * @param IOrganizacjaRepository $organizacjaRepository
     */
    public function __construct(IOrganizacjaRepository $organizacjaRepository)
    {
        $this->organizacjaRepository = $organizacjaRepository;
    }

    public function handle(DodajOrganizacjeCommand $command)
    {
        $organizacja = new Organizacja($command->getUser(), $command->getNazwa(), $command->getPnazwa());
        $this->organizacjaRepository->add($organizacja);
    }
}