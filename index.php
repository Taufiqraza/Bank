<?php 
include 'validate.php';

// Check if user is already logged in
if(isset($_SESSION['uaccount'])) {
    header("Location: user_login.php");
    exit();
}


// Logout functionality
if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank - Account Login</title>

    <!-- Prevent caching -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
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
        /* Custom styling for container */
        .container-custom {
            margin-top: 100px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        /* Custom styling for headings */
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
                <a class="nav-link" href="admin.php">Admin Login</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container pt-5 pb-5 col-md-6 container-custom d-flex flex-column align-items-center">
    <h1 class="heading-custom">Account Login</h1>
    <form method="post" class="img-thumbnail col-md-8 p-4" action="validate.php" onsubmit="return validateForm()">
    <div id="error-msg" class="alert alert-danger" style="display: none;"></div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="user">Account Number</label>
            <input type="text" class="form-control form-control-custom" name="uaccount" id="uaccount">
        </div>
        <div class="form-group col-md-12">
            <label for="password">Password</label>
            <input type="password" class="form-control form-control-custom" name="pwd" id="pwd">
        </div>
    </div>
    <div class="form-group col-md-12">
        <button type="submit" name="lgbtn" class="btn btn-custom btn-lg btn-block">Login Account</button>
    </div>
</form>

</div>
<script>
function validateForm() {
    var uaccount = document.getElementById("uaccount").value;
    var pwd = document.getElementById("pwd").value;
    var errorMsg = document.getElementById("error-msg");

    if (uaccount.trim() === "" || pwd.trim() === "") {
        errorMsg.innerHTML = "Account Number and Password are required";
        errorMsg.style.display = "block";
        return false;
    } else {
        return true;
    }
}
</script>
<script src="js/jquery.3.5.1.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
