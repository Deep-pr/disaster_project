<?php
session_start();
include('config.php');

// Ensure admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Handle delete action
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $reliefID = intval($_GET['delete']);
    $delete_sql = "DELETE FROM ReliefInformation WHERE ReliefID = $reliefID";
    $conn->query($delete_sql);
    header("Location: view_relief_information.php");
    exit();
}

// Fetch relief data
$sql = "SELECT * FROM ReliefInformation ORDER BY DateGranted DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Relief Information</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/style.css">

</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">All Relief Information</h2>
        <div>
            <a href="add_relief.php" class="btn btn-success me-2">+ Add New Relief Info</a>
            <a href="admin_dashboard.php" class="btn btn-secondary">← Back to Admin Dashboard</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date Granted</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['ReliefID']; ?></td>
                        <td><?php echo htmlspecialchars($row['Title']); ?></td>
                        <td><?php echo htmlspecialchars($row['Description']); ?></td>
                        <td><?php echo $row['DateGranted']; ?></td>
                        <td><?php echo number_format($row['Amount'], 2); ?>INR</td>
                        <td>
                            <a href="edit_relief.php?id=<?php echo $row['ReliefID']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="view_relief_information.php?delete=<?php echo $row['ReliefID']; ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure you want to delete this record?');">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-muted">No relief records found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

