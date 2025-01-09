<?php

namespace PagBankApi\Entity;

class CheckoutPaymentMethodConfig implements PagBankSerializable
{
    use SerializeTrait;

    private ?string $type = null;

    /**
     * @var mixed[]|null
     */
    private ?array $config_options = [];

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        if (!in_array($type, [CheckoutPaymentMethod::PAYMENT_TYPE_CREDIT_CARD, CheckoutPaymentMethod::PAYMENT_TYPE_DEBIT_CARD], true)) {
            throw new \InvalidArgumentException("Invalid payment type: {$type}. Must be 'CREDIT_CARD' or 'DEBIT_CARD'.");
        }
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed[]|null
     */
    public function getConfigOptions(): ?array
    {
        return $this->config_options;
    }

    /**
     * @param mixed[] $config_options
     */
    public function setConfigOptions(array $config_options): static
    {
        $this->config_options = $config_options;

        return $this;
    }

    public function addInstallmentsLimit(string|int $value): static
    {
        $this->config_options[] = ['option' => 'INSTALLMENTS_LIMIT', 'value' => $value];

        return $this;
    }

    public function addInterestFreeInstallments(string|int $value): static
    {
        $this->config_options[] = ['option' => 'INTEREST_FREE_INSTALLMENTS', 'value' => $value];

        return $this;
    }
}
