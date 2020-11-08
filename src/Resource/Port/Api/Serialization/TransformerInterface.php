<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Serialization;

interface TransformerInterface
{
    public function transform(array $data): array;
}