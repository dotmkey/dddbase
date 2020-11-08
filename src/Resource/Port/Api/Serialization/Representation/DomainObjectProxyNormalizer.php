<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Serialization\Representation;

use DDDBase\Domain\Model\AbstractIdentifiedDomainObject;
use DDDBase\Domain\Model\AbstractValueObject;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DomainObjectProxyNormalizer implements NormalizerInterface
{
    protected array $normalizers = [];

    public function __construct(DomainObjectNormalizerInterface ...$normalizers)
    {
        foreach ($normalizers as $normalizer) {
            $this->normalizers[$normalizer->domainObjectClass()] = $normalizer;
        }
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        if (!$this->supportsNormalization($object) || ($normalizer = $this->normalizerOfObject($object)) === null) {
            return null;
        }

        return $normalizer->normalize($object);
    }

    protected function normalizerOfObject(object $object): ?NormalizerInterface
    {
        return $this->normalizers[get_class($object)] ?? null;
    }

    public function supportsNormalization($data, string $format = null)
    {
        return is_object($data) && ($data instanceof AbstractIdentifiedDomainObject || $data instanceof AbstractValueObject);
    }
}