<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion\DefaultStatement;

use DDDBase\Domain\Assertion\DefaultErrorEnum;
use DDDBase\Domain\Assertion\AbstractStatement;
use Symfony\Component\Validator\Constraints\IsFalse as BaseIsFalse;

class IsFalse extends AbstractStatement
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function type(): string
    {
        return DefaultErrorEnum::IS_FALSE;
    }

    public function value()
    {
        return $this->value;
    }

    public function constraint(): \Symfony\Component\Validator\Constraint
    {
        return new BaseIsFalse();
    }
}