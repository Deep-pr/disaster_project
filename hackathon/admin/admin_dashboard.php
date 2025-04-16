<?php
session_start();

// Redirect if admin is not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin_login.php");
    exit();
}

$admin_username = $_SESSION['admin_username'];

// Include DB connection
include('config.php'); // Make sure this path is correct

// Fetch total General Users
$sql_general_users = "SELECT COUNT(*) as total FROM User WHERE UserType = 'General User'";
$result_general = $conn->query($sql_general_users);
$total_general_users = $result_general->fetch_assoc()['total'];

// Fetch total Rehabitational Institutes
$sql_rehab_users = "SELECT COUNT(*) as total FROM User WHERE UserType = 'Rehabitational Institute'";
$result_rehab = $conn->query($sql_rehab_users);
$total_rehab_users = $result_rehab->fetch_assoc()['total'];

// Fetch total Disasters
$sql_disasters = "SELECT COUNT(*) as total FROM DisasterInformation";
$result_disasters = $conn->query($sql_disasters);
$total_disasters = $result_disasters->fetch_assoc()['total'];

// Fetch total Relief Info
$sql_reliefs = "SELECT COUNT(*) as total FROM ReliefInformation";
$result_reliefs = $conn->query($sql_reliefs);
$total_reliefs = $result_reliefs->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <h2 class="mb-4">Welcome, <?php echo htmlspecialchars($admin_username); ?></h2>

    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card text-bg-primary shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-person-fill display-5 mb-2"></i>
                    <h5 class="card-title">General Users</h5>
                    <p class="card-text fs-3"><?php echo $total_general_users; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-bg-success shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-building-fill display-5 mb-2"></i>
                    <h5 class="card-title">Rehabitational Institutes</h5>
                    <p class="card-text fs-3"><?php echo $total_rehab_users; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-bg-warning shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-exclamation-triangle-fill display-5 mb-2"></i>
                    <h5 class="card-title">Disasters</h5>
                    <p class="card-text fs-3"><?php echo $total_disasters; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-bg-danger shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-clipboard-heart-fill display-5 mb-2"></i>
                    <h5 class="card-title">Relief Info</h5>
                    <p class="card-text fs-3"><?php echo $total_reliefs; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-end mt-4">
        <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
