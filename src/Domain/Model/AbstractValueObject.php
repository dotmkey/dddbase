<?php
declare(strict_types=1);

namespace DDDBase\Domain\Model;

abstract class AbstractValueObject
{
    abstract public function equals(self $valueObject): bool;
}