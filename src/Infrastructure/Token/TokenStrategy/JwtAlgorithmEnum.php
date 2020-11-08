<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Token\TokenStrategy;

use DDDBase\Domain\Model\EnumInterface;

class JwtAlgorithmEnum implements EnumInterface
{
    public const RS_512_ALGORITHM = 'RS512';
    public const RS_384_ALGORITHM = 'RS384';
    public const RS_256_ALGORITHM = 'RS256';
    public const HS_512_ALGORITHM = 'HS512';
    public const HS_384_ALGORITHM = 'HS384';
    public const HS_256_ALGORITHM = 'HS256';

    public static function toArray(): array
    {
        return [
            self::RS_512_ALGORITHM,
            self::RS_384_ALGORITHM,
            self::RS_256_ALGORITHM,
            self::HS_512_ALGORITHM,
            self::HS_384_ALGORITHM,
            self::HS_256_ALGORITHM
        ];
    }
}