<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Exception;

use DDDBase\Resource\Port\Api\Response\Error;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class AbstractBadRequestHttpException extends BadRequestHttpException implements HttpProtocolExceptionInterface
{
    public function __construct(string $message = null, \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct($message ?? $this->getType(), $previous, $code, $headers);
    }

    public function getHttpCode(): int
    {
        return $this->getStatusCode();
    }

    public function generateError(): Error
    {
        $error = new Error();
        $error->setType($this->getType())->setMessage($this->getMessage());

        return $error;
    }
}