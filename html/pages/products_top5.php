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

$counts = [];
if (!empty($_COOKIE['product_counts'])) {
    $counts = json_decode($_COOKIE['product_counts'], true) ?: [];
}

arsort($counts);
$top = array_slice($counts, 0, 5, true);

?>
<div class="page-wrapper">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
    <div class="content">
        <h2>Top 5 Most Visited Products</h2>
        <?php if (empty($top)): ?>
            <p>No product visits recorded yet.</p>
        <?php else: ?>
            <ol>
                <?php foreach ($top as $id => $cnt): ?>
                    <li><a href="/<?php echo "pages/$id.php"; ?>"><?php echo htmlspecialchars($map[$id] ?? $id); ?></a> — <?php echo (int)$cnt; ?> visits</li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</div>


