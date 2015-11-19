<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 18.11.15
 * Time: 21:40
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class DoctrineRepository extends EntityRepository
{
    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager, $entityManager->getClassMetadata($this->getEntityClassName()));
    }

    protected function getQueryBuilder($alias, $with_del = true)
    {
        $qb = $this->createQueryBuilder($alias);

        $qb->where($alias . '.wysw = :wysw')->setParameter('wysw', true);

        if($with_del){
            $qb->andWhere($alias . '.del = :del')->setParameter('del', false);
        }

        return $qb;
    }

    protected function doAdd($entity)
    {
        $this->_em->persist($entity);
    }

    abstract protected function getEntityClassName();
}