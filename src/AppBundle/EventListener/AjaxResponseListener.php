<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 18.11.15
 * Time: 11:07
 */

namespace AppBundle\EventListener;


use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AjaxResponseListener implements EventSubscriberInterface
{
	/** @var LoggerInterface */
	private $logger;

	private $debug;

	public function __construct(LoggerInterface $logger, $debug)
	{
		$this->logger = $logger;
		$this->debug = $debug;
	}

	/**
	 * Zamienia Response na JsonResposne dla Requesta AJAXowego
	 */
	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		$request = $event->getRequest();

		if ( ! $request->isXmlHttpRequest()) {
			return;
		}

		$e = $event->getException();

		$response = new JsonResponse($this->prepareContent($e));
		$event->setResponse($response);

		$this->logger->critical($e->getMessage(), [
			'code' => $e->getCode(),
			'file' => $e->getFile(),
			'line' => $e->getLine(),
		]);
	}

	/**
	 * Zamienia RedirectResponse na JsonResponse dla Requesta AJAXowego
	 */
	public function onKernelResponse(FilterResponseEvent $event)
	{
		if ( ! $event->isMasterRequest()) {
			return;
		}

		$request = $event->getRequest();

		if ( ! $request->isXmlHttpRequest()) {
			return;
		}

		$response = $event->getResponse();

		if ( ! $response instanceof RedirectResponse) {
			return;
		}

		$event->setResponse(new JsonResponse([
			'statusCode' => $response->getStatusCode(),
			'targetUrl' => $response->getTargetUrl()
		]));
	}

	private function prepareContent(\Exception $e)
	{
		$content = [ 'message' => 'Wystąpił nieoczekiwany błąd!' ];

		if (true === $this->debug) {
			$content = [
				'code' => $e->getCode(),
				'message' => $e->getMessage(),
				'file' => $e->getFile(),
				'line' => $e->getLine(),
			];
		}

		return $content;
	}

	public static function getSubscribedEvents()
	{
		return [
			KernelEvents::EXCEPTION => ['onKernelException'],
			KernelEvents::RESPONSE => ['onKernelResponse']
		];
	}

}