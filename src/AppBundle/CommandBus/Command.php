<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 11.11.15
 * Time: 10:27
 */

namespace AppBundle\CommandBus;


use SimpleBus\Message\Name\NamedMessage;

abstract class Command implements NamedMessage
{

}