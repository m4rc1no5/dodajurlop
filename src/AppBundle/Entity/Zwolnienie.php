<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 10.11.15
 * Time: 16:31
 */

namespace AppBundle\Entity;


class Zwolnienie extends Entity
{

    /**
     * @var ZwolnienieRodzaj
     *
     *
     */
    protected $zwolnienieRodzaj;

    protected $pracownik;

    protected $organizacja;

    protected $dataOd;

    protected $dataDo;

    protected $iloscDni;

    protected $rok;
}