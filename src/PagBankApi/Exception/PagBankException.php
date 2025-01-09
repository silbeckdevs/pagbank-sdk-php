<?php

declare(strict_types=1);

namespace PagBankApi\Exception;

class PagBankException extends \Exception
{
    private int $statusCode;

    public function __construct(
        string $message,
        int $statusCode,
        ?\Throwable $previous = null,
    ) {
        $this->statusCode = $statusCode;

        parent::__construct($message, $statusCode, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
