<?php

namespace PagBankApi\Entity\Fee;

use PagBankApi\Entity\PagBankSerializable;
use PagBankApi\Entity\SerializeTrait;

class AmountFee implements PagBankSerializable
{
    use SerializeTrait;

    private ?Buyer $buyer = null;

    public function getBuyer(): ?Buyer
    {
        return $this->buyer;
    }

    public function setBuyer(?Buyer $buyer): static
    {
        $this->buyer = $buyer;

        return $this;
    }
}
