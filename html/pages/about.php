<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="page-wrapper">

    <!-- Modern Hero Section -->
    <div class="hero modern-hero">
        <div class="hero-content">
            <h1>About TechPro Solutions</h1>
            <p>Your Trusted Technology Partner</p>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="content-card">
        <div class="content-section">
            <h2>Our Story</h2>
            <p>Founded in 2010, TechPro Solutions has grown from a small startup to a leading technology solutions provider.
                We're passionate about helping businesses leverage technology to achieve their goals and stay competitive in
                today's digital landscape.</p>
        </div>

        <div class="content-section">
            <h2>Our Mission</h2>
            <p>To deliver innovative, reliable, and scalable technology solutions that drive business growth and digital
                transformation for our clients.</p>
        </div>

        <div class="content-section">
            <h2>Our Team</h2>
            <p>Our team consists of experienced developers, designers, and technology consultants who are committed to
                excellence and continuous learning. We bring diverse expertise and perspectives to every project we undertake.
            </p>
        </div>

        <div class="content-section">
            <h2>Core Values</h2>
            <ul class="core-values">
                <li>Innovation and Excellence</li>
                <li>Customer-Centric Approach</li>
                <li>Integrity and Transparency</li>
                <li>Continuous Learning</li>
                <li>Collaborative Spirit</li>
            </ul>
        </div>
    </div>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>


<style>
/* Main Content Card */
.content-card {
    background: #fff;
    width: 90%;
    max-width: 900px;
    margin: 20px auto 0;
    padding: 0 50px;
    border-radius: 16px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.08);
    animation: fadeInUp 0.5s ease;
}

/* Section Titles */
.content-section h2 {
    color: #4e4376;
    font-size: 1.6rem;
    margin-bottom: 0.5rem;
    border-left: 4px solid #ffd700;
    padding-left: 10px;
}

/* Section Text */
.content-section p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 1.7rem;
}

/* Core Values */
.core-values {
    list-style: none;
    padding-left: 0;
    margin-top: 1rem;
}

.core-values li {
    padding: 8px 0;
    font-size: 1rem;
    color: #444;
}

.core-values li:last-child {
    border-bottom: none;
}

/* Fade-in Up Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .modern-hero h1 {
        font-size: 2.2rem;
    }

    .modern-hero p {
        font-size: 1rem;
    }

    .content-card {
        padding: 1.6rem;
    }

    .content-section h2 {
        font-size: 1.4rem;
    }
}
</style>
