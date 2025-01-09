<?php

return $data = [
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
                    'store' => false,
                    'encrypted' => 'dMS5cyCFGr7OOXHv4oJy17Da31nvmTpF7GMPvDXhleCKSwkxXcVCaDT0H+5nH30UFV+k9h1I36rYsnm6etgoaw9p82YSTzfRN9ENxxhThMajcj28vNd5mGLBx4vPqE7cWE3zJvKTHTFtMRQVLzIrzqXdRwXuKFWmPMmXFQRoWBd51FOQWsPxkwzQA3m0+mOmZEw74Xm6uSMbQyYd8/HYAUyPBwLLNfhIsegvK1kRvWwlVmtePSuVTy2DoWO5t6OP/arGox21Njts5WkjXqBWJNmRk+gPFerpzQwtT/EHwvZMHIWA5C2GxGmgxaaZpEkYKDDSViZrPVnUi0D5hErrag==',
                ],
            ],
        ],
    ],
    'notification_urls' => [
        'https://meusite.com/notificacoes',
    ],
];
