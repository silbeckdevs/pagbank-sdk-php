# API Checkout

<https://developer.pagbank.com.br/reference/criar-checkout>

## Criar Checkout

```php
use PagBankApi\Config\PagBankConfig;
use PagBankApi\Entity\Checkout;
use PagBankApi\Service\PagBankService;

$pagBankService = new PagBankService(new PagBankConfig('123456789', PagBankConfig::ENVIRONMENT_SANDBOX));

$checkout = new Checkout();
$checkout
    ->setReferenceId('1234')
    ->setNotificationUrls(['https://meusite.com/notificacoes'])
    ->createItem()
    ->setName('nome do item')
    ->setQuantity(1)
    ->setReferenceId('referencia do item')
    ->setUnitAmount(10000);

$checkout->createCustomer()
    ->setName('Jose da Silva')
    ->setEmail('email@test.com')
    ->setTaxId('12345678909')
    ->createCheckoutPhone()
    ->setCountry(55)
    ->setArea(11)
    ->setNumber(999999999);

$checkout->createShipping()
    ->setType('FREE')
    ->createAddress()
    ->setCity('São Paulo')
    ->setRegionCode('SP')
    ->setStreet('Avenida Brigadeiro Faria Lima')
    ->setPostalCode('01452002')
    ->setNumber('1138423')
    ->setComplement('apto 12')
    ->setLocality('Pinheiros');



$response = $pagBankService->createCheckout($checkout);
var_dump($response);

// Get checkout payment orders
var_dump($response->getOrders());

```

## Outros recursos

```php
$pagBankService = new PagBankService(new PagBankConfig('123456789', PagBankConfig::ENVIRONMENT_SANDBOX));

$pagBankService->getCheckout(...);
$pagBankService->activateCheckout(...);
$pagBankService->inactivateCheckout(...);
```
