<?php
session_start();
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM User WHERE ID = $delete_id";
    $conn->query($delete_sql);
}

// Fetch all users
$sql = "SELECT * FROM User";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Users</h2>
        <a href="add_users.php" class="btn btn-primary">Add Users</a>
    </div>

    <p><strong>Admin:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>User Type</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo htmlspecialchars($row['Username']); ?></td>
                        <td><?php echo htmlspecialchars($row['Email']); ?></td>
                        <td><?php echo htmlspecialchars($row['ContactInfo']); ?></td>
                        <td><?php echo htmlspecialchars($row['UserType']); ?></td>
                        <td><?php echo htmlspecialchars($row['Address']); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['ID']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="manage_users.php?delete_User=<?php echo $row['ID']; ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">No users found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <a href="logout.php" class="btn btn-outline-secondary mt-3">Logout</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
