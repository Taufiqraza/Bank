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

$response = array(); // Initialize response array

// Check if account to delete is provided in URL
if (isset($_GET['uaccount'])) {
    $uaccount = $_GET['uaccount'];
    
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'bank');
    if (!$conn) {
        $response['success'] = false;
        $response['message'] = 'Database connection failed.';
        echo json_encode($response);
        exit();
    }
    
    // Prepare and execute delete query
    $sql = "DELETE FROM uacc WHERE uaccount = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $uaccount);
    
    if (mysqli_stmt_execute($stmt)) {
        // Set success message
        $response['success'] = true;
        $response['message'] = 'Account deleted successfully.';
    } else {
        // Set error message
        $response['success'] = false;
        $response['message'] = 'Error deleting account: ' . mysqli_error($conn);
    }
    
    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // If no account to delete is provided in URL
    $response['success'] = false;
    $response['message'] = 'No account specified for deletion.';
}

// Return JSON response
echo json_encode($response);
?>
