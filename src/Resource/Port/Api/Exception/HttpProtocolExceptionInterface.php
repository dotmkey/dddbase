<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Exception;

interface HttpProtocolExceptionInterface extends ErrorableExceptionInterface
{
    public function getType(): string;

    public function getHttpCode(): int;
}