<?php
session_start();
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT * FROM DisasterInformation";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Disasters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Disaster Records</h2>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>DisasterID</th>
                            <th>DisasterType</th>
                            <th>Description</th>
                            <th>DateOccurred</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['DisasterID']); ?></td>
                                <td><?php echo htmlspecialchars($row['DisasterType']); ?></td>
                                <td><?php echo htmlspecialchars($row['Description']); ?></td>
                                <td><?php echo htmlspecialchars($row['DateOccurred']); ?></td>
                                <td><?php echo htmlspecialchars($row['Location']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No disaster records found.</p>
        <?php endif; ?>

        <div class="mt-4">
            <a href="admin_panel.php" class="btn btn-link">← Back to Admin Panel</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>