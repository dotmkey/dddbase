<?php
declare(strict_types=1);

namespace DDDBase\Application;

interface IntegrationEventInterface
{
    public function version(): int;

    public function occurredAt(): \DateTimeImmutable;
}