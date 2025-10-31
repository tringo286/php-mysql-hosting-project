<?php
header('Content-Type: application/json');
// Local fallback for Company C when their endpoint is unreachable
$users = [
    ['name' => 'Anu Krithi', 'email' => 'anu.k@example.com'],
    ['name' => 'Priya Rao', 'email' => 'priya.rao@example.com'],
    ['name' => 'Suresh Kumar', 'email' => 'suresh.k@example.com']
];

echo json_encode(['status' => 'success', 'users' => $users]);
?>