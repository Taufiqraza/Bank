<?php

session_start();

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

$uaccount = $_GET['uaccount'];

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'bank');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch existing account details
$sql = "SELECT * FROM uacc WHERE uaccount = '$uaccount'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    // If the account doesn't exist, redirect to the account list page
    header('Location: all.php');
    exit();
}

// Handle form submission for updating account
if (isset($_POST['update'])) {
    // Retrieve form data
    // Perform validation if needed
    $name = $_POST['uname'];
    $email = $_POST['uemail'];
    $mobile = $_POST['umobile'];
    $gender = $_POST['ugender'];
    $password = $_POST['upassword'];
    $address = $_POST['uaddress'];
    $pincode = $_POST['upincode'];
    $pancard = $_POST['upancard'];
    $adhar = $_POST['uadhar'];
    $bankname = $_POST['ubankname'];
    $ifsc = $_POST['uifsc'];
    $actype = $_POST['uactype'];

    // Update account details in the database
    $sql = "UPDATE uacc SET 
            uname='$name', 
            uemail='$email', 
            umobile='$mobile', 
            ugender='$gender', 
            pwd='$password', 
            uaddress='$address', 
            upincode='$pincode', 
            upancard='$pancard', 
            uadhar='$adhar', 
            ubank='$bankname', 
            uifsc='$ifsc', 
            uactype='$actype' 
            WHERE uaccount='$uaccount'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success_msg'] = 'Account updated successfully.';
        header('Location: all.php');
        exit();
    } else {
        $_SESSION['error_msg'] = 'Error updating account: ' . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #b9c7c7;
        }

        .container {
            margin-top: 50px;
        }

        .form-control-custom {
            border-radius: 1.25rem;
        }

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
<body>
<div class="container">
    <h2 class="text-center mb-4">Update Account</h2>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="uname">Name</label>
                <input type="text" class="form-control form-control-custom" name="uname" value="<?php echo $row['uname']; ?>" placeholder="Name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="uemail">Email</label>
                <input type="email" class="form-control form-control-custom" name="uemail" value="<?php echo $row['uemail']; ?>" placeholder="Email" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="umobile">Mobile</label>
                <input type="text" class="form-control form-control-custom" name="umobile" value="<?php echo $row['umobile']; ?>" placeholder="Mobile" required>
            </div>
            <div class="form-group col-md-6">
                <label for="ugender">Gender</label>
                <select class="form-control form-control-custom" name="ugender" required>
                    <option value="Male" <?php if ($row['ugender'] === 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($row['ugender'] === 'Female') echo 'selected'; ?>>Female</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="upassword">Password</label>
                <input type="password" class="form-control form-control-custom" name="upassword" value="<?php echo $row['pwd']; ?>" placeholder="Password" required>
            </div>
            <div class="form-group col-md-6">
                <label for="uaddress">Address</label>
                <input type="text" class="form-control form-control-custom" name="uaddress" value="<?php echo $row['uaddress']; ?>" placeholder="Address" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="upincode">Pincode</label>
                <input type="text" class="form-control form-control-custom" name="upincode" value="<?php echo $row['upincode']; ?>" placeholder="Pincode" required>
            </div>
            <div class="form-group col-md-6">
                <label for="upancard">Pancard Number</label>
                <input type="text" class="form-control form-control-custom" name="upancard" value="<?php echo $row['upancard']; ?>" placeholder="Pancard Number" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="uadhar">Adharcard Number</label>
                <input type="text" class="form-control form-control-custom" name="uadhar" value="<?php echo $row['uadhar']; ?>" placeholder="Adharcard Number" required>
            </div>
            <div class="form-group col-md-6">
                <label for="ubankname">Bank Name</label>
                <input type="text" class="form-control form-control-custom" name="ubankname" value="<?php echo $row['ubank']; ?>" placeholder="Bank Name" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="uifsc">IFSC Code</label>
                <input type="text" class="form-control form-control-custom" name="uifsc" value="<?php echo $row['uifsc']; ?>" placeholder="IFSC Code" required>
            </div>
            <div class="form-group col-md-6">
                <label for="uactype">Account Type</label>
                <select class="form-control form-control-custom" name="uactype" required>
                    <option value="Current" <?php if ($row['uactype'] === 'Current') echo 'selected'; ?>>Current</option>
                    <option value="Savings" <?php if ($row['uactype'] === 'Savings') echo 'selected'; ?>>Savings</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-custom" name="update">Update Account</button>
    </form>
</div>
</body>
</html>
