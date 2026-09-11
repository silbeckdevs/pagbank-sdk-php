<?php

namespace PagBankApi\Tests\Unit;

use PagBankApi\Entity\PaymentMethod;
use PagBankApi\Entity\Pix;
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

    public function testCreatePixSetsTypeAndReturnsPix(): void
    {
        $paymentMethod = new PaymentMethod();

        $pix = $paymentMethod->createPix();

        $this->assertInstanceOf(Pix::class, $pix);
        $this->assertTrue($paymentMethod->isPix());
        $this->assertSame(PaymentMethod::PAYMENT_TYPE_PIX, $paymentMethod->getType());
        $this->assertSame($pix, $paymentMethod->getPix());
    }

    public function testSetAndGetPix(): void
    {
        $paymentMethod = new PaymentMethod();
        $pix = new Pix();
        $pix->setExpirationDate('2026-08-06T20:14:00Z');

        $result = $paymentMethod->setPix($pix);

        $this->assertSame($paymentMethod, $result);
        $this->assertSame($pix, $paymentMethod->getPix());
        $this->assertSame('2026-08-06T20:14:00Z', $paymentMethod->getPix()->getExpirationDate());
    }

    public function testGetPixDefaultNull(): void
    {
        $paymentMethod = new PaymentMethod();

        $this->assertNull($paymentMethod->getPix());
    }
}
