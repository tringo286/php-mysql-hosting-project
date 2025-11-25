<?php

$map = [
    'product1' => 'AI Analytics Platform',
    'product2' => 'Cloud Migration Service',
    'product3' => 'Mobile App Development',
    'product4' => 'Enterprise Software',
    'product5' => 'DevOps & SRE',
    'product6' => 'Cybersecurity Services',
    'product7' => 'UX/UI Design',
    'product8' => 'Data Engineering',
    'product9' => 'AI Chatbots',
    'product10' => 'Custom Integrations'
];

$recent = [];
if (!empty($_COOKIE['recent_products'])) {
    $recent = json_decode($_COOKIE['recent_products'], true) ?: [];
}

?>
<div class="page-wrapper">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
    <div class="content">
        <h2>Recently Visited Products</h2>
        <?php if (empty($recent)): ?>
            <p>No recently visited products yet.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($recent as $id): ?>
                    <li><a href="/<?php echo "pages/$id.php"; ?>"><?php echo htmlspecialchars($map[$id] ?? $id); ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</div>


