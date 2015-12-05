<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 05.12.15
 * Time: 20:13
 */

namespace AppBundle\Repository\Doctrine;


use AppBundle\Entity\Urlop;
use AppBundle\Repository\DoctrineRepository;
use AppBundle\Repository\IUrlopRepository;

class UrlopRepository extends DoctrineRepository implements IUrlopRepository
{

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