<?php
session_start(); // Start the session

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();
}

// Redirect to the login page after logout
header("Location: login.php");
exit();

include('config.php');

if (isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);

    // SQL query to delete the record based on user ID
    $deleteSql = "DELETE FROM user_details WHERE id = '$user_id'";

    if ($conn->query($deleteSql) === TRUE) {
        // Record deleted successfully, redirect to the dashboard or any other page
        header("Location: dashboard.html");
        exit();
    } else {
        // Error occurred while deleting the record, handle the error
        echo "Error deleting record: " . $conn->error;
        exit();
    }
} else {
    // ID parameter not set, handle the error
    echo "ID parameter not set";
    exit();
}
?>
