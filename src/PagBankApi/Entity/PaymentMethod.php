<?php

namespace PagBankApi\Entity;

class PaymentMethod implements PagBankSerializable
{
    use SerializeTrait;

    public const PAYMENT_TYPE_CREDIT_CARD = 'CREDIT_CARD';

    public const PAYMENT_TYPE_DEBIT_CARD = 'DEBIT_CARD';

    public const PAYMENT_TYPE_PIX = 'PIX';

    public const PAYMENT_TYPE_BOLETO = 'BOLETO';

    private ?string $type = null;

    private ?int $installments = null;

    private bool $capture = true;

    private ?string $soft_descriptor = null;

    private ?Card $card = null;

    private ?Authentication $authentication_method = null;

    private ?Boleto $boleto = null;

    public function createCard(): Card
    {
        return $this->card = new Card();
    }

    public function createBoleto(): Boleto
    {
        $this->setType(PaymentMethod::PAYMENT_TYPE_BOLETO);

        return $this->boleto = new Boleto();
    }

    public function isCard(): bool
    {
        return in_array($this->getType(), [self::PAYMENT_TYPE_CREDIT_CARD, self::PAYMENT_TYPE_DEBIT_CARD]);
    }

    public function isPix(): bool
    {
        return self::PAYMENT_TYPE_PIX === $this->getType();
    }

    public function isBoleto(): bool
    {
        return self::PAYMENT_TYPE_BOLETO === $this->getType();
    }

    // gets and sets
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        if (
            !in_array($type, [
                self::PAYMENT_TYPE_CREDIT_CARD,
                self::PAYMENT_TYPE_DEBIT_CARD,
                self::PAYMENT_TYPE_PIX,
                self::PAYMENT_TYPE_BOLETO,
            ], true)
        ) {
            throw new \InvalidArgumentException("Invalid payment type: {$type}. Must be 'CREDIT_CARD', 'DEBIT_CARD' or 'BOLETO'.");
        }
        $this->type = $type;

        return $this;
    }

    public function getInstallments(): ?int
    {
        return $this->installments;
    }

    public function setInstallments(int $installments): static
    {
        $this->installments = $installments;

        return $this;
    }

    public function setCapture(bool $capture): static
    {
        $this->capture = $capture;

        return $this;
    }

    public function getCapture(): bool
    {
        return $this->capture;
    }

    public function getSoftDescriptor(): ?string
    {
        return $this->soft_descriptor;
    }

    public function setSoftDescriptor(string $softDescriptor): static
    {
        $this->soft_descriptor = $softDescriptor;

        return $this;
    }

    public function getCard(): ?Card
    {
        return $this->card;
    }

    public function setCard(Card $card): static
    {
        $this->card = $card;

        return $this;
    }

    public function getAuthenticationMethod(): ?Authentication
    {
        return $this->authentication_method;
    }

    public function setAuthenticationMethod(Authentication $authentication_method): static
    {
        $this->authentication_method = $authentication_method;

        return $this;
    }

    public function createAuthenticationMethod(): Authentication
    {
        return $this->authentication_method = new Authentication();
    }

    public function getBoleto(): ?Boleto
    {
        return $this->boleto;
    }

    public function setBoleto(Boleto $boleto): static
    {
        $this->boleto = $boleto;

        return $this;
    }
}
