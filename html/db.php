<?php
// Enable mysqli error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Autoload Composer
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables from .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    // Read DB values
    $host = $_ENV['DB_HOST'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];
    $dbname = $_ENV['DB_NAME'];
    $port = (int) $_ENV['DB_PORT'];

    // Connect
    $mysqli = new mysqli($host, $user, $password, $dbname, $port);

    // Set charset
    $mysqli->set_charset('utf8mb4');

    // Enable numeric type conversion
    $mysqli->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);

} catch (mysqli_sql_exception $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection error.");
}

// Optional: remove sensitive vars
unset($host, $user, $password, $dbname, $port);
?>
