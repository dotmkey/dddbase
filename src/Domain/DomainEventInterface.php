<?php
declare(strict_types=1);

namespace DDDBase\Domain;

interface DomainEventInterface
{
    public function version(): int;

    public function occurredAt(): \DateTimeImmutable;
}