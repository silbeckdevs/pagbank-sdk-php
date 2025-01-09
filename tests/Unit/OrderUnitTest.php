<?php

namespace PagBankApi\Tests\Unit;

use PagBankApi\Entity\Order;
use PagBankApi\Entity\PaymentMethod;
use PagBankApi\Tests\BaseTestCase;

class OrderUnitTest extends BaseTestCase
{
    public function testOrderSerialize(): void
    {
        $order = new Order();

        $order->createCustomer()
            ->setName('Teste')
            ->setEmail('Teste@example.com')
            ->setTaxId('00000000000');
        $order->createShipping()
            ->createAddress()
            ->setStreet('Rua Exemplo')
            ->setNumber('123')
            ->setComplement('Apto 101')
            ->setLocality('Centro')
            ->setCity('São Paulo')
            ->setRegionCode('SP')
            ->setRegion('Sao Paulo')
            ->setPostalCode('01000000');
        $order->createItem()
            ->setName('teste')
            ->setQuantity(2)
            ->setUnitAmount(5000);
        $order->createCharge()
            ->setDescription('Pagamento do Produto Exemplo')
            ->setAmount(10000)
            ->setReferenceId('ex-0001')
            ->createPaymentMethod()
            ->setType(PaymentMethod::PAYMENT_TYPE_CREDIT_CARD)
            ->setInstallments(1)
            ->setCapture(true)
            ->setSoftDescriptor('My Store')
            ->createCard()
            ->setNumber('5240082975622454')
            ->setExpMonth(3)
            ->setExpYear(2026)
            ->setSecurityCode('123')
            ->createHolder()
            ->setName('teste')
            ->setTaxId('00000000000');
        $order->setNotificationUrls(['https://meusite.com/notificacao']);
        $order->setId('123456');

        $orderJson = $order->toJSON();

        if ('string' !== gettype($orderJson)) {
            $this->fail('Error to convert Order to JSON');
        }

        $this->assertJsonStringEqualsJsonString((string) json_encode($this->getMockFileContents('create_order.php')), (string) $orderJson);
    }
}
