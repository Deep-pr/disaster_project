
<?php
session_start();
include('config.php');

// Redirect if not logged in or wrong user type
if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'General User') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$userType = $_SESSION['user_type'];
?>

<?php
session_start();
include('config.php');

// Redirect if not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$userType = $_SESSION['user_type'];

// Fetch 3 latest relief info
$relief = $conn->query("SELECT * FROM ReliefInformation ORDER BY DateGranted DESC LIMIT 3");

// Fetch 3 latest disaster info
$disasters = $conn->query("SELECT * FROM DisasterInformation ORDER BY DateOccurred DESC LIMIT 3");

// Fetch 3 latest public messages
$messages = $conn->query("SELECT * FROM PublicMessage ORDER BY DatePosted DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in-out both;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <h2 class="mb-4">Welcome to User Dashboard</h2>
    <p><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
    <p><strong>User Type:</strong> <?= htmlspecialchars($userType) ?></p>

    <div class="row mt-4">
        <!-- Relief Info -->
        <h4 class="mb-3">Latest Relief Information</h4>
        <?php while ($row = $relief->fetch_assoc()): ?>
            <div class="col-md-4 mb-4 fade-in">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['Title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['Description']) ?></p>
                        <p><strong>Date:</strong> <?= htmlspecialchars($row['DateGranted']) ?></p>
                        <p><strong>Amount:</strong> $<?= htmlspecialchars($row['Amount']) ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="mb-5">
            <a href="relief_information.php" class="btn btn-outline-primary">View More Relief Info</a>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Disaster Info -->
        <h4 class="mb-3">Recent Disasters</h4>
        <?php while ($row = $disasters->fetch_assoc()): ?>
            <div class="col-md-4 mb-4 fade-in">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['DisasterType']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['Description']) ?></p>
                        <p><strong>Date:</strong> <?= htmlspecialchars($row['DateOccurred']) ?></p>
                        <p><strong>Location:</strong> <?= htmlspecialchars($row['Location']) ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="mb-5">
            <a href="disaster_information.php" class="btn btn-outline-primary">View More Disaster Info</a>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Public Messages -->
        <h4 class="mb-3">Public Messages</h4>
        <?php while ($row = $messages->fetch_assoc()): ?>
            <div class="col-md-4 mb-4 fade-in">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['Title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['Message']) ?></p>
                        <p><strong>Date:</strong> <?= htmlspecialchars($row['DatePosted']) ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="mb-5">
            <a href="view_public_message.php" class="btn btn-outline-primary">View More Public Messages</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

