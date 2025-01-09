<?php

namespace PagBankApi\Entity;

class Holder implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $name = null;

    private ?string $tax_id = null;

    private ?string $email = null;

    private ?Address $address = null;

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function createAddress(): Address
    {
        return $this->address = new Address();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTaxId(): ?string
    {
        return $this->tax_id;
    }

    public function setTaxId(?string $tax_id): static
    {
        $this->tax_id = $tax_id;

        return $this;
    }
}
