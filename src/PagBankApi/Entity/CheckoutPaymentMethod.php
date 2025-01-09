<?php

namespace PagBankApi\Entity;

class CheckoutPaymentMethod implements PagBankSerializable
{
    use SerializeTrait;

    public const PAYMENT_TYPE_CREDIT_CARD = 'CREDIT_CARD';

    public const PAYMENT_TYPE_DEBIT_CARD = 'DEBIT_CARD';

    public const PAYMENT_TYPE_BOLETO = 'BOLETO';

    public const PAYMENT_TYPE_PIX = 'PIX';

    private ?string $type = null;

    /**
     * @var string[]|null
     */
    private ?array $brands = null;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        if (!in_array($type, [self::PAYMENT_TYPE_CREDIT_CARD, self::PAYMENT_TYPE_DEBIT_CARD, self::PAYMENT_TYPE_BOLETO, self::PAYMENT_TYPE_PIX], true)) {
            throw new \InvalidArgumentException("Invalid payment type: {$type}. Must be 'CREDIT_CARD', 'DEBIT_CARD', 'PIX' or 'BOLETO'.");
        }
        $this->type = $type;

        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getBrands(): ?array
    {
        return $this->brands;
    }

    /**
     * @param string[] $brands
     */
    public function setBrands(array $brands): static
    {
        $this->brands = $brands;

        return $this;
    }
}
