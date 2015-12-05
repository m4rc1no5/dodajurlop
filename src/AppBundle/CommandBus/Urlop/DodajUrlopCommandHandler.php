<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 05.12.15
 * Time: 19:32
 */

namespace AppBundle\CommandBus\Urlop;


use AppBundle\Entity\Urlop;
use AppBundle\Repository\Doctrine\UrlopRepository;

class DodajUrlopCommandHandler
{

    /** @var UrlopRepository */
    private $urlopRepository;

    /**
     * DodajUrlopCommandHandler constructor.
     * @param UrlopRepository $urlopRepository
     */
    public function __construct(UrlopRepository $urlopRepository)
    {
        $this->urlopRepository = $urlopRepository;
    }

    /**
     * @param DodajUrlopCommand $command
     * @return Urlop $urlop
     */
    public function handle(DodajUrlopCommand $command)
    {
        $urlop = new Urlop(
            $command->getUser(),
            $command->getUrlopRodzaj(),
            $command->getPracownik(),
            $command->getOrganizacja(),
            $command->getDataOd(),
            $command->getDataDo(),
            $command->getIloscDni(),
            $command->getRok());

        $this->urlopRepository->add($urlop);

        return $urlop;
    }
}