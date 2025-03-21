<div class="col-md-2 sidebar">
    <h3 class="text-white mb-4">University Portal</h3>
    <nav>
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
    </nav>
</div>