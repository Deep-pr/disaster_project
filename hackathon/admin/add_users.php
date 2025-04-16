<?php
session_start();
include('config.php');

// Ensure only logged-in admin can access
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username  = htmlspecialchars($_POST['username']);
    $email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password  = htmlspecialchars($_POST['password']); // You may hash this
    $contact   = htmlspecialchars($_POST['contact_info']);
    $usertype  = htmlspecialchars($_POST['user_type']);
    $address   = htmlspecialchars($_POST['address']);

    // Check if email or username already exists (optional, for better UX)
    $check_sql = "SELECT * FROM User WHERE Email = '$email' OR Username = '$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result && $check_result->num_rows > 0) {
        $message = "<span style='color:red;'>Username or Email already exists.</span>";
    } else {
        $sql = "INSERT INTO User (Username, Email, Password, ContactInfo, UserType, Address)
                VALUES ('$username', '$email', '$password', '$contact', '$usertype', '$address')";

        if ($conn->query($sql) === TRUE) {
            $message = "<span style='color:green;'>User added successfully!</span>";
        } else {
            $message = "<span style='color:red;'>Error: " . $conn->error . "</span>";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/style.css">

</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Add New User <small class="text-muted">(Admin Access Only)</small></h2>

        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <div class="mb-3">
                <label for="contact_info" class="form-label">Contact Info:</label>
                <input type="text" class="form-control" name="contact_info" id="contact_info">
            </div>

            <div class="mb-3">
                <label for="user_type" class="form-label">User Type:</label>
                <select name="user_type" id="user_type" class="form-select" required>
                    <option value="Rehabitational Institute">Rehabitational Institute</option>
                    <option value="General User">General User</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" name="address" id="address" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Add User</button>
            <a href="manage_users.php" class="btn btn-outline-secondary ms-2">← Back to Manage Users</a>
        </form>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

