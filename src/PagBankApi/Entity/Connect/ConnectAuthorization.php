<?php

namespace PagBankApi\Entity\Connect;

use PagBankApi\Entity\PagBankSerializable;
use PagBankApi\Entity\SerializeTrait;

class ConnectAuthorization implements PagBankSerializable
{
    use SerializeTrait;

    /**
     * Scope separated by spaces.
     *
     * @see https://developer.pagbank.com.br/docs/connect-authorization
     * payments.read: Permissão para visualizar pedidos e cobranças.
     * payments.create: Permissão para criar e visualizar pedidos e cobranças.
     * payments.refund: Permissão para fazer reembolsos.
     * accounts.read: Permissão para consultar os dados de cadastro do vendedor.
     * checkout.create: Permissão para criar checkout PagBank.
     * checkout.view: Permissão para visualizar checkout PagBank.
     * checkout.update: Permissão para atualizar checkouts PagBank criados.
     */

    /**
     * @param string|string[]|null $scope
     */
    public function __construct(
        public readonly ?string $client_id = null,
        public readonly ?string $redirect_uri = null,
        public readonly string|array|null $scope = null,
        public readonly ?string $code = null,
        public readonly ?string $state = null,
        public readonly ?string $response_type = 'code',
    ) {
    }

    public function buildQueryParams(): string
    {
        $params = $this->toArray();

        if (is_array($this->scope)) {
            $params['scope'] = implode(' ', $this->scope);
        }

        return http_build_query($params);
    }
}
