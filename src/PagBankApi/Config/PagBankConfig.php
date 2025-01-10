<?php

declare(strict_types=1);

namespace PagBankApi\Config;

class PagBankConfig
{
    public const BASE_URL_PRODUCTION = 'https://api.pagseguro.com';

    public const BASE_URL_SANDBOX = 'https://sandbox.api.pagseguro.com';

    public const ENVIRONMENT_PRODUCTION = 'production';

    public const ENVIRONMENT_SANDBOX = 'sandbox';

    public function __construct(
        private readonly string $token,
        private readonly string $environment = self::ENVIRONMENT_PRODUCTION,
    ) {
        if (!in_array($environment, [self::ENVIRONMENT_SANDBOX, self::ENVIRONMENT_PRODUCTION])) {
            throw new \InvalidArgumentException("Invalid environment: {$environment}");
        }
    }

    public function isProduction(): bool
    {
        return self::ENVIRONMENT_PRODUCTION === $this->environment;
    }

    public function getBaseUrl(): string
    {
        return $this->isProduction() ? self::BASE_URL_PRODUCTION : self::BASE_URL_SANDBOX;
    }

    public function getBaseUrlConnect(): string
    {
        return $this->isProduction() ? 'https://connect.pagbank.com.br' : 'https://connect.sandbox.pagbank.com.br';
    }

    // gets and sets
    public function getToken(): string
    {
        return $this->token;
    }

    public function getEnvironment(): string
    {
        return $this->environment;
    }
}
