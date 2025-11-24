<?php
// Enable mysqli exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Load Composer autoload
require_once __DIR__ . '/vendor/autoload.php';

// Load .env only if it exists (local development)
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // adjust path if needed
    $dotenv->load();
}

// Get database credentials from environment variables
$host = $_ENV['DB_HOST'] ?? 'localhost';
$user = $_ENV['DB_USER'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';
$dbname = $_ENV['DB_NAME'] ?? 'database';
$port = (int) ($_ENV['DB_PORT'] ?? 3306);

try {
    $mysqli = new mysqli($host, $user, $password, $dbname, $port);
    $mysqli->set_charset('utf8mb4');
    $mysqli->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
} catch (mysqli_sql_exception $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection error.");
}

// Optional cleanup
unset($host, $user, $password, $dbname, $port);
?>
