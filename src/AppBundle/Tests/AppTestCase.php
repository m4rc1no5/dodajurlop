<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 05.12.15
 * Time: 23:10
 */

namespace AppBundle\Tests;

use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;

abstract class AppTestCase extends TestCase
{
    /**
     * Funkcja wspomagająca testowanie metod private i protected
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    protected function getMockQueryBuilder()
    {
        $qbuilder = M::mock(QueryBuilder::class);
        $qbuilder->shouldReceive('select')->andReturn($qbuilder);
        $qbuilder->shouldReceive('from')->andReturn($qbuilder);
        $qbuilder->shouldReceive('where')->andReturn($qbuilder);
        $qbuilder->shouldReceive('setParameter')->andReturn($qbuilder);
        $qbuilder->shouldReceive('andWhere')->andReturn($qbuilder);
        $qbuilder->shouldReceive('getQuery')->andReturn($qbuilder);
        $qbuilder->shouldReceive('orderBy')->andReturn($qbuilder);
        $qbuilder->shouldReceive('addOrderBy')->andReturn($qbuilder);
        $qbuilder->shouldReceive('getResult')->andReturn('Zwraca rezultat');

        return $qbuilder;
    }
}