<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Annotation;

/**
 * @Annotation
 * Class SchemaValidation
 * @package DDDBase\Resource\Port\Api\Annotation
 */
class SchemaValidation extends Middleware
{
    protected int $order = 20;

    protected string $schemable = "";

    public function schemable(): string
    {
        return $this->schemable;
    }
}