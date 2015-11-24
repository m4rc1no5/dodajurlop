<?php
namespace AppBundle\CommandBus\Organizacja;


use AppBundle\Entity\Organizacja;
use AppBundle\Repository\IOrganizacjaRepository;

class EdytujOrganizacjeCommandHandler
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

    public function handle(EdytujOrganizacjeCommand $command)
    {

    }
}