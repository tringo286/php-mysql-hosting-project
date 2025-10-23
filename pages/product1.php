<?php
// Product 1
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

$productId = 'product1';
$productName = 'AI Analytics Platform';

// Manage recent visits cookie (last 5)
$recent = [];
if (!empty($_COOKIE['recent_products'])) {
    $recent = json_decode($_COOKIE['recent_products'], true) ?: [];
}
// remove if exists
$recent = array_values(array_filter($recent, function($p) use ($productId) { return $p !== $productId; }));
array_unshift($recent, $productId);
$recent = array_slice($recent, 0, 5);
setcookie('recent_products', json_encode($recent), time()+60*60*24*30, '/');

// Manage visit counts cookie
$counts = [];
if (!empty($_COOKIE['product_counts'])) {
    $counts = json_decode($_COOKIE['product_counts'], true) ?: [];
}
if (!isset($counts[$productId])) $counts[$productId] = 0;
$counts[$productId] += 1;
setcookie('product_counts', json_encode($counts), time()+60*60*24*365, '/');
?>

<div class="hero">
    <h1><?php echo htmlspecialchars($productName); ?></h1>
    <p>Powerful analytics driven by machine learning.</p>
    <img src="/assets/images/product1.svg" alt="<?php echo htmlspecialchars($productName); ?>" style="max-width:100%; margin-top:18px; border-radius:8px;">
</div>

<div class="content">
    <h2>Overview</h2>
    <p>Our AI Analytics Platform helps organizations transform raw data into actionable insights using
        state-of-the-art machine learning models and beautiful visualizations.</p>

    <h3>Features</h3>
    <ul>
        <li>Real-time dashboards</li>
        <li>Predictive analytics</li>
        <li>Customizable reports</li>
    </ul>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
