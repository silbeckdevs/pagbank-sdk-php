# PagBank SDK PHP - v1

Todos os passos e processos referentes à integração com o sistema de captura e autorização de transações financeiras do PagBank via as funcionalidades da API.

Documentação oficial

- <https://developer.pagbank.com.br/reference/introducao>

## Pré-requisitos

- PHP `^8.2`

## Instalação

add composer.json

```bash
"silbeckdevs/pagbank-sdk-php": "^1.0"
```

ou execute

```bash
composer require silbeckdevs/pagbank-sdk-php
```

## Exemplos de uso

- [Connect](./docs/connect.md)
- [Order e Payment](./docs/order.md)
- [Checkout](./docs/checkout.md)
- [Chaves Públicas](./docs/public-keys.md)
- [Outros](./docs/custom.md)

### Testes e linters

- Rodar todos os testes e PHPStan `composer test`
- Rodar todos os testes `composer phpunit`
- Testes unitários `composer test:unit`
- Testes integração `composer test:e2e`
- PHPStan `composer phpstan`
- PHP-CS-Fixer verify `composer format:check`
- PHP-CS-Fixer fix `composer format:fix`
