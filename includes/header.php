<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechPro Solutions - <?php echo ucfirst(str_replace('.php', '', $currentPage)); ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        nav {
            background-color: #333;
            padding: 1rem 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            color: #00a8ff;
        }

        .active {
            color: #00a8ff !important;
        }

        .hero {
            background-color: #f4f4f4;
            padding: 2rem 0;
            text-align: center;
            margin-bottom: 2rem;
        }

        .content {
            margin-bottom: 2rem;
        }

        .news-item,
        .product-item {
            border: 1px solid #ddd;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
        }

        .contact-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php" <?php echo $currentPage == 'index.php' ? 'class="active"' : ''; ?>>Home</a></li>
            <li><a href="about.php" <?php echo $currentPage == 'about.php' ? 'class="active"' : ''; ?>>About</a></li>
            <li><a href="products.php" <?php echo $currentPage == 'products.php' ? 'class="active"' : ''; ?>>Products</a>
            </li>
            <li><a href="news.php" <?php echo $currentPage == 'news.php' ? 'class="active"' : ''; ?>>News</a></li>
            <li><a href="contact.php" <?php echo $currentPage == 'contact.php' ? 'class="active"' : ''; ?>>Contact</a>
            </li>
        </ul>
    </nav>
    <div class="container">