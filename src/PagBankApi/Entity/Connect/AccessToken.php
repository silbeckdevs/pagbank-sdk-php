<?php

namespace PagBankApi\Entity\Connect;

use PagBankApi\Entity\PagBankSerializable;
use PagBankApi\Entity\SerializeTrait;

class AccessToken implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $token_type = null;

    private ?string $access_token = null;

    private ?string $expires_in = null;

    private ?string $refresh_token = null;

    private ?string $scope = null;

    private ?string $account_id = null;

    public function getTokenType(): ?string
    {
        return $this->token_type;
    }

    public function getAccessToken(): ?string
    {
        return $this->access_token;
    }

    public function getExpiresIn(): ?string
    {
        return $this->expires_in;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refresh_token;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }

    public function getAccountId(): ?string
    {
        return $this->account_id;
    }
}
