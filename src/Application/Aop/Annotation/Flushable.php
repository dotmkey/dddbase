<?php
declare(strict_types=1);

namespace DDDBase\Application\Aop\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Flushable extends Annotation
{
}