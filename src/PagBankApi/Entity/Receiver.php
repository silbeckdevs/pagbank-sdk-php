<?php

namespace PagBankApi\Entity;

class Receiver implements PagBankSerializable
{
    use SerializeTrait;

    public function __construct(
        private ?Amount $amount = null,
        private ?Account $account = null,
        private ?string $reason = null,
    ) {
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

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(Account $account): static
    {
        $this->account = $account;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }
}
