<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 10.11.15
 * Time: 14:50
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Organizacja
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="organizacja")
 */
class Organizacja extends Entity
{

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128)
     */
    protected $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=512)
     */
    protected $pnazwa;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Pracownik", mappedBy="organizacja")
     */
    protected $pracownicy;

    public function __construct()
    {
        $this->pracownicy = new ArrayCollection();
    }
}