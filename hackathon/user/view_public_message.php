<?php
session_start();
include('config.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'General User') {
    header("Location: login.php");
    exit();
}

$query = "SELECT pm.Title, pm.Message, pm.DatePosted, u.Username 
          FROM PublicMessage pm
          JOIN User u ON pm.InstituteID = u.ID
          ORDER BY pm.DatePosted DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Public Messages</title>
</head>
<body>
<?php include('navbar.php'); ?>
<h2>Public Messages from Rehabilitation Institutes</h2>

<?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>Institute</th>
            <th>Title</th>
            <th>Message</th>
            <th>Date Posted</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['Username']) ?></td>
                <td><?= htmlspecialchars($row['Title']) ?></td>
                <td><?= htmlspecialchars($row['Message']) ?></td>
                <td><?= htmlspecialchars($row['DatePosted']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No public messages available.</p>
<?php endif; ?>

</body>
</html>
