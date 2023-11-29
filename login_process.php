<?php
include('config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Fetch hashed password from the database based on the entered username
    $sql = "SELECT password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the entered password with the hashed password from the database
        if (password_verify($password, $hashedPassword)) {
            // Passwords match, redirect to dashboard.html
            header("Location: dashboard.html");
            exit();
        } else {
            // Incorrect password, handle the error (e.g., display an error message)
            echo "Incorrect password";
        }
    } else {
        // User not found, handle the error (e.g., display an error message)
        echo "User not found";
    }
}
?>
