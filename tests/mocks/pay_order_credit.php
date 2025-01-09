<?php

return [
    'customer' => [
        'name' => 'Jose da Silva',
        'email' => 'jose@email.com',
        'tax_id' => '65544332211',
        'phones' => [],
    ],
    'shipping' => [
        'address' => [
            'street' => 'Avenida Brigadeiro Faria Lima',
            'number' => '1384',
            'complement' => '',
            'locality' => 'Pinheiros',
            'city' => 'Sao Paulo',
            'region' => '',
            'region_code' => 'SP',
            'country' => 'BRA',
            'postal_code' => '01452002',
        ],
    ],
    'items' => [
        [
            'name' => 'Item teste',
            'quantity' => 2,
            'unit_amount' => 5000,
        ],
    ],
    'charges' => [
        [
            'reference_id' => 'referencia do pagamento',
            'description' => 'descricao do pagamento',
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
                        'name' => 'Jose da Silva',
                        'tax_id' => '65544332211',
                    ],
                ],
            ],
        ],
    ],
    'notification_urls' => [
        'https://meusite.com/notificacoes',
    ],
];
