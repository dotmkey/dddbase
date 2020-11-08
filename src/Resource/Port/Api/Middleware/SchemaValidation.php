<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Middleware;

use DDDBase\Application\Command\SchemableInterface;
use DDDBase\Resource\Port\Api\Annotation\Middleware as MWAnnotation;
use DDDBase\Resource\Port\Api\Exception\BadRequest\RequestDoentMatchTheSchema;
use JsonSchema\Validator;
use Symfony\Component\HttpFoundation\Request;

class SchemaValidation implements MiddlewareInterface
{
    /**
     * @param Request $request
     * @param \DDDBase\Resource\Port\Api\Annotation\SchemaValidation $annotation
     */
    public function handle(Request $request, MWAnnotation $annotation): void
    {
        if (!$this->isForAnnotation($annotation)) {
            return;
        }

        if (!class_exists($schemable = $annotation->schemable())) {
            return;
        }

        $data = json_decode($request->getContent());
        $schemable = new $schemable();

        if (!($schemable instanceof SchemableInterface)) {
            return;
        }

        $validator = new Validator();
        $validator->validate($data, $schemable->schema());

        if (!$validator->isValid()) {
            throw new RequestDoentMatchTheSchema($validator);
        }
    }

    public function isForAnnotation(MWAnnotation $annotation): bool
    {
        return is_a($annotation, $this->annotationClass());
    }

    public function annotationClass(): string
    {
        return \DDDBase\Resource\Port\Api\Annotation\SchemaValidation::class;
    }
}