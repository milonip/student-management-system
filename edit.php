<?php
session_start();
include 'config.php';

if(!isset($_SESSION['username'])) {
    header('location: login.php');
}

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM students WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);

    if(!$student) {
        header('location: dashboard.php');
    }
}

if(isset($_POST['update_student'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $roll_no = mysqli_real_escape_string($conn, $_POST['roll_no']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    
    // Check if roll number exists for other students
    $check_query = "SELECT * FROM students WHERE roll_no='$roll_no' AND id!='$id'";
    $check_result = mysqli_query($conn, $check_query);
    
    if(mysqli_num_rows($check_result) > 0) {
        $error = "Roll number already exists. Please use a different roll number.";
    } else {
        $query = "UPDATE students SET name='$name', roll_no='$roll_no', class='$class' WHERE id='$id'";
        mysqli_query($conn, $query);
        header('location: dashboard.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Edit Student</h5>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)) { ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $student['name']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Roll No</label>
                                <input type="text" name="roll_no" class="form-control" value="<?php echo $student['roll_no']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Class</label>
                                <input type="text" name="class" class="form-control" value="<?php echo $student['class']; ?>" required>
                            </div>
                            <button type="submit" name="update_student" class="btn btn-primary">Update Student</button>
                            <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>