<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\ErrorHandling;

use DDDBase\Resource\Port\Api\Response\Error;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

class NativeHttpExceptionHandler implements EventSubscriberInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!($exception instanceof HttpException)) {
            return;
        }

        $error = new Error();
        $error->setMessage($exception->getMessage());

        $error = $this->serilizer()->serialize($error, 'json');

        $event->setResponse(new JsonResponse($error, $exception->getStatusCode(), [], true));
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => 'onKernelException'];
    }

    private function serilizer(): SerializerInterface
    {
        return $this->serializer;
    }
}