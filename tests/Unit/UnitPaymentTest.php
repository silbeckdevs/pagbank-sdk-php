<?php

namespace PagBankApi\Tests\Unit;

use PagBankApi\Entity\PaymentMethod;
use PagBankApi\Tests\BaseTestCase;

class UnitPaymentTest extends BaseTestCase
{
    public function testPaymentMethod(): void
    {
        $paymentMethod = new PaymentMethod();

        $this->assertFalse($paymentMethod->isCard(), 'isCard');
        $this->assertFalse($paymentMethod->isPix(), 'isPix');
        $this->assertFalse($paymentMethod->isBoleto(), 'isBoleto');

        $paymentMethod->setType(PaymentMethod::PAYMENT_TYPE_BOLETO);
        $this->assertTrue($paymentMethod->isBoleto(), 'isBoleto');
        $this->assertFalse($paymentMethod->isCard(), 'isCard');
        $this->assertFalse($paymentMethod->isPix(), 'isPix');

        $paymentMethod->setType(PaymentMethod::PAYMENT_TYPE_CREDIT_CARD);
        $this->assertTrue($paymentMethod->isCard(), 'isCard');
        $this->assertFalse($paymentMethod->isBoleto(), 'isBoleto');
        $this->assertFalse($paymentMethod->isPix(), 'isPix');

        $paymentMethod->setType(PaymentMethod::PAYMENT_TYPE_DEBIT_CARD);
        $this->assertTrue($paymentMethod->isCard(), 'isCard');
        $this->assertFalse($paymentMethod->isBoleto(), 'isBoleto');
        $this->assertFalse($paymentMethod->isPix(), 'isPix');

        $paymentMethod->setType(PaymentMethod::PAYMENT_TYPE_PIX);
        $this->assertTrue($paymentMethod->isPix(), 'isPix');
        $this->assertFalse($paymentMethod->isCard(), 'isCard');
        $this->assertFalse($paymentMethod->isBoleto(), 'isBoleto');

        $this->expectException(\InvalidArgumentException::class);
        $paymentMethod->setType('invalid');
    }
}
