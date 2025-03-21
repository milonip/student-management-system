<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)), url('images/university.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            animation: fadeInUp 1s ease;
        }

        .feature-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .feature-card img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .feature-card:hover img {
            transform: scale(1.1);
        }

        .card-body {
            padding: 2rem 1.5rem;
        }

        .card-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background: #3498db;
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .stats-section {
            background: #f8f9fa;
            padding: 5rem 0;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #3498db;
            margin-bottom: 1rem;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark position-absolute w-100" style="z-index: 100; background: rgba(0,0,0,0.3);">
        <div class="container">
            <a class="navbar-brand" href="#">UMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Update the navbar section -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 hero-content">
                    <h1 class="display-3 fw-bold mb-4">Transform Your Educational Management</h1>
                    <p class="lead mb-4">A comprehensive solution for managing students, courses, and faculty with ease and efficiency.</p>
                    <a href="login.php" class="btn btn-primary btn-lg">Get Started <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="stat-card">
                        <i class="fas fa-users fa-2x mb-3 text-primary"></i>
                        <div class="stat-number">1000+</div>
                        <h5>Active Students</h5>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="stat-card">
                        <i class="fas fa-book fa-2x mb-3 text-primary"></i>
                        <div class="stat-number">50+</div>
                        <h5>Courses Offered</h5>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="stat-card">
                        <i class="fas fa-chalkboard-teacher fa-2x mb-3 text-primary"></i>
                        <div class="stat-number">100+</div>
                        <h5>Expert Faculty</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container py-5">
        <h2 class="text-center mb-5 display-4">Our Features</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-card card">
                    <img src="images/students.jpg" class="card-img-top" alt="Students">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user-graduate me-2"></i>Student Management</h5>
                        <p class="card-text">Comprehensive student information system with easy tracking and updates.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card card">
                    <img src="images/courses.jpg" class="card-img-top" alt="Courses">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-book me-2"></i>Course Management</h5>
                        <p class="card-text">Efficiently manage courses, schedules, and academic programs.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card card">
                    <img src="images/faculty.jpg" class="card-img-top" alt="Faculty">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-chalkboard-teacher me-2"></i>Faculty Portal</h5>
                        <p class="card-text">Dedicated faculty management system for better coordination.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>