<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion\DefaultStatement;

use DDDBase\Domain\Assertion\DefaultErrorEnum;
use DDDBase\Domain\Assertion\AbstractStatement;
use Symfony\Component\Validator\Constraints\NotBlank as BaseNotBlank;

class NotBlank extends AbstractStatement
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function type(): string
    {
        return DefaultErrorEnum::NOT_BLANK;
    }

    public function value()
    {
        return $this->value;
    }

    public function constraint(): \Symfony\Component\Validator\Constraint
    {
        return new BaseNotBlank();
    }
}