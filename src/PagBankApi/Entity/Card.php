<?php

namespace PagBankApi\Entity;

class Card implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $id = null;

    private ?string $encrypted = null;

    private ?string $number = null;

    private ?string $network_token = null;

    private ?int $exp_month = null;

    private ?int $exp_year = null;

    private ?string $security_code = null;

    private bool $store = false;

    private ?Holder $holder = null;

    private ?TokenData $token_data = null;

    private ?string $brand = null;

    private ?string $first_digits = null;

    private ?string $last_digits = null;

    public function createTokenData(): TokenData
    {
        return $this->token_data = new TokenData();
    }

    public function createHolder(): Holder
    {
        return $this->holder = new Holder();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getNetworkToken(): ?string
    {
        return $this->network_token;
    }

    public function setNetworkToken(string $network_token): static
    {
        $this->network_token = $network_token;

        return $this;
    }

    public function getExpMonth(): ?int
    {
        return $this->exp_month;
    }

    public function setExpMonth(int $exp_month): static
    {
        $this->exp_month = $exp_month;

        return $this;
    }

    public function getExpYear(): ?int
    {
        return $this->exp_year;
    }

    public function setExpYear(int $exp_year): static
    {
        $this->exp_year = $exp_year;

        return $this;
    }

    public function getSecurityCode(): ?string
    {
        return $this->security_code;
    }

    public function setSecurityCode(string $security_code): static
    {
        $this->security_code = $security_code;

        return $this;
    }

    public function getStore(): bool
    {
        return $this->store;
    }

    public function setStore(bool $store): static
    {
        $this->store = $store;

        return $this;
    }

    public function getEncrypted(): ?string
    {
        return $this->encrypted;
    }

    public function setEncrypted(string $encrypted): static
    {
        $this->encrypted = $encrypted;

        return $this;
    }

    public function getHolder(): ?Holder
    {
        return $this->holder;
    }

    public function setHolder(Holder $holder): static
    {
        $this->holder = $holder;

        return $this;
    }

    public function getTokenData(): ?TokenData
    {
        return $this->token_data;
    }

    public function setTokenData(TokenData $token_data): static
    {
        $this->token_data = $token_data;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function getFirstDigits(): ?string
    {
        return $this->first_digits;
    }

    public function getLastDigits(): ?string
    {
        return $this->last_digits;
    }
}
