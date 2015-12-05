<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 05.12.15
 * Time: 19:58
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Urlop;

interface IUrlopRepository
{
    public function add(Urlop $urlop);
}