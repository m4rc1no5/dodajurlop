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
 * Class UrlopRodzaj
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="urloprodzaj")
 */
class UrlopRodzaj extends Entity
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Urlop", mappedBy="urlopRodzaj")
     */
    protected $urlopy;

    public function __construct()
    {
        $this->urlopy = new ArrayCollection();
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