<?php
session_start();
include 'config.php';

if(!isset($_SESSION['username'])) {
    header('location: login.php');
    exit();
}

// Fetch counts for dashboard
$student_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM students"))['count'];
$faculty_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM faculty"))['count'];
$course_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM courses"))['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
        }

        body {
            background-color: #f8f9fc;
        }

        .dashboard-container {
            margin-left: 16.666667%; /* Matches sidebar width */
            padding: 20px;
        }

        .stats-card {
            border-radius: 15px;
            border: none;
            transition: transform 0.3s ease;
            background: linear-gradient(45deg, var(--primary-color), #224abe);
            color: white;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            font-size: 2rem;
            opacity: 0.8;
        }

        .stats-number {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .recent-activity {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .welcome-section {
            background: linear-gradient(120deg, #2c3e50, #3498db);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .quick-actions {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .action-button {
            padding: 15px;
            border-radius: 10px;
            border: none;
            background: #f8f9fc;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--secondary-color);
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .action-button:hover {
            background: var(--primary-color);
            color: white;
            transform: translateX(5px);
        }

        .action-button i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="dashboard-container">
        <div class="welcome-section">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p class="lead">Here's what's happening in your university today</p>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-4">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="stats-number"><?php echo $student_count; ?></div>
                                <div>Total Students</div>
                            </div>
                            <div class="col-4 text-end">
                                <i class="fas fa-user-graduate stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="stats-number"><?php echo $faculty_count; ?></div>
                                <div>Faculty Members</div>
                            </div>
                            <div class="col-4 text-end">
                                <i class="fas fa-chalkboard-teacher stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="stats-number"><?php echo $course_count; ?></div>
                                <div>Active Courses</div>
                            </div>
                            <div class="col-4 text-end">
                                <i class="fas fa-book stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Quick Actions -->
            <div class="col-md-4">
                <div class="quick-actions">
                    <h4 class="mb-4">Quick Actions</h4>
                    <a href="add_student.php" class="action-button">
                        <i class="fas fa-user-plus"></i> Add New Student
                    </a>
                    <a href="add_course.php" class="action-button">
                        <i class="fas fa-book-medical"></i> Add New Course
                    </a>
                    <a href="add_faculty.php" class="action-button">
                        <i class="fas fa-user-tie"></i> Add New Faculty
                    </a>
                    <a href="attendance.php" class="action-button">
                        <i class="fas fa-clipboard-check"></i> Mark Attendance
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="col-md-8">
                <div class="recent-activity">
                    <h4 class="mb-4">Recent Activity</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Activity</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>New Student Registration</td>
                                    <td>Today</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>Course Assignment</td>
                                    <td>Yesterday</td>
                                    <td><span class="badge bg-info">In Progress</span></td>
                                </tr>
                                <tr>
                                    <td>Faculty Meeting</td>
                                    <td>2 days ago</td>
                                    <td><span class="badge bg-primary">Scheduled</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>