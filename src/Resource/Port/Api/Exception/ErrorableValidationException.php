<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Exception;

use DDDBase\Resource\Port\Api\Response\ErrorMessage;
use DDDBase\Resource\Port\Api\Response\MultipleError;
use DDDBase\Domain\Assertion\ValidationException;
use Symfony\Component\Validator\ConstraintViolation;

class ErrorableValidationException implements ErrorableExceptionInterface
{
    private ValidationException $exception;

    public function __construct(ValidationException $exception)
    {
        $this->exception = $exception;
    }

    public function generateError(): MultipleError
    {
        $error = new MultipleError();
        $error->setType($this->exception()->getType())->setMessage($this->exception()->getMessage());

        $errorMessages = [];
        /** @var ConstraintViolation $validationError */
        foreach ($this->exception()->getErrors() as $validationError) {
            $errorMessage = new ErrorMessage();
            $errorMessage->setType($validationError->getPropertyPath())->setMessage($validationError->getMessage());
            $errorMessages[] = $errorMessage;
        }
        $error->setErrors($errorMessages);

        return $error;
    }

    private function exception(): ValidationException
    {
        return $this->exception;
    }
}