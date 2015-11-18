<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 18.11.15
 * Time: 21:38
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Organizacja;

class OrganizacjaRepository extends DoctrineRepository
{
    public function add(Organizacja $organizacja)
    {
        $this->doAdd($organizacja);
    }

    protected function getEntityClassName()
    {
        return 'AppBundle\Entity\Organizacja';
    }
}