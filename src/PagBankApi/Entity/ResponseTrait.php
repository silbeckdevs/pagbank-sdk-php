<?php

namespace PagBankApi\Entity;

use PagBankApi\Http\PagBankResponse;

trait ResponseTrait
{
    private ?PagBankResponse $http_response = null;

    public function getHttpResponse(): ?PagBankResponse
    {
        return $this->http_response;
    }

    public function setHttpResponse(?PagBankResponse $http_response): static
    {
        $this->http_response = $http_response;

        return $this;
    }
}
