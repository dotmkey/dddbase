<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\ErrorHandling;

use DDDBase\Domain\BusinessLogicException;
use DDDBase\Resource\Port\Api\Exception\ErrorableBusinessLogicException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

class BusinessLogicExceptionHandler implements EventSubscriberInterface
{
    private SerializerInterface $serializer;

    private AbstractBusinessLogicErrorProxyRegistry $errorProxyRegistry;

    public function __construct(SerializerInterface $serializer, AbstractBusinessLogicErrorProxyRegistry $errorProxyRegistry)
    {
        $this->serializer = $serializer;
        $this->errorProxyRegistry = $errorProxyRegistry;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!($exception instanceof BusinessLogicException)) {
            return;
        }

        $errorableException = new ErrorableBusinessLogicException($exception);

        $context = $event->getRequest()->attributes->get('_route');
        if (($errorProxy = $this->errorProxyRegistry()->errorProxy($context)) !== null) {
            $httpCode = $errorProxy->httpCodeOfExceptionType($exception->getType());
        }

        $error = $this->serializer()->serialize($errorableException->generateError(), 'json');

        $event->setResponse(new JsonResponse($error, $httpCode ?? Response::HTTP_BAD_REQUEST, [], true));
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => 'onKernelException'];
    }

    private function serializer(): SerializerInterface
    {
        return $this->serializer;
    }

    private function errorProxyRegistry(): AbstractBusinessLogicErrorProxyRegistry
    {
        return $this->errorProxyRegistry;
    }
}