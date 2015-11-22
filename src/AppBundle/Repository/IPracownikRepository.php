<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 22.11.15
 * Time: 21:11
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Pracownik;
use AppBundle\Entity\User;

interface IPracownikRepository
{
    public function findAllByUser(User $user);

    public function add(Pracownik $pracownik);
}