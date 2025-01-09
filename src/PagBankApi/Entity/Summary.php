<?php

namespace PagBankApi\Entity;

class Summary implements PagBankSerializable
{
    use SerializeTrait;

    public function __construct(
        private ?int $total = null,
        private ?int $paid = null,
        private ?int $refunded = null,
    ) {
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function getPaid(): ?int
    {
        return $this->paid;
    }

    public function getRefunded(): ?int
    {
        return $this->refunded;
    }
}
