<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion;

use DDDBase\Domain\Assertion\DefaultStatement\GreaterThan;
use DDDBase\Domain\Assertion\DefaultStatement\InArray;
use DDDBase\Domain\Assertion\DefaultStatement\IsArray;
use DDDBase\Domain\Assertion\DefaultStatement\IsEmail;
use DDDBase\Domain\Assertion\DefaultStatement\IsEmpty;
use DDDBase\Domain\Assertion\DefaultStatement\IsFalse;
use DDDBase\Domain\Assertion\DefaultStatement\IsInstanceOf;
use DDDBase\Domain\Assertion\DefaultStatement\IsNotEmpty;
use DDDBase\Domain\Assertion\DefaultStatement\IsNotNull;
use DDDBase\Domain\Assertion\DefaultStatement\IsNull;
use DDDBase\Domain\Assertion\DefaultStatement\IsTrue;
use DDDBase\Domain\Assertion\DefaultStatement\LessThan;
use DDDBase\Domain\BusinessLogicException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class Assertion
{
    protected static Validation $validation;

    protected static function validation(): Validation
    {
        return static::$validation;
    }

    public static function assertInArray($needle, array $haystack)
    {
        static::throwIfError(static::validation()->validate(new InArray($needle, $haystack)));
    }

    public static function assertIsNull($value): void
    {
        static::throwIfError(static::validation()->validate(new IsNull($value)));
    }

    public static function assertIsNotNull($value): void
    {
        static::throwIfError(static::validation()->validate(new IsNotNull($value)));
    }

    public static function assertIsTrue($value): void
    {
        static::throwIfError(static::validation()->validate(new IsTrue($value)));
    }

    public static function assertIsFalse($value): void
    {
        static::throwIfError(static::validation()->validate(new IsFalse($value)));
    }

    public static function assertIsEmpty($value): void
    {
        static::throwIfError(static::validation()->validate(new IsEmpty($value)));
    }

    public static function assertIsNotEmpty($value): void
    {
        static::throwIfError(static::validation()->validate(new IsNotEmpty($value)));
    }

    public static function assertIsEmail(string $value): void
    {
        static::throwIfError(static::validation()->validate(new IsEmail($value)));
    }

    public static function assertInstanceOf(?object $object, string $className): void
    {
        static::throwIfError(static::validation()->validate(new IsInstanceOf($object, $className)));
    }

    public static function assertGT(int $value, int $compareTo, bool $strictly = true): void
    {
        static::throwIfError(static::validation()->validate(new GreaterThan($value, $compareTo, $strictly)));
    }

    public static function assertLT(int $value, int $compareTo, bool $strictly = true): void
    {
        static::throwIfError(static::validation()->validate(new LessThan($value, $compareTo, $strictly)));
    }

    public static function assertIsArray($value): void
    {
        static::throwIfError(static::validation()->validate(new IsArray($value)));
    }

    public static function assert(AbstractStatement $statement): void
    {
        static::throwIfError(static::validation()->validate($statement));
    }

    private static function throwIfError(ConstraintViolationListInterface $errors): void
    {
        if ($errors->count()) {
            throw new BusinessLogicException($errors[0]);
        }
    }
}