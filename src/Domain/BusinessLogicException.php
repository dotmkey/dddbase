<?php
declare(strict_types=1);

namespace DDDBase\Domain;

use Symfony\Component\Validator\ConstraintViolationInterface;

class BusinessLogicException extends \LogicException
{
    private string $type;

    public function __construct(ConstraintViolationInterface $error)
    {
        $this->setType($error->getPropertyPath());

        parent::__construct($error->getMessage());
    }

    public function getType(): string
    {
        return $this->type;
    }

    private function setType(string $type): void
    {
        $this->type = $type;
    }
}