
<?php include 'validate.php';

// Check if the user is not logged in, redirect to login page
if(!isset($_SESSION['uaccount'])) {
    header("Location: index.php");
    exit();
}

// Logout functionality
if(isset($_POST['logout'])) {
    session_destroy();
    header("Location:   index.php");
    exit();
}


 

// Establish database connection
$con = mysqli_connect('localhost', 'root', '', 'Bank');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user details from the database
$account = $_SESSION['uaccount'];
$sql = "SELECT * FROM uacc WHERE uaccount = '$account'";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error fetching user details: " . mysqli_error($con));
}

// Fetch user details
$user = mysqli_fetch_assoc($result);

// Close database connection
mysqli_close($con);


?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bank</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css"> <!-- You can add custom CSS here -->

    <!-- Font Awesome for icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-sm-6">
            <h3 class="text-primary">Bank Account Detail</h3>
        </div>
        <div class="col-sm-6 text-right">
            <!-- Logout Button -->
            <form method="post" action="" class="mt-3">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>

        </div>
    </div>
</div>

<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Account Details</h5>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <strong>Name:</strong> <?php echo $user['uname']; ?>
                        </div>
                        <div class="list-group-item">
                            <strong>Email:</strong> <?php echo $user['uemail']; ?>
                        </div>
                        <div class="list-group-item">
                            <strong>Mobile:</strong> <?php echo $user['umobile']; ?>
                        </div>
                        <div class="list-group-item">
                            <strong>Adhar:</strong> <?php echo $user['uadhar']; ?>
                        </div>
                        <!-- Add more fields as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>


<script src="js/jquery.3.5.1.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
