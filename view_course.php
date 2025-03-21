<?php
session_start();
include 'config.php';
include 'includes/header.php';

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM courses WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $course = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Course - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin-left: 16.666667%;
            padding: 30px;
        }
        
        .course-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .course-header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .course-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            background: rgba(255,255,255,0.2);
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
            margin: 0 auto 20px;
        }
        
        .course-details {
            padding: 30px;
        }
        
        .info-group {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .info-label {
            color: #7f8c8d;
            font-size: 0.9em;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #2c3e50;
            font-size: 1.1em;
            font-weight: 500;
        }
        
        .course-stats {
            display: flex;
            justify-content: space-around;
            padding: 20px;
            background: #f8f9fa;
            margin-top: 20px;
            border-radius: 10px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #3498db;
        }
        
        .stat-label {
            color: #7f8c8d;
            font-size: 0.9em;
        }
        
        .action-buttons {
            padding: 20px;
            background: #f8f9fa;
            text-align: right;
            border-top: 1px solid #eee;
        }
        
        .btn-edit, .btn-back {
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            margin-left: 10px;
        }
        
        .btn-back {
            background: #95a5a6;
            color: white;
        }
        
        .btn-edit:hover, .btn-back:hover {
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="course-container">
            <div class="course-header">
                <div class="course-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h2><?php echo htmlspecialchars($course['course_name']); ?></h2>
                <span class="badge bg-light text-dark">
                    <i class="fas fa-clock me-1"></i><?php echo htmlspecialchars($course['duration']); ?> Months
                </span>
            </div>

            <div class="course-details">
                <div class="info-group">
                    <div class="info-label">Description</div>
                    <div class="info-value"><?php echo htmlspecialchars($course['description']); ?></div>
                </div>

                <div class="info-group">
                    <div class="info-label">Credits</div>
                    <div class="info-value"><?php echo htmlspecialchars($course['credits']); ?> Credits</div>
                </div>

                <div class="course-stats">
                    <div class="stat-item">
                        <div class="stat-value">30</div>
                        <div class="stat-label">Students Enrolled</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">5</div>
                        <div class="stat-label">Faculty Members</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">8</div>
                        <div class="stat-label">Subjects</div>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="courses.php" class="btn btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
                <a href="edit_course.php?id=<?php echo $course['id']; ?>" class="btn btn-edit">
                    <i class="fas fa-edit me-2"></i>Edit Course
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>