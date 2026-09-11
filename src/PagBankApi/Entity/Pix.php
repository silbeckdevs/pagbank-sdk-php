<?php

namespace PagBankApi\Entity;

class Pix implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $expiration_date = null;

    private ?string $end_to_end_id = null;

    private ?Holder $holder = null;

    public function getExpirationDate(): ?string
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(string $expiration_date): static
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }

    public function getEndToEndId(): ?string
    {
        return $this->end_to_end_id;
    }

    public function getHolder(): ?Holder
    {
        return $this->holder;
    }

    public function setHolder(Holder $holder): static
    {
        $this->holder = $holder;

        return $this;
    }
}
