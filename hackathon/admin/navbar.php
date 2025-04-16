<!-- Animate.css CDN (Add this in <head> section) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<!-- Bootstrap Icons (Optional, but used for icons) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm animate__animated animate__fadeInDown">
  <div class="container">
    <a class="navbar-brand fw-bold" href="admin_dashboard.php">
      <i class="bi bi-shield-exclamation me-2"></i>Disaster Information System
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" 
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link animate__animated animate__fadeInUp animate__delay-1s" href="admin_dashboard.php">
            <i class="bi bi-house-door-fill me-1"></i>Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link animate__animated animate__fadeInUp animate__delay-1s" href="manage_users.php">
            <i class="bi bi-people-fill me-1"></i>Manage Users
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link animate__animated animate__fadeInUp animate__delay-1s" href="add_relief.php">
            <i class="bi bi-journal-plus me-1"></i>Add Relief Info
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link animate__animated animate__fadeInUp animate__delay-1s" href="add_disaster.php">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>Add Disaster Information
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-warning animate__animated animate__fadeInUp animate__delay-1s" href="logout.php">
            <i class="bi bi-box-arrow-right me-1"></i>Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
