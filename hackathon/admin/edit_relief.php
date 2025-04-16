<?php
session_start();
include('config.php');

// Check login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Get ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: view_relief_information.php");
    exit();
}

$reliefID = intval($_GET['id']);
$message = "";

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $dateGranted = $_POST['date_granted'];
    $amount = floatval($_POST['amount']);

    $update_sql = "UPDATE ReliefInformation 
                   SET Title='$title', Description='$description', DateGranted='$dateGranted', Amount='$amount'
                   WHERE ReliefID = $reliefID";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: view_relief_information.php");
        exit();
    } else {
        $message = "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}

// Get original data
$sql = "SELECT * FROM ReliefInformation WHERE ReliefID = $reliefID";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    echo "Relief record not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Relief Information</title>
</head>
<body>

<?php include('navbar.php'); ?>

<h2>Edit Relief Information</h2>

<?php if ($message !== "") echo $message; ?>

<form method="post" action="">
    <label>Relief Title:</label><br>
    <input type="text" name="title" value="<?php echo htmlspecialchars($row['Title']); ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="50"><?php echo htmlspecialchars($row['Description']); ?></textarea><br><br>

    <label>Date Granted:</label><br>
    <input type="date" name="date_granted" value="<?php echo $row['DateGranted']; ?>" required><br><br>

    <label>Amount:</label><br>
    <input type="number" step="0.01" name="amount" value="<?php echo $row['Amount']; ?>" required><br><br>

    <input type="submit" value="Update Relief Info">
</form>

<br>
<a href="view_relief_information.php">← Back to Relief Info List</a>

</body>
</html>
