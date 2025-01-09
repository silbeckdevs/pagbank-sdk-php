<?php

namespace PagBankApi\Entity;

class Boleto implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $due_date = null;

    private ?InstructionLines $instruction_lines = null;

    private ?Holder $holder = null;

    private ?string $id = null;

    private ?string $barcode = null;

    private ?string $formatted_barcode = null;

    public function getDueDate(): ?string
    {
        return $this->due_date;
    }

    public function setDueDate(string $due_date): static
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $due_date)) {
            throw new \InvalidArgumentException('The due date must be in the format YYYY-MM-DD.');
        }

        $this->due_date = $due_date;

        return $this;
    }

    public function createInstructionLines(): InstructionLines
    {
        return $this->instruction_lines = new InstructionLines();
    }

    public function getInstructionLines(): ?InstructionLines
    {
        return $this->instruction_lines;
    }

    public function setInstructionLines(InstructionLines $instructionLines): static
    {
        $this->instruction_lines = $instructionLines;

        return $this;
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

    public function createHolder(): Holder
    {
        return $this->holder = new Holder();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function getFormattedBarcode(): ?string
    {
        return $this->formatted_barcode;
    }
}
