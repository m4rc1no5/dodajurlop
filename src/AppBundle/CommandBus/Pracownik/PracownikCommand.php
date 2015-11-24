<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 22.11.15
 * Time: 20:57
 */

namespace AppBundle\CommandBus\Pracownik;


use AppBundle\CommandBus\Command;
use AppBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

abstract class PracownikCommand extends Command
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="128")
     */
    protected $imie;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="256")
     */
    protected $nazw;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="250")
     * @Assert\Email()
     */
    protected $email;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    protected $ilosc_dni_wolnych;

    /**
     * @var User
     */
    protected $user;
}