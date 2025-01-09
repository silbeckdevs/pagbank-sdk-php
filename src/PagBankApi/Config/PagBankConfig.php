<?php

declare(strict_types=1);

namespace PagBankApi\Config;

class PagBankConfig
{
    private string $token;

    private bool $sandbox;

    private string $baseUrl;

    public const BASE_URL_PRODUCTION = 'https://api.pagseguro.com';

    public const BASE_URL_SANDBOX = 'https://sandbox.api.pagseguro.com';

    public const ENVIRONMENT_PRODUCTION = 'production';

    public const ENVIRONMENT_SANDBOX = 'sandbox';

    public function __construct(
        string $token,
        bool $sandbox = false,
    ) {
        $this->token = $token;
        $this->sandbox = $sandbox;
        $this->baseUrl = $this->sandbox ? self::BASE_URL_SANDBOX : self::BASE_URL_PRODUCTION;
    }

    public function isProduction(): bool
    {
        return false === $this->sandbox;
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

    public function setToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getEnvironment(): string
    {
        return $this->sandbox ? self::ENVIRONMENT_SANDBOX : self::ENVIRONMENT_PRODUCTION;
    }
}
