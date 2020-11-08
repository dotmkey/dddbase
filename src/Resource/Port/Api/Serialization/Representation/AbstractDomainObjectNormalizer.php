<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Serialization\Representation;

abstract class AbstractDomainObjectNormalizer implements DomainObjectNormalizerInterface
{
    use DefaultNormalizersTrait;

    abstract protected function map(object $object): array;

    public function normalize($object, string $format = null, array $context = []): ?array
    {
        if (!$this->supportsNormalization($object)) {
            return null;
        }

        return $this->map($object);
    }

    public function supportsNormalization($data, string $format = null)
    {
        return is_object($data) && is_a($data, $this->domainObjectClass());
    }
}