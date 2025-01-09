<?php

namespace PagBankApi\Entity\Fee;

use PagBankApi\Entity\PagBankSerializable;
use PagBankApi\Entity\SerializeTrait;

class Buyer implements PagBankSerializable
{
    use SerializeTrait;

    private ?Interest $interest = null;

    public function getInterest(): ?Interest
    {
        return $this->interest;
    }

    public function setInterest(?Interest $interest): static
    {
        $this->interest = $interest;

        return $this;
    }
}
