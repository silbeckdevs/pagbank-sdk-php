# API Chaves Públicas

<https://developer.pagbank.com.br/reference/criar-chave-publica>

## Recursos

```php
use PagBankApi\Config\PagBankConfig;
use PagBankApi\Service\PagBankService;

$pagBankService = new PagBankService(new PagBankConfig('123456789', sandbox: true));

$pagBankService->createPublicKey();
$pagBankService->getPublicKey();
$pagBankService->updatePublicKey();
```