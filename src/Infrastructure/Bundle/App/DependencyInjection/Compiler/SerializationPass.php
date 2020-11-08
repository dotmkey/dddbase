<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Bundle\App\DependencyInjection\Compiler;

use DDDBase\Resource\Port\Api\Serialization\Representation\DomainObjectProxyNormalizer;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SerializationPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        list($normalizerClasses, $tag) = [[], 'app.serializer.normalizer.domain_object'];
        foreach ($container->findTaggedServiceIds($tag) ?? [] as $normalizerClass => $_) {
            $normalizerClasses[] = $normalizerClass;
        }

        $container
            ->getDefinition(DomainObjectProxyNormalizer::class)
            ->setArguments([
                ...array_map(function (string $item) {
                    return new Reference($item);
                }, $normalizerClasses)
            ])
        ;

        foreach ($normalizerClasses as $normalizerClass) {
            $container->getDefinition($normalizerClass)->clearTag('serializer.normalizer');
        }
    }
}