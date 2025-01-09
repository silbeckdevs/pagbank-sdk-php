<?php

namespace PagBankApi\Service;

use PagBankApi\Config\PagBankConfig;
use PagBankApi\Http\PagBankHttpClient;
use Psr\Log\LoggerInterface;

abstract class AbstractService
{
    protected PagBankHttpClient $httpClient;

    public function __construct(
        protected readonly PagBankConfig $config,
        protected readonly ?LoggerInterface $logger = null,
        ?PagBankHttpClient $httpClient = null,
    ) {
        $this->httpClient = $httpClient ?? new PagBankHttpClient($this->config);

        if ($logger) {
            $this->httpClient->setLogger($logger);
        }
    }

    protected function getHttpClient(): PagBankHttpClient
    {
        return $this->httpClient;
    }
}
