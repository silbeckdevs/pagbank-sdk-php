# API Connect

<https://developer.pagbank.com.br/reference/criar-aplicacao>

## Criar aplicação

```php
$pagBankService = new PagBankService(new PagBankConfig('123456789', PagBankConfig::ENVIRONMENT_SANDBOX));
$connectService = $pagBankService->getConnectService();

$responseApp = $connectService->createApplication(
    (new Application())
        ->setName('App Name')
        ->setDescription('Descrição da plataforma')
        ->setSite('https://developer.pagbank.com.br/')
        ->setRedirectUri('http://www.parceiro.com.br/retorno')
);

var_dump($responseApp);

```

## Consultar aplicação

```php
$responseApp = $connectService->getApplication('[client_id]');

var_dump($responseApp);

```

## Solicitar autorização via Connect Authorization

```php
$auth = new ConnectAuthorization(
    client_id: '[client_id]',
    redirect_uri: 'http://www.parceiro.com.br/retorno',
    scope: [
        'payments.read',
        'payments.create',
        'payments.refund',
        'accounts.read',
        'checkout.create',
        'checkout.view',
        'checkout.update',
    ],
    state: 'spay2701'
);
$redirectUrl = $connectService->generateUrlConnectAuthorization($auth);

var_dump($redirectUrl);
```

## Obter access token

```php
$requestToken = new RequestToken(code: '123', redirect_uri: 'http://www.parceiro.com.br/retorno');
$tokenResponse = $connectService->createAccessToken('[client_id]', '[client_secret]', $requestToken);

var_dump($tokenResponse);
```

## Renovar access token

```php
$tokenResponse = $connectService->refreshAccessToken('[client_id]', '[client_secret]', $tokenResponse->getRefreshToken());

var_dump($tokenResponse);
```

## Revogar access token

```php
$tokenResponse = $connectService->revokeAccessToken(
    '[client_id]',
    '[client_secret]',
    'access_token',
    $tokenResponse->getAccessToken()
);

var_dump($tokenResponse);
```
