<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion;

abstract class AbstractStatement
{
    abstract public function type(): string;

    abstract public function value();

    abstract public function constraint(): \Symfony\Component\Validator\Constraint;
}