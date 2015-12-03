<?php
/**
 * What can I do? What can't I do!
 * User: mistrzJoda
 * Date: 03.12.15
 */

namespace AppBundle\Tests\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use AppBundle\EventListener\AjaxResponseListener;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;

class AjaxResponseListenerTest extends TestCase
{

    /** @var  AjaxResponseListener */
    private $listener;

    /** @var M\Mock */
    private $logger;

    protected function setUp()
    {
        $this->logger = M::mock(LoggerInterface::class);
        $this->listener = new AjaxResponseListener($this->logger, true);
    }

    public function testOnKernelExceptionReturnNull()
    {
        $event = M::mock(GetResponseForExceptionEvent::class);
        $event->shouldReceive('getRequest')->andReturn(M::mock()->shouldReceive('isXmlHttpRequest')->andReturn(false)->getMock());
        $this->assertNull($this->listener->onKernelException($event));
    }

    public function testOnKernelException()
    {
        $event = M::mock(GetResponseForExceptionEvent::class);
        $event->shouldReceive('getRequest')->andReturn(M::mock()->shouldReceive('isXmlHttpRequest')->andReturn(true)->getMock());
        $event->shouldReceive('getException')->andReturn(new \Exception());
        $event->shouldReceive('setResponse');

        $this->logger->shouldReceive('critical');

        $this->assertNull($this->listener->onKernelException($event));

    }

    public function testOnKernelResponseReturnNull()
    {
        $event = M::mock(FilterResponseEvent::class);
        $event->shouldReceive('isMasterRequest')->andReturn(false);
        $this->assertNull($this->listener->onKernelResponse($event));
    }

    public function testOnKernelResponseReturnNullSecond()
    {
        $event = M::mock(FilterResponseEvent::class);
        $event->shouldReceive('isMasterRequest')->andReturn(true);
        $event->shouldReceive('getRequest')->andReturn(M::mock()->shouldReceive('isXmlHttpRequest')->andReturn(false)->getMock());
        $this->assertNull($this->listener->onKernelResponse($event));
    }

    public function testOnKernelResponseReturnNullThird()
    {
        $event = M::mock(FilterResponseEvent::class);
        $event->shouldReceive('isMasterRequest')->andReturn(true);
        $event->shouldReceive('getRequest')->andReturn(M::mock()->shouldReceive('isXmlHttpRequest')->andReturn(true)->getMock());
        $event->shouldReceive('getResponse');
        $this->assertNull($this->listener->onKernelResponse($event));
    }

    public function testOnKernelResponse()
    {
        $event = M::mock(FilterResponseEvent::class);
        $event->shouldReceive('isMasterRequest')->andReturn(true);
        $event->shouldReceive('getRequest')->andReturn(M::mock()->shouldReceive('isXmlHttpRequest')->andReturn(true)->getMock());
        $event->shouldReceive('getResponse')->andReturn(new RedirectResponse('localhost'));
        $event->shouldReceive('setResponse');
        $this->listener->onKernelResponse($event);
    }




}
