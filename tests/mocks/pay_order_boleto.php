<?php

return [
    'customer' => [
        'name' => 'Jose da Silva',
        'email' => 'jose@email.com',
        'tax_id' => '12345679891',
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
    'charge' => [
        'reference_id' => 'referencia do pagamento',
        'description' => 'descricao do pagamento',
        'amount' => [
            'value' => 10000,
            'currency' => 'BRL',
        ],
        'payment_method' => [
            'type' => 'BOLETO',
            'boleto' => [
                'due_date' => '2023-06-28',
                'instruction_lines' => [
                    'line_1' => 'Pagamento processado para DESC Fatura',
                    'line_2' => 'Via PagSeguro',
                ],
                'holder' => [
                    'name' => 'Jose da Silva',
                    'tax_id' => '12345679891',
                    'email' => 'jose@email.com',
                    'address' => [
                        'street' => 'Avenida Brigadeiro Faria Lima',
                        'number' => '1384',
                        'complement' => '',
                        'locality' => 'Pinheiros',
                        'city' => 'Sao Paulo',
                        'region' => 'Sao Paulo',
                        'region_code' => 'SP',
                        'country' => 'BRA',
                        'postal_code' => '01452002',
                    ],
                ],
            ],
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
                'type' => 'BOLETO',
                'boleto' => [
                    'due_date' => '2023-06-28',
                    'instruction_lines' => [
                        'line_1' => 'Pagamento processado para DESC Fatura',
                        'line_2' => 'Via PagSeguro',
                    ],
                    'holder' => [
                        'name' => 'Jose da Silva',
                        'tax_id' => '12345679891',
                        'email' => 'jose@email.com',
                        'address' => [
                            'street' => 'Avenida Brigadeiro Faria Lima',
                            'number' => '1384',
                            'complement' => '',
                            'locality' => 'Pinheiros',
                            'city' => 'Sao Paulo',
                            'region' => 'Sao Paulo',
                            'region_code' => 'SP',
                            'country' => 'BRA',
                            'postal_code' => '01452002',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'notification_urls' => [
        'https://meusite.com/notificacoes',
    ],
];
