<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 05.12.15
 * Time: 20:13
 */

namespace AppBundle\Repository\Doctrine;


use AppBundle\Entity\Urlop;
use AppBundle\Entity\User;
use AppBundle\Repository\DoctrineRepository;
use AppBundle\Repository\IUrlopRepository;

class UrlopRepository extends DoctrineRepository implements IUrlopRepository
{

    /**
     * @param User $user
     * @return array
     */
    public function findAllByUser(User $user)
    {
        $qb = $this->getQueryBuilder('u');

        $qb
            ->andWhere('u.user = :user')->setParameter('user', $user)
            ->andWhere('u.del = :del')->setParameter('del', false)
            ->addOrderBy('u.rok')
            ->addOrderBy('u.dataOd');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param Urlop $urlop
     */
    public function add(Urlop $urlop)
    {
        $this->doAdd($urlop);
    }

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return 'AppBundle\Entity\Urlop';
    }

}