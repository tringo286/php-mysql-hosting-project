<?php
$currentPage = basename($_SERVER['PHP_SELF']);
    <style>
        body {
            font-family: 'Montserrat', 'Arial', sans-serif;
            background: #f4f6fb;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 30px auto;
            padding: 30px 28px;
            background: #fff;
            box-shadow: 0 2px 12px rgba(78,67,118,0.08);
            border-radius: 12px;
        }

        nav {
            background: linear-gradient(90deg, #2b5876 0%, #4e4376 100%);
            box-shadow: 0 2px 8px rgba(78,67,118,0.07);
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        nav ul li {
            margin: 0 22px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.13rem;
            padding: 18px 0;
            display: block;
            letter-spacing: 0.5px;
            transition: color 0.2s, border-bottom 0.2s;
        }

        nav ul li a.active,
        nav ul li a:hover {
            color: #ffd700;
            border-bottom: 2px solid #ffd700;
        }

        .admin-link {
            margin-left: auto;
        }

        h1, h2, h3 {
            color: #4e4376;
            font-family: 'Montserrat', Arial, sans-serif;
            margin-top: 0;
        }

        button, input[type="submit"] {
            background: linear-gradient(90deg, #2b5876 0%, #4e4376 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 22px;
            font-size: 1.07rem;
            font-family: 'Montserrat', Arial, sans-serif;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        button:hover, input[type="submit"]:hover {
            background: #ffd700;
            color: #4e4376;
        }

        input, textarea {
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 10px;
            font-size: 1.07rem;
            margin-bottom: 14px;
            width: 100%;
            box-sizing: border-box;
            font-family: 'Montserrat', Arial, sans-serif;
        }

        .error {
            color: #d32f2f;
            background: #ffeaea;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 14px;
        }

        .users-list ul {
            background: #f7f7fa;
            border-radius: 8px;
            padding: 22px;
            box-shadow: 0 1px 4px rgba(78,67,118,0.04);
        }

        .users-list li {
            margin-bottom: 12px;
            font-size: 1.09rem;
        }

        .contact-info {
            background-color: #f9f9f9;
            padding: 24px;
            border-radius: 8px;
            margin-top: 24px;
            box-shadow: 0 1px 4px rgba(78,67,118,0.04);
        }
        .hero {
            background: linear-gradient(90deg, #2b5876 0%, #4e4376 100%);
            color: #fff;
            padding: 48px 0 32px 0;
            text-align: center;
            border-radius: 12px 12px 0 0;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(78,67,118,0.07);
        }
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 12px;
            font-weight: 700;
        }
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 0;
        }
        .content {
            margin-top: 18px;
        }
        .product-item, .news-item {
            background: #f7f7fa;
            border-radius: 8px;
            padding: 22px;
            margin-bottom: 18px;
            box-shadow: 0 1px 4px rgba(78,67,118,0.04);
        }
        .product-item h3, .news-item h3 {
            color: #2b5876;
            margin-top: 0;
        }
        .product-item ul, .news-item ul {
            margin-left: 18px;
        }
        .contact-info {
            background-color: #f9f9f9;
            padding: 24px;
            border-radius: 8px;
            margin-top: 24px;
            box-shadow: 0 1px 4px rgba(78,67,118,0.04);
        }
        form label {
            font-weight: 500;
            color: #4e4376;
        }
        form button, form input[type="submit"] {
            background: linear-gradient(90deg, #2b5876 0%, #4e4376 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 22px;
            font-size: 1.07rem;
            font-family: 'Montserrat', Arial, sans-serif;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        form button:hover, form input[type="submit"]:hover {
            background: #ffd700;
            color: #4e4376;
        }
    </style>