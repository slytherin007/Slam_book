<?php
session_start(); // Start the session
include('config.php'); // Include your database connection file

// Check if the user is already logged in, redirect to dashboard if true
if(isset($_SESSION['username'])) {
    header("Location: dashboard.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check the username and password in the database
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username and password are correct, set session variables and redirect to dashboard
        $_SESSION['username'] = $username;
        header("Location: dashboard.html");
        exit();
    } else {
        // Username or password is incorrect, show error message
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css"> <!-- Include your CSS file here -->
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        if(isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>

</html>
