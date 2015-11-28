<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 28.11.15
 * Time: 11:56
 */

namespace AppBundle\Repository\Doctrine;


use AppBundle\Repository\DoctrineRepository;
use AppBundle\Repository\IUrlopRodzajRepository;
use AppBundle\Entity\UrlopRodzaj;

class UrlopRodzajRepository extends DoctrineRepository implements IUrlopRodzajRepository
{
    public function getAll()
    {
        $qb = $this->getQueryBuilder('ur');

        return $qb->getQuery()->getResult();
    }

    protected function getEntityClassName()
    {
        return 'AppBundle\Entity\UrlopRodzaj';
    }
}