<?php
header('Content-Type: application/json');
// Simple JSON endpoint returning the same users list shown in admin/users.php
$users = [
    ['id' => 1, 'name' => 'Mary Smith', 'email' => 'mary.smith@example.com'],
    ['id' => 2, 'name' => 'John Wang', 'email' => 'john.wang@example.com'],
    ['id' => 3, 'name' => 'Alex Bington', 'email' => 'alex.bington@example.com'],
    ['id' => 4, 'name' => 'Sarah Johnson', 'email' => 'sarah.johnson@example.com'],
    ['id' => 5, 'name' => 'Michael Brown', 'email' => 'michael.brown@example.com'],
];

echo json_encode(['status' => 'success', 'data' => $users]);
?>