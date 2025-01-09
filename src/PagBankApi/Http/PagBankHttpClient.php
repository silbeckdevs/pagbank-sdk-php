<?php

namespace PagBankApi\Http;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use PagBankApi\Config\PagBankConfig;
use PagBankApi\Exception\PagBankException;
use PagBankApi\Http\Client\PagBankHttpClientInterface;
use Psr\Log\LoggerInterface;

class PagBankHttpClient implements PagBankHttpClientInterface
{
    private ClientInterface $client;

    private ?LoggerInterface $logger = null;

    public const HTTP_GET = 'GET';

    public const HTTP_POST = 'POST';

    public const HTTP_PUT = 'PUT';

    public const HTTP_DELETE = 'DELETE';

    public function __construct(private readonly PagBankConfig $config, ?ClientInterface $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function getRequest(string $endpoint): PagBankResponse
    {
        return $this->sendRequest(self::HTTP_GET, $endpoint);
    }

    /**
     * @param array<string, mixed>|object $body
     */
    public function postRequest(string $endpoint, array|object $body = []): PagBankResponse
    {
        return $this->sendRequest(self::HTTP_POST, $endpoint, $body);
    }

    /**
     * @param array<string, mixed>|object|null $body
     */
    public function putRequest(string $endpoint, array|object|null $body = []): PagBankResponse
    {
        return $this->sendRequest(self::HTTP_PUT, $endpoint, $body ?? []);
    }

    public function deleteRequest(string $endpoint): PagBankResponse
    {
        return $this->sendRequest(self::HTTP_DELETE, $endpoint);
    }

    /**
     * @param array<string, mixed>|object $body
     * @param array<string, string>       $headers
     */
    public function sendRequest(string $method, string $endpoint, array|object $body = [], array $headers = []): PagBankResponse
    {
        try {
            $options = [
                'headers' => array_merge(
                    [
                        'Content-Type' => 'application/json',
                        'Authorization' => "Bearer {$this->config->getToken()}",
                    ],
                    $headers
                ),
            ];

            if (!empty($body)) {
                $options['json'] = $body;
            }

            $response = $this->client->request($method, $this->config->getBaseUrl() . $endpoint, $options);

            if ($this->logger) {
                // TODO replace sensitive data
                $this->logger->info(
                    $endpoint,
                    [
                        'environment' => $this->config->getEnvironment(),
                        'method' => $method,
                        'url' => $this->config->getBaseUrl() . $endpoint,
                        'body' => $body,
                        'responseStatusCode' => $response->getStatusCode(),
                        'responseBody' => json_decode($response->getBody()->__toString()),
                    ]
                );
            }

            return new PagBankResponse($response);
        } catch (ClientException $e) {
            throw new PagBankException($e->getResponse()->getBody()->getContents() ?: $e->getMessage(), (int) $e->getCode(), $e);
        } catch (\Throwable $e) {
            throw new PagBankException($e->getMessage(), (int) $e->getCode(), $e);
        }
    }

    // gets and sets
    public function setLogger(LoggerInterface $logger): static
    {
        $this->logger = $logger;

        return $this;
    }
}
