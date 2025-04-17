<?php
session_start();
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type        = htmlspecialchars($_POST['disaster_type']);
    $description = htmlspecialchars($_POST['description']);
    $date        = $_POST['date_occurred'];
    $location    = htmlspecialchars($_POST['location']);

    $sql = "INSERT INTO DisasterInformation (DisasterType, Description, DateOccurred, Location)
            VALUES ('$type', '$description', '$date', '$location')";

    if ($conn->query($sql) === TRUE) {
        $message = "<p style='color:green;'>Disaster information added successfully.</p>";
    } else {
        $message = "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Disaster Information</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Add Disaster Information</h2>

        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="disaster_type" class="form-label">Disaster Type:</label>
                <input type="text" class="form-control" name="disaster_type" id="disaster_type" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="date_occurred" class="form-label">Date Occurred:</label>
                <input type="date" class="form-control" name="date_occurred" id="date_occurred" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location:</label>
                <input type="text" class="form-control" name="location" id="location" required>
            </div>

            <button type="submit" class="btn btn-danger">Add Disaster Info</button>
            <a href="view_disaster.php" class="btn btn-outline-primary ms-2">View Disaster Information</a>
        </form>

        <div class="mt-4">
            <a href="admin_dashboard.php" class="btn btn-link">← Back to Admin Dashboard</a>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
