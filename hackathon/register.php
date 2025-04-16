<?php

include('config.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// === FORM PROCESSING ===
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username  = htmlspecialchars($_POST['username']);
    $email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password  = htmlspecialchars($_POST['password']);
    $contact   = htmlspecialchars($_POST['contact_info']);
    $usertype  = htmlspecialchars($_POST['user_type']);
    $address   = htmlspecialchars($_POST['address']);

    $sql = "INSERT INTO User (Username, Email, Password, ContactInfo, UserType, Address)
            VALUES ('$username', '$email', '$password', '$contact', '$usertype', '$address')";

    if($conn->query($sql) === TRUE) {
        $message = "Registration successful!";
    } else {
        $message = "Error: " . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <?php if (!empty($registration_result)) echo "<div class='alert alert-info'>$registration_result</div>"; ?>
    <div class="card shadow-lg p-4">
        <h2 class="mb-4">User Registration</h2>

        <?php if (!empty($message)) echo "<div class='alert alert-warning'>$message</div>"; ?>

        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contact Info:</label>
                <input type="text" name="contact_info" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">User Type:</label>
                <select name="user_type" class="form-select" required>
                    <option value="Rehabitational Institute">Rehabilitational Institute</option>
                    <option value="General User">General User</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Address:</label>
                <textarea name="address" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
