<?php
// Remove session_start() from here since it's already in dashboard.php
require_once 'config.php';

if(!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}
?>
<!-- Only the sidebar, no HTML structure -->
<div class="col-md-2 sidebar">
    <h3 class="mb-4">University Portal</h3>
    <a href="dashboard.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
    </a>
    <a href="students.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'students.php' ? 'active' : ''; ?>">
        <i class="fas fa-user-graduate me-2"></i> Students
    </a>
    <a href="courses.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'courses.php' ? 'active' : ''; ?>">
        <i class="fas fa-book me-2"></i> Courses
    </a>
    <a href="faculty.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'faculty.php' ? 'active' : ''; ?>">
        <i class="fas fa-chalkboard-teacher me-2"></i> Faculty
    </a>
    <a href="attendance.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'attendance.php' ? 'active' : ''; ?>">
        <i class="fas fa-calendar-check me-2"></i> Attendance
    </a>
    <a href="exams.php" class="sidebar-link <?php echo basename($_SERVER['PHP_SELF']) == 'exams.php' ? 'active' : ''; ?>">
        <i class="fas fa-file-alt me-2"></i> Exams
    </a>
    <a href="logout.php" class="sidebar-link">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
    </a>
</div>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 16.666667%;
        background: linear-gradient(135deg, #3498db, #2980b9);
        padding: 20px;
        z-index: 1000;
        box-shadow: 4px 0 15px rgba(0,0,0,0.1);
    }
    
    .sidebar-link {
        display: block;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        padding: 12px 15px;
        margin: 8px 0;
        border-radius: 8px;
        transition: all 0.3s ease;
        backdrop-filter: blur(5px);
        background: rgba(255, 255, 255, 0.1);
    }
    
    .sidebar-link:hover, .sidebar-link.active {
        background: rgba(255, 255, 255, 0.2);
        transform: translateX(5px);
        color: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .sidebar h3 {
        color: white;
        font-size: 1.5rem;
        padding: 15px 0;
        border-bottom: 1px solid rgba(255,255,255,0.2);
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .sidebar-link i {
        width: 20px;
        text-align: center;
        margin-right: 10px;
        opacity: 0.9;
    }
</style>

<li class="nav-item">
    <a class="nav-link" href="attendance_report.php">
        <i class="fas fa-chart-bar"></i> Attendance Report
    </a>
</li>