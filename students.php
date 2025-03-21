<?php
session_start();
include 'config.php';
include 'includes/header.php';

// Fetch all students
$query = "SELECT * FROM students ORDER BY name";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin-left: 16.666667%;
            padding: 30px;
        }
        
        .student-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        
        .student-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .search-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .btn-add-student {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-add-student:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            color: white;
        }
        
        .student-actions a {
            color: #3498db;
            margin: 0 5px;
            transition: all 0.3s ease;
        }
        
        .student-actions a:hover {
            color: #2980b9;
            transform: scale(1.1);
        }
        
        .table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .table thead {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }
        
        .table th {
            border: none;
            padding: 15px;
        }
        
        .table td {
            padding: 15px;
            vertical-align: middle;
        }
        
        .status-active {
            background: #2ecc71;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-user-graduate me-2"></i>Students Management</h2>
            <a href="add_student.php" class="btn btn-add-student">
                <i class="fas fa-plus me-2"></i>Add New Student
            </a>
        </div>

        <!-- Search Box -->
        <div class="search-box">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" id="searchStudent" placeholder="Search students...">
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="filterClass">
                        <option value="">All Classes</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Information Technology">Information Technology</option>
                        <!-- Add more options based on your classes -->
                    </select>
                </div>
            </div>
        </div>

        <!-- Students Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['roll_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['class']); ?></td>
                            <td><span class="status-active">Active</span></td>
                            <td class="student-actions">
                                <a href="view_student.php?id=<?php echo $row['id']; ?>" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="edit_student.php?id=<?php echo $row['id']; ?>" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="delete_student.php?id=<?php echo $row['id']; ?>" title="Delete" 
                                   onclick="return confirm('Are you sure you want to delete this student?')">
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>