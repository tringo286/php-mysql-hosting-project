<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="hero">
    <h1>Our Products & Services</h1>
    <p>Comprehensive Technology Solutions for Your Business</p>
</div>

<div class="content">
    <h2>All Products & Services</h2>
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:16px; margin-top:18px;">
        <div class="product-item"><h3><a href="/pages/product1.php">AI Analytics Platform</a></h3><p>Real-time dashboards and predictive analytics.</p></div>
        <div class="product-item"><h3><a href="/pages/product2.php">Cloud Migration Service</a></h3><p>Smooth, secure cloud migration.</p></div>
        <div class="product-item"><h3><a href="/pages/product3.php">Mobile App Development</a></h3><p>iOS & Android native and cross-platform apps.</p></div>
        <div class="product-item"><h3><a href="/pages/product4.php">Enterprise Software</a></h3><p>Scalable business-critical systems.</p></div>
        <div class="product-item"><h3><a href="/pages/product5.php">DevOps & SRE</a></h3><p>CI/CD, automation, and reliability engineering.</p></div>
        <div class="product-item"><h3><a href="/pages/product6.php">Cybersecurity Services</a></h3><p>Security assessments and monitoring.</p></div>
        <div class="product-item"><h3><a href="/pages/product7.php">UX/UI Design</a></h3><p>User research and polished interfaces.</p></div>
        <div class="product-item"><h3><a href="/pages/product8.php">Data Engineering</a></h3><p>ETL, data lakes, and pipelines.</p></div>
        <div class="product-item"><h3><a href="/pages/product9.php">AI Chatbots</a></h3><p>Conversational bots for support and sales.</p></div>
        <div class="product-item"><h3><a href="/pages/product10.php">Custom Integrations</a></h3><p>APIs and connector development.</p></div>
    </div>

    <div style="margin-top: 22px; display:flex; gap:12px;">
        <a href="/pages/products_recent.php" style="text-decoration:none; padding:8px 12px; background:#fff; border:1px solid #ddd; border-radius:6px;">Recently Visited</a>
        <a href="/pages/products_top5.php" style="text-decoration:none; padding:8px 12px; background:#fff; border:1px solid #ddd; border-radius:6px;">Top 5 Most Visited</a>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>