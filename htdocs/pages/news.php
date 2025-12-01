<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="hero">
    <h1>Company News</h1>
    <p>Stay Updated with TechPro Solutions</p>
</div>

<div class="content">
    <div class="news-wrapper">

        <div class="news-item">
            <h3>TechPro Solutions Launches New AI-Powered Analytics Platform</h3>
            <p><small>Posted on <?php echo date('F d, Y', strtotime('-2 days')); ?></small></p>
            <p>We're excited to announce the launch of our new AI-powered analytics platform, designed to help businesses
                make data-driven decisions more effectively. This innovative solution combines advanced machine learning
                algorithms with intuitive visualization tools to transform complex data into actionable insights.</p>
            <a href="#">Read more →</a>
        </div>

        <div class="news-item">
            <h3>TechPro Solutions Named Top Tech Innovator 2025</h3>
            <p><small>Posted on <?php echo date('F d, Y', strtotime('-2 weeks')); ?></small></p>
            <p>We're proud to announce that TechPro Solutions has been recognized as a Top Tech Innovator for 2025 by Tech
                Industry Magazine. This award recognizes our commitment to innovation and excellence in delivering
                cutting-edge technology solutions.</p>
            <a href="#">Read more →</a>
        </div>

        <div class="news-item">
            <h3>Expanding Our Global Presence</h3>
            <p><small>Posted on <?php echo date('F d, Y', strtotime('-1 month')); ?></small></p>
            <p>TechPro Solutions is excited to announce the opening of our new office in Singapore, expanding our presence
                in the Asia-Pacific region. This strategic move will help us better serve our growing international client
                base.</p>
            <a href="#">Read more →</a>
        </div>

    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

<style>
    /* News List Layout (3 per row like index features) */
    .news-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 25px;
        margin-top: 2rem;
    }

    /* Individual News Items styled like 'feature' boxes */
    .news-item {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 1.5rem;
        box-sizing: border-box;
    }

    .news-item h3 {
        margin-bottom: 0.5rem;
        color: #4e4376;
    }

    .news-item small {
        color: #999;
    }

    .news-item p {
        color: #555;
        line-height: 1.6;
    }

    .news-item a {
        color: #2b5876;
        text-decoration: none;
        font-weight: 600;
    }

    .news-item a:hover {
        text-decoration: underline;
    }
</style>
