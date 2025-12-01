<?php
require_once __DIR__ . '/../db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

// Fetch all products
$result = $mysqli->query("SELECT id, slug, title, description, details FROM products ORDER BY title ASC");
$products = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="hero">
    <h1>Our Products & Services</h1>
    <p>Innovative technology solutions built for real business impact</p>
</div>

<div class="products-container">
    <div class="products-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img 
                    src="/assets/images/<?php echo htmlspecialchars($product['slug']); ?>.png" 
                    alt="<?php echo htmlspecialchars($product['slug']); ?>" 
                    class="product-img"
                />                

                <h3>
                    <a href="/pages/product.php?slug=<?php echo urlencode($product['slug']); ?>">
                        <?php echo htmlspecialchars($product['title']); ?>
                    </a>
                </h3>               

                <?php if (!empty($product['details'])): ?>
                    <p class="product-details"><?php echo nl2br(htmlspecialchars(substr($product['details'], 0, 150))); ?>...</p>
                <?php endif; ?>

                <a href="/pages/product.php?slug=<?php echo urlencode($product['slug']); ?>" class="action-btn">View Product</a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="product-actions">
        <a class="action-btn" href="/pages/products_recent.php">Recently Visited</a>
        <a class="action-btn" href="/pages/products_top5.php">Top 5 Most Visited</a>
    </div>
</div>

<style>
    .products-container {
        width: 90%;
        max-width: 1200px;
        margin: 40px auto 60px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Only 2 cards per row */
        gap: 32px;
    }

    .product-card {
        background: #fff;
        padding: 28px;
        border-radius: 16px;
        box-shadow: 0 6px 25px rgba(0,0,0,0.1);
        transition: 0.3s ease;
        border: 1px solid #eee;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-card img.product-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(78,67,118,0.2);
        border-color: #dcd6f3;
    }

    .product-card h3 {
        margin: 0 0 12px;
        font-size: 1.5rem;
        color: #4e4376;
    }

    .product-card a {
        text-decoration: none;
        color: #4e4376;
    }

    .product-card p {
        color: #555;
        font-size: 1rem;
        line-height: 1.6;
    }

    .product-card .product-details {
        font-size: 0.9rem;
        color: #333;
        margin-top: 10px;
    }

    .product-card .action-btn {
        margin-top: 16px;
        text-align: center;
        padding: 10px 18px;
        font-size: 0.95rem;
        background: #4e4376;
        color: #fff;
        border-radius: 10px;
        font-weight: 600;
        transition: 0.25s ease;
    }

    .product-card .action-btn:hover {
        transform: translateY(-2px);
    }

    .product-actions {
        margin-top: 40px;
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .action-btn {
        text-decoration: none;
        padding: 12px 20px;
        background: #4e4376;
        color: #fff;
        border-radius: 10px;
        font-weight: 600;
        transition: 0.25s ease;
    }

    .action-btn:hover {
        transform: translateY(-3px);
    }

    @media (max-width: 992px) {
        .products-grid {
            grid-template-columns: 1fr; /* Stack on smaller screens */
        }
        .product-card img.product-img {
            height: 200px;
        }
    }
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
