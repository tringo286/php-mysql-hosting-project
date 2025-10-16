<?php
session_start();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // For this example, we're using a simple hardcoded credential
    // In a real application, you should use a database and proper password hashing
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: users.php');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include('../includes/header.php'); ?>
    
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div>
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required>
            </div>
            <div style="margin-top: 10px;">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>