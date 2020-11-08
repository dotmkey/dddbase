<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Bundle\App\DependencyInjection\Compiler;

use Doctrine\Common\Annotations\Reader;
use DDDBase\Resource\Port\Api\Middleware\MiddlewareManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MiddlewarePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $middlewareClasses = [];
        foreach ($container->findTaggedServiceIds('middleware') ?? [] as $middlewareClass => $_) {
            $middlewareClasses[] = $middlewareClass;
        }

        $container
            ->getDefinition(MiddlewareManager::class)
            ->setArguments([
                new Reference(Reader::class),
                ...array_map(function (string $item) {
                    return new Reference($item);
                }, $middlewareClasses)
            ])
        ;
    }
}