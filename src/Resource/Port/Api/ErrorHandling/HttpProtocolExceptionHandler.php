<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\ErrorHandling;

use DDDBase\Resource\Port\Api\Exception\HttpProtocolExceptionInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

class HttpProtocolExceptionHandler implements EventSubscriberInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!($exception instanceof HttpProtocolExceptionInterface)) {
            return;
        }

        $error = $this->serializer()->serialize($exception->generateError(), 'json');

        $event->setResponse(new JsonResponse($error, $exception->getHttpCode(), [], true));
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => 'onKernelException'];
    }

    private function serializer(): SerializerInterface
    {
        return $this->serializer;
    }
}