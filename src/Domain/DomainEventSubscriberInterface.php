<?php
declare(strict_types=1);

namespace DDDBase\Domain;

interface DomainEventSubscriberInterface
{
    public function handleEvent(DomainEventInterface $event): void;

    public function isSubscribedTo(DomainEventInterface $event): bool;

    public function eventType(): string;
}