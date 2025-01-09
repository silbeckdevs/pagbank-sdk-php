<?php

namespace PagBankApi\Entity;

class Payment implements PagBankSerializable
{
    use SerializeTrait;

    /**
     * @var Charge[]|null
     */
    #[PropertyMapping(className: Charge::class, type: 'array')]
    private ?array $charges = null;

    public function createCharge(): Charge
    {
        if (is_null($this->charges)) {
            $this->charges = [];
        }

        $charge = new Charge();
        $this->charges[] = $charge;

        return $charge;
    }

    /**
     * @return Charge[]|null
     */
    public function getCharges(): ?array
    {
        return $this->charges;
    }

    /**
     * @param Charge[] $charges
     */
    public function setCharges(array $charges): static
    {
        $this->charges = $charges;

        return $this;
    }
}
