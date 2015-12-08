<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 22.11.15
 * Time: 20:57
 */

namespace AppBundle\CommandBus\Pracownik;


use AppBundle\CommandBus\Command;
use AppBundle\Entity\Organizacja;
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

    /**
     * @var Organizacja
     *
     * @Assert\NotBlank()
     */
    protected $organizacja;

    /**
     * @return string
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * @param string $imie
     */
    public function setImie($imie)
    {
        $this->imie = $imie;
    }

    /**
     * @return string
     */
    public function getNazw()
    {
        return $this->nazw;
    }

    /**
     * @param string $nazw
     */
    public function setNazw($nazw)
    {
        $this->nazw = $nazw;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return integer
     */
    public function getIloscDniWolnych()
    {
        return $this->ilosc_dni_wolnych;
    }

    /**
     * @param integer $ilosc_dni_wolnych
     */
    public function setIloscDniWolnych($ilosc_dni_wolnych)
    {
        $this->ilosc_dni_wolnych = $ilosc_dni_wolnych;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return Organizacja
     */
    public function getOrganizacja()
    {
        return $this->organizacja;
    }

    /**
     * @param Organizacja $organizacja
     */
    public function setOrganizacja(Organizacja $organizacja)
    {
        $this->organizacja = $organizacja;
    }


}