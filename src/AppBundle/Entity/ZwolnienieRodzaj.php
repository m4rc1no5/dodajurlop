<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 10.11.15
 * Time: 16:22
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ZwolnienieRodzaj
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="zwolnienierodzaj")
 */
class ZwolnienieRodzaj extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128)
     */
    protected $nazw;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Zwolnienie", mappedBy="zwolnienieRodzaj")
     */
    protected $zwolnienia;

    public function __construct()
    {
        $this->zwolnienia = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazw;
    }

    /**
     * @param string $nazw
     */
    public function setNazwa($nazw)
    {
        $this->nazw = $nazw;
    }

}