<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

// Function to get users from a remote API using CURL
function getUsersFromAPI($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200 && $response) {
        $data = json_decode($response, true);
        return is_array($data) ? $data : [];
    }
    return [];
}

// --- Company A (Local Users) ---
$localUsers = [];
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$baseUrl = $scheme . '://' . $_SERVER['HTTP_HOST'];

// Prefer a JSON API for local users
$localUsers = getUsersFromAPI($baseUrl . '/api/local_users.php');

// --- Optional: Fallback to local DB query (only if needed) ---
try {
    $mysqli = new mysqli('127.0.0.1', 'username', 'password', 'database');
    if ($mysqli->connect_error) {
        throw new Exception($mysqli->connect_error);
    }

    $result = $mysqli->query("SELECT id, name, email FROM users");
    if ($result) {
        while ($r = $result->fetch_assoc()) {
            $localUsers[] = $r;
        }
    }

    $mysqli->close();
} catch (Exception $e2) {
    $pdoError = isset($pdoError) ? $pdoError : '';
    $combined = htmlspecialchars($pdoError . ' | ' . $e2->getMessage());
    echo "<div class='error-message'>Database connection failed: " . $combined . "</div>";
    echo "<div class='error-message'>Possible causes: 
        <ul style='margin:6px 0 6px 18px;'>
            <li>PDO MySQL extension (pdo_mysql) is not enabled in PHP — check <code>phpinfo()</code> for 'pdo_mysql'.</li>
            <li>MySQL server is not running or not reachable at <code>127.0.0.1:3306</code>. Start MySQL (MAMP/Homebrew/XAMPP/Docker) or update host/port.</li>
            <li>Incorrect DB credentials or database name — update the variables at the top of this page.</li>
        </ul>
    </div>";
}

// --- Company B ---
$companyB_users = getUsersFromAPI('https://lambertnguyen.cloud/api/users');

// --- Company C (Temporarily Disabled) ---
$companyC_users = [];
?>

<div class="content">
    <h1>Combined List of Users</h1>

    <h2 class="section-title">Company A Users (Local)</h2>
    <table class="users-table">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th></tr>
        </thead>
        <tbody>
            <?php foreach ($localUsers as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="section-title">Company B Users</h2>
    <table class="users-table">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th></tr>
        </thead>
        <tbody>
            <?php foreach ($companyB_users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="section-title">Company C Users</h2>
    <table class="users-table">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th></tr>
        </thead>
        <tbody>
            <?php foreach ($companyC_users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
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
