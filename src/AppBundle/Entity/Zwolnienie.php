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
 * Class Zwolnienie
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="zwolnienie")
 */
class Zwolnienie extends Entity
{

    /**
     * @var ZwolnienieRodzaj
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ZwolnienieRodzaj", inversedBy="zwolnienia")
     * @ORM\JoinColumn(name="zwolnienierodzaj_id", referencedColumnName="id")
     */
    protected $zwolnienieRodzaj;

    /**
     * @var Pracownik
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pracownik", inversedBy="zwolnienia")
     * @ORM\JoinColumn(name="pracownik_id", referencedColumnName="id")
     */
    protected $pracownik;

    /**
     * @var Organizacja
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Organizacja", inversedBy="zwolnienia")
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