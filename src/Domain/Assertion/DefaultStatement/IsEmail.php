<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion\DefaultStatement;

use DDDBase\Domain\Assertion\DefaultErrorEnum;
use DDDBase\Domain\Assertion\AbstractStatement;
use Symfony\Component\Validator\Constraints\Email;

class IsEmail extends AbstractStatement
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function type(): string
    {
        return DefaultErrorEnum::IS_EMAIL;
    }

    public function value(): string
    {
        return $this->email();
    }

    public function constraint(): \Symfony\Component\Validator\Constraint
    {
        return new Email();
    }

    private function email(): string
    {
        return $this->email;
    }
}