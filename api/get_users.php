<?php
header('Content-Type: application/json');

// Database connection - read from environment variables for security and portability
$servername = getenv('DB_HOST') ?: '127.0.0.1';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$dbname = getenv('DB_NAME') ?: 'companydb';
$dbport = getenv('DB_PORT') ?: 3306;

try {
    $dsn = "mysql:host=$servername;port=$dbport;dbname=$dbname";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to get all users
    $stmt = $conn->prepare("SELECT id, name, email FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'data' => $users
    ]);
} catch(PDOException $e) {
    // Return an error response but keep message short for security
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Database connection failed',
        'details' => getenv('APP_DEBUG') ? $e->getMessage() : null
    ]);
}
?>