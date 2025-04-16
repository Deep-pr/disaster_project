<?php
session_start();
include('config.php');

// Check login and get ID
if (!isset($_SESSION['admin_logged_in']) || !isset($_GET['ID'])) {
    header("Location: admin_login.php");
    exit();
}

$id = intval($_GET['ID']);
$message = "";

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = htmlspecialchars($_POST['disaster_type']);
    $description = htmlspecialchars($_POST['description']);
    $date = $_POST['date_occurred'];
    $location = htmlspecialchars($_POST['location']);

    $update = "UPDATE DisasterInformation SET 
                DisasterType = '$type', 
                Description = '$description', 
                DateOccurred = '$date', 
                Location = '$location' 
               WHERE DisasterID = $id";

    if ($conn->query($update)) {
        header("Location: view_disasters.php");
        exit();
    } else {
        $message = "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}

// Get disaster record
$res = $conn->query("SELECT * FROM DisasterInformation WHERE DisasterID = $id");
$data = $res->fetch_assoc();

if (!$data) {
    echo "Disaster not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Disaster</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title mb-4">Edit Disaster Information</h2>

            <?php if (!empty($message)): ?>
                <div class="alert alert-info"><?= $message ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="mb-3">
                    <label for="disaster_type" class="form-label">Disaster Type</label>
                    <input type="text" class="form-control" id="disaster_type" name="disaster_type" 
                           value="<?= htmlspecialchars($data['DisasterType']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($data['Description']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="date_occurred" class="form-label">Date Occurred</label>
                    <input type="date" class="form-control" id="date_occurred" name="date_occurred" 
                           value="<?= $data['DateOccurred'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" 
                           value="<?= htmlspecialchars($data['Location']) ?>" required>
                </div>

                <button type="submit" class="btn btn-success">Update Disaster Info</button>
                <a href="view_disasters.php" class="btn btn-secondary ms-2">← Back to Disaster List</a>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

