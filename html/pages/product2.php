<?php
$productId = 'product2';
$productName = 'Cloud Migration Service';
$recent = [];
if (!empty($_COOKIE['recent_products'])) {
    $recent = json_decode($_COOKIE['recent_products'], true) ?: [];
}
$recent = array_values(array_filter($recent, function($p) use ($productId) { return $p !== $productId; }));
array_unshift($recent, $productId);
$recent = array_slice($recent, 0, 5);
setcookie('recent_products', json_encode($recent), time()+60*60*24*30, '/');
$counts = [];
if (!empty($_COOKIE['product_counts'])) {
    $counts = json_decode($_COOKIE['product_counts'], true) ?: [];
}
if (!isset($counts[$productId])) $counts[$productId] = 0;
$counts[$productId] += 1;
setcookie('product_counts', json_encode($counts), time()+60*60*24*365, '/');

include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>
<div class="hero">
    <h1><?php echo htmlspecialchars($productName); ?></h1>
    <p>Smooth, secure migration to the cloud.</p>
    <img src="/assets/images/product2.svg" alt="<?php echo htmlspecialchars($productName); ?>" style="max-width:100%; margin-top:18px; border-radius:8px;">
</div>
<div class="content">
    <h2>Overview</h2>
    <p>We help companies migrate applications and data to the cloud with minimal downtime and risk.</p>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
