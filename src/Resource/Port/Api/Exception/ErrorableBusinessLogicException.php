<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Exception;

use DDDBase\Resource\Port\Api\Response\Error;
use DDDBase\Domain\BusinessLogicException;

class ErrorableBusinessLogicException implements ErrorableExceptionInterface
{
    private BusinessLogicException $exception;

    public function __construct(BusinessLogicException $exception)
    {
        $this->exception = $exception;
    }

    public function generateError(): Error
    {
        $error = new Error();
        $error->setType($this->exception()->getType())->setMessage($this->exception()->getMessage());

        return $error;
    }

    private function exception(): BusinessLogicException
    {
        return $this->exception;
    }
}