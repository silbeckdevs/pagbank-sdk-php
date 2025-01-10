# API Custom

<https://developer.pagbank.com.br/reference/introducao>

> [!NOTE]
> Com o `$pagBankService->customRequest(...)` você pode interagir com qualquer método que ainda não esteja implementado na sdk.

## Outros endpoints

```php
use PagBankApi\Config\PagBankConfig;
use PagBankApi\Service\PagBankService;

$pagBankService = new PagBankService(new PagBankConfig('123456789', PagBankConfig::ENVIRONMENT_SANDBOX));
// Consultar taxas de uma transação
$response = $pagBankService->customRequest('GET', '/charges/fees/calculate?payment_methods=CREDIT_CARD&value=10000&max_installments=10&max_installments_no_interest=4');

var_dump($response->getBody(), $response->getContent());
```
