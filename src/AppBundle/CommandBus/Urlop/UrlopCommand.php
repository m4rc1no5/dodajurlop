<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 28.11.15
 * Time: 11:42
 */

namespace AppBundle\CommandBus\Urlop;


use AppBundle\CommandBus\Command;
use AppBundle\Entity\Organizacja;
use AppBundle\Entity\Pracownik;
use AppBundle\Entity\UrlopRodzaj;
use AppBundle\Entity\User;
use AppBundle\Repository\Doctrine\PracownikRepository;

abstract class UrlopCommand extends Command
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var UrlopRodzaj
     */
    protected $urlopRodzaj;

    /**
     * @var Pracownik
     */
    protected $pracownik;

    /**
     * @var Organizacja
     */
    protected $organizacja;

    /**
     * @var \DateTime
     */
    protected $dataOd;

    /**
     * @var \DateTime
     */
    protected $dataDo;

    /**
     * @var int
     */
    protected $iloscDni;

    /**
     * @var int
     */
    protected $rok;

    /**
     * @return UrlopRodzaj
     */
    public function getUrlopRodzaj()
    {
        return $this->urlopRodzaj;
    }

    /**
     * @param UrlopRodzaj $urlopRodzaj
     */
    public function setUrlopRodzaj(UrlopRodzaj $urlopRodzaj)
    {
        $this->urlopRodzaj = $urlopRodzaj;
    }

    /**
     * @return Pracownik
     */
    public function getPracownik()
    {
        return $this->pracownik;
    }

    /**
     * @param Pracownik $pracownik
     */
    public function setPracownik(Pracownik $pracownik)
    {
        $this->pracownik = $pracownik;
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

    /**
     * @return \DateTime
     */
    public function getDataOd()
    {
        return $this->dataOd;
    }

    /**
     * @param \DateTime $dataOd
     */
    public function setDataOd(\DateTime $dataOd)
    {
        $this->dataOd = $dataOd;
    }

    /**
     * @return \DateTime
     */
    public function getDataDo()
    {
        return $this->dataDo;
    }

    /**
     * @param \DateTime $dataDo
     */
    public function setDataDo(\DateTime $dataDo)
    {
        $this->dataDo = $dataDo;
    }

    /**
     * @return int
     */
    public function getIloscDni()
    {
        return $this->iloscDni;
    }

    /**
     * @param int $iloscDni
     */
    public function setIloscDni($iloscDni)
    {
        $this->iloscDni = $iloscDni;
    }

    /**
     * @return int
     */
    public function getRok()
    {
        return $this->rok;
    }

    /**
     * @param int $rok
     */
    public function setRok($rok)
    {
        $this->rok = $rok;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

}