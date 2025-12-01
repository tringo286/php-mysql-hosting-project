<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

include __DIR__ . '/../db.php';

$sql = "SELECT id, name, email, role, status, joined_date FROM users ORDER BY id ASC";
$result = $mysqli->query($sql);

if (!$result) {
    die("Query failed: " . $mysqli->error);
}
?>

<?php include('../includes/header.php'); ?>

<div class="page-container">
    <div class="admin-container">
        <h2>Website Users</h2>

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
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['role']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['joined_date']) . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6" style="text-align:center;">No users found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<?php include('../includes/footer.php'); ?>

<style>
    .page-container {
        display: flex;
        justify-content: center;
        padding: 20px;
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
        margin-bottom: 25px;
        font-weight: 700;
        font-size: 1.8rem;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* smoother scroll on iOS */
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 14px;
        min-width: 800px;
    }

    thead th {
        background: #4e4376;
        color: #fff;
        text-transform: uppercase;
        padding: 12px 15px;
        font-weight: 600;
    }

    tbody td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        color: #333;
    }

    tbody tr:hover {
        background: #f0f0f5;
    }

    .logout-btn {
        display: inline-block;
        background: #4e4376;
        color: #fff;
        padding: 10px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        margin-top: 25px;
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        background: #2b5876;
        transform: translateY(-2px);
    }

    /* --------------------------------------
    RESPONSIVE — MEDIUM SCREENS (≤ 900px)
    --------------------------------------- */
    @media (max-width: 900px) {
        .admin-container {
            padding: 20px 22px;
        }

        h2 {
            font-size: 1.6rem;
        }

        table {
            font-size: 13px;
        }
    }

    /* --------------------------------------
    MOBILE (≤ 600px)
    --------------------------------------- */
    @media (max-width: 600px) {
        .page-container {
            padding: 10px;
        }

        .admin-container {
            padding: 18px 15px;
            border-radius: 14px;
        }

        h2 {
            font-size: 1.45rem;
            margin-bottom: 18px;
            text-align: center;
        }

        table {
            font-size: 12px;
            min-width: 500px; 
        }

        thead th,
        tbody td {
            padding: 10px 12px;
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            text-align: center;
            margin-top: 22px;
            font-size: 1rem;
            border-radius: 10px;
        }
    }

    /* --------------------------------------
    EXTRA-SMALL MOBILE (≤ 400px)
    --------------------------------------- */
    @media (max-width: 400px) {
        table {
            min-width: 420px; 
        }

        .admin-container {
            padding: 15px 12px;
        }

        h2 {
            font-size: 1.3rem;
        }

        thead th,
        tbody td {
            padding: 8px 10px;
        }
    }

</style>

<?php $mysqli->close(); ?>
