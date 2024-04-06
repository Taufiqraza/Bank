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

$msg=""; 
// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'bank');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM uacc";
$result = mysqli_query($conn, $sql);

// Display success message if set
if (isset($_SESSION['success_msg'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_msg'] . '</div>';
    unset($_SESSION['success_msg']); // Clear the session variable
}

// Display error message if set
if (isset($_SESSION['error_msg'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error_msg'] . '</div>';
    unset($_SESSION['error_msg']); // Clear the session variable
}

// Close the database connection
mysqli_close($conn);


?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account List</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css"> <!-- You can add custom CSS here -->
    <style>
        #header {
            background-color: #343a40;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
        }

        #content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }

        #footer {
            background-color: #343a40;
            color: white;
            padding: 20px;
            margin-top: 20px;
        }

        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container col-md-12">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <a class="navbar-brand text-dark" href="all.php">User's Account Details</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link  bg-dark mt-1 rounded mr-1" href="admin.php">Dashboard</a>
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

    <div id="content">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Account Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Address</th>
                <th>Pincode</th>
                <th>Pancard</th>
                <th>Adhar</th>
                <th>Bank</th>
                <th>IFSC</th>
                <th>Account Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['uaccount']; ?></td>
                    <td><?php echo $row['uname']; ?></td>
                    <td><?php echo $row['uemail']; ?></td>
                    <td><?php echo $row['umobile']; ?></td>
                    <td><?php echo $row['ugender']; ?></td>
                    <td><?php echo $row['udate']; ?></td>
                    <td><?php echo $row['uaddress']; ?></td>
                    <td><?php echo $row['upincode']; ?></td>
                    <td><?php echo $row['upancard']; ?></td>
                    <td><?php echo $row['uadhar']; ?></td>
                    <td><?php echo $row['ubank']; ?></td>
                    <td><?php echo $row['uifsc']; ?></td>
                    <td><?php echo $row['uactype']; ?></td>
                    <td>
                        <button onclick="deleteAccount('<?php echo $row['uaccount']; ?>')" class="btn btn-danger btn-sm">Delete</button>
                        <a href="update.php?uaccount=<?php echo $row['uaccount']; ?>" class="btn btn-primary btn-sm">Update</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function deleteAccount(uaccount) {
        // Confirm deletion
        if (confirm('Are you sure you want to delete this account?')) {
            // AJAX request to delete the account
            $.ajax({
                url: 'delete.php',
                type: 'GET',
                data: {uaccount: uaccount},
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Account deleted successfully
                        alert(response.message);
                        // Refresh the page or update the account list
                        location.reload();
                    } else {
                        // Error deleting account
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // AJAX error
                    alert('AJAX request failed: ' + status + ', ' + error);
                }
            });
        }
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>
