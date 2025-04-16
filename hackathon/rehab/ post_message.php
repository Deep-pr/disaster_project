<?php
session_start();
include('config.php');

// Redirect if not logged in or wrong user type
if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'Rehabitational Institute') {
    header("Location: login.php");
    exit();
}

$message = "";
$username = $_SESSION['username'];
$usertype = $_SESSION['user_type'];
$instituteID = $_SESSION['user_id']; // Make sure this is set during login

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']);
    $public_message = htmlspecialchars($_POST['message']);
    $date_posted = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO PublicMessage (InstituteID, Title, Message, DatePosted) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $instituteID, $title, $public_message, $date_posted);

    if ($stmt->execute()) {
        $message = "Public message posted successfully.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Public Message</title>
</head>
<body>

<?php include('navbar.php'); ?>

<h2>Post a Public Message</h2>

<p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
<p><strong>User Type:</strong> <?php echo htmlspecialchars($usertype); ?></p>

<?php if ($message): ?>
    <p style="color: green;"><?php echo $message; ?></p>
<?php endif; ?>

<form method="post" action="">
    <label for="title">Title:</label><br>
    <input type="text" name="title" id="title" required><br><br>

    <label for="message">Message:</label><br>
    <textarea name="message" id="message" rows="5" cols="50" required></textarea><br><br>

    <input type="submit" value="Post Message">
</form>

<br>
<a href="rehab_home.php">Back to Dashboard</a>

</body>
</html>
