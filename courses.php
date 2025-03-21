<?php
session_start();
include 'config.php';
include 'includes/header.php';

// Fetch all courses
$query = "SELECT * FROM courses ORDER BY course_name";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin-left: 16.666667%;
            padding: 30px;
        }
        
        .course-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .course-header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 20px;
        }
        
        .course-body {
            padding: 20px;
        }
        
        .course-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-value {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: #7f8c8d;
        }
        
        .btn-add-course {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-add-course:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52,152,219,0.3);
            color: white;
        }
        
        .course-actions {
            padding: 15px;
            background: #f8f9fa;
            text-align: right;
        }
        
        .course-actions a {
            color: #3498db;
            margin-left: 15px;
            transition: all 0.3s ease;
        }
        
        .course-actions a:hover {
            color: #2980b9;
            transform: scale(1.1);
        }
        
        .course-description {
            color: #666;
            margin: 10px 0;
            line-height: 1.6;
        }
        
        .course-duration {
            display: inline-block;
            padding: 5px 15px;
            background: #f0f3f4;
            border-radius: 20px;
            font-size: 0.9em;
            color: #34495e;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-book me-2"></i>Course Management</h2>
            <a href="add_course.php" class="btn btn-add-course">
                <i class="fas fa-plus me-2"></i>Add New Course
            </a>
        </div>

        <div class="row">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-header">
                            <h3><?php echo htmlspecialchars($row['course_name']); ?></h3>
                            <span class="course-duration">
                                <i class="fas fa-clock me-2"></i><?php echo htmlspecialchars($row['duration']); ?> Months
                            </span>
                        </div>
                        <div class="course-body">
                            <p class="course-description"><?php echo htmlspecialchars($row['description']); ?></p>
                            <div class="course-stats">
                                <div class="stat-item">
                                    <div class="stat-value">30</div>
                                    <div class="stat-label">Students</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">5</div>
                                    <div class="stat-label">Faculty</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">8</div>
                                    <div class="stat-label">Subjects</div>
                                </div>
                            </div>
                        </div>
                        <div class="course-actions">
                            <a href="view_course.php?id=<?php echo $row['id']; ?>" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="edit_course.php?id=<?php echo $row['id']; ?>" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete_course.php?id=<?php echo $row['id']; ?>" title="Delete" 
                               onclick="return confirm('Are you sure you want to delete this course?')">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>