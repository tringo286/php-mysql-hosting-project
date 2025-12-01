<?php
require_once __DIR__ . '/../db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

// Get product visit counts from cookie
$counts = [];
if (!empty($_COOKIE['product_counts'])) {
    $counts = json_decode($_COOKIE['product_counts'], true) ?: [];
}

// Sort counts descending and take top 5
arsort($counts);
$top = array_slice($counts, 0, 5, true);
?>

<div class="page-wrapper" style="position: relative;">
    <div class="hero">
        <a class="back-button" href="/pages/products.php">&#8592;</a>
        <h1>Top 5 Most Visited Services</h1>
        <p>See which products are the most popular among our users.</p>
    </div>

    <div class="products-container">
        <?php if (empty($top)): ?>
            <p>No product visits recorded yet.</p>
        <?php else: ?>
            <div class="products-grid">
                <?php
                // Fetch titles for the top products
                $slugs = array_keys($top);
                $placeholders = implode(',', array_fill(0, count($slugs), '?'));
                $types = str_repeat('s', count($slugs));

                $stmt = $mysqli->prepare("SELECT slug, title, description FROM products WHERE slug IN ($placeholders)");
                $stmt->bind_param($types, ...$slugs);
                $stmt->execute();
                $result = $stmt->get_result();

                $products = [];
                while ($row = $result->fetch_assoc()) {
                    $products[$row['slug']] = $row;
                }

                foreach ($top as $slug => $cnt):
                    if (!isset($products[$slug])) continue;
                    $p = $products[$slug];
                ?>
                    <div class="product-card">
                        <h3>
                            <a href="/pages/product.php?slug=<?php echo urlencode($slug); ?>">
                                <?php echo htmlspecialchars($p['title']); ?>
                            </a>
                        </h3>
                        <p><?php echo htmlspecialchars($p['description'] ?? ''); ?></p>
                        <span class="visits"><?php echo (int)$cnt; ?> visits</span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

<style>
    /* Container */
    .products-container {
        width: 90%;
        max-width: 1200px;
        margin: 30px auto 60px;
    }

    /* Grid layout */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 22px;
    }

    /* Card styling */
    .product-card {
        background: #fff;
        padding: 22px;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        border: 1px solid #eee;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(78,67,118,0.2);
        border-color: #dcd6f3;
    }

    .product-card h3 {
        margin: 0 0 10px;
        font-size: 1.25rem;
        color: #4e4376;
    }

    .product-card a {
        text-decoration: none;
        color: #4e4376;
    }
    .product-card a:hover {
        text-decoration: underline;
    }

    .product-card p {
        color: #555;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .product-card .visits {
        display: block;
        margin-top: 10px;
        font-weight: 600;
        color: #4e4376;
    }
</style>
