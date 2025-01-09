<?php

namespace PagBankApi\Entity;

class InstructionLines implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $line_1 = null;

    private ?string $line_2 = null;

    public function getLine1(): ?string
    {
        return $this->line_1;
    }

    public function setLine1(string $line_1): static
    {
        $this->line_1 = $line_1;

        return $this;
    }

    public function getLine2(): ?string
    {
        return $this->line_2;
    }

    public function setLine2(string $line_2): static
    {
        $this->line_2 = $line_2;

        return $this;
    }
}
