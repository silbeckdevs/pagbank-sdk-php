<?php

namespace PagBankApi\Entity;

class Account implements PagBankSerializable
{
    use SerializeTrait;

    public function __construct(private ?string $id = null)
    {
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }
}
