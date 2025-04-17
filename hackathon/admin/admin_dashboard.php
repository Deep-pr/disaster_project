<?php
session_start();

// Redirect if admin is not logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin_login.php");
    exit();
}

$admin_username = $_SESSION['admin_username'];

// Include DB connection
include('config.php');

// Fetch counts
$sql_general_users = "SELECT COUNT(*) as total FROM User WHERE UserType = 'General User'";
$result_general = $conn->query($sql_general_users);
$total_general_users = $result_general->fetch_assoc()['total'];

$sql_rehab_users = "SELECT COUNT(*) as total FROM User WHERE UserType = 'Rehabitational Institute'";
$result_rehab = $conn->query($sql_rehab_users);
$total_rehab_users = $result_rehab->fetch_assoc()['total'];

$sql_disasters = "SELECT COUNT(*) as total FROM DisasterInformation";
$result_disasters = $conn->query($sql_disasters);
$total_disasters = $result_disasters->fetch_assoc()['total'];

$sql_reliefs = "SELECT COUNT(*) as total FROM ReliefInformation";
$result_reliefs = $conn->query($sql_reliefs);
$total_reliefs = $result_reliefs->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --warning: #f8961e;
            --danger: #ef233c;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .admin-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        
        .admin-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }
        
        .stat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            overflow: hidden;
            position: relative;
            z-index: 1;
            color: white;
        }
        
        .stat-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
            transition: all 0.5s ease;
            z-index: -1;
        }
        
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .stat-card:hover::after {
            transform: rotate(45deg) translateX(20px);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            opacity: 0.3;
            position: absolute;
            right: 20px;
            top: 20px;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover i {
            transform: scale(1.2);
            opacity: 0.4;
        }
        
        .card-general {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }
        
        .card-rehab {
            background: linear-gradient(135deg, #4cc9f0 0%, #4895ef 100%);
        }
        
        .card-disasters {
            background: linear-gradient(135deg, #f8961e 0%, #f3722c 100%);
        }
        
        .card-relief {
            background: linear-gradient(135deg, #ef233c 0%, #d90429 100%);
        }
        
        .btn-admin {
            background: rgba(255,255,255,0.2);
            border: 2px solid white;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
        }
        
        .btn-admin:hover {
            background: white;
            color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .admin-avatar {
            width: 80px;
            height: 80px;
            background-color: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-right: 1.5rem;
        }
    </style>
</head>
<body>

<?php include('navbar.php'); ?>

<div class="container py-5">
    <div class="admin-header floating">
        <div class="d-flex align-items-center">
            <div class="admin-avatar animate__animated animate__bounceIn">
                <i class="fas fa-user-shield"></i>
            </div>
            <div>
                <h1 class="mb-2">Admin Dashboard</h1>
                <p class="lead mb-0">Welcome back, <?php echo htmlspecialchars($admin_username); ?></p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="stat-card card-general animate__animated animate__fadeInLeft animate__delay-1s">
                <div class="card-body p-4">
                    <i class="fas fa-users"></i>
                    <h5 class="card-title">General Users</h5>
                    <h2 class="display-4 fw-bold mb-0 pulse"><?php echo $total_general_users; ?></h2>
                    <p class="mb-0">Registered users</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stat-card card-rehab animate__animated animate__fadeInUp animate__delay-1-5s">
                <div class="card-body p-4">
                    <i class="fas fa-hospital"></i>
                    <h5 class="card-title">Rehab Institutes</h5>
                    <h2 class="display-4 fw-bold mb-0 pulse"><?php echo $total_rehab_users; ?></h2>
                    <p class="mb-0">Registered institutes</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stat-card card-disasters animate__animated animate__fadeInDown animate__delay-2s">
                <div class="card-body p-4">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h5 class="card-title">Disasters</h5>
                    <h2 class="display-4 fw-bold mb-0 pulse"><?php echo $total_disasters; ?></h2>
                    <p class="mb-0">Recorded disasters</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stat-card card-relief animate__animated animate__fadeInRight animate__delay-2-5s">
                <div class="card-body p-4">
                    <i class="fas fa-hands-helping"></i>
                    <h5 class="card-title">Relief Info</h5>
                    <h2 class="display-4 fw-bold mb-0 pulse"><?php echo $total_reliefs; ?></h2>
                    <p class="mb-0">Relief records</p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            <i class="fas fa-shield-alt me-2"></i> Secure Admin Portal
        </div>
        <a href="logout.php" class="btn-admin animate__animated animate__fadeIn animate__delay-3s">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add interactive elements
    document.addEventListener('DOMContentLoaded', function() {
        // Add ripple effect to cards
        const cards = document.querySelectorAll('.stat-card');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                this.classList.add('animate__pulse');
                setTimeout(() => {
                    this.classList.remove('animate__pulse');
                }, 1000);
            });
        });
        
        // Add parallax effect to admin header
        const adminHeader = document.querySelector('.admin-header');
        if (adminHeader) {
            window.addEventListener('scroll', function() {
                let offset = window.pageYOffset;
                adminHeader.style.backgroundPositionY = offset * 0.5 + 'px';
            });
        }
    });
</script>
</body>
</html>
