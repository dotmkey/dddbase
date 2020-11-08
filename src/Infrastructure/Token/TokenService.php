<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Token;

class TokenService
{
    protected TokenStrategyInterface $tokenStrategy;

    public function __construct(TokenStrategyInterface $tokenStrategy)
    {
        $this->tokenStrategy = $tokenStrategy;
    }

    public function createToken(array $payload): string
    {
        return $this->tokenStrategy->encode($payload);
    }

    public function payload(string $token): array
    {
        return $this->tokenStrategy->decode($token);
    }
}