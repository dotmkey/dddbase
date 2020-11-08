<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Serialization\Representation;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

interface DomainObjectNormalizerInterface extends NormalizerInterface
{
    public function domainObjectClass(): string;
}