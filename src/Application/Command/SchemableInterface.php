<?php
declare(strict_types=1);

namespace DDDBase\Application\Command;

interface SchemableInterface
{
    public function schema(): array;
}