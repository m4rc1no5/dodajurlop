<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 19.11.15
 * Time: 19:08
 */

namespace AppBundle\Repository\Doctrine;


use AppBundle\Entity\Organizacja;
use AppBundle\Entity\User;
use AppBundle\Repository\DoctrineRepository;
use AppBundle\Repository\IOrganizacjaRepository;

class OrganizacjaRepository extends DoctrineRepository implements IOrganizacjaRepository
{
    public function findAllByUser(User $user)
    {
        $qb = $this->getQueryBuilder('o');

        $qb
            ->andWhere('o.user = :user')->setParameter('user', $user)
            ->addOrderBy('o.nazwa')
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @param Organizacja $organizacja
     */
    public function add(Organizacja $organizacja)
    {
        $this->doAdd($organizacja);
    }

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return 'AppBundle\Entity\Organizacja';
    }
}