<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 18.11.15
 * Time: 22:03
 */

namespace Component;


use Doctrine\ORM\EntityManager;

class UnitOfWork
{
    /** @var EntityManager */
    protected $entityManager;

    /**
     * UnitOfWork constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function commit()
    {
        $this->entityManager->flush();
    }
}