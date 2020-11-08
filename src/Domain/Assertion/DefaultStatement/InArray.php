<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion\DefaultStatement;

use DDDBase\Domain\Assertion\DefaultErrorEnum;
use DDDBase\Domain\Assertion\AbstractStatement;
use Symfony\Component\Validator\Constraints\Choice;

class InArray extends AbstractStatement
{
    private $needle;

    private $haystack;

    public function __construct($needle, array $haystack)
    {
        $this->needle = $needle;
        $this->haystack = $haystack;
    }

    public function type(): string
    {
        return DefaultErrorEnum::IN_ARRAY;
    }

    public function value()
    {
        return $this->needle();
    }

    public function constraint(): \Symfony\Component\Validator\Constraint
    {
        return new Choice(['choices' => $this->haystack()]);
    }

    private function needle()
    {
        return $this->needle;
    }

    private function haystack(): array
    {
        return $this->haystack;
    }
}