<?php
session_start();
include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT * FROM User WHERE Email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Assuming passwords are stored in plain text (not recommended)
        if ($user['Password'] === $password) {
            // Set session variables
            $_SESSION['user_id']    = $user['ID'];
            $_SESSION['username']   = $user['Username'];
            $_SESSION['user_type']  = $user['UserType'];
            $_SESSION['logged_in']  = true;

            // Redirect based on user type
            if ($user['UserType'] === 'Rehabitational Institute') {
                header("Location: ./rehab/rehab_home.php");
            } elseif ($user['UserType'] === 'General User') {
                header("Location: ./user/user_home.php");
            }
            exit();
        } else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "User not found.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h2 class="mb-4 text-center">User Login</h2>

                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger"><?= $message ?></div>
                <?php endif; ?>

                <form method="post" action="">
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" required>
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
                    <a href="register.php">Don't have an account? Register</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

