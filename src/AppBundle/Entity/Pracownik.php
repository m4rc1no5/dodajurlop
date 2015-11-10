<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 10.11.15
 * Time: 15:08
 */

namespace AppBundle\Entity;

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
     * @var Organizacja
     *
     * @ORM\ManyToOne(targetEntity="Organizacja", inversedBy="pracownicy")
     * @ORM\JoinColumn(name="organizacja_id", referencedColumnName="id")
     */
    protected $organizacja;
}