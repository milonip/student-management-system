<?php
session_start();
include 'config.php';
include 'includes/header.php';

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM faculty WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $faculty = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Faculty - University Management System</title>
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
            max-width: 800px;
            margin: 0 auto;
            overflow: hidden;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border: 4px solid rgba(255,255,255,0.3);
        }
        
        .profile-avatar i {
            font-size: 3rem;
            color: #2ecc71;
        }
        
        .profile-name {
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .profile-designation {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .profile-body {
            padding: 30px;
        }
        
        .info-group {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .info-label {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #2c3e50;
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        .department-badge {
            background: rgba(255,255,255,0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-top: 10px;
            display: inline-block;
        }
        
        .btn-back {
            background: #95a5a6;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin-top: 20px;
        }
        
        .btn-back:hover {
            background: #7f8c8d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h1 class="profile-name"><?php echo htmlspecialchars($faculty['name']); ?></h1>
                <p class="profile-designation"><?php echo htmlspecialchars($faculty['designation']); ?></p>
                <span class="department-badge">
                    <i class="fas fa-building me-1"></i>
                    <?php echo htmlspecialchars($faculty['department']); ?>
                </span>
            </div>
            
            <div class="profile-body">
                <div class="info-group">
                    <div class="info-label">Contact Information</div>
                    <div class="info-value">
                        <i class="fas fa-envelope me-2"></i><?php echo htmlspecialchars($faculty['email']); ?>
                    </div>
                    <div class="info-value mt-2">
                        <i class="fas fa-phone me-2"></i><?php echo htmlspecialchars($faculty['phone']); ?>
                    </div>
                </div>
                
                <div class="info-group">
                    <div class="info-label">Qualification</div>
                    <div class="info-value">
                        <i class="fas fa-graduation-cap me-2"></i>
                        <?php echo nl2br(htmlspecialchars($faculty['qualification'])); ?>
                    </div>
                </div>
                
                <div class="info-group">
                    <div class="info-label">Joining Date</div>
                    <div class="info-value">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <?php echo date('F d, Y', strtotime($faculty['joining_date'])); ?>
                    </div>
                </div>
                
                <div class="text-center">
                    <a href="faculty.php" class="btn btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Back to Faculty List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>