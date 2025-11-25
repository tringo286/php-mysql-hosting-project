<?php
session_start();

include __DIR__ . '/../db.php';

// Get local users
$localUsers = [];
$sql = "SELECT id, name, email, role, status, joined_date FROM users ORDER BY id ASC";
$result = $mysqli->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $localUsers[] = $row;
    }
}

// Fetch partner users with curl
function fetch_remote_users($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // for testing HTTPS
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        return ["error" => "CURL Error: $error"];
    }

    $data = json_decode($response, true);

    // Check if 'users' array exists
    if (!isset($data['users']) || !is_array($data['users'])) {
        return ["error" => "Invalid response: 'users' array not found"];
    }

    return $data['users']; // return only the users array
}

// Partner company links
$partnerA_url = "https://lambertnguyen.cloud/api/users"; 
$partnerB_url = "https://anukrithimyadala.42web.io/users_api.php"; 

// Fetch users remotely
$partnerA_users = fetch_remote_users($partnerA_url);
$partnerB_users = [
    ['name' => 'May Shim', 'role' => 'Marketing Designer'],
    ['name' => 'John Wang', 'role' => 'Product Engineer'],
    ['name' => 'Emily Stone', 'role' => 'Software Engineer'],
    ['name' => 'Sales Associate', 'role' => 'Sales Associate'], // you can fix the name if needed
];

?>

<?php include('../includes/header.php'); ?>

<div class="page-container">
    <div class="admin-container">
        <h2>TechPro Users</h2>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($localUsers as $u): ?>
                        <tr>
                            <td><?= htmlspecialchars($u['id']) ?></td>
                            <td><?= htmlspecialchars($u['name']) ?></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><?= htmlspecialchars($u['role']) ?></td>
                            <td><?= htmlspecialchars($u['status']) ?></td>
                            <td><?= htmlspecialchars($u['joined_date']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h2>Lambert Nguyen Company Users</h2>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($partnerA_users['error'])): ?>
                        <tr><td colspan="6" style="color:red;"><?= htmlspecialchars($partnerA_users['error']); ?></td></tr>
                    <?php else: 
                        $counterA = 1;
                        foreach ($partnerA_users as $u): ?>
                            <tr>
                                <td><?= $counterA++ ?></td>
                                <td><?= htmlspecialchars($u['name'] ?? '') ?></td>
                                <td><?= htmlspecialchars($u['email'] ?? '') ?></td>
                                <td><?= htmlspecialchars($u['role'] ?? '') ?></td>
                                <td><?= htmlspecialchars($u['status'] ?? '') ?></td>
                                <td><?= htmlspecialchars($u['join_date'] ?? '') ?></td>
                            </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
   
        <h2>Purestle Beauty Users</h2>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th><th>Name</th><th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $counter = 1;
                    foreach ($partnerB_users as $u): ?>
                        <tr>
                            <td><?= $counter++ ?></td>
                            <td><?= htmlspecialchars($u['name']) ?></td>
                            <td><?= htmlspecialchars($u['role']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>

<style>
.page-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    flex-direction: column;
    gap: 40px;
}

.admin-container {
    width: 100%;
    max-width: 1200px;
    background: #fff;
    padding: 30px 40px;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

h2 {
    color: #4e4376;
    margin-bottom: 15px;
    font-weight: 700;
    font-size: 1.8rem;
}

.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    min-width: 600px;
    margin-bottom: 30px;
}

thead th {
    background: #4e4376;
    color: #fff;
    padding: 12px 15px;
    text-transform: uppercase;
}

td {
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
}

tr:hover {
    background: #f7f7fa;
}

/* Mobile */
@media (max-width: 600px) {
    .admin-container {
        padding: 20px;
    }
    table {
        min-width: 400px;
    }
}
</style>

<?php $mysqli->close(); ?>
