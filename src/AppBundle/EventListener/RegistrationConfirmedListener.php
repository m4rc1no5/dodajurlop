<?php
/**
 * What can I do? What can't I do!
 * User: mistrzJoda
 * Date: 05.12.15
 */
namespace AppBundle\EventListener;

use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\UserBundle\Event\FilterUserResponseEvent;

class RegistrationConfirmedListener implements EventSubscriberInterface
{
    /** @var LoggerInterface */
    private $logger;

    private $debug;

    /** @var  UrlGeneratorInterface */
    private $route;

    public function __construct(LoggerInterface $logger, $debug, UrlGeneratorInterface $route)
    {
        $this->logger = $logger;
        $this->debug = $debug;
        $this->route = $route;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationConfirm'
        );
    }

    public function onRegistrationConfirm(FormEvent $event)
    {
        $url = $this->route->generate('dashboard');
        $response = new RedirectResponse($url);
        $event->setResponse($response);
    }

}