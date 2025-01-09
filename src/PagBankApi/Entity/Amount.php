<?php

namespace PagBankApi\Entity;

use PagBankApi\Entity\Fee\AmountFee;

class Amount implements PagBankSerializable
{
    use SerializeTrait;

    public const CURRENCY_BRL = 'BRL';

    private ?int $value = null;

    private ?string $currency = self::CURRENCY_BRL;

    private ?Summary $summary = null;

    private ?AmountFee $fees = null;

    public function __construct(?int $value = null)
    {
        if (!is_null($value)) {
            $this->value = $value;
        }
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function getSummary(): ?Summary
    {
        return $this->summary;
    }

    public function setSummary(Summary $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getFees(): ?AmountFee
    {
        return $this->fees;
    }

    public function setFees(?AmountFee $fees): static
    {
        $this->fees = $fees;

        return $this;
    }
}
