<?php

namespace PagBankApi\Tests\E2E;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PagBankApi\Config\PagBankConfig;
use PagBankApi\Http\PagBankHttpClient;
use PagBankApi\Service\PagBankService;
use PagBankApi\Tests\BaseTestCase;

abstract class AbstractPagBankTestCase extends BaseTestCase
{
    protected PagBankService $pagBankService;

    protected MockHandler $mockHandler;

    protected PagBankHttpClient $httpClient;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $httpClient = new Client(['handler' => HandlerStack::create($this->mockHandler)]);
        $configMock = new PagBankConfig('your-token-here');
        $this->httpClient = new PagBankHttpClient($configMock, $httpClient);

        $this->pagBankService = new PagBankService(
            $configMock,
            null,
            $this->httpClient
        );
    }
}
