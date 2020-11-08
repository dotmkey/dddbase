<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion\DefaultStatement;

use DDDBase\Domain\Assertion\DefaultErrorEnum;
use DDDBase\Domain\Assertion\AbstractStatement;
use Symfony\Component\Validator\Constraints\Type;

class IsInstanceOf extends AbstractStatement
{
    private ?object $object = null;

    private string $className;

    public function __construct(?object $object, string $className)
    {
        $this->object = $object;
        $this->className = $className;
    }

    public function type(): string
    {
        return DefaultErrorEnum::IS_INSTANCE_OF;
    }

    public function value(): ?object
    {
        return $this->object();
    }

    public function constraint(): \Symfony\Component\Validator\Constraint
    {
        return new Type(['type' => $this->className()]);
    }

    private function object(): ?object
    {
        return $this->object;
    }

    private function className(): string
    {
        return $this->className;
    }
}