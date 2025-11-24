<?php
// Enable mysqli error reporting with exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Load environment variables
    $host = getenv('DB_HOST') ?: 'localhost';
    $user = getenv('DB_USER') ?: 'root';
    $password = getenv('DB_PASSWORD') ?: '';
    $dbname = getenv('DB_NAME') ?: 'database';
    $port = getenv('DB_PORT') ?: 3306;

    // Create connection
    $mysqli = new mysqli($host, $user, $password, $dbname, $port);
    
    // Set charset to prevent encoding issues
    $mysqli->set_charset('utf8mb4');
    
    // Optional: Set options for better type handling
    $mysqli->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
    
} catch (mysqli_sql_exception $e) {
    // Log error securely (don't expose details to users in production)
    error_log("Database connection failed: " . $e->getMessage());
    
    // Show user-friendly message
    die("Database connection error. Please try again later.");
}

// Unset sensitive variables
unset($host, $user, $password, $dbname, $port);
?>
