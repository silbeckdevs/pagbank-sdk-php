<?php

namespace PagBankApi\Entity;

class CancelPayment implements PagBankSerializable
{
    use SerializeTrait;

    private ?Amount $amount = null;

    private ?Split $splits = null;

    public function createAmount(?int $value = null): Amount
    {
        return $this->amount = new Amount($value);
    }

    public function createSplit(): Split
    {
        return $this->splits = new Split();
    }

    public function getAmount(): ?Amount
    {
        return $this->amount;
    }

    public function setAmount(Amount $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getSplit(): ?Split
    {
        return $this->splits;
    }

    public function setSplit(Split $split): static
    {
        $this->splits = $split;

        return $this;
    }
}
