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

if(isset($_POST['update_student'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $roll_no = mysqli_real_escape_string($conn, $_POST['roll_no']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    
    $query = "UPDATE students SET name = ?, roll_no = ?, class = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $roll_no, $class, $id);
    
    if(mysqli_stmt_execute($stmt)) {
        header('location: students.php?success=2');
    } else {
        $error = "Failed to update student. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin-left: 16.666667%;
            padding: 30px;
        }
        
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        
        .form-header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .form-control {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52,152,219,0.25);
        }
        
        .btn-update {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52,152,219,0.3);
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
            margin-right: 10px;
        }
        
        .btn-cancel:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-user-edit me-2"></i>Edit Student</h2>
                <p class="mb-0">Update student information below</p>
            </div>

            <?php if(isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>

            <form method="POST" action="">
                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" 
                                   value="<?php echo htmlspecialchars($student['name']); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Roll Number</label>
                            <input type="text" name="roll_no" class="form-control" 
                                   value="<?php echo htmlspecialchars($student['roll_no']); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Class</label>
                    <select name="class" class="form-control" required>
                        <option value="">Select Class</option>
                        <option value="Computer Science" <?php echo $student['class'] == 'Computer Science' ? 'selected' : ''; ?>>
                            Computer Science
                        </option>
                        <option value="Information Technology" <?php echo $student['class'] == 'Information Technology' ? 'selected' : ''; ?>>
                            Information Technology
                        </option>
                        <option value="Electronics" <?php echo $student['class'] == 'Electronics' ? 'selected' : ''; ?>>
                            Electronics
                        </option>
                        <option value="Mechanical" <?php echo $student['class'] == 'Mechanical' ? 'selected' : ''; ?>>
                            Mechanical
                        </option>
                    </select>
                </div>

                <div class="text-end mt-4">
                    <a href="students.php" class="btn btn-cancel">Cancel</a>
                    <button type="submit" name="update_student" class="btn btn-update">
                        <i class="fas fa-save me-2"></i>Update Student
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>