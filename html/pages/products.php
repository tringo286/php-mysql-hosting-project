<?php
require_once __DIR__ . '/../db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

// Fetch all products
$result = $mysqli->query("SELECT id, slug, title, description FROM products ORDER BY title ASC");
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
                <h3>
                    <a href="/pages/product.php?slug=<?php echo urlencode($product['slug']); ?>">
                        <?php echo htmlspecialchars($product['title']); ?>
                    </a>
                </h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
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
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
}

.product-card {
    background: #fff;
    padding: 22px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: 0.3s ease;
    border: 1px solid #eee;
    position: relative;
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(78,67,118,0.2);
    border-color: #dcd6f3;
}

.product-card h3 {
    margin: 0 0 12px;
    font-size: 1.3rem;
    color: #4e4376;
}

.product-card a {
    text-decoration: none;
    color: #4e4376;
}

.product-card p {
    color: #555;
    font-size: 0.95rem;
    line-height: 1.5;
}

.product-actions {
    margin-top: 36px;
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

@media (max-width: 768px) {
    .hero h1 {
        font-size: 2rem;
    }
    .hero p {
        font-size: 1rem;
    }
}
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
