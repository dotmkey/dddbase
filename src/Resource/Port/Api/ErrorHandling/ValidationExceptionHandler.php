<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\ErrorHandling;

use DDDBase\Domain\Assertion\ValidationException;
use DDDBase\Resource\Port\Api\Exception\ErrorableValidationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

class ValidationExceptionHandler implements EventSubscriberInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!($exception instanceof ValidationException)) {
            return;
        }

        $errorableException = new ErrorableValidationException($exception);

        $error = $this->serializer()->serialize($errorableException->generateError(), 'json');

        $event->setResponse(new JsonResponse($error, Response::HTTP_UNPROCESSABLE_ENTITY, [], true));
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