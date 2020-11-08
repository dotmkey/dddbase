<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Middleware;

use Doctrine\Common\Annotations\Reader;
use DDDBase\Resource\Port\Api\Annotation\Middleware as MWAnnotation;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MiddlewareManager implements EventSubscriberInterface
{
    private Reader $annotationReader;

    private array $middlewares;

    public function __construct(Reader $annotationReader, MiddlewareInterface ...$middlewares)
    {
        $this->annotationReader = $annotationReader;

        foreach ($middlewares as $middleware) {
            $this->middlewares[$middleware->annotationClass()] = $middleware;
        }
    }

    public function onKernelController(ControllerEvent $event): void
    {
        if (!is_array($event->getController())) {
            return;
        }

        list($controller, $method) = $event->getController();

        $controllerReflection = new \ReflectionClass(get_class($controller));
        $methodReflection = $controllerReflection->getMethod($method);

        $middlewareAnnotations = array_filter(
            $this->annotationReader->getMethodAnnotations($methodReflection),
            function ($annotation) {
                return $annotation instanceof MWAnnotation;
            }
        );

        usort(
            $middlewareAnnotations,
            function (MWAnnotation $annotationA, MWAnnotation $annotationB) {
                return $annotationA->order() <=> $annotationB->order();
            }
        );

        foreach ($middlewareAnnotations as $middlewareAnnotation) {
            if ($middleware = $this->middlewareOfAnnotation($middlewareAnnotation)) {
                $middleware->handle($event->getRequest(), $middlewareAnnotation);
            }
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::CONTROLLER => 'onKernelController'];
    }

    public function middlewareOfAnnotation(MWAnnotation $annotation): ?MiddlewareInterface
    {
        return $this->middlewares[get_class($annotation)] ?? null;
    }
}