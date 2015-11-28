<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 22.11.15
 * Time: 21:09
 */

namespace AppBundle\Repository\Doctrine;


use AppBundle\Entity\User;
use AppBundle\Repository\DoctrineRepository;
use AppBundle\Entity\Pracownik;
use AppBundle\Repository\IPracownikRepository;

class PracownikRepository extends DoctrineRepository implements IPracownikRepository
{

    /**
     * @param User $user
     * @return array
     */
    public function findAllByUser(User $user)
    {
        $qb = $this->getQueryBuilder('p');

        $qb
            ->andWhere('p.user = :user')->setParameter('user', $user)
            ->andWhere('p.del = :del')->setParameter('del', false)
            ->orderBy('p.nazw')
        ;

        return $qb->getQuery()->getResult();
    }

    /**
     * @param Pracownik $pracownik
     */
    public function add(Pracownik $pracownik)
    {
        $this->doAdd($pracownik);
    }

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return 'AppBundle\Entity\Pracownik';
    }
}