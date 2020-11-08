<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Exception;

use DDDBase\Resource\Port\Api\Response\Error;

interface ErrorableExceptionInterface
{
    public function generateError(): Error;
}