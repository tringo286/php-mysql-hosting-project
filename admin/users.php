<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users List - Admin Section</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>
    
    <div class="container">
        <h2>Website Users</h2>
        <div class="users-list">
            <ul>
                <li>Mary Smith - Premium Member</li>
                <li>John Wang - Basic Member</li>
                <li>Alex Bington - Premium Member</li>
                <li>Sarah Johnson - Basic Member</li>
                <li>Michael Brown - Premium Member</li>
            </ul>
        </div>
        
        <p><a href="logout.php">Logout</a></p>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>