<?php

namespace PagBankApi\Entity;

class PublicKey implements PagBankSerializable
{
    use SerializeTrait;

    public function __construct(
        private ?string $public_key = null,
        private ?string $created_at = null,
    ) {
    }

    public function getKey(): ?string
    {
        return $this->public_key;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }
}
