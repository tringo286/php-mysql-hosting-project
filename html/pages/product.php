<?php
require_once __DIR__ . '/../db.php';

// Get product slug from query string
$slug = $_GET['slug'] ?? null;

if (!$slug) {
    die("Product not specified.");
}

// Fetch product from DB
$stmt = $mysqli->prepare("SELECT id, slug, title, description, details FROM products WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

// Manage recent visits cookie (last 5)
$recent = [];
if (!empty($_COOKIE['recent_products'])) {
    $recent = json_decode($_COOKIE['recent_products'], true) ?: [];
}
$recent = array_values(array_filter($recent, fn($p) => $p !== $product['slug']));
array_unshift($recent, $product['slug']);
$recent = array_slice($recent, 0, 5);
setcookie('recent_products', json_encode($recent), time()+60*60*24*30, '/');

// Manage visit counts cookie
if ($slug) {
    // Get existing counts
    $counts = [];
    if (!empty($_COOKIE['product_counts'])) {
        $counts = json_decode($_COOKIE['product_counts'], true) ?: [];
    }

    // Increment the count for this product
    if (!isset($counts[$slug])) {
        $counts[$slug] = 1;
    } else {
        $counts[$slug]++;
    }

    // Save the updated counts back to the cookie
    setcookie('product_counts', json_encode($counts), [
        'expires' => time() + 30*24*60*60,
        'path' => '/',
        'httponly' => false,
    ]);
}

include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<div class="hero product-hero">
    <a class="back-button" href="/pages/products.php">&#8592;</a>
    <h1><?php echo htmlspecialchars($product['title']); ?></h1>
    <p><?php echo htmlspecialchars($product['description']); ?></p>    
</div>

<div class="content">
    <?php if (!empty($product['details'])): ?>
        <h2>Details</h2>
        <p><?php echo nl2br(htmlspecialchars($product['details'])); ?></p>
    <?php endif; ?>
</div>

<style>
    .product-hero {
        position: relative;
        padding: 40px 20px; 
    }
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
