<?php
// local_users.php
header('Content-Type: application/json'); // tell browser/client it's JSON

include __DIR__ . '/../db.php'; // adjust path if needed

// Fetch users from database
$sql = "SELECT id, name, email, role, status, joined_date FROM users ORDER BY id ASC";
$result = $mysqli->query($sql);

$users = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    http_response_code(500);
    echo json_encode([
        'error' => 'Database query failed',
        'details' => $mysqli->error
    ]);
    exit;
}

// Return the data as JSON
echo json_encode([
    'users' => $users
]);

$mysqli->close();
