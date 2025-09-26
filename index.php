<!DOCTYPE html>
<html>

<head>
    <title>PHP Demo</title>
</head>

<body>
    <?php
    $name = "Tringo"; // Change this to your name
    echo "<h1>Hello, this is " . htmlspecialchars($name) . "'s PHP site!</h1>";
    echo "<p>Current date and time: " . date('Y-m-d H:i:s') . "</p>";
    ?>
</body>

</html>