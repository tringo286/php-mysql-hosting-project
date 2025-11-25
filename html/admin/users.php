<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Include DB connection   
include __DIR__ . '/../db.php';

// Fetch users
$sql = "SELECT id, name, email, role, status, joined_date FROM users ORDER BY id ASC";
$result = $mysqli->query($sql);

// Handle query errors (optional)
if (!$result) {
    die("Query failed: " . $mysqli->error);
}
?>

<?php include('../includes/header.php'); ?>

<div class="page-wrapper">
    <div class="container">
        <h2>Website Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['role']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['joined_date']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7" style="text-align:center;">No users found</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<?php include('../includes/footer.php'); ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f7f7f7;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 1100px;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    h2 {
        color: #333;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }
    table th, table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
    }
    table th {
        background: linear-gradient(90deg, #2b5876 0%, #4e4376 100%);
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    table tr:nth-child(even) {
        background: #f4f4f4;
    }
    table tr:hover {
        background: #eaeaea;
    }
    .action-buttons a {
        text-decoration: none;
        padding: 6px 12px;
        margin-right: 5px;
        border-radius: 4px;
        color: #fff;
        font-size: 13px;
    }
    .edit-btn {
        background: #4CAF50;
    }
    .delete-btn {
        background: #f44336;
    }
    .logout-btn {
        display: inline-block;
        background: linear-gradient(90deg, #2b5876 0%, #4e4376 100%);
        color: #fff;
        padding: 8px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
        margin-top: 20px;
    }
</style>

<?php
$mysqli->close();
?>
