<?php

namespace PagBankApi\Tests\Unit;

use PagBankApi\Config\PagBankConfig;
use PagBankApi\Tests\BaseTestCase;

class UnitPagBankConfigTest extends BaseTestCase
{
    public function testEnvironment(): void
    {
        $config = new PagBankConfig('123');
        $this->assertSame(PagBankConfig::ENVIRONMENT_PRODUCTION, $config->getEnvironment());
        $this->assertSame(PagBankConfig::BASE_URL_PRODUCTION, $config->getBaseUrl());
        $this->assertSame('123', $config->getToken());
        $this->assertSame('https://connect.pagbank.com.br', $config->getBaseUrlConnect());
        $this->assertTrue($config->isProduction());

        $config = new PagBankConfig('456', PagBankConfig::ENVIRONMENT_PRODUCTION);
        $this->assertSame(PagBankConfig::ENVIRONMENT_PRODUCTION, $config->getEnvironment());
        $this->assertSame(PagBankConfig::BASE_URL_PRODUCTION, $config->getBaseUrl());
        $this->assertSame('456', $config->getToken());
        $this->assertSame('https://connect.pagbank.com.br', $config->getBaseUrlConnect());
        $this->assertTrue($config->isProduction());

        $config = new PagBankConfig('789', PagBankConfig::ENVIRONMENT_SANDBOX);
        $this->assertSame(PagBankConfig::ENVIRONMENT_SANDBOX, $config->getEnvironment());
        $this->assertSame(PagBankConfig::BASE_URL_SANDBOX, $config->getBaseUrl());
        $this->assertSame('789', $config->getToken());
        $this->assertSame('https://connect.sandbox.pagbank.com.br', $config->getBaseUrlConnect());
        $this->assertFalse($config->isProduction());

        $this->expectExceptionMessage('Invalid environment: simulated');
        new PagBankConfig('123', 'simulated');
    }
}
