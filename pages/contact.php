<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

<div class="hero">
    <h1>Contact Us</h1>
    <p>Get in Touch with Our Team</p>
</div>

<div class="content">
    <div class="contact-info">
        <?php
        // Read and display contact information from contacts.txt
        $contactFile = $_SERVER['DOCUMENT_ROOT'] . '/data/contacts.txt';
        if (file_exists($contactFile)) {
            $contacts = file_get_contents($contactFile);
            // Convert plain text to HTML (preserve line breaks)
            echo nl2br(htmlspecialchars($contacts));
        } else {
            echo "<p>Contact information is currently unavailable. Please try again later.</p>";
        }
        ?>
    </div>

    <div style="margin-top: 2rem;">
        <h2>Send us a Message</h2>
        <form action="#" method="post" style="max-width: 500px;">
            <div style="margin-bottom: 1rem;">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required style="width: 100%; padding: 8px;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 8px;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="message">Message:</label><br>
                <textarea id="message" name="message" rows="5" required style="width: 100%; padding: 8px;"></textarea>
            </div>

            <button type="submit"
                style="background-color: #333; color: white; padding: 10px 20px; border: none; cursor: pointer;">Send
                Message</button>
        </form>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>