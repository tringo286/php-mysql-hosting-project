<?php
require_once __DIR__ . '/../db.php';

// Get product slug
$slug = $_GET['slug'] ?? null;
if (!$slug) die("Product not specified.");

// Fetch product from DB including extra_info and specs
$stmt = $mysqli->prepare("
    SELECT id, slug, title, description, details, extra_info, specs
    FROM products 
    WHERE slug = ?
");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
if (!$product) die("Product not found.");

// Automatically detect local image
$imageFolder = $_SERVER['DOCUMENT_ROOT'] . "/assets/images/";
$imageUrl = null;
foreach (['jpg','jpeg','png','webp'] as $ext) {
    $file = $imageFolder . $product['slug'] . "." . $ext;
    if (file_exists($file)) {
        $imageUrl = "/assets/images/" . $product['slug'] . "." . $ext;
        break;
    }
}

// Recent visits cookie
$recent = (!empty($_COOKIE['recent_products'])) ? json_decode($_COOKIE['recent_products'], true) : [];
$recent = array_values(array_filter($recent, fn($p) => $p !== $product['slug']));
array_unshift($recent, $product['slug']);
$recent = array_slice($recent, 0, 5);
setcookie('recent_products', json_encode($recent), time()+60*60*24*30, '/');

// Visit counts cookie
$counts = (!empty($_COOKIE['product_counts'])) ? json_decode($_COOKIE['product_counts'], true) : [];
$counts[$slug] = ($counts[$slug] ?? 0) + 1;
setcookie('product_counts', json_encode($counts), [
    'expires' => time()+30*24*60*60,
    'path' => '/',
    'httponly' => false
]);

include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<!-- ORIGINAL HERO SECTION -->
<div class="hero product-hero">
    <a class="back-button" href="/pages/products.php">&#8592;</a>
    <h1><?php echo htmlspecialchars($product['title']); ?></h1>
    <p><?php echo htmlspecialchars($product['description']); ?></p>    
</div>

<!-- IMAGE BELOW HERO -->
<?php if ($imageUrl): ?>
<div class="product-image-container">
    <img src="<?php echo $imageUrl; ?>" alt="<?php echo htmlspecialchars($product['title']); ?>">
</div>
<?php endif; ?>

<!-- DETAILS AND EXTRA CONTENT -->
<div class="content">

    <?php if (!empty($product['details'])): ?>
        <h2>Description</h2>
        <p><?php echo nl2br(htmlspecialchars($product['details'])); ?></p>
    <?php endif; ?>

    <!-- NEW: Extra Info from DB -->
    <?php if (!empty($product['extra_info'])): ?>
    <div class="extra-section">
        <h2>More Information</h2>
        <p><?php echo nl2br(htmlspecialchars($product['extra_info'])); ?></p>
    </div>
    <?php endif; ?>

    <!-- NEW: Specs from DB -->
    <?php if (!empty($product['specs'])): ?>
    <div class="extra-section">
        <h2>Specifications</h2>
        <ul>
            <?php
            $specs = explode("\n", $product['specs']);
            foreach ($specs as $spec) {
                if(trim($spec)) echo "<li>" . htmlspecialchars($spec) . "</li>";
            }
            ?>
        </ul>
    </div>
    <?php endif; ?>

</div>

<style>
.product-hero {
    position: relative;
    padding: 40px 20px;
}

.product-image-container {
    width: 100%;
    max-width: 900px;
    margin: 20px auto;
    border-radius: 10px;
    overflow: hidden;
}

.product-image-container img {
    width: 100%;
    display: block;
    border-radius: 10px;
}

.content {
    padding: 40px 20px;
    max-width: 900px;
    margin: auto;
}

.extra-section {
    margin-top: 40px;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
    border: 1px solid #ddd;
}
.extra-section ul {
    padding-left: 20px;
}
.extra-section li {
    margin-bottom: 8px;
}
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
