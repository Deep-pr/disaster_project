<?php
session_start();
include('config.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['user_type'] !== 'General User') {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM DisasterInformation ORDER BY DateOccurred DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Disaster Information</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- AOS Animation CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Disaster Information</h2>

    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?= htmlspecialchars($row['DisasterType']) ?></h5>
                            <p class="card-text"><strong>Description:</strong><br><?= htmlspecialchars($row['Description']) ?></p>
                            <p class="card-text"><strong>Date Occurred:</strong> <?= htmlspecialchars($row['DateOccurred']) ?></p>
                            <p class="card-text"><strong>Location:</strong> <?= htmlspecialchars($row['Location']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    No disaster information available.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animation JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>

</body>
</html>

