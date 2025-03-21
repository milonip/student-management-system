<?php
session_start();
include 'config.php';
include 'includes/header.php';

if(!isset($_GET['exam_id'])) {
    header('Location: exams.php');
    exit();
}

$exam_id = mysqli_real_escape_string($conn, $_GET['exam_id']);

// Fetch exam details
$query = "SELECT e.*, c.course_name, c.course_code 
          FROM exams e 
          JOIN courses c ON e.course_id = c.id 
          WHERE e.id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $exam_id);
mysqli_stmt_execute($stmt);
$exam = mysqli_stmt_get_result($stmt)->fetch_assoc();

// If form submitted
if(isset($_POST['save_marks'])) {
    $student_marks = $_POST['marks'];
    
    foreach($student_marks as $student_id => $marks) {
        $marks = mysqli_real_escape_string($conn, $marks);
        
        // Check if marks already exist
        $check_query = "SELECT id FROM marks WHERE exam_id = ? AND student_id = ?";
        $stmt = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($stmt, "ii", $exam_id, $student_id);
        mysqli_stmt_execute($stmt);
        $existing = mysqli_stmt_get_result($stmt)->fetch_assoc();
        
        if($existing) {
            // Update existing marks
            $query = "UPDATE marks SET marks_obtained = ? WHERE exam_id = ? AND student_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "dii", $marks, $exam_id, $student_id);
        } else {
            // Insert new marks
            $query = "INSERT INTO marks (exam_id, student_id, marks_obtained) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "iid", $exam_id, $student_id, $marks);
        }
        mysqli_stmt_execute($stmt);
    }
    
    $success = "Marks saved successfully!";
}

// Fetch students and their marks
$query = "SELECT s.*, m.marks_obtained 
          FROM students s 
          LEFT JOIN marks m ON s.id = m.student_id AND m.exam_id = ?
          ORDER BY s.roll_no";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $exam_id);
mysqli_stmt_execute($stmt);
$students = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Marks - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f8f9fa;
            display: flex;
        }
        
        .dashboard-container {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
            flex: 1;
            background: #f8f9fa;
        }
        
        .marks-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .form-header {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .btn-save {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="marks-container">
            <div class="form-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="fas fa-pen me-2"></i>Enter Marks</h2>
                        <p class="mb-0">
                            <?php echo $exam['exam_name']; ?> - 
                            <?php echo $exam['course_name']; ?> (<?php echo $exam['course_code']; ?>)
                        </p>
                    </div>
                    <a href="exams.php" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Back to Exams
                    </a>
                </div>
            </div>

            <?php if(isset($success)) { ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php } ?>

            <form method="POST">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Roll No</th>
                                <th>Name</th>
                                <th>Marks (Out of <?php echo $exam['total_marks']; ?>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($student = mysqli_fetch_assoc($students)) { ?>
                                <tr>
                                    <td><?php echo $student['roll_no']; ?></td>
                                    <td><?php echo $student['name']; ?></td>
                                    <td>
                                        <input type="number" name="marks[<?php echo $student['id']; ?>]" 
                                               class="form-control" min="0" max="<?php echo $exam['total_marks']; ?>" 
                                               step="0.01" value="<?php echo $student['marks_obtained']; ?>" required>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" name="save_marks" class="btn btn-save">
                        <i class="fas fa-save me-2"></i>Save Marks
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>