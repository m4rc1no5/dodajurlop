<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 18.11.15
 * Time: 21:36
 */

namespace AppBundle\CommandBus\Organizacja;


use AppBundle\Entity\Organizacja;
use AppBundle\Repository\OrganizacjaRepository;

class DodajOrganizacjeCommandHandler
{
    /** @var OrganizacjaRepository */
    protected $organizacjaRepository;

    /**
     * DodajOrganizacjeCommandHandler constructor.
     * @param OrganizacjaRepository $organizacjaRepository
     */
    public function __construct(OrganizacjaRepository $organizacjaRepository)
    {
        $this->organizacjaRepository = $organizacjaRepository;
    }

    public function handle(DodajOrganizacjeCommand $command)
    {
        $organizacja = new Organizacja($command->getUser(), $command->getNazwa(), $command->getPnazwa());
        $this->organizacjaRepository->add($organizacja);
    }
}