# API Order e Payment

<https://developer.pagbank.com.br/reference/casos-de-uso>

## Criar order e pagar com cartão de crédito

```php
use PagBankApi\Config\PagBankConfig;
use PagBankApi\Entity\Order;
use PagBankApi\Entity\PaymentMethod;
use PagBankApi\Service\PagBankService;

$pagBankService = new PagBankService(new PagBankConfig('123456789', PagBankConfig::ENVIRONMENT_SANDBOX));

$order = new Order();
$order
    ->setReferenceId('1234')
    ->setNotificationUrls(['https://meusite.com/notificacoes'])
    ->createItem()
    ->setName('nome do item')
    ->setQuantity(1)
    ->setReferenceId('referencia do item')
    ->setUnitAmount(10000);

$order->createCustomer()
    ->setName('Jose da Silva')
    ->setEmail('email@test.com')
    ->setTaxId('12345678909')
    ->createPhone()
    ->setCountry(55)
    ->setArea(11)
    ->setNumber(999999999);

$order->createShipping()
    ->createAddress()
    ->setCity('São Paulo')
    ->setRegionCode('SP')
    ->setStreet('Avenida Brigadeiro Faria Lima')
    ->setPostalCode('01452002')
    ->setNumber('1138423')
    ->setComplement('apto 12')
    ->setLocality('Pinheiros');

$order->createCharge()
    ->setReferenceId('Pedido 123')
    ->setDescription('Pedido 123')
    ->setAmount(10000)
    ->createPaymentMethod()
    ->setType(PaymentMethod::PAYMENT_TYPE_CREDIT_CARD)
    ->setInstallments(1)
    ->setCapture(true)
    ->createCard()
    ->setEncrypted('[card_token]')
    ->setStore(false)
    ->createHolder()
    ->setName('Jose da Silva')
    ->setTaxId('65544332211');

$response = $pagBankService->createOrder($order);
var_dump($response);

var_dump($pagBankService->getOrder($response->getId()));

```

## Criar order PIX

```php
use PagBankApi\Config\PagBankConfig;
use PagBankApi\Entity\Order;
use PagBankApi\Entity\PaymentMethod;
use PagBankApi\Service\PagBankService;

$pagBankService = new PagBankService(new PagBankConfig('123456789', PagBankConfig::ENVIRONMENT_SANDBOX));

$order = new Order();
// populate oder ...

$order->createQrCode()
    ->setAmount(50000)
    ->setExpirationDate('2025-01-20T20:15:59-03:00');

$response = $pagBankService->createOrder($order);
var_dump($response->getQrCodes());

```

## Outros recursos

```php
$pagBankService = new PagBankService(new PagBankConfig('123456789', PagBankConfig::ENVIRONMENT_SANDBOX));

$pagBankService->getOrder(...);
$pagBankService->getOrderByParams(...);
$pagBankService->createPayment(...);
$pagBankService->capturePayment(...);
$pagBankService->getPayment(...);
$pagBankService->cancelPayment(...);
```
