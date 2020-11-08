<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Annotation;

use Doctrine\Common\Annotations\Annotation;

class Middleware extends Annotation
{
    protected int $order = 10;

    public function order(): int
    {
        return $this->order;
    }
}