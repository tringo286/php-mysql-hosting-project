<?php
header('Content-Type: application/json');
// Local fallback for Company C (PureBite Beauty) when their endpoint is unreachable
$response = [
    'success' => true,
    'company' => 'PureBite Beauty',
    'url' => 'https://anukrithimyadala.42web.io',
    'count' => 4,
    'users' => [
        [
            'name' => 'Mary Smith',
            'email' => 'mary.smith@purebitebeauty.com',
            'role' => 'Marketing Lead',
            'status' => 'Active',
            'join_date' => '2024-01-10'
        ],
        [
            'name' => 'John Wang',
            'email' => 'john.wang@purebitebeauty.com',
            'role' => 'Product Designer',
            'status' => 'Active',
            'join_date' => '2024-02-14'
        ],
        [
            'name' => 'Alex Bington',
            'email' => 'alex.bington@purebitebeauty.com',
            'role' => 'Software Engineer',
            'status' => 'Active',
            'join_date' => '2024-03-20'
        ],
        [
            'name' => 'Emily Stone',
            'email' => 'emily.stone@purebitebeauty.com',
            'role' => 'Sales Associate',
            'status' => 'Inactive',
            'join_date' => '2024-04-05'
        ]
    ],
    'timestamp' => date('Y-m-d H:i:s')
];

echo json_encode($response);
?>