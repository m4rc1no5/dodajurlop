<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 10.11.15
 * Time: 15:08
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Pracownik
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="pracownik")
 */
class Pracownik extends Entity
{

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128)
     */
    protected $imie;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=256)
     */
    protected $nazw;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250)
     */
    protected $email;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $ilosc_dni_wolnych;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="pracownicy")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Urlop", mappedBy="pracownik")
     */
    protected $urlopy;


    /**
     * @param User $user
     * @param string $imie
     * @param string $nazw
     * @param string $email
     * @param int $ilosc_dni_wolnych
     */
    public function __construct(User $user, $imie, $nazw, $email, $ilosc_dni_wolnych)
    {
        $this->user = $user;
        $this->imie = $imie;
        $this->nazw = $nazw;
        $this->email = $email;
        $this->ilosc_dni_wolnych = $ilosc_dni_wolnych;
    }

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

    public function getUser()
    {
        return $this->user;
    }
}