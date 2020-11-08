<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion\DefaultStatement;

use DDDBase\Domain\Assertion\DefaultErrorEnum;
use DDDBase\Domain\Assertion\AbstractStatement;
use Symfony\Component\Validator\Constraints\GreaterThan as BaseGreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual as BaseGreaterThanOrEqual;

class GreaterThan extends AbstractStatement
{
    private int $value;

    private int $compareTo;

    private bool $strict;

    public function __construct(int $value, int $compareTo, bool $strict)
    {
        $this->value = $value;
        $this->compareTo = $compareTo;
        $this->strict = $strict;
    }

    public function type(): string
    {
        return DefaultErrorEnum::GREATER_THAN;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function constraint(): \Symfony\Component\Validator\Constraint
    {
        return $this->strict()
            ? new BaseGreaterThan(['value' => $this->compareTo()])
            : new BaseGreaterThanOrEqual(['value' => $this->compareTo()])
        ;
    }

    private function compareTo(): int
    {
        return $this->compareTo;
    }

    private function strict(): bool
    {
        return $this->strict;
    }
}