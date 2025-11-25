<?php
session_start();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: users.php');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<?php include('../includes/header.php'); ?>

    <div class="login-container">
        <h2>Admin Login</h2>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php" class="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div> 

<?php include('../includes/footer.php'); ?>   

<style>
    .page-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .login-container {
        width: 100%;
        max-width: 460px;
        margin: 60px auto;
        padding: 40px 35px;
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 10px 28px rgba(78, 67, 118, 0.12);
        animation: fadeIn 0.5s ease;
    }

    h2 {
        text-align: center;
        color: #4e4376;
        font-size: 1.9rem;
        margin-bottom: 28px;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        font-weight: 600;
        color: #4e4376;
        display: block;
        margin-bottom: 6px;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 14px;
        font-size: 1.1rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: 0.2s;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        border-color: #4e4376;
        box-shadow: 0 0 0 3px rgba(78, 67, 118, 0.15);
    }

    .btn-login {
        width: 100%;
        padding: 14px;
        margin-top: 10px;
        font-size: 1.15rem;
        background: linear-gradient(135deg, #4e4376, #6d5ba8);
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: 0.25s;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(78, 67, 118, 0.3);
    }

    .error {
        color: #d32f2f;
        background: #ffeaea;
        border-radius: 6px;
        padding: 12px;
        margin-bottom: 18px;
        text-align: center;
        font-size: 0.95rem;
        border-left: 4px solid #d32f2f;
    }

    /* Simple fade in animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Mobile-friendly adjustments */
    @media (max-width: 480px) {
        .login-container {
            width: 92%;
            margin: 30px auto;
            padding: 28px 22px;
            box-shadow: 0 6px 18px rgba(78, 67, 118, 0.10);
            border-radius: 12px;
        }

        h2 {
            font-size: 1.6rem;
            margin-bottom: 22px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        label {
            font-size: 1rem;
            margin-bottom: 4px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 12px;
            font-size: 1rem;
        }

        .btn-login {
            padding: 12px;
            font-size: 1.05rem;
            margin-top: 12px;
            border-radius: 7px;
        }

        .error {
            padding: 10px;
            font-size: 0.9rem;
            margin-bottom: 16px;
        }
    }

</style>

