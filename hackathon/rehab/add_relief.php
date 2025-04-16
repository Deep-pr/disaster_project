<?php
session_start();
include('config.php');

// Redirect if not logged in or wrong user type
if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'Rehabitational Institute') {
    header("Location: login.php");
    exit();
}

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title        = htmlspecialchars($_POST['title']);
    $description  = htmlspecialchars($_POST['description']);
    $dateGranted  = $_POST['date_granted'];
    $amount       = floatval($_POST['amount']);

    $sql = "INSERT INTO ReliefInformation (Title, Description, DateGranted, Amount)
            VALUES ('$title', '$description', '$dateGranted', '$amount')";

    if ($conn->query($sql) === TRUE) {
        $message = "<p style='color: green;'>Relief information added successfully.</p>";
    } else {
        $message = "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Relief Information</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Add Relief Information</h2>

        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="title" class="form-label">Relief Title:</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" name="description" id="description" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="date_granted" class="form-label">Date Granted:</label>
                <input type="date" class="form-control" name="date_granted" id="date_granted" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Amount (e.g. 1500.00):</label>
                <input type="number" step="0.01" class="form-control" name="amount" id="amount" required>
            </div>

            <button type="submit" class="btn btn-success">Add Relief Info</button>
            <a href="view_relief_information.php" class="btn btn-outline-primary ms-2">View Relief Information</a>
        </form>

        <div class="mt-4">
            <a href="admin_panel.php" class="btn btn-link">← Back to Admin Panel</a>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
