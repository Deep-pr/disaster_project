<?php
session_start();
include('config.php');

// Redirect if not logged in or not a Rehab Institute
if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'Rehabitational Institute') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$usertype = $_SESSION['user_type'];

// Get current user's ID (to count public messages)
$user_query = $conn->prepare("SELECT ID FROM User WHERE Username = ?");
$user_query->bind_param("s", $username);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc();
$user_id = $user['ID'];

// Count records
$total_disasters = $conn->query("SELECT COUNT(*) AS total FROM DisasterInformation")->fetch_assoc()['total'];
$total_reliefs = $conn->query("SELECT COUNT(*) AS total FROM ReliefInformation")->fetch_assoc()['total'];
$total_messages = $conn->query("SELECT COUNT(*) AS total FROM PublicMessage WHERE InstituteID = $user_id")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rehab Institute Dashboard</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-3">Welcome to Rehab Institute Dashboard</h2>

        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>User Type:</strong> <?php echo htmlspecialchars($usertype); ?></p>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-bg-primary mb-3 shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Disasters</h5>
                        <p class="display-6"><?php echo $total_disasters; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-success mb-3 shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Relief Records</h5>
                        <p class="display-6"><?php echo $total_reliefs; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-warning mb-3 shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Your Public Messages</h5>
                        <p class="display-6"><?php echo $total_messages; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
