<?php

namespace PagBankApi\Entity\Fee;

use PagBankApi\Entity\PagBankSerializable;
use PagBankApi\Entity\SerializeTrait;

class Interest implements PagBankSerializable
{
    use SerializeTrait;

    private ?int $total = null;

    private ?int $installments = null;

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getInstallments(): ?int
    {
        return $this->installments;
    }

    public function setInstallments(?int $installments): static
    {
        $this->installments = $installments;

        return $this;
    }
}
