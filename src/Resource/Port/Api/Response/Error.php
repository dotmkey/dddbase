<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Response;

class Error
{
    protected ?string $type = null;

    protected string $message;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type = null): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}