<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 18.11.15
 * Time: 22:06
 */

namespace Component;


interface IHasUnitOfWork
{
    public function setUnitOfWork(UnitOfWork $unitOfWork);
}