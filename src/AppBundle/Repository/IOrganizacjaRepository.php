<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 19.11.15
 * Time: 19:11
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Organizacja;
use AppBundle\Entity\User;

interface IOrganizacjaRepository
{
    public function findAllByUser(User $user);

    public function add(Organizacja $organizacja);
}