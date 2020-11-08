<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Middleware;

use DDDBase\Resource\Port\Api\Annotation\Middleware as MWAnnotation;
use DDDBase\Resource\Port\Api\Annotation\AjaxOnly as AjaxOnlyAnnotation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AjaxOnly implements MiddlewareInterface
{
    public function handle(Request $request, MWAnnotation $annotation): void
    {
        if (!$this->isForAnnotation($annotation)) {
            return;
        }

        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Ajax only.');
        }
    }

    public function isForAnnotation(MWAnnotation $annotation): bool
    {
        return $annotation instanceof AjaxOnlyAnnotation;
    }

    public function annotationClass(): string
    {
        return AjaxOnlyAnnotation::class;
    }
}