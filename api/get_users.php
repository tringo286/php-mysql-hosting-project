<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";  // replace with your DB username
$password = "";      // replace with your DB password
$dbname = "companydb";  // replace with your DB name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
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
    echo json_encode([
        'status' => 'error',
        'message' => "Connection failed: " . $e->getMessage()
    ]);
}
?>