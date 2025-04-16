<?php
session_start();
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin_login.php");
    exit();
}

// Validate and fetch user data
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $user_sql = "SELECT * FROM User WHERE ID = $user_id";
    $result = $conn->query($user_sql);

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contact = htmlspecialchars($_POST['contact_info']);
    $usertype = htmlspecialchars($_POST['user_type']);
    $address = htmlspecialchars($_POST['address']);

    $update_sql = "UPDATE User SET 
                    Username = '$username',
                    Email = '$email',
                    ContactInfo = '$contact',
                    UserType = '$usertype',
                    Address = '$address'
                    WHERE ID = $user_id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: manage_users.php");
        exit();
    } else {
        $error = "Error updating user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/style.css">

</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Edit User</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" name="username" id="username" 
                       value="<?php echo htmlspecialchars($user['Username']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" 
                       value="<?php echo htmlspecialchars($user['Email']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="contact_info" class="form-label">Contact Info:</label>
                <input type="text" class="form-control" name="contact_info" id="contact_info" 
                       value="<?php echo htmlspecialchars($user['ContactInfo']); ?>">
            </div>

            <div class="mb-3">
                <label for="user_type" class="form-label">User Type:</label>
                <select name="user_type" id="user_type" class="form-select" required>
                    <option value="Rehabitational Institute" <?php if ($user['UserType'] == 'Rehabitational Institute') echo 'selected'; ?>>
                        Rehabitational Institute
                    </option>
                    <option value="General User" <?php if ($user['UserType'] == 'General User') echo 'selected'; ?>>
                        General User
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea name="address" id="address" class="form-control" rows="4"><?php echo htmlspecialchars($user['Address']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="manage_users.php" class="btn btn-outline-secondary ms-2">← Back to User Management</a>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

 