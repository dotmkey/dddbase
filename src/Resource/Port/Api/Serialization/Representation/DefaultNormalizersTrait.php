<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Serialization\Representation;

use DDDBase\Domain\Model\AbstractDomainObjectId;

trait DefaultNormalizersTrait
{
    protected function normalizeDomainObjectId(?AbstractDomainObjectId $domainObjectId): ?string
    {
        return is_null($domainObjectId) ? null : $domainObjectId->id();
    }

    protected function normalizeDateTime(?\DateTimeImmutable $dateTime): ?string
    {
        return is_null($dateTime) ? null : $dateTime->format(\DateTimeInterface::RFC3339);
    }
}