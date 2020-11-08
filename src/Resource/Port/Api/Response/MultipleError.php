<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Response;

class MultipleError extends Error
{
    /** @var ErrorMessage[] */
    protected array $errors = [];

    /**
     * @return ErrorMessage[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors): self
    {
        $this->errors = $errors;

        return $this;
    }
}