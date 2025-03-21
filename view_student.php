<?php
session_start();
include 'config.php';
include 'includes/header.php';

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM students WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin-left: 16.666667%;
            padding: 30px;
        }
        
        .profile-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid rgba(255,255,255,0.5);
            margin-bottom: 15px;
            background: #fff;
            padding: 3px;
        }
        
        .profile-details {
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
        
        .status-badge {
            background: #2ecc71;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            display: inline-block;
            margin-top: 10px;
        }
        
        .action-buttons {
            padding: 20px 30px;
            background: #f8f9fa;
            text-align: right;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-left: 10px;
        }
        
        .btn-back {
            background: #95a5a6;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
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
        <div class="profile-container">
            <div class="profile-header">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($student['name']); ?>&background=random" 
                     alt="Profile" class="profile-img">
                <h2><?php echo htmlspecialchars($student['name']); ?></h2>
                <span class="status-badge">Active Student</span>
            </div>

            <div class="profile-details">
                <div class="info-group">
                    <div class="info-label">Roll Number</div>
                    <div class="info-value"><?php echo htmlspecialchars($student['roll_no']); ?></div>
                </div>

                <div class="info-group">
                    <div class="info-label">Class</div>
                    <div class="info-value"><?php echo htmlspecialchars($student['class']); ?></div>
                </div>

                <div class="info-group">
                    <div class="info-label">Admission Date</div>
                    <div class="info-value"><?php echo date('F d, Y'); ?></div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="students.php" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
                <a href="edit_student.php?id=<?php echo $student['id']; ?>" class="btn-edit">
                    <i class="fas fa-edit me-2"></i>Edit Student
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>