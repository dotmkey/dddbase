<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Bundle\App\DependencyInjection;

use DDDBase\Resource\Port\Api\Middleware\MiddlewareInterface;
use DDDBase\Resource\Port\Api\Serialization\Representation\DomainObjectNormalizerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class AppExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->registerForAutoconfiguration(MiddlewareInterface::class)->addTag('middleware');
        $container
            ->registerForAutoconfiguration(DomainObjectNormalizerInterface::class)
            ->addTag('app.serializer.normalizer.domain_object')
        ;
    }
}