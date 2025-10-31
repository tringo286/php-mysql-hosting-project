<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';

// Function to get users from a remote API using CURL
function getUsersFromAPI($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200 && $response) {
        $data = json_decode($response, true);
        // Normalize common shapes: {data: [...]}, {users: [...]}, or raw list
        if (is_array($data)) {
            if (isset($data['data']) && is_array($data['data'])) return $data['data'];
            if (isset($data['users']) && is_array($data['users'])) return $data['users'];
            // If it's an associative with numeric keys, try to return as list
            $allNumeric = true;
            foreach ($data as $k => $v) { if (!is_int($k)) { $allNumeric = false; break; } }
            if ($allNumeric) return $data;
        }
        return [];
    }
    return [];
}

// --- Company A (Local Users) ---
$localUsers = [];
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$baseUrl = $scheme . '://' . $_SERVER['HTTP_HOST'];

// Prefer a JSON API for local users
$localUsers = getUsersFromAPI($baseUrl . '/api/local_users.php');

// We now use the local JSON endpoint `api/local_users.php` for Company A and do not attempt a local DB here.

// --- Company B ---
$companyB_users = getUsersFromAPI('https://lambertnguyen.cloud/api/users');

// --- Company C ---
$companyC_users = getUsersFromAPI('https://anukrithimyadala.42web.io/users_api.php');
// If remote Company C is unreachable, fall back to a local sample endpoint so the page always shows Company C
if (empty($companyC_users)) {
    $companyC_users = getUsersFromAPI($baseUrl . '/api/company_c_fallback.php');
}

// Determine simple health/status for each source
$endpointStatus['local'] = !empty($localUsers) ? 'ok' : 'empty';
$endpointStatus['company_b'] = !empty($companyB_users) ? 'ok' : 'unreachable';
$endpointStatus['company_c'] = !empty($companyC_users) ? 'ok' : 'unreachable';

// Normalize/sanitize user lists to ensure we only iterate arrays of associative items
function normalizeUsers($raw) {
    if (!is_array($raw)) return [];
    // If it's already a numerically indexed list, filter to keep only arrays
    $keys = array_keys($raw);
    $isIndexed = ($keys === range(0, count($raw) - 1));
    if ($isIndexed) {
        $out = [];
        foreach ($raw as $item) {
            if (is_array($item)) {
                $out[] = $item;
            }
        }
        return $out;
    }
    // If associative, try to find a nested list value
    foreach ($raw as $val) {
        if (is_array($val)) {
            $innerKeys = array_keys($val);
            if ($innerKeys === range(0, count($val) - 1)) return $val; // nested list
        }
    }
    return [];
}

$localUsers = normalizeUsers($localUsers);
$companyB_users = normalizeUsers($companyB_users);
$companyC_users = normalizeUsers($companyC_users);
?>

<div class="content">
    <h1>Combined List of Users</h1>

    <h2 class="section-title">Company A Users (Local) <small style="font-size:0.8rem;color:#666;">Status: <?php echo $endpointStatus['local']; ?></small></h2>
    <table class="users-table">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th></tr>
        </thead>
        <tbody>
            <?php foreach ($localUsers as $idx => $user): ?>
                <?php
                    if (!is_array($user)) continue;
                    $uid = $user['id'] ?? ($idx+1);
                    $uname = $user['name'] ?? ($user['full_name'] ?? '');
                    $uemail = $user['email'] ?? '';
                ?>
                <tr>
                    <td><?= htmlspecialchars((string)$uid) ?></td>
                    <td><?= htmlspecialchars((string)$uname) ?></td>
                    <td><?= htmlspecialchars((string)$uemail) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="section-title">Company B Users <small style="font-size:0.8rem;color:#666;">Status: <?php echo $endpointStatus['company_b']; ?></small></h2>
    <table class="users-table">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th></tr>
        </thead>
        <tbody>
                <?php foreach ($companyB_users as $idx => $user): ?>
                <?php
                    if (!is_array($user)) continue;
                    $uid = $user['id'] ?? ($idx+1);
                    $uname = $user['name'] ?? ($user['full_name'] ?? '');
                    $uemail = $user['email'] ?? '';
                ?>
                <tr>
                    <td><?= htmlspecialchars((string)$uid) ?></td>
                    <td><?= htmlspecialchars((string)$uname) ?></td>
                    <td><?= htmlspecialchars((string)$uemail) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="section-title">Company C Users <small style="font-size:0.8rem;color:#666;">Status: <?php echo $endpointStatus['company_c']; ?></small></h2>
    <table class="users-table">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th></tr>
        </thead>
        <tbody>
                <?php foreach ($companyC_users as $idx => $user): ?>
                <?php
                    if (!is_array($user)) continue;
                    $uid = $user['id'] ?? ($idx+1);
                    $uname = $user['name'] ?? ($user['full_name'] ?? '');
                    $uemail = $user['email'] ?? '';
                ?>
                <tr>
                    <td><?= htmlspecialchars((string)$uid) ?></td>
                    <td><?= htmlspecialchars((string)$uname) ?></td>
                    <td><?= htmlspecialchars((string)$uemail) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<style>
.users-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.users-table th,
.users-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}
.users-table th {
    background: linear-gradient(90deg, #2b5876 0%, #4e4376 100%);
    color: white;
}
.users-table tr:nth-child(even) {
    background-color: #f9f9f9;
}
.error-message {
    background-color: #ffebee;
    color: #c62828;
    padding: 12px;
    border-radius: 4px;
    margin-bottom: 20px;
    border: 1px solid #ffcdd2;
}
.section-title {
    color: #2b5876;
    margin: 30px 0 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid #4e4376;
}
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
