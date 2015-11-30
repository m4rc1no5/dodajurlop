<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 29.11.15
 * Time: 11:40
 */

namespace AppBundle\CommandBus\Urlop;


use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class DodajUrlopCommand extends UrlopCommand
{

    /**
     * DodajUrlopCommand constructor. Musi być user.
     *
     * @param TokenStorage $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        $user = $tokenStorage->getToken()->getUser();
        $this->user = $user;
    }

    /**
     * @return string
     */
    public static function messageName()
    {
        return 'app.command.urlop.dodaj';
    }

}