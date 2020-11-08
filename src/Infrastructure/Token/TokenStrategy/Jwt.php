<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Token\TokenStrategy;

use DDDBase\Infrastructure\Token\TokenStrategyInterface;

class Jwt implements TokenStrategyInterface
{
    protected JwtPolicyInterface $policy;

    public function __construct(JwtPolicyInterface $policy)
    {
        if (!in_array($policy->algorithm(), JwtAlgorithmEnum::toArray())) {
            throw new \Exception('Bad jwt config.');
        }

        if (
            strpos($policy->algorithm(), 'RS') !== false
            and (!$policy->privateKey() or !file_exists($policy->privateKey()))
        ) {
            throw new \Exception('Bad jwt config.');
        }

        if (strpos($policy->algorithm(), 'HS') !== false and !$policy->secret()) {
            throw new \Exception('Bad jwt config.');
        }

        $this->policy = $policy;
    }

    public function encode(array $payload): string
    {
        if (strpos($this->policy->algorithm(), 'HS') !== false) {
            return \Firebase\JWT\JWT::encode($payload, $this->policy->secret(), $this->policy->algorithm());
        } else {
            $key = openssl_get_privatekey(file_get_contents($this->policy->privateKey()));
            return \Firebase\JWT\JWT::encode($payload, $key, $this->policy->algorithm());
        }
    }

    public function decode(string $token): array
    {
        return (array) \Firebase\JWT\JWT::decode($token, $this->policy->secret(), [$this->policy->algorithm()]);
    }
}