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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="organizacje")
     * @ORM\JoinColumn(name="fos_user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Zwolnienie", mappedBy="organizacja")
     */
    protected $zwolnienia;

    public function __construct()
    {
        $this->zwolnienia = new ArrayCollection();
    }
}