<?php

namespace PagBankApi\Entity;

class Item implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $name = null;

    private ?int $quantity = null;

    private ?int $unit_amount = null;

    private ?string $reference_id = null;

    private ?string $description = null;

    public function getReferenceId(): ?string
    {
        return $this->reference_id;
    }

    public function setReferenceId(string $reference_id): static
    {
        $this->reference_id = $reference_id;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnitAmount(): ?int
    {
        return $this->unit_amount;
    }

    public function setUnitAmount(?int $unit_amount): static
    {
        $this->unit_amount = $unit_amount;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
