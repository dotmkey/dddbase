<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\ErrorHandling;

abstract class AbstractBusinessLogicErrorProxy
{
    abstract protected static function errors(): array;

    public final function httpCodeOfExceptionType(string $exceptionType): ?int
    {
        foreach (static::errors() as $httpCode => $exceptionTypes) {
            if (in_array($exceptionType, $exceptionTypes)) {
                return $httpCode;
            }
        }

        return null;
    }
}