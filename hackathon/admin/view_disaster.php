<?php
session_start();
include('config.php');

// Ensure admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Handle deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM DisasterInformation WHERE DisasterID = $id");
    header("Location: view_disaster.php");
    exit();
}

// Fetch all disaster records
$result = $conn->query("SELECT * FROM DisasterInformation ORDER BY DateOccurred DESC");

?>

<?php include('navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Disaster Information</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Disaster Records</h2>
        <div>
            <a href="add_disaster.php" class="btn btn-primary me-2">+ Add New Disaster</a>
            <a href="admin_dashboard.php" class="btn btn-secondary">← Back to Admin Dashboard</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Disaster Type</th>
                    <th>Description</th>
                    <th>Date Occurred</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['DisasterID'] ?></td>
                            <td><?= htmlspecialchars($row['DisasterType']) ?></td>
                            <td><?= htmlspecialchars($row['Description']) ?></td>
                            <td><?= $row['DateOccurred'] ?></td>
                            <td><?= htmlspecialchars($row['Location']) ?></td>
                            <td>
                                <a href="edit_disaster.php?id=<?= $row['DisasterID'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="view_disaster.php?delete=<?= $row['DisasterID'] ?>" 
                                   onclick="return confirm('Are you sure you want to delete this disaster?');" 
                                   class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No disaster records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
