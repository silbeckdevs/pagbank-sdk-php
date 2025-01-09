<?php

namespace PagBankApi\Entity;

class Phone implements PagBankSerializable
{
    use SerializeTrait;

    public const TYPE_MOBILE = 'MOBILE';

    public const TYPE_BUSINESS = 'BUSINESS';

    public const TYPE_HOME = 'HOME';

    private ?int $country = null;

    private ?int $area = null;

    private ?int $number = null;

    private string $type = self::TYPE_MOBILE;

    public function getCountry(): ?int
    {
        return $this->country;
    }

    public function setCountry(int $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getArea(): ?int
    {
        return $this->area;
    }

    public function setArea(int $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
