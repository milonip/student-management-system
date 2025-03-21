<?php
session_start();
include 'config.php';
include 'includes/header.php';

$query = "SELECT * FROM courses";
$courses = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin-left: 16.666667%;
            padding: 30px;
        }
        
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
        
        .attendance-table {
            margin-top: 30px;
        }
        
        .btn-generate {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            border: none;
        }
        
        .badge {
            padding: 8px 12px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="attendance-container">
            <div class="form-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="fas fa-chart-bar me-2"></i>Attendance Report</h2>
                        <p class="mb-0">View attendance statistics by course and date range</p>
                    </div>
                    <a href="attendance.php" class="btn btn-light">
                        <i class="fas fa-calendar-check me-2"></i>Mark Attendance
                    </a>
                </div>
            </div>

            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Select Course</label>
                    <select name="course_id" class="form-control" required>
                        <option value="">Choose...</option>
                        <?php while($course = mysqli_fetch_assoc($courses)) { ?>
                            <option value="<?php echo $course['id']; ?>" <?php echo (isset($_GET['course_id']) && $_GET['course_id'] == $course['id']) ? 'selected' : ''; ?>>
                                <?php echo $course['course_name'] . ' (' . $course['course_code'] . ')'; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" required value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" required value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-generate d-block w-100">Generate Report</button>
                </div>
            </form>

            <?php if(isset($_GET['course_id']) && isset($_GET['start_date']) && isset($_GET['end_date'])) { 
                $course_id = mysqli_real_escape_string($conn, $_GET['course_id']);
                $start_date = mysqli_real_escape_string($conn, $_GET['start_date']);
                $end_date = mysqli_real_escape_string($conn, $_GET['end_date']);
                
                $query = "SELECT s.name, s.roll_no, 
                          COUNT(CASE WHEN a.status = 'present' THEN 1 END) as present_count,
                          COUNT(CASE WHEN a.status = 'absent' THEN 1 END) as absent_count,
                          COUNT(a.status) as total_classes,
                          ROUND((COUNT(CASE WHEN a.status = 'present' THEN 1 END) / COUNT(a.status)) * 100, 2) as attendance_percentage
                          FROM students s
                          LEFT JOIN attendance a ON s.id = a.student_id
                          WHERE a.course_id = ? AND a.date BETWEEN ? AND ?
                          GROUP BY s.id, s.name, s.roll_no
                          ORDER BY s.roll_no";
                          
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "iss", $course_id, $start_date, $end_date);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            ?>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Roll No</th>
                                <th>Name</th>
                                <th>Present Days</th>
                                <th>Absent Days</th>
                                <th>Total Classes</th>
                                <th>Attendance %</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['roll_no']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['present_count']; ?></td>
                                    <td><?php echo $row['absent_count']; ?></td>
                                    <td><?php echo $row['total_classes']; ?></td>
                                    <td><?php echo $row['attendance_percentage']; ?>%</td>
                                    <td>
                                        <?php
                                        $percentage = $row['attendance_percentage'];
                                        if($percentage >= 75) {
                                            echo '<span class="badge bg-success">Good</span>';
                                        } elseif($percentage >= 60) {
                                            echo '<span class="badge bg-warning">Average</span>';
                                        } else {
                                            echo '<span class="badge bg-danger">Poor</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>