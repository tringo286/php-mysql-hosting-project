<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechPro Solutions</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <div class="logo">
                <a href="/index.php">TechPro</a>
            </div>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links" id="nav-links">
                <li><a href="/index.php" <?php echo $currentPage == 'index.php' ? 'class="active"' : ''; ?>>Home</a></li>
                <li><a href="/pages/about.php" <?php echo $currentPage == 'about.php' ? 'class="active"' : ''; ?>>About</a></li>
                <li><a href="/pages/products.php" <?php echo $currentPage == 'products.php' ? 'class="active"' : ''; ?>>Products</a></li>
                <li><a href="/pages/news.php" <?php echo $currentPage == 'news.php' ? 'class="active"' : ''; ?>>News</a></li>
                <li><a href="/pages/contact.php" <?php echo $currentPage == 'contact.php' ? 'class="active"' : ''; ?>>Contact</a></li>
                <li><a href="/pages/combined_users.php" <?php echo $currentPage == 'combined_users.php' ? 'class="active"' : ''; ?>>Users</a></li>
                <li><a href="/admin/login.php" <?php echo $currentPage == 'login.php' ? 'class="active"' : ''; ?>>Admin</a></li>
            </ul>
        </div>
    </nav>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', Arial, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        nav {
            background: linear-gradient(90deg, #2b5876 0%, #4e4376 100%);
            box-shadow: 0 2px 8px rgba(78,67,118,0.07);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: auto;
            margin: 0;
            padding: 10px 50px;
        }

        .logo a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 30px;
        }

        ul.nav-links {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        ul.nav-links li {
            margin: 0 15px;
        }

        ul.nav-links li a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 18px;
            padding: 18px 0;
            display: block;
            transition: color 0.2s, border-bottom 0.2s;
        }

        ul.nav-links li a.active,
        ul.nav-links li a:hover {
            color: #ffd700;
            border-bottom: 2px solid #ffd700;
        }

        /* Hamburger menu */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 5px;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: #fff;
            display: block;
            border-radius: 2px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hamburger {
                display: flex;
            }

            ul.nav-links {
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background: linear-gradient(90deg, #2b5876 0%, #4e4376 100%);
                flex-direction: column;
                display: none;
            }

            ul.nav-links.show {
                display: flex;
            }

            ul.nav-links li {
                margin: 10px 0;
                text-align: center;
            }
        }
    </style>

    <!-- ===== Hamburger JS ===== -->
    <script>
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('nav-links');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('show');
        });
    </script>
