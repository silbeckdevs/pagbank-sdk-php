<?php

namespace PagBankApi\Entity;

class Customer implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $name = null;

    private ?string $email = null;

    /**
     * CPF ou CNPJ.
     */
    private ?string $tax_id = null;

    /** @var Phone[] */
    #[PropertyMapping(className: Phone::class, type: 'array')]
    private array $phones = [];

    /**
     * Used in checkout.
     */
    private ?Phone $phone = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTaxId(): ?string
    {
        return $this->tax_id;
    }

    public function setTaxId(?string $tax_id): static
    {
        $this->tax_id = $tax_id;

        return $this;
    }

    /**
     * @return Phone[]
     */
    public function getPhones(): array
    {
        return $this->phones;
    }

    /**
     * @param Phone[] $phones
     */
    public function setPhones(array $phones): static
    {
        $this->phones = $phones;

        return $this;
    }

    public function addPhone(Phone $phone): static
    {
        $this->phones[] = $phone;

        return $this;
    }

    public function createPhone(): Phone
    {
        $phone = new Phone();
        $this->addPhone($phone);

        return $phone;
    }

    public function getCheckoutPhone(): ?Phone
    {
        return $this->phone;
    }

    public function setCheckoutPhone(Phone $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function createCheckoutPhone(): Phone
    {
        return $this->phone = new Phone();
    }
}
