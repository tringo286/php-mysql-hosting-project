<div class="page-wrapper">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
    
    <div class="hero">
        <h1>Our Products & Services</h1>
        <p>Innovative technology solutions built for real business impact</p>
    </div>

    <div class="products-container">
        
        <div class="products-grid">
            <div class="product-card"><h3><a href="/pages/product1.php">AI Analytics Platform</a></h3><p>Real-time dashboards and predictive analytics.</p></div>
            <div class="product-card"><h3><a href="/pages/product2.php">Cloud Migration Service</a></h3><p>Smooth, secure cloud migration.</p></div>
            <div class="product-card"><h3><a href="/pages/product3.php">Mobile App Development</a></h3><p>iOS & Android native and cross-platform apps.</p></div>
            <div class="product-card"><h3><a href="/pages/product4.php">Enterprise Software</a></h3><p>Scalable business-critical systems.</p></div>
            <div class="product-card"><h3><a href="/pages/product5.php">DevOps & SRE</a></h3><p>CI/CD, automation, and reliability engineering.</p></div>
            <div class="product-card"><h3><a href="/pages/product6.php">Cybersecurity Services</a></h3><p>Security assessments and monitoring.</p></div>
            <div class="product-card"><h3><a href="/pages/product7.php">UX/UI Design</a></h3><p>User research and polished interfaces.</p></div>
            <div class="product-card"><h3><a href="/pages/product8.php">Data Engineering</a></h3><p>ETL, data lakes, and pipelines.</p></div>
            <div class="product-card"><h3><a href="/pages/product9.php">AI Chatbots</a></h3><p>Conversational bots for support and sales.</p></div>
            <div class="product-card"><h3><a href="/pages/product10.php">Custom Integrations</a></h3><p>APIs and connector development.</p></div>
        </div>

        <div class="product-actions">
            <a class="action-btn" href="/pages/products_recent.php">Recently Visited</a>
            <a class="action-btn" href="/pages/products_top5.php">Top 5 Most Visited</a>
        </div>

    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</div>


<style>

.products-container {
    width: 90%;
    max-width: 1200px;
    margin: 40px auto 60px;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 22px;
}

.product-card {
    background: #fff;
    padding: 22px;
    border-radius: 14px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    transition: 0.25s ease;
    border: 1px solid #eee;
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

.product-actions {
    margin-top: 32px;
    display: flex;
    gap: 14px;
    justify-content: center;
}

.action-btn {
    text-decoration: none;
    padding: 10px 16px;
    background: #4e4376;
    color: #fff;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.25s ease;
}

.action-btn:hover {
    background: #2b5876;
    transform: translateY(-3px);
}

@media (max-width: 768px) {
    .hero-modern h1 {
        font-size: 2.2rem;
    }
    .hero-modern p {
        font-size: 1rem;
    }
}
</style>
