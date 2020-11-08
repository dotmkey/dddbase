<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Token;

use DDDBase\Domain\Model\EnumInterface;

class TokenStrategyEnum implements EnumInterface
{
    public const JWT_STRATEGY = 'jwt';

    public static function toArray(): array
    {
        return [self::JWT_STRATEGY];
    }
}