<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Token\TokenStrategy;

interface JwtPolicyInterface
{
    public function privateKey(): ?string;

    public function secret(): ?string;

    public function algorithm(): string;
}