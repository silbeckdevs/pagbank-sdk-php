<?php

namespace PagBankApi\Entity;

class TokenData implements PagBankSerializable
{
    use SerializeTrait;

    private string $requestor_id;

    private string $cryptogram;

    private string $ecommerce_domain;

    private int $assurance_level;

    public function getRequestorId(): string
    {
        return $this->requestor_id;
    }

    public function setRequestorId(string $requestor_id): static
    {
        $this->requestor_id = $requestor_id;

        return $this;
    }

    public function getCryptogram(): string
    {
        return $this->cryptogram;
    }

    public function setCryptogram(string $cryptogram): static
    {
        $this->cryptogram = $cryptogram;

        return $this;
    }

    public function getEcommerceDomain(): string
    {
        return $this->ecommerce_domain;
    }

    public function setEcommerceDomain(string $ecommerce_domain): static
    {
        $this->ecommerce_domain = $ecommerce_domain;

        return $this;
    }

    public function getAssuranceLevel(): int
    {
        return $this->assurance_level;
    }

    public function setAssuranceLevel(int $assurance_level): static
    {
        $this->assurance_level = $assurance_level;

        return $this;
    }
}
