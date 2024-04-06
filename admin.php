<?php
session_start();

// Check if user is already logged in
if(isset($_SESSION['uaccount'])) {
    header("Location:login_admin.php");
    exit();
}



// Check if form is submitted for login
if(isset($_POST['lgbtn'])) {
    // Check admin credentials (dummy credentials for example)
    $admin_username = 'admin';
    $admin_password = 'admin123';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username === $admin_username && $password === $admin_password) {
        // Admin login successful
        $_SESSION['admin_logged_in'] = true;
        header('location: login_admin.php');
        exit();
    } else {
        $error_message = "Invalid username or password";
    }
}

// Logout functionality
if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        /* Additional CSS for styling */
        .bdy {
            background-color: #f8f9fa;
        }

        /* Custom styling for navigation links */
        .navbar-custom .navbar-nav .nav-link {
            color: #fff;
            padding: 0.5rem 1rem;
        }

        /* Custom styling for form fields */
        .form-control-custom {
            border-color: #ced4da;
            border-radius: 1.25rem;
        }

        /* Custom styling for buttons */
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 1.25rem;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Custom styling for card */
        .card-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        /* Custom styling for alert */
        .alert-custom {
            border-radius: 1.25rem;
        }

        /* Custom styling for heading */
        .heading-custom {
            color: #007bff;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body class="bdy">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Bank</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">User Login</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-body">
                    <?php if(isset($error_message)): ?>
                        <div class="alert alert-danger alert-custom" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    <h1 class="heading-custom">Admin Login</h1>
                    <form method="post" class="img-thumbnail p-5 m-5" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                        <div class="form-row col-md-12">
                            <div class="form-group col-md-12">
                                <label for="User">User Name</label>
                                <input type="text" class="form-control form-control-custom" name="username">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="password">Password</label>
                                <input type="password" class="form-control form-control-custom" name="password">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" name="lgbtn" class="btn btn-custom btn-lg btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
