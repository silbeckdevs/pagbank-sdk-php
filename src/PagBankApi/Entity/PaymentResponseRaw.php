<?php

namespace PagBankApi\Entity;

class PaymentResponseRaw implements PagBankSerializable
{
    use SerializeTrait;

    private mixed $authorization_code = null;

    private mixed $nsu = null;

    private mixed $reason_code = null;

    private mixed $merchant_advice_code = null;

    public function getAuthorizationCode(): mixed
    {
        return $this->authorization_code;
    }

    public function getNsu(): mixed
    {
        return $this->nsu;
    }

    public function getReasonCode(): mixed
    {
        return $this->reason_code;
    }

    public function getMerchantAdviceCode(): mixed
    {
        return $this->merchant_advice_code;
    }
}
