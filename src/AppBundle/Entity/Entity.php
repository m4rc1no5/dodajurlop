<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 10.11.15
 * Time: 14:54
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class Entity
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $wysw = true;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $del = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $dodata;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $modata;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $licznik = 1;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $opis;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    protected $komentarz;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function isWysw()
    {
        return $this->wysw;
    }

    /**
     * @param boolean $wysw
     */
    public function setWysw($wysw)
    {
        $this->wysw = $wysw;
    }

    /**
     * @return boolean
     */
    public function isDel()
    {
        return $this->del;
    }

    /**
     * @param boolean $del
     */
    public function setDel($del)
    {
        $this->del = $del;
    }

    /**
     * @return \DateTime
     */
    public function getDodata()
    {
        return $this->dodata;
    }

    /**
     * @param \DateTime $dodata
     */
    public function setDodata(\DateTime $dodata)
    {
        $this->dodata = $dodata;
    }

    /**
     * @return \DateTime
     */
    public function getModata()
    {
        return $this->modata;
    }

    /**
     * @param \DateTime $modata
     */
    public function setModata(\DateTime $modata)
    {
        $this->modata = $modata;
    }

    /**
     * @return int
     */
    public function getLicznik()
    {
        return $this->licznik;
    }

    /**
     * @param int $licznik
     */
    public function setLicznik($licznik)
    {
        $this->licznik = $licznik;
    }

    /**
     * @return string
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * @param string $opis
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;
    }

    /**
     * @return string
     */
    public function getKomentarz()
    {
        return $this->komentarz;
    }

    /**
     * @param string $komentarz
     */
    public function setKomentarz($komentarz)
    {
        $this->komentarz = $komentarz;
    }

}