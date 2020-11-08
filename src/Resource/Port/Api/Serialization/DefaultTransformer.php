<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Serialization;

class DefaultTransformer implements TransformerInterface
{
    public function transform(array $data): array
    {
        return $data;
    }
}