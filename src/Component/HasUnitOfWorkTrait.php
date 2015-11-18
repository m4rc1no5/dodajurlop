<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 18.11.15
 * Time: 22:05
 */

namespace Component;


trait HasUnitOfWorkTrait
{
    /** @var UnitOfWork */
    protected $unitOfWork;

    /**
     * @param UnitOfWork $unitOfWork
     */
    public function setUnitOfWork(UnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }

}