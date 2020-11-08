<?php
declare(strict_types=1);

namespace DDDBase\Domain;

class DomainEventPublisher
{
    /** @var DomainEventSubscriberInterface[] */
    private static array $subscribers = [];

    public static function subscribe(DomainEventSubscriberInterface $subscriber): void
    {
        static::$subscribers[] = $subscriber;
    }

    /**
     * @return DomainEventSubscriberInterface[]
     */
    public static function subscribers(): array
    {
        return static::$subscribers;
    }

    public static function publish(DomainEventInterface $event): void
    {
        foreach (static::subscribers() as $subscriber) {
            if ($subscriber->isSubscribedTo($event)) {
                $subscriber->handleEvent($event);
            }
        }
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}