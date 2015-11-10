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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Zwolnienie", mappedBy="pracownik")
     */
    protected $zwolnienia;
}