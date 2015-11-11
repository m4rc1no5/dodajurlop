<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 11.11.15
 * Time: 10:40
 */

namespace AppBundle\CommandBus\Organizacja;


use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class DodajOrganizacjeCommand extends OrganizacjaCommand
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
     * Nazwa Commanda
     *
     * @return string
     */
    public static function messageName()
    {
        return 'app.command.organizacja.dodaj';
    }

}