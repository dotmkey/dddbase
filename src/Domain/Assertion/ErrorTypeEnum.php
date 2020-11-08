<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion;

use DDDBase\Domain\Model\EnumInterface;

class ErrorTypeEnum implements EnumInterface
{
    public const PREFIX = 'PREFIX-';

    public const DEFAULT_ERROR = self::PREFIX . 'DFLT-';

    public static function toArray(): array
    {
        return [self::DEFAULT_ERROR];
    }
}