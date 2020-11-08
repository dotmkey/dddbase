<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Bundle\App;

use DDDBase\Infrastructure\Bundle\App\DependencyInjection\Compiler\SerializationPass;
use DDDBase\Infrastructure\Bundle\App\DependencyInjection\Compiler\MiddlewarePass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new MiddlewarePass());
        $container->addCompilerPass(new SerializationPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1);
    }
}