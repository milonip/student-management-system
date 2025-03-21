<?php
session_start();
include 'config.php';
include 'includes/header.php';

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    if(isset($_POST['confirm_delete'])) {
        $query = "DELETE FROM faculty WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if(mysqli_stmt_execute($stmt)) {
            header('location: faculty.php?success=3');
            exit();
        } else {
            $error = "Failed to delete faculty member. Please try again.";
        }
    }

    // Fetch faculty details
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
    <title>Delete Faculty - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin-left: 16.666667%;
            padding: 30px;
        }
        
        .delete-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            text-align: center;
        }
        
        .warning-icon {
            font-size: 5rem;
            color: #e74c3c;
            margin-bottom: 20px;
        }
        
        .faculty-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            text-align: left;
        }
        
        .info-item {
            margin-bottom: 10px;
            color: #2c3e50;
        }
        
        .info-label {
            font-weight: 600;
            color: #7f8c8d;
            margin-right: 10px;
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-left: 10px;
        }
        
        .btn-cancel {
            background: #95a5a6;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-delete:hover, .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            color: white;
        }
        
        .warning-text {
            color: #7f8c8d;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="delete-container">
            <i class="fas fa-exclamation-triangle warning-icon"></i>
            <h2>Delete Faculty Member</h2>
            <p class="warning-text">Are you sure you want to delete this faculty member? This action cannot be undone.</p>
            
            <div class="faculty-info">
                <div class="info-item">
                    <span class="info-label">Name:</span>
                    <?php echo htmlspecialchars($faculty['name']); ?>
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span>
                    <?php echo htmlspecialchars($faculty['email']); ?>
                </div>
                <div class="info-item">
                    <span class="info-label">Department:</span>
                    <?php echo htmlspecialchars($faculty['department']); ?>
                </div>
                <div class="info-item">
                    <span class="info-label">Designation:</span>
                    <?php echo htmlspecialchars($faculty['designation']); ?>
                </div>
            </div>

            <form method="POST" action="">
                <a href="faculty.php" class="btn btn-cancel">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
                <button type="submit" name="confirm_delete" class="btn btn-delete">
                    <i class="fas fa-trash-alt me-2"></i>Delete Faculty
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>