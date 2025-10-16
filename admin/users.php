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
        <h2 style="margin-bottom: 24px;">Website Users</h2>
        <div class="users-list">
            <ul>
                <li><strong>Mary Smith</strong> <span style="color:#4e4376;">- Premium Member</span></li>
                <li><strong>John Wang</strong> <span style="color:#4e4376;">- Basic Member</span></li>
                <li><strong>Alex Bington</strong> <span style="color:#4e4376;">- Premium Member</span></li>
                <li><strong>Sarah Johnson</strong> <span style="color:#4e4376;">- Basic Member</span></li>
                <li><strong>Michael Brown</strong> <span style="color:#4e4376;">- Premium Member</span></li>
            </ul>
        </div>
        <div style="margin-top: 32px; text-align: right;">
            <a href="logout.php" style="background: linear-gradient(90deg, #2b5876 0%, #4e4376 100%); color: #fff; padding: 8px 18px; border-radius: 6px; text-decoration: none; font-weight: 500; transition: background 0.2s;">Logout</a>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>