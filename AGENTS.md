# AGENTS.md

## Contexto do projeto

- Projeto: `silbeckdevs/pagbank-sdk-php`.
- Tipo: SDK PHP para integracao com a API PagBank (orders, payments, charges, checkout, public keys, Connect/OAuth).
- Namespace principal: `PagBankApi\`.
- Documentacao da API: <https://developer.pagbank.com.br/reference/introducao>.

## Stack e versoes

- PHP: `^8.2`.
- Composer: `^2`.
- HTTP: Guzzle 7 sobre `psr/http-client`.
- Qualidade: PHPUnit 12, PHPStan 2 (level 9), PHP-CS-Fixer 3.

## Estrutura do codigo

- `src/PagBankApi/Config/`: configuracao do SDK (`PagBankConfig` — token, sandbox/production, URLs base).
- `src/PagBankApi/Entity/`: DTOs e modelos da API (Order, Payment, Charge, Checkout, Customer, Card, Boleto, QrCode, etc.).
- `src/PagBankApi/Entity/Connect/`: entidades do fluxo Connect/OAuth (Application, AccessToken, RequestToken, ConnectAuthorization).
- `src/PagBankApi/Entity/Fee/`: entidades de taxas (AmountFee, Interest, Buyer).
- `src/PagBankApi/Exception/`: excecoes do SDK (`PagBankException`).
- `src/PagBankApi/Http/`: cliente HTTP (`PagBankHttpClient`, `PagBankResponse`) e interface (`PagBankHttpClientInterface`).
- `src/PagBankApi/Service/`: servicos principais (`PagBankService`, `PagBankConnectService`, `AbstractService`).
- `tests/Unit/`: testes unitarios.
- `tests/E2E/`: testes de integracao/E2E contra a API sandbox.
- `tests/mocks/`: fixtures JSON e helpers PHP para cenarios de teste.
- `docs/`: guias de uso (connect, order, checkout, public-keys, custom).

## Diretrizes para alteracoes

- Preserve compatibilidade retroativa sempre que possivel, por ser biblioteca compartilhada.
- Evite quebrar assinaturas publicas sem justificativa clara e sem atualizar testes.
- Para novas features, prefira adicionar classes/metodos em vez de alterar comportamento legado de forma silenciosa.
- Mantenha coesao por modulo (`Config`, `Entity`, `Exception`, `Http`, `Service`).
- Reutilize utilitarios e traits existentes (`SerializeTrait`, `ResponseTrait`) antes de criar duplicacoes.
- Ao adicionar suporte a novos endpoints, siga o padrao de `PagBankService::customRequest()` ou crie metodo dedicado.

## Qualidade e convencoes

- Arquivos em UTF-8 e quebra de linha `LF`.
- Indentacao: `4 espacos` para PHP, `2 espacos` para demais (conforme `.editorconfig`).
- Convencoes: classe `PascalCase`, metodo/variavel `camelCase`, constante `SCREAMING_SNAKE_CASE`.
- Estilo de codigo: `.php-cs-fixer.php` (`@PSR12` + `@Symfony`).
- Analise estatica: `phpstan.neon` (level 9, PHP 8.2).
- Sempre adicionar/atualizar testes quando alterar comportamento publico.
- Toda alteracao deve terminar com execucao de lint e testes antes de concluir a tarefa.

## Comandos relevantes

- Rodar localmente: `composer start`
- Testes + analise estatica: `composer test`
- PHPUnit: `composer phpunit`
- Testes unitarios: `composer test:unit`
- Testes E2E: `composer test:e2e`
- Cobertura: `composer test:coverage`
- PHPStan: `composer phpstan`
- Checar formato: `composer format:check`
- Corrigir formato: `composer format:fix`
- Lint padrao do projeto: `composer lint`

## Seguranca e limites

- Nunca commitar credenciais, tokens PagBank, chaves privadas ou segredos.
- Nunca registrar segredos em logs, mensagens de erro ou dumps de debug.
- Evitar alterar `vendor/` e arquivos gerados automaticamente.
- Em erros/excecoes, evitar exposicao de informacoes sensiveis (tokens, dados de cartao).
- Tokens de API e OAuth devem ser tratados como dados sensiveis em toda a cadeia.
- Dados de cartao (numero, CVV, validade) nunca devem ser persistidos ou logados.

## Testes e validacao final (obrigatorio)

- Ao finalizar qualquer alteracao, executar obrigatoriamente:
  - `composer lint`
  - `composer test`
- Se houver falha em qualquer comando, corrigir e rodar novamente ate passar.
- Em alteracoes pontuais, pode rodar `composer test:unit` durante o desenvolvimento, mas o fechamento da tarefa exige `composer test`.
- Nao considerar tarefa concluida sem evidenciar que lint e testes passaram.

## Commits (obrigatorio)

Usar Conventional Commits em pt-BR:

- `<tipo>(<escopo>): <mensagem curta em pt-BR>`
- Tipos: `feat`, `fix`, `refactor`, `chore`, `docs`, `style`, `perf`, `test`, `build`, `ci`, `revert`
