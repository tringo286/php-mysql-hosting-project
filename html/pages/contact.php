<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="hero">
    <h1>Contact Us</h1>
    <p>Get in Touch with Our Team</p>
</div>

<div class="contact-container">

    <!-- Contact Information Card -->
    <div class="contact-card">
        <h2>Contact Information</h2>
        <div class="contact-info">
            <?php
            $contactFile = $_SERVER['DOCUMENT_ROOT'] . '/data/contacts.txt';
            if (file_exists($contactFile)) {
                $contacts = file_get_contents($contactFile);
                $lines = explode("\n", $contacts);

                echo "<ul class='contact-list'>";
                foreach ($lines as $line) {
                    if (trim($line) !== "") {
                        echo "<li>" . htmlspecialchars($line) . "</li>";
                    }
                }
                echo "</ul>";

            } else {
                echo "<p>Contact information is currently unavailable. Please try again later.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Contact Form Card -->
    <div class="form-card">
        <h2>Send us a Message</h2>

        <form action="#" method="post">
            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn-submit">Send Message</button>
        </form>
    </div>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>


<style>
/* Layout Container */
.contact-container {
    width: 90%;
    max-width: 1100px;
    margin: 2.5rem auto 4rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

/* Cards (shared style) */
.contact-card,
.form-card {
    background: #fff;
    padding: 2rem;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
}

/* Section Titles */
.contact-card h2,
.form-card h2 {
    color: #4e4376;
    margin-bottom: 1rem;
}

/* Contact Info */
.contact-info p {
    color: #555;
    line-height: 1.7;
}

/* Styled Contact Info List */
.contact-list {
    list-style: none;
    padding-left: 0;
    margin-top: 1rem;
}

.contact-list li {
    padding: 8px 0;
    border-bottom: 1px solid #e0e0e0;
    font-size: 1rem;
    color: #444;
}

.contact-list li:last-child {
    border-bottom: none;
}

/* Inputs */
.input-group {
    margin-bottom: 1.2rem;
}

.input-group label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.input-group input,
.input-group textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    outline: none;
    transition: 0.25s ease;
}

/* Modern focus effect */
.input-group input:focus,
.input-group textarea:focus {
    border-color: #4e4376;
    box-shadow: 0 0 6px rgba(78, 67, 118, 0.25);
}

/* Submit Button */
.btn-submit {
    background: #4e4376;
    color: #fff;
    padding: 12px 24px;
    font-size: 1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.25s;
    width: 100%;
}

.btn-submit:hover {
    background: #2b5876;
}

/* Responsive */
@media (max-width: 900px) {
    .contact-container {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {
    .contact-hero h1 {
        font-size: 2rem;
    }
}
</style>
