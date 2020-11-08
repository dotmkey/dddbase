<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api\Response;

class Success
{
    protected $data;

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }
}