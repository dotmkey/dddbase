<?php
declare(strict_types=1);

namespace DDDBase\Domain\Assertion;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validation
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(AbstractStatement ...$statements): ConstraintViolationListInterface
    {
        $values = $constraints = [];
        foreach ($statements as $statement) {
            $values[$statement->type()] = $statement->value();
            $constraints[$statement->type()] = $statement->constraint();
        }

        return $this->validator()->validate($values, new Collection($constraints));
    }

    public function validateOrThrow(AbstractStatement ...$statements): void
    {
        $errors = $this->validate(...$statements);

        if ($errors->count()) {
            throw new ValidationException($errors);
        }
    }

    private function validator(): ValidatorInterface
    {
        return $this->validator;
    }
}