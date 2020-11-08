<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion;

use DDDBase\Domain\Model\EnumInterface;

class DefaultErrorEnum implements EnumInterface
{
    public const NOT_BLANK      = ErrorTypeEnum::DEFAULT_ERROR . '001';
    public const IS_EMPTY       = ErrorTypeEnum::DEFAULT_ERROR . '002';
    public const IS_NOT_EMPTY   = ErrorTypeEnum::DEFAULT_ERROR . '003';
    public const IS_NULL        = ErrorTypeEnum::DEFAULT_ERROR . '004';
    public const IS_NOT_NULL    = ErrorTypeEnum::DEFAULT_ERROR . '005';
    public const IS_TRUE        = ErrorTypeEnum::DEFAULT_ERROR . '006';
    public const IS_FALSE       = ErrorTypeEnum::DEFAULT_ERROR . '007';
    public const IS_ARRAY       = ErrorTypeEnum::DEFAULT_ERROR . '008';
    public const IS_EMAIL       = ErrorTypeEnum::DEFAULT_ERROR . '009';
    public const IN_ARRAY       = ErrorTypeEnum::DEFAULT_ERROR . '010';
    public const IS_INSTANCE_OF = ErrorTypeEnum::DEFAULT_ERROR . '011';
    public const GREATER_THAN   = ErrorTypeEnum::DEFAULT_ERROR . '012';
    public const LESS_THAN      = ErrorTypeEnum::DEFAULT_ERROR . '013';

    public static function toArray(): array
    {
        return [
            self::NOT_BLANK,
            self::IS_EMPTY,
            self::IS_NOT_EMPTY,
            self::IS_NULL,
            self::IS_NOT_NULL,
            self::IS_TRUE,
            self::IS_FALSE,
            self::IS_ARRAY,
            self::IS_EMAIL,
            self::IN_ARRAY,
            self::IS_INSTANCE_OF,
            self::GREATER_THAN,
            self::LESS_THAN
        ];
    }
}