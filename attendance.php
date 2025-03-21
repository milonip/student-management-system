<?php
session_start();
include 'config.php';
include 'includes/header.php';

// Fetch all subjects from courses table
$query = "SELECT * FROM courses";
$subjects = mysqli_query($conn, $query);

// If form submitted
if(isset($_POST['mark_attendance'])) {
    $subject_id = mysqli_real_escape_string($conn, $_POST['subject_id']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $students = $_POST['attendance'];
    
    foreach($students as $student_id => $status) {
        $query = "INSERT INTO attendance (student_id, course_id, date, status) 
                  VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "iiss", $student_id, $subject_id, $date, $status);
        mysqli_stmt_execute($stmt);
    }
    
    $success = "Attendance marked successfully!";
}

// If subject selected, fetch students
$student_list = [];
if(isset($_GET['subject_id']) && isset($_GET['date'])) {
    $subject_id = mysqli_real_escape_string($conn, $_GET['subject_id']);
    $date = mysqli_real_escape_string($conn, $_GET['date']);
    
    $query = "SELECT s.*, a.status 
              FROM students s 
              LEFT JOIN attendance a ON s.id = a.student_id 
              AND a.course_id = ? AND a.date = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "is", $subject_id, $date);
    mysqli_stmt_execute($stmt);
    $student_list = mysqli_stmt_get_result($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management - University Management System</title>
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
            margin-left: 50px; /* Fixed width instead of percentage */
            padding: 30px;
            min-height: 10vh;
            flex: 1;
            background: #f8f9fa;
        }
        
        .attendance-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        
        .form-header {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .attendance-table {
            margin-top: 30px;
        }
        
        .btn-mark {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="attendance-container">
            <div class="form-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="fas fa-calendar-check me-2"></i>Attendance Management</h2>
                        <p class="mb-0">Mark and view student attendance</p>
                    </div>
                    <a href="attendance_report.php" class="btn btn-light">
                        <i class="fas fa-chart-bar me-2"></i>View Attendance Report
                    </a>
                </div>
            </div>

            <form method="GET" class="row g-3">
                <div class="col-5">
                    <label class="form-label">Select Subject</label>
                    <select name="subject_id" class="form-select" required>
                        <option value="">Choose...</option>
                        <?php while($subject = mysqli_fetch_assoc($subjects)) { ?>
                            <option value="<?php echo $subject['id']; ?>">
                                <?php echo $subject['course_name'] . ' (' . $subject['course_code'] . ')'; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-5">
                    <label class="form-label">Select Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">Load Students</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>
    .attendance-container {
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