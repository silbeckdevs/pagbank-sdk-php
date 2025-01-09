<?php

namespace PagBankApi\Entity;

class Shipping implements PagBankSerializable
{
    use SerializeTrait;

    public const TYPE_FIXED = 'FIXED';

    public const TYPE_FREE = 'FREE';

    public const TYPE_CALCULATE = 'CALCULATE';

    public const SERVICE_TYPE_SEDEX = 'SEDEX';

    public const SERVICE_TYPE_PAC = 'PAC';

    private ?Address $address = null;

    private ?string $type = null;

    private ?string $service_type = null;

    private ?bool $address_modifiable = null;

    private ?int $amount = null;

    /**
     * @var mixed[]
     */
    private ?array $box = null;

    public function createAddress(): Address
    {
        return $this->address = new Address();
    }

    // gets and sets
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getServiceType(): ?string
    {
        return $this->service_type;
    }

    public function setServiceType(string $service_type): static
    {
        $this->service_type = $service_type;

        return $this;
    }

    public function getAddressModifiable(): ?bool
    {
        return $this->address_modifiable;
    }

    public function setAddressModifiable(bool $address_modifiable): static
    {
        $this->address_modifiable = $address_modifiable;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }
}
