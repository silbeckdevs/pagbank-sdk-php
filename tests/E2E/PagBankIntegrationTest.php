<?php

namespace PagBankApi\Tests\E2E;

use PagBankApi\Entity\Amount;
use PagBankApi\Entity\Boleto;
use PagBankApi\Entity\CancelPayment;
use PagBankApi\Entity\Card;
use PagBankApi\Entity\Charge;
use PagBankApi\Entity\Customer;
use PagBankApi\Entity\Link;
use PagBankApi\Entity\Order;
use PagBankApi\Entity\PaymentMethod;
use PagBankApi\Entity\Phone;
use PagBankApi\Entity\QrCode;
use PagBankApi\Entity\Shipping;
use PagBankApi\Exception\PagBankException;

// TODO refatorar todos os testes
class PagBankIntegrationTest extends AbstractPagBankTestCase
{
    public function testCreateOrderSuccess(): void
    {
        $order = new Order();
        $customer = $order->createCustomer();
        $customer->setName('Teste')
            ->setEmail('Teste@example.com')
            ->setTaxId('00000000000');
        $shipping = $order->createShipping()->createAddress();
        $shipping->setStreet('Rua Exemplo')
            ->setNumber('123')
            ->setComplement('Apto 101')
            ->setLocality('Centro')
            ->setCity('São Paulo')
            ->setRegionCode('SP')
            ->setPostalCode('01000000');
        $item = $order->createItem();
        $item->setName('Item teste')
            ->setQuantity(2)
            ->setUnitAmount(5000);
        $charge = $order->createCharge();
        $charge->setDescription('Pagamento do Produto Exemplo')
            ->setAmount(10000)
            ->setReferenceId('ex-0001');
        $payment_method = $charge->createPaymentMethod();
        $payment_method->setType(PaymentMethod::PAYMENT_TYPE_CREDIT_CARD)
            ->setInstallments(1)
            ->setCapture(true)
            ->setSoftDescriptor('My Store');
        $card = $payment_method->createCard();
        $card->setNumber('5240082975622454')
            ->setExpMonth(3)
            ->setExpYear(2026)
            ->setSecurityCode('123');

        $card->createHolder()
            ->setName('teste')
            ->setTaxId('00000000000');
        $order->setNotificationUrls(['https://meusite.com/notificacao']);

        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(201, [], $this->getMockFileContents('create_order_success.json')));
        $response = $this->pagBankService->createOrder($order);
        $this->assertInstanceOf(Order::class, $response);
        $this->assertInstanceOf(Customer::class, $response->getCustomer());
        $this->assertInstanceOf(Shipping::class, $response->getShipping());
        $this->assertInstanceOf(Phone::class, $response->getCustomer()->getPhones()[0] ?? null);
        $this->assertInstanceOf(Link::class, $response->getLinks()[0] ?? null);
        $this->assertInstanceOf(QrCode::class, $response->getQrCodes()[0] ?? null);
        $this->assertEquals(['https://meusite.com/notificacao'], $response->getNotificationUrls());
    }

    public function testCreateOrderFailure(): void
    {
        /** @var PagBankException|null $exception */
        $exception = null;

        try {
            $order = new Order();
            $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(400, [], $this->getMockFileContents('create_order_error.json')));
            $this->pagBankService->createOrder($order);
        } catch (\Exception $e) {
            $exception = $e;
        }

        $this->assertInstanceOf(PagBankException::class, $exception);
        $this->assertStringContainsString('incomplete_configuration', $exception->getMessage());
    }

    public function testCreateAndPayOrderSuccess(): void
    {
        $order = new Order();
        $customer = $order->createCustomer();
        $customer->setName('Teste')
            ->setEmail('Teste@example.com')
            ->setTaxId('00000000000');
        $shipping = $order->createShipping()->createAddress();
        $shipping->setStreet('Rua Exemplo')
            ->setNumber('123')
            ->setComplement('Apto 101')
            ->setLocality('Centro')
            ->setCity('São Paulo')
            ->setRegionCode('SP')
            ->setPostalCode('01000000');
        $item = $order->createItem();
        $item->setName('Item teste')
            ->setQuantity(2)
            ->setUnitAmount(5000);
        $charge = $order->createCharge();
        $charge->setDescription('Pagamento do Produto Exemplo')
            ->setAmount(10000)
            ->setReferenceId('ex-0001');
        $payment_method = $charge->createPaymentMethod();
        $payment_method->setType(PaymentMethod::PAYMENT_TYPE_CREDIT_CARD)
            ->setInstallments(1)
            ->setCapture(true)
            ->setSoftDescriptor('My Store');
        $card = $payment_method->createCard();
        $card->setNumber('5240082975622454')
            ->setExpMonth(3)
            ->setExpYear(2026)
            ->setSecurityCode('123');

        $card->createHolder()
            ->setName('teste')
            ->setTaxId('00000000000');
        $order->setNotificationUrls(['https://meusite.com/notificacao']);

        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(201, [], $this->getMockFileContents('create_order_success.json')));
        $response = $this->pagBankService->createOrder($order);
        $this->assertInstanceOf(Order::class, $response);

        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(201, [], $this->getMockFileContents('payment_success.json')));
        if (!empty($response->getOrderId())) {
            $response = $this->pagBankService->createPayment($response->getOrderId(), $order->generatePayment());
        }

        $this->assertInstanceOf(Order::class, $response);
        $charge = $response->getCharges()[0] ?? null;
        $this->assertInstanceOf(Charge::class, $charge);
        $this->assertSame(Charge::STATUS_PAID, $charge->getStatus());
    }

    public function testCreateAndPayOrderFailure(): void
    {
        /** @var PagBankException|null $exception */
        $exception = null;

        try {
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
                ->setPostalCode('01000000');
            $order->createItem()
                ->setName('Item teste')
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
            $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(400, [], $this->getMockFileContents('create_order_error.json')));
            $this->pagBankService->createOrder($order);
        } catch (PagBankException $e) {
            $exception = $e;
        }

        $this->assertInstanceOf(PagBankException::class, $exception);
        $this->assertEquals(400, $exception->getStatusCode());
        $this->assertStringContainsString('incomplete_configuration', $exception->getMessage());
    }

    public function testCapturePaymentSuccess(): void
    {
        $chargeId = 'ORDE_F87334AC-BB8B-42E2-AA85-8579F70AA328';
        $amount = new Amount(11111);

        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(200, [], $this->getMockFileContents('capture_payment_success.json')));
        $response = $this->pagBankService->capturePayment($chargeId, $amount);

        $this->assertInstanceOf(Charge::class, $response);
        $this->assertSame(Charge::STATUS_PAID, $response->getStatus());
    }

    public function testCapturePaymentFailure(): void
    {
        $chargeId = 'ORDE_F87334AC-BB8B-42E2-AA85-8579F70AA328';
        $amount = new Amount(11111);

        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(400, [], $this->getMockFileContents('capture_payment_error.json')));

        /** @var PagBankException|null $exception */
        $exception = null;
        try {
            $this->pagBankService->capturePayment($chargeId, $amount);
        } catch (PagBankException $e) {
            $exception = $e;
        }

        $this->assertInstanceOf(PagBankException::class, $exception);
        $this->assertEquals(400, $exception->getStatusCode());
    }

    public function testGetPaymentSuccess(): void
    {
        $chargeId = 'ORDE_F87334AC-BB8B-42E2-AA85-8579F70AA328';

        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(200, [], $this->getMockFileContents('get_payment_success.json')));
        $response = $this->pagBankService->getPayment($chargeId);

        $this->assertInstanceOf(Charge::class, $response);
        $this->assertSame(Charge::STATUS_PAID, $response->getStatus());
    }

    public function testGetPaymentFailure(): void
    {
        $chargeId = 'ORDE_F87334AC-BB8B-42E2-AA85-8579F70AA328';

        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(404, [], $this->getMockFileContents('get_payment_error.json')));

        /** @var PagBankException|null $exception */
        $exception = null;
        try {
            $this->pagBankService->getPayment($chargeId);
        } catch (PagBankException $e) {
            $exception = $e;
        }

        $this->assertInstanceOf(PagBankException::class, $exception);
        $this->assertEquals(404, $exception->getStatusCode());
    }

    public function testCancelPaymentSuccess(): void
    {
        $chargeId = 'ORDE_F87334AC-BB8B-42E2-AA85-8579F70AA328';
        $cancelPayment = new CancelPayment();

        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(200, [], $this->getMockFileContents('cancel_payment_success.json')));
        $response = $this->pagBankService->cancelPayment($chargeId, $cancelPayment);

        $this->assertInstanceOf(Charge::class, $response);
        $this->assertSame(Charge::STATUS_CANCELED, $response->getStatus());
    }

    public function testCancelPaymentFailure(): void
    {
        $chargeId = 'ORDE_F87334AC-BB8B-42E2-AA85-8579F70AA328';
        $cancelPayment = new CancelPayment();

        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(400, [], $this->getMockFileContents('cancel_payment_error.json')));

        /** @var PagBankException|null $exception */
        $exception = null;
        try {
            $this->pagBankService->cancelPayment($chargeId, $cancelPayment);
        } catch (PagBankException $e) {
            $exception = $e;
        }

        $this->assertInstanceOf(PagBankException::class, $exception);
        $this->assertEquals(400, $exception->getStatusCode());
    }

    public function testCreateOrderBoletoSuccess(): void
    {
        $order = new Order();

        $customer = $order->createCustomer();
        $customer->setName('Jose da Silva')
            ->setEmail('jose@email.com')
            ->setTaxId('12345679891');

        $shipping = $order->createShipping()->createAddress();
        $shipping->setStreet('Avenida Brigadeiro Faria Lima')
            ->setNumber('1384')
            ->setLocality('Pinheiros')
            ->setCity('Sao Paulo')
            ->setRegion('')
            ->setRegionCode('SP')
            ->setPostalCode('01452002');

        $item = $order->createItem();
        $item->setName('Item teste')
            ->setQuantity(2)
            ->setUnitAmount(5000);

        $charge = $order->createCharge();
        $charge->setDescription('descricao do pagamento')
            ->setAmount(10000)
            ->setReferenceId('referencia do pagamento');

        $payment_method = $charge->createPaymentMethod();
        $payment_method->setType(PaymentMethod::PAYMENT_TYPE_BOLETO);
        $boleto = $payment_method->createBoleto();
        $boleto->setDueDate('2023-06-28')
            ->createInstructionLines()
            ->setLine1('Pagamento processado para DESC Fatura')
            ->setLine2('Via PagSeguro');
        $holder = $boleto->createHolder();
        $holder->setName('Jose da Silva')
            ->setTaxId('12345679891')
            ->setEmail('jose@email.com');
        $holderAddress = $holder->createAddress();
        $holderAddress->setStreet('Avenida Brigadeiro Faria Lima')
            ->setNumber('1384')
            ->setLocality('Pinheiros')
            ->setCity('Sao Paulo')
            ->setRegion('Sao Paulo')
            ->setRegionCode('SP')
            ->setCountry('BRA')
            ->setPostalCode('01452002');

        $order->setNotificationUrls(['https://meusite.com/notificacoes']);
        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(201, [], $this->getMockFileContents('payment_boleto.json')));
        $response = $this->pagBankService->createOrder($order);

        $this->assertInstanceOf(Order::class, $response);

        $charge = $response->getCharges()[0] ?? null;
        $this->assertInstanceOf(Charge::class, $charge);
        $this->assertInstanceOf(PaymentMethod::class, $charge->getPaymentMethod());
        $this->assertInstanceOf(Boleto::class, $charge->getPaymentMethod()->getBoleto());
        $this->assertSame(Charge::STATUS_WAITING, $charge->getStatus());
        $this->assertSame('BOLETO', $charge->getPaymentMethod()->getType());
    }

    public function testCreateOrderCardEncryptedSuccess(): void
    {
        $order = new Order();

        $customer = $order->createCustomer();
        $customer->setName('Jose da Silva')
            ->setEmail('jose@email.com')
            ->setTaxId('65544332211');

        $shipping = $order->createShipping()->createAddress();
        $shipping->setStreet('Avenida Brigadeiro Faria Lima')
            ->setNumber('1384')
            ->setComplement('')
            ->setLocality('Pinheiros')
            ->setCity('Sao Paulo')
            ->setRegion('')
            ->setRegionCode('SP')
            ->setCountry('BRA')
            ->setPostalCode('01452002');

        $item = $order->createItem();
        $item->setName('Item teste')
            ->setQuantity(2)
            ->setUnitAmount(5000);

        $charge = $order->createCharge();
        $charge->setDescription('descricao do pagamento')
            ->setReferenceId('referencia do pagamento')
            ->createAmount()
            ->setValue(10000);

        $payment_method = $charge->createPaymentMethod();
        $payment_method->setType(PaymentMethod::PAYMENT_TYPE_CREDIT_CARD)
            ->setInstallments(1)
            ->setCapture(true)
            ->setSoftDescriptor('My Store');

        $card = $payment_method->createCard();
        $card->setEncrypted('dMS5cyCFGr7OOXHv4oJy17Da31nvmTpF7GMPvDXhleCKSwkxXcVCaDT0H+5nH30UFV+k9h1I36rYsnm6etgoaw9p82YSTzfRN9ENxxhThMajcj28vNd5mGLBx4vPqE7cWE3zJvKTHTFtMRQVLzIrzqXdRwXuKFWmPMmXFQRoWBd51FOQWsPxkwzQA3m0+mOmZEw74Xm6uSMbQyYd8/HYAUyPBwLLNfhIsegvK1kRvWwlVmtePSuVTy2DoWO5t6OP/arGox21Njts5WkjXqBWJNmRk+gPFerpzQwtT/EHwvZMHIWA5C2GxGmgxaaZpEkYKDDSViZrPVnUi0D5hErrag==');

        $order->setNotificationUrls(['https://meusite.com/notificacoes']);

        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(201, [], $this->getMockFileContents('create_order_success.json')));
        $response = $this->pagBankService->createOrder($order);
        $orderJson = (string) $order->toJSON();
        $this->assertJson($orderJson);

        $compare = json_encode($this->getMockFileContents('pay_order_credit_encrypted.php'));
        $this->assertJsonStringEqualsJsonString((string) $compare, $orderJson);
        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(201, [], $this->getMockFileContents('payment_credit_card.json')));
        $paymentResponse = $this->pagBankService->createPayment($response->getOrderId() ?? '', $order->generatePayment());

        $this->assertInstanceOf(Order::class, $response);
        $this->assertInstanceOf(Order::class, $paymentResponse);

        $charge = $paymentResponse->getCharges()[0] ?? null;
        $this->assertInstanceOf(Charge::class, $charge);
        $this->assertSame(Charge::STATUS_PAID, $charge->getStatus());
        $this->assertInstanceOf(PaymentMethod::class, $charge->getPaymentMethod());
        $this->assertInstanceOf(Card::class, $charge->getPaymentMethod()->getCard());
        $this->assertSame('CREDIT_CARD', $charge->getPaymentMethod()->getType());
    }

    public function testCreateOrderCardSuccess(): void
    {
        $order = new Order();

        $customer = $order->createCustomer();
        $customer->setName('Jose da Silva')
            ->setEmail('jose@email.com')
            ->setTaxId('65544332211');
        $shipping = $order->createShipping()->createAddress();
        $shipping->setStreet('Avenida Brigadeiro Faria Lima')
            ->setNumber('1384')
            ->setLocality('Pinheiros')
            ->setCity('Sao Paulo')
            ->setRegionCode('SP')
            ->setRegion('')
            ->setComplement('')
            ->setPostalCode('01452002');
        $item = $order->createItem();
        $item->setName('Item teste')
            ->setQuantity(2)
            ->setUnitAmount(5000);
        $charge = $order->createCharge();
        $charge->setDescription('descricao do pagamento')
            ->setReferenceId('referencia do pagamento')
            ->setAmount(10000);
        $payment_method = $charge->createPaymentMethod();
        $payment_method->setType(PaymentMethod::PAYMENT_TYPE_CREDIT_CARD)
            ->setInstallments(1)
            ->setCapture(true)
            ->setSoftDescriptor('My Store');
        $card = $payment_method->createCard();
        $card->setNumber('5240082975622454')
            ->setExpMonth(3)
            ->setExpYear(2026)
            ->setSecurityCode('123')
            ->setStore(false);
        $holder = $card->createHolder();
        $holder->setName('Jose da Silva')
            ->setTaxId('65544332211');

        $order->setNotificationUrls(['https://meusite.com/notificacoes']);

        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(201, [], $this->getMockFileContents('create_order_success.json')));
        $response = $this->pagBankService->createOrder($order);
        $orderJson = (string) $order->toJSON();
        $this->assertJson($orderJson);

        $compare = json_encode($this->getMockFileContents('pay_order_credit.php'));
        $this->assertJsonStringEqualsJsonString((string) $compare, $orderJson);
        $this->mockHandler->append(new \GuzzleHttp\Psr7\Response(201, [], $this->getMockFileContents('payment_credit_card.json')));
        $paymentResponse = $this->pagBankService->createPayment($response->getOrderId() ?? '', $order->generatePayment());

        $this->assertInstanceOf(Order::class, $response);
        $this->assertInstanceOf(Order::class, $paymentResponse);

        $charge = $paymentResponse->getCharges()[0] ?? null;
        $this->assertInstanceOf(Charge::class, $charge);
        $this->assertSame(Charge::STATUS_PAID, $charge->getStatus());
        $this->assertInstanceOf(PaymentMethod::class, $charge->getPaymentMethod());
        $this->assertInstanceOf(Card::class, $charge->getPaymentMethod()->getCard());
        $this->assertSame('CREDIT_CARD', $charge->getPaymentMethod()->getType());
    }
}
