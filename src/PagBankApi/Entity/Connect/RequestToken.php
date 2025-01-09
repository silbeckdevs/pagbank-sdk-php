<?php

namespace PagBankApi\Entity\Connect;

use PagBankApi\Entity\PagBankSerializable;
use PagBankApi\Entity\SerializeTrait;

class RequestToken implements PagBankSerializable
{
    use SerializeTrait;

    public const TYPE_AUTHORIZATION_CODE = 'authorization_code';

    public const TYPE_SMS = 'sms';

    public const TYPE_CHALLENGE = 'challenge';

    public function __construct(
        private ?string $code = null,
        private ?string $redirect_uri = null,
        private ?string $grant_type = self::TYPE_AUTHORIZATION_CODE,
        private ?string $sms_code = null,
        private ?string $email = null,
        private ?string $scope = null,
        private ?string $authorization_id = null,
    ) {
    }

    public function getGrantType(): ?string
    {
        return $this->grant_type;
    }

    public function setGrantType(?string $grant_type): static
    {
        $this->grant_type = $grant_type;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getSmsCode(): ?string
    {
        return $this->sms_code;
    }

    public function setSmsCode(?string $sms_code): static
    {
        $this->sms_code = $sms_code;

        return $this;
    }

    public function getRedirectUri(): ?string
    {
        return $this->redirect_uri;
    }

    public function setRedirectUri(?string $redirect_uri): static
    {
        $this->redirect_uri = $redirect_uri;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }

    public function setScope(?string $scope): static
    {
        $this->scope = $scope;

        return $this;
    }

    public function getAuthorizationId(): ?string
    {
        return $this->authorization_id;
    }

    public function setAuthorizationId(?string $authorization_id): static
    {
        $this->authorization_id = $authorization_id;

        return $this;
    }
}
