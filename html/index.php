<?php include __DIR__ . '/includes/header.php'; ?>

<div class="page-wrapper">
    <div class="hero">
        <h1>Welcome to TechPro Solutions</h1>
        <p>Innovative Technology Solutions for Tomorrow's Challenges</p>
    </div>

    <div class="content">
        <h2>Why Choose TechPro Solutions?</h2>
        <p>We're a leading technology solutions provider specializing in custom software development, cloud solutions, and
            digital transformation. With over a decade of experience, we help businesses thrive in the digital age.</p>

        <div class="features">
            <div class="feature">
                <h3>Innovation</h3>
                <p>Cutting-edge solutions using the latest technologies</p>
            </div>
            <div class="feature">
                <h3>Expertise</h3>
                <p>Team of skilled professionals with deep industry knowledge</p>
            </div>
            <div class="feature">
                <h3>Results</h3>
                <p>Proven track record of successful project deliveries</p>
            </div>
            <div class="feature">
                <h3>Reliability</h3>
                <p>Dependable solutions and ongoing support for your business</p>
            </div>
            <div class="feature">
                <h3>Scalability</h3>
                <p>Solutions that grow with your business needs</p>
            </div>
            <div class="feature">
                <h3>Customer Focus</h3>
                <p>Prioritizing client success with tailored solutions</p>
            </div>
        </div> 
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

<style>
    .features {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 per row on full screen */
    gap: 30px; /* more spacing so items look bigger */
    padding: 20px 0;
}

.feature {
    text-align: center;
    padding: 2rem; /* bigger boxes */
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #fff;
    box-sizing: border-box;
    min-height: 220px; /* optional: makes them more uniform */
}

.feature h3 {
    margin-bottom: 0.75rem;
    font-size: 1.3rem;
}

.feature p {
    color: #666;
    font-size: 1rem;
    color: #666;
}

/* Responsive – 2 per row on tablets */
@media (max-width: 992px) {
    .features {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Responsive – 1 per row on mobile */
@media (max-width: 600px) {
    .features {
        grid-template-columns: 1fr;
    }
}
</style>
