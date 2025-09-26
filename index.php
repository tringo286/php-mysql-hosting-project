<?php
// Simple PHP + MySQL demo app
// Reads connection info from environment variables: DB_HOST, DB_USER, DB_PASS, DB_NAME (optional DB_PORT)
$dbHost = (string) (getenv('DB_HOST') ?: 'localhost');
$dbUser = (string) (getenv('DB_USER') ?: 'root');
$dbPass = (string) (getenv('DB_PASS') ?: '');
$dbName = (string) (getenv('DB_NAME') ?: '');

// Ensure port is an integer. Prefer DB_PORT env var, then PHP ini, then 3306.
$envPort = getenv('DB_PORT');
if ($envPort !== false && $envPort !== '') {
    $dbPort = (int) $envPort;
} else {
    $iniPort = ini_get('mysqli.default_port');
    $dbPort = ($iniPort !== false && $iniPort !== '') ? (int) $iniPort : 3306;
}

$conn = null;
try {
    // Wrap in try/catch to avoid fatal TypeError (e.g. if a string is accidentally used with numeric ops).
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);
} catch (TypeError $e) {
    $conn = null; // will be handled below
    $connectError = 'TypeError during mysqli construction: ' . $e->getMessage();
}

function h($s)
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

$connected = true;
if ($conn === null) {
    $connected = false;
    if (!isset($connectError)) {
        $connectError = 'Could not create mysqli connection (null)';
    }
} else {
    if ($conn->connect_error) {
        $connected = false;
        $connectError = $conn->connect_error;
    }
}

// Handle actions: create table, insert row
$message = '';
if ($connected && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'create_table') {
        $sql = "CREATE TABLE IF NOT EXISTS visits (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(100) NOT NULL,
                        message TEXT NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        if ($conn->query($sql) === TRUE) {
            $message = 'Table `visits` created or already exists.';
        } else {
            $message = 'Error creating table: ' . $conn->error;
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $name = trim((string) ($_POST['name'] ?? ''));
        $msg = trim((string) ($_POST['message'] ?? ''));
        if ($name === '' || $msg === '') {
            $message = 'Please provide both name and message.';
        } else {
            $stmt = $conn->prepare('INSERT INTO visits (name, message) VALUES (?, ?)');
            if ($stmt) {
                $stmt->bind_param('ss', $name, $msg);
                if ($stmt->execute()) {
                    $message = 'Entry added.';
                } else {
                    $message = 'Insert failed: ' . $stmt->error;
                }
                $stmt->close();
            } else {
                $message = 'Prepare failed: ' . $conn->error;
            }
        }
    }
}

// Fetch rows if table exists
$rows = [];
if ($connected) {
    $res = $conn->query("SHOW TABLES LIKE 'visits'");
    if ($res && $res->num_rows > 0) {
        $r = $conn->query('SELECT id, name, message, created_at FROM visits ORDER BY id DESC LIMIT 100');
        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $rows[] = $row;
            }
            $r->free();
        }
        $res->free();
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>PHP + MySQL demo</title>
    <style>
        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial;
            max-width: 900px;
            margin: 28px auto;
            padding: 0 16px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .card {
            border: 1px solid #e6e6e6;
            padding: 14px;
            border-radius: 8px;
            margin-top: 12px
        }

        form {
            display: flex;
            gap: 8px;
            flex-wrap: wrap
        }

        input[type=text],
        textarea {
            width: 100%;
            padding: 8px;
        }

        .row {
            display: flex;
            gap: 8px
        }

        table {
            width: 100%;
            border-collapse: collapse
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px
        }

        small.note {
            color: #666
        }
    </style>
</head>

<body>
    <header>
        <h1>PHP + MySQL demo</h1>
        <div>
            <small class="note">Env: DB_HOST=<?= h($dbHost) ?> DB_NAME=<?= h($dbName) ?></small>
        </div>
    </header>

    <div class="card">
        <h2>Connection</h2>
        <p>
            <?php if ($connected): ?>
                <strong style="color:green">Connected to MySQL server at <?= h($dbHost) ?>.</strong>
            <?php else: ?>
                <strong style="color:red">Not connected.</strong> <?= isset($connectError) ? h($connectError) : '' ?>
            <?php endif; ?>
        </p>
        <?php if ($message): ?>
            <p><em><?= h($message) ?></em></p><?php endif; ?>
        <form method="post">
            <input type="hidden" name="action" value="create_table">
            <button type="submit">Create table `visits`</button>
        </form>
    </div>

    <div class="card">
        <h2>Add an entry</h2>
        <form method="post">
            <input type="hidden" name="action" value="add">
            <div>
                <label>Name</label>
                <input type="text" name="name" placeholder="Your name">
            </div>
            <div>
                <label>Message</label>
                <textarea name="message" rows="3" placeholder="A short message..."></textarea>
            </div>
            <div>
                <button type="submit">Add</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h2>Recent entries</h2>
        <?php if (count($rows) === 0): ?>
            <p>No entries yet. Use "Create table" first, then add an entry.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Message</th>
                        <th>At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r): ?>
                        <tr>
                            <td><?= h($r['id']) ?></td>
                            <td><?= h($r['name']) ?></td>
                            <td><?= h($r['message']) ?></td>
                            <td><?= h($r['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>

</html>