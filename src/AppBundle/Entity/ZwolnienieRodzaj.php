<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 10.11.15
 * Time: 16:22
 */

namespace AppBundle\Entity;

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
}