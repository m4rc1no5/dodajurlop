<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 10.11.15
 * Time: 23:04
 */

namespace AppBundle\Doctrine;


use AppBundle\Entity\Entity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

final class DataEntityListener
{
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        $this->setDefaults($eventArgs->getEntity(), $eventArgs->getEntityManager());
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $this->setDefaults($eventArgs->getEntity(), $eventArgs->getEntityManager());
    }

    private function setDefaults($entity, EntityManager $em)
    {

        if(!$entity instanceof Entity) return;

        $defaults = array(
            'modata' => new \DateTime(date('Y-m-d H:i:s'))
        );

        if(is_null($entity->getId())) {
            $defaults['dodata'] = new \DateTime(date('Y-m-d H:i:s'));
            $defaults['wysw']   = true;
            $defaults['del']    = false;
        }

        $ref = new \ReflectionObject($entity);
        foreach($defaults as $property => $value) {
            $refProperty = $ref->getProperty($property);
            $refProperty->setAccessible(true);
            $refProperty->setValue($entity, $value);
        }
    }
}