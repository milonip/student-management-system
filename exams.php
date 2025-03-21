<?php
session_start();
include 'config.php';
include 'includes/header.php';

// Fetch all courses
$query = "SELECT * FROM courses";
$courses = mysqli_query($conn, $query);

// If form submitted
if(isset($_POST['add_exam'])) {
    $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
    $exam_name = mysqli_real_escape_string($conn, $_POST['exam_name']);
    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);
    $total_marks = mysqli_real_escape_string($conn, $_POST['total_marks']);
    
    // Update the INSERT query
    $query = "INSERT INTO exams (course_id, exam_name, date, total_marks) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "issi", $course_id, $exam_name, $exam_date, $total_marks);
    
    if(mysqli_stmt_execute($stmt)) {
        $success = "Exam added successfully!";
    } else {
        $error = "Error adding exam!";
    }
}

// Fetch existing exams
// Also update the display part
$query = "SELECT e.*, c.course_name, c.course_code 
          FROM exams e 
          JOIN courses c ON e.course_id = c.id 
          ORDER BY e.date DESC";
$exams = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Management - University Management System</title>
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
            margin-left: 50px;
            padding: 30px;
            min-height: 100vh;
            flex: 1;
            background: #f8f9fa;
        }
        
        .exam-container {
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
        
        .btn-add {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            border: none;
        }
        
        .btn-light {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
        }
        
        .btn-light:hover {
            background: rgba(255,255,255,0.3);
            color: white;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="exam-container">
            <div class="form-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="fas fa-file-alt me-2"></i>Exam Management</h2>
                        <p class="mb-0">Schedule and manage exams</p>
                    </div>
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addExamModal">
                        <i class="fas fa-plus me-2"></i>Add New Exam
                    </button>
                </div>
            </div>

            <?php if(isset($success)) { ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php } ?>
            
            <?php if(isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Course</th>
                            <th>Exam Name</th>
                            <th>Date</th>
                            <th>Total Marks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($exam = mysqli_fetch_assoc($exams)) { ?>
                            <tr>
                                <td><?php echo $exam['course_name'] . ' (' . $exam['course_code'] . ')'; ?></td>
                                <td><?php echo $exam['exam_name']; ?></td>
                               
                                <td><?php echo date('d M Y', strtotime($exam['date'])); ?></td>
                                <td><?php echo $exam['total_marks']; ?></td>
                                <td>
                                    <a href="marks.php?exam_id=<?php echo $exam['id']; ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-pen me-1"></i>Enter Marks
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Exam Modal -->
    <div class="modal fade" id="addExamModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <select name="course_id" class="form-select" required>
                                <option value="">Choose...</option>
                                <?php while($course = mysqli_fetch_assoc($courses)) { ?>
                                    <option value="<?php echo $course['id']; ?>">
                                        <?php echo $course['course_name'] . ' (' . $course['course_code'] . ')'; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Exam Name</label>
                            <input type="text" name="exam_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Exam Date</label>
                            <input type="date" name="exam_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Marks</label>
                            <input type="number" name="total_marks" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_exam" class="btn btn-add">Add Exam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>