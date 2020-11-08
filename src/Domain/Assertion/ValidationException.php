<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

class ValidationException extends \LogicException
{
    private string $type = 'validation';

    private ConstraintViolationListInterface $errors;

    public function __construct(
        ConstraintViolationListInterface $errors,
        ?string $type = null,
        $message = "",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->errors = $errors;
        $this->type = $type ?? $this->type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }
}