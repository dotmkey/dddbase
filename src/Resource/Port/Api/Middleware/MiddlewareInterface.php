<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Middleware;

use DDDBase\Resource\Port\Api\Annotation\Middleware as MWAnnotation;
use Symfony\Component\HttpFoundation\Request;

interface MiddlewareInterface
{
    public function handle(Request $request, MWAnnotation $annotation): void;

    public function isForAnnotation(MWAnnotation $annotation): bool;

    public function annotationClass(): string;
}