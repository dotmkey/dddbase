<?php
declare(strict_types=1);

namespace DDDBase\Domain\Model;

interface EnumInterface
{
    public static function toArray(): array;
}