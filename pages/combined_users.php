<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

// Function to get users from a remote API using CURL
function getUsersFromAPI($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Only for development
    $response = curl_exec($ch);
    
    if(curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        return [];
    }
    
    curl_close($ch);
    $result = json_decode($response, true);
    
    return isset($result['data']) ? $result['data'] : [];
}

// Get local users from database
$localUsers = [];
try {
    // Make sure to update these with your actual database credentials
    $servername = "localhost";
    $username = "root";      // replace with your actual database username
    $password = "";          // replace with your actual database password
    $dbname = "hosting_db"; // replace with your actual database name

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if users table exists, if not create it
    $conn->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL
    )");
    
    // Insert some sample data if table is empty
    $stmt = $conn->query("SELECT COUNT(*) FROM users");
    if ($stmt->fetchColumn() == 0) {
        $conn->exec("INSERT INTO users (name, email) VALUES 
            ('John Doe', 'john@example.com'),
            ('Jane Smith', 'jane@example.com'),
            ('Bob Johnson', 'bob@example.com')
        ");
    }
    
    $stmt = $conn->prepare("SELECT id, name, email FROM users");
    $stmt->execute();
    $localUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "<div class='error-message'>Database connection failed: " . $e->getMessage() . "</div>";
}

// Get users from Company B (Lambert's endpoint)
$companyB_users = getUsersFromAPI('https://lambertnguyen.cloud/api/users');

// Temporarily disable Company C until we have their endpoint
$companyC_users = [];
?>

<div class="content">
    <h1>Combined List of Users</h1>
    
    <h2>Company A Users (Local)</h2>
    <table class="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($localUsers as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Company B Users</h2>
    <table class="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($companyB_users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Company C Users</h2>
    <table class="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($companyC_users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<style>
.users-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.users-table th,
.users-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

.users-table th {
    background: linear-gradient(90deg, #2b5876 0%, #4e4376 100%);
    color: white;
}

.users-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.error-message {
    background-color: #ffebee;
    color: #c62828;
    padding: 12px;
    border-radius: 4px;
    margin-bottom: 20px;
    border: 1px solid #ffcdd2;
}

.section-title {
    color: #2b5876;
    margin: 30px 0 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid #4e4376;
}
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>