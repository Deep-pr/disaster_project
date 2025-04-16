<?php
session_start();
include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = "";

// Process form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT * FROM Admin WHERE Username = '$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        // Plain text comparison (update this if you hash passwords)
        if ($admin['Password'] === $password) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['Username'];

            header("Location: ./admin/admin_dashboard.php");
            exit();
        } else {
            $message = "Invalid username or password.";
        }
    } else {
        $message = "Admin not found.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h2 class="text-center mb-4">Admin Login</h2>

                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger"><?= $message ?></div>
                <?php endif; ?>

                <form method="post" action="">
                    <div class="mb-3">
                        <label class="form-label">Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <a href="login.php">Back to User Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

