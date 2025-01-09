<?php

namespace PagBankApi\Entity;

class PaymentResponse implements PagBankSerializable
{
    use SerializeTrait;

    private mixed $code = null;

    private mixed $message = null;

    private mixed $reference = null;

    private ?PaymentResponseRaw $raw_data = null;

    public function getCode(): mixed
    {
        return $this->code;
    }

    public function getMessage(): mixed
    {
        return $this->message;
    }

    public function getReference(): mixed
    {
        return $this->reference;
    }

    public function getRawData(): ?PaymentResponseRaw
    {
        return $this->raw_data;
    }
}
