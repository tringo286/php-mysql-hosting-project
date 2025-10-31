<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

// Function to get users from a remote API using CURL
// Instead of directly accessing a local DB here, fetch local users from the admin users endpoint
// or a small JSON endpoint we provide. This avoids auth/session issues with admin pages.
$localUsers = [];
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$baseUrl = $scheme . '://' . $_SERVER['HTTP_HOST'];
// Prefer a JSON API for local users; we added /api/local_users.php which mirrors admin/users.php content
$localUsers = getUsersFromAPI($baseUrl . '/api/local_users.php');
        if ($result) {
            while ($r = $result->fetch_assoc()) {
                $localUsers[] = $r;
            }
        }

        $mysqli->close();
    } catch (Exception $e2) {
        // Show combined error but keep it safe for display
        $combined = htmlspecialchars($pdoError . ' | ' . $e2->getMessage());
        echo "<div class='error-message'>Database connection failed: " . $combined . "</div>";
        echo "<div class='error-message'>Possible causes: <ul style='margin:6px 0 6px 18px;'>";
        echo "<li>PDO MySQL extension (pdo_mysql) is not enabled in PHP — check <code>phpinfo()</code> for 'pdo_mysql'.</li>";
        echo "<li>MySQL server is not running or not reachable at <code>127.0.0.1:3306</code>. Start MySQL (MAMP/Homebrew/XAMPP/Docker) or update host/port.</li>";
        echo "<li>Incorrect DB credentials or database name — update the variables at the top of this page.</li>";
        echo "</ul></div>";
    }
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