<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 11.11.15
 * Time: 10:30
 */

namespace AppBundle\CommandBus\Organizacja;

use AppBundle\CommandBus\Command;
use AppBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

abstract class OrganizacjaCommand extends Command
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="128")
     */
    protected $nazwa;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="512")
     */
    protected $pnazwa;

    /**
     * @var User
     */
    protected $user;

    /**
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * @param string $nazwa
     */
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

    /**
     * @param string $pnazwa
     */
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

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}