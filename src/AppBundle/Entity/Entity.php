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
}