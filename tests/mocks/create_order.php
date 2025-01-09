<?php

return [
    'customer' => [
        'name' => 'Teste',
        'email' => 'Teste@example.com',
        'tax_id' => '00000000000',
        'phones' => [],
    ],
    'shipping' => [
        'address' => [
            'street' => 'Rua Exemplo',
            'number' => '123',
            'complement' => 'Apto 101',
            'locality' => 'Centro',
            'city' => 'São Paulo',
            'region' => 'Sao Paulo',
            'region_code' => 'SP',
            'country' => 'BRA',
            'postal_code' => '01000000',
        ],
    ],
    'items' => [
        [
            'name' => 'teste',
            'quantity' => 2,
            'unit_amount' => 5000,
        ],
    ],
    'charges' => [
        [
            'reference_id' => 'ex-0001',
            'description' => 'Pagamento do Produto Exemplo',
            'amount' => [
                'value' => 10000,
                'currency' => 'BRL',
            ],
            'payment_method' => [
                'type' => 'CREDIT_CARD',
                'installments' => 1,
                'capture' => true,
                'soft_descriptor' => 'My Store',
                'card' => [
                    'number' => '5240082975622454',
                    'exp_month' => 3,
                    'exp_year' => 2026,
                    'security_code' => '123',
                    'store' => false,
                    'holder' => [
                        'name' => 'teste',
                        'tax_id' => '00000000000',
                    ],
                ],
            ],
        ],
    ],
    'notification_urls' => [
        'https://meusite.com/notificacao',
    ],
    'id' => '123456',
];
