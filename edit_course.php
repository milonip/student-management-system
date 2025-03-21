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

if(isset($_POST['update_course'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $credits = mysqli_real_escape_string($conn, $_POST['credits']);
    
    $query = "UPDATE courses SET course_name = ?, description = ?, duration = ?, credits = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssiii", $course_name, $description, $duration, $credits, $id);
    
    if(mysqli_stmt_execute($stmt)) {
        header('location: courses.php?success=2');
    } else {
        $error = "Failed to update course. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Same styles as add_course.php */
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
        
        /* ... other styles same as add_course.php ... */
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-edit me-2"></i>Edit Course</h2>
                <p class="mb-0">Update course information below</p>
            </div>

            <form method="POST" action="">
                <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
                
                <div class="mb-3">
                    <label class="form-label">Course Name</label>
                    <input type="text" name="course_name" class="form-control" 
                           value="<?php echo htmlspecialchars($course['course_name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" required><?php 
                        echo htmlspecialchars($course['description']); 
                    ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Duration (Months)</label>
                            <input type="number" name="duration" class="form-control" 
                                   value="<?php echo htmlspecialchars($course['duration']); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Credits</label>
                            <input type="number" name="credits" class="form-control" 
                                   value="<?php echo htmlspecialchars($course['credits']); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <a href="courses.php" class="btn btn-cancel">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                    <button type="submit" name="update_course" class="btn btn-submit">
                        <i class="fas fa-save me-2"></i>Update Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>