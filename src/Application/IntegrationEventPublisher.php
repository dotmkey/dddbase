<?php
declare(strict_types=1);

namespace DDDBase\Application;

use Symfony\Component\Messenger\MessageBusInterface;

class IntegrationEventPublisher
{
    private static MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        static::$messageBus = $messageBus;
    }

    public static function publish(IntegrationEventInterface $event): void
    {
        static::$messageBus->dispatch($event);
    }
}