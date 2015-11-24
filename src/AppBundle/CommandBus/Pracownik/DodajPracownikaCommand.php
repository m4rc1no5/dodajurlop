<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 22.11.15
 * Time: 21:04
 */

namespace AppBundle\CommandBus\Pracownik;


use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class DodajPracownikaCommand extends PracownikCommand
{
    /**
     * Konstruktor - musi być obiekt User
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
        return 'app.command.pracownik.dodaj';
    }
}