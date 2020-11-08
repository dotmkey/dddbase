<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Token;

interface TokenStrategyInterface
{
    public function encode(array $payload): string;

    public function decode(string $token): array;
}