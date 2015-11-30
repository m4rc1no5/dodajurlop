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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Urlop", mappedBy="organizacja")
     */
    protected $urlopy;

    /**
     * @param User $user
     * @param string $nazwa
     * @param string $pnazwa
     */
    public function __construct(User $user, $nazwa, $pnazwa)
    {
        $this->user = $user;
        $this->nazwa = $nazwa;
        $this->pnazwa = $pnazwa;
        $this->urlopy = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getNazwa();
    }

    /**
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
    }

    /**
     * @return string
     */
    public function getPnazwa()
    {
        return $this->pnazwa;
    }

    public function setPnazwa($pnazwa)
    {
        $this->pnazwa = $pnazwa;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

}