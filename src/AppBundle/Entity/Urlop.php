<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 10.11.15
 * Time: 16:31
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Urlop
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="urlop")
 */
class Urlop extends Entity
{

    /**
     * @var UrlopRodzaj
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UrlopRodzaj", inversedBy="urlopy")
     * @ORM\JoinColumn(name="urloprodzaj_id", referencedColumnName="id")
     */
    protected $urlopRodzaj;

    /**
     * @var Pracownik
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pracownik", inversedBy="urlopy")
     * @ORM\JoinColumn(name="pracownik_id", referencedColumnName="id")
     */
    protected $pracownik;

    /**
     * @var Organizacja
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Organizacja", inversedBy="urlopy")
     * @ORM\JoinColumn(name="organizacja_id", referencedColumnName="id")
     */
    protected $organizacja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $dataOd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $dataDo;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $iloscDni;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $rok;
}