<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Aop;

use Go\Core\AspectKernel;

abstract class AbstractApplicationAspectKernel extends AspectKernel
{
    protected function normalizeOptions(array $options): array
    {
        function camelize(array $options): array
        {
            foreach ($options as $key => $option) {
                if (is_array($option)) {
                    camelize($option);
                }

                unset($options[$key]);

                $key = preg_replace_callback('/_(.?)/', fn($matches) => strtoupper($matches[1]), $key);

                $options[$key] = $option;
            }

            return $options;
        }

        $options = camelize($options);

        return parent::normalizeOptions($options);
    }
}