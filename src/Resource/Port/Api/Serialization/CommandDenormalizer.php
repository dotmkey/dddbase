<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Serialization;

use DDDBase\Application\Command\AbstractCommand;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class CommandDenormalizer implements DenormalizerInterface
{
    public const TRANSFORMER_CONTEXT = 'transformer';
    
    public function denormalize($data, string $type, string $format = null, array $context = []): ?AbstractCommand
    {
        if (!$this->supportsDenormalization($data, $type, $format)) {
            return null;
        }

        $transformer = $context[self::TRANSFORMER_CONTEXT] ?? new DefaultTransformer();

        if (!($transformer instanceof TransformerInterface)) {
            $transformer = new DefaultTransformer();
        }

        return $type::fromArray($transformer->transform($data));
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return is_a($type, AbstractCommand::class, true);
    }
}