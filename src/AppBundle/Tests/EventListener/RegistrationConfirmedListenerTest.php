<?php
/**
 * What can I do? What can't I do!
 * User: mistrzJoda
 * Date: 05.12.15
 */

namespace AppBundle\Tests\EventListener;

use AppBundle\EventListener\RegistrationConfirmedListener;
use Mockery as M;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationConfirmedListenerTest extends TestCase
{
    /** @var  RegistrationConfirmedListener */
    private $listener;

    /** @var M\Mock */
    private $logger;

    /** @var  M\Mock */
    private $route;

    protected function setUp()
    {
        $this->logger = M::mock(LoggerInterface::class);
        $this->route = M::mock(UrlGeneratorInterface::class);
        $this->listener = new RegistrationConfirmedListener($this->logger, true, $this->route);
    }

    public function testOnRegistrationConfirm()
    {
        $event = M::mock(FormEvent::class);
        $event->shouldReceive('setResponse');
        $this->route->shouldReceive('generate')->andReturn('dashboard/');
        $this->assertNull($this->listener->onRegistrationConfirm($event));
    }

    public function testGetSubscribedEvents()
    {
        $ar_dane = $this->listener->getSubscribedEvents();
       $this->assertEquals('onRegistrationConfirm', $ar_dane['fos_user.registration.success']);
    }


}
