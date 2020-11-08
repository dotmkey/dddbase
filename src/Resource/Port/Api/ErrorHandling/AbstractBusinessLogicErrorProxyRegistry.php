<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\ErrorHandling;

abstract class AbstractBusinessLogicErrorProxyRegistry
{
    abstract protected function errorProxyContextMap(): array;

    final public function errorProxy(string $context): ?AbstractBusinessLogicErrorProxy
    {
        $className = $this->errorProxyContextMap()[$context] ?? null;

        if (!is_null($className) && class_exists($className)) {
            return new $className();
        }

        return null;
    }
}