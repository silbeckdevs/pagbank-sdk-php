<?php

namespace PagBankApi\Entity;

class Refund implements PagBankSerializable
{
    use SerializeTrait;

    private bool $rounding_liable;

    public function getRoundingLiable(): bool
    {
        return $this->rounding_liable;
    }

    public function setRoundingLiable(bool $rounding_liable): static
    {
        $this->rounding_liable = $rounding_liable;

        return $this;
    }
}
