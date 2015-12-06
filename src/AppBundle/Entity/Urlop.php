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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="urlopy")
     * @ORM\JoinColumn(name="fos_user_id", referencedColumnName="id")
     */
    protected $user;

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

    /**
     * Urlop constructor.
     * @param User $user
     * @param UrlopRodzaj $urlopRodzaj
     * @param Pracownik $pracownik
     * @param Organizacja $organizacja
     * @param \DateTime $dataOd
     * @param \DateTime $dataDo
     * @param string $iloscDni
     * @param int $rok
     */
    public function __construct(User $user, UrlopRodzaj $urlopRodzaj, Pracownik $pracownik, Organizacja $organizacja, \DateTime $dataOd, \DateTime $dataDo, $iloscDni, $rok)
    {
        $this->user = $user;
        $this->urlopRodzaj = $urlopRodzaj;
        $this->pracownik = $pracownik;
        $this->organizacja = $organizacja;
        $this->dataOd = $dataOd;
        $this->dataDo = $dataDo;
        $this->iloscDni = $iloscDni;
        $this->rok = $rok;
    }

    /**
     * @return UrlopRodzaj
     */
    public function getUrlopRodzaj()
    {
        return $this->urlopRodzaj;
    }

    /**
     * @return Pracownik
     */
    public function getPracownik()
    {
        return $this->pracownik;
    }

    /**
     * @return Organizacja
     */
    public function getOrganizacja()
    {
        return $this->organizacja;
    }

    /**
     * @return \DateTime
     */
    public function getDataOd()
    {
        return $this->dataOd;
    }

    /**
     * @return \DateTime
     */
    public function getDataDo()
    {
        return $this->dataDo;
    }

    /**
     * @return string
     */
    public function getIloscDni()
    {
        return $this->iloscDni;
    }

    /**
     * @return int
     */
    public function getRok()
    {
        return $this->rok;
    }

}