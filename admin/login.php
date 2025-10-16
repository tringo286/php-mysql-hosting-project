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
            margin: 60px auto;
            padding: 32px 28px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(78,67,118,0.08);
        }
        h2 {
            text-align: center;
            color: #4e4376;
            margin-bottom: 24px;
        }
        label {
            font-weight: 500;
            color: #4e4376;
        }
        input[type="text"], input[type="password"] {
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 10px;
            font-size: 1.07rem;
            margin-bottom: 14px;
            width: 100%;
            box-sizing: border-box;
            font-family: 'Montserrat', Arial, sans-serif;
        }
        input[type="submit"] {
            width: 100%;
            margin-top: 10px;
        }
        .error {
            color: #d32f2f;
            background: #ffeaea;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 14px;
            text-align: center;
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