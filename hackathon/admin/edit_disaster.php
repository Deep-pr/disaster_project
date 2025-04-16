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
</head>
<body>

<?php include('navbar.php'); ?>

<h2>Edit Disaster Information</h2>

<?php echo $message; ?>

<form method="post" action="">
    <label>Disaster Type:</label><br>
    <input type="text" name="disaster_type" value="<?= htmlspecialchars($data['DisasterType']) ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="50" required><?= htmlspecialchars($data['Description']) ?></textarea><br><br>

    <label>Date Occurred:</label><br>
    <input type="date" name="date_occurred" value="<?= $data['DateOccurred'] ?>" required><br><br>

    <label>Location:</label><br>
    <input type="text" name="location" value="<?= htmlspecialchars($data['Location']) ?>" required><br><br>

    <input type="submit" value="Update Disaster Info">
</form>

<br>
<a href="view_disasters.php">← Back to Disaster List</a>

</body>
</html>
