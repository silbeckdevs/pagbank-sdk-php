<?php

namespace PagBankApi\Entity;

class CheckoutOrder implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $id = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): static
    {
        $this->id = $id;

        return $this;
    }
}
