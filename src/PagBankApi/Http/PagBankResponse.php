<?php

namespace PagBankApi\Http;

use Psr\Http\Message\ResponseInterface;

class PagBankResponse
{
    private int $statusCode;

    /**
     * @var array<mixed>
     */
    private array $content;

    private string $body;

    public function __construct(ResponseInterface $response)
    {
        $this->statusCode = $response->getStatusCode();
        $this->body = (string) $response->getBody();
        $this->content = (array) (json_decode($this->body, true) ?: null);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function isSuccess(): bool
    {
        return $this->getStatusCode() >= 200 && $this->getStatusCode() < 300;
    }

    /**
     * @return array<string, mixed>
     */
    public function getContent(): array
    {
        return $this->content;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
