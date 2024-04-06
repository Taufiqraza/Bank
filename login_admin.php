<?php 
include 'validate.php';

// Check if admin is not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit();
}

// Logout functionality
if(isset($_POST['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bank</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">

    <style>
        /* Additional CSS for styling */
    
        .bdy {
            background-color:#f8f9fa;
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

    </style>
</head>

<body class="bdy">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="home.php">Bank</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="all.php">Bank Account List</a>
            </li>
            <!-- Logout Button -->
            <li class="nav-item">
                <!-- HTML code for logout button -->
                <form method="post" action="" class="mt-1">
                    <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<div class="container pt-5">
    <?php echo $msg; ?>
    <h1 class="text-center">Account Form</h1>
    <form method="post" class="img-thumbnail p-4 bg_body" onsubmit="return validateAccountForm()">
        <div class="form-row">
                <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-custom" name="uname">
                </div>
                <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-custom" name="uemail">
                </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                    <label for="mobile">Mobile</label>
                    <input type="text" class="form-control" name="umobile">
            </div>
            <div class="form-group col-md-6 form-inline pt-4">
                    <label for="gender">Gender :-</label>              
                    <label for="male" class="px-3">Male</label>              
                    <input type="radio" value="male" class="form-control mt-2" name="ugen"/>
                    <label for="female" class="px-3">Female</label>
                    <input type="radio" value="female" class="form-control mt-2" name="ugen"/>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="mobile">Date Of Birth</label>
                <input type="date" class="form-control" name="udob">
            </div>
            <div class="form-group col-md-6">
                <label for="password">Create Password</label>                    
                <input type="password" class="form-control" name="upwd"/>
            </div>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="uadd">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="pincode">Pincode</label>
                <input type="text" class="form-control" name="upincode">
            </div>
            <div class="form-group col-md-6">
                <label for="pancard">Pancard Number</label>                    
                <input type="text" class="form-control" name="upancard"/>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="adhar">Adharcard Number</label>
                <input type="text" class="form-control" name="uadhar">
            </div>
            <div class="form-group col-md-6">
                <label for="bank">Bank Name</label>                    
                <input type="text" class="form-control" name="ubankname"/>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="account">Account Number</label>
                <input type="text" class="form-control" name="uaccount">
            </div>
            <div class="form-group col-md-6">
                <label for="ifsc">Ifsc Code</label>                    
                <input type="text" class="form-control" name="uifsc"/>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Acctype">Account Type</label>
                <select name="uactype" class="form-control">
                    <option value="" selected>Account Type</option>
                    <option value="current">Current</option>
                    <option value="saving">Saving</option>
                </select>
            </div>
            <div class="form-group col-md-6 pt-4">
                    <button type="submit" name="asubmit" class="btn btn-custom btn-lg btn-block">Create Account</button>
            </div>
        </div>
    </form>
</div>

<div class="container pt-5">
    <?php echo $err; ?>
    <h1 class="text-center">Account Login</h1>
    <form method="post" action="validate.php" class="img-thumbnail p-5">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="User">User Name</label>
                <input type="text" class="form-control form-control-custom" name="uaccount">
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control form-control-custom" name="pwd">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" name="lgbtn" class="btn btn-custom btn-lg btn-block">Login Account</button>
        </div>
    </form>
</div>

<script src="js/jquery.3.5.1.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
