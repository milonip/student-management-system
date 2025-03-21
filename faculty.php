<?php
session_start();
include 'config.php';
include 'includes/header.php';

// Fetch all faculty members
$query = "SELECT * FROM faculty ORDER BY name";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin-left: 16.666667%;
            padding: 30px;
        }
        
        .faculty-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .faculty-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .faculty-header {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            padding: 20px;
            position: relative;
        }
        
        .faculty-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            border: 3px solid rgba(255,255,255,0.3);
        }
        
        .faculty-avatar i {
            font-size: 2.5rem;
            color: #2ecc71;
        }
        
        .faculty-body {
            padding: 20px;
        }
        
        .faculty-info {
            margin-bottom: 15px;
        }
        
        .info-label {
            color: #7f8c8d;
            font-size: 0.9em;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #2c3e50;
            font-weight: 500;
        }
        
        .faculty-footer {
            padding: 15px;
            background: #f8f9fa;
            text-align: right;
        }
        
        .faculty-footer a {
            color: #2ecc71;
            margin-left: 15px;
            transition: all 0.3s ease;
        }
        
        .faculty-footer a:hover {
            color: #27ae60;
            transform: scale(1.1);
        }
        
        .btn-add-faculty {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-add-faculty:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46,204,113,0.3);
            color: white;
        }
        
        .department-badge {
            background: rgba(255,255,255,0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            margin-top: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-chalkboard-teacher me-2"></i>Faculty Management</h2>
            <a href="add_faculty.php" class="btn btn-add-faculty">
                <i class="fas fa-plus me-2"></i>Add New Faculty
            </a>
        </div>

        <div class="row">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-6 col-lg-4">
                    <div class="faculty-card">
                        <div class="faculty-header">
                            <div class="faculty-avatar">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h3 class="text-center mb-2"><?php echo htmlspecialchars($row['name']); ?></h3>
                            <div class="text-center">
                                <span class="department-badge">
                                    <i class="fas fa-building me-1"></i>
                                    <?php echo htmlspecialchars($row['department']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="faculty-body">
                            <div class="faculty-info">
                                <div class="info-label">Email</div>
                                <div class="info-value">
                                    <i class="fas fa-envelope me-2"></i>
                                    <?php echo htmlspecialchars($row['email']); ?>
                                </div>
                            </div>
                            <div class="faculty-info">
                                <div class="info-label">Phone</div>
                                <div class="info-value">
                                    <i class="fas fa-phone me-2"></i>
                                    <?php echo htmlspecialchars($row['phone']); ?>
                                </div>
                            </div>
                            <div class="faculty-info">
                                <div class="info-label">Designation</div>
                                <div class="info-value">
                                    <i class="fas fa-user-graduate me-2"></i>
                                    <?php echo htmlspecialchars($row['designation']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="faculty-footer">
                            <a href="view_faculty.php?id=<?php echo $row['id']; ?>" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="edit_faculty.php?id=<?php echo $row['id']; ?>" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete_faculty.php?id=<?php echo $row['id']; ?>" title="Delete" 
                               onclick="return confirm('Are you sure you want to delete this faculty member?')">
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