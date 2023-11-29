<?php
session_start(); // Start the session

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('config.php'); // Include your database connection file



// Check if the user is already logged in, redirect to dashboard if true


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $contact = $_POST['contact']; // Remove non-numeric characters from phone number
        $hobbies = $_POST['hobbies'];
        $ambitions = $_POST['ambitions'];
        $experiences = $_POST['experiences'];
        $quotes = $_POST['quotes'];

// SQL query to insert data into the database
$sql = "INSERT INTO user_details (name, age, dob, address, contact, hobbies, ambitions, experiences, quotes) 
        VALUES ('$name', '$age', '$dob', '$address', '$contact', '$hobbies', '$ambitions', '$experiences', '$quotes')";

if ($conn->query($sql) === TRUE) {
    // Data inserted successfully, display a popup message
    echo "<script>alert('Data inserted successfully!');</script>";
    header("Location: dashboard.html");
    exit();
} else {
    // Error occurred while inserting data, display a popup message
    echo "<script>alert('Error: " . $conn->error . "');</script>";
}

// Close the database connection
$conn->close();
    }?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="add_form.css">
    <title>Details Form</title>
</head>

<body>
    <div class="container">
        <h2 style="color: #7db17f;">Fill Your Details Here: </h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number:</label>
                    <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" inputmode="numeric" 
                    maxlength="10" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" maxlength="100"></textarea>
                </div>
                <div class="form-group">
                    <label for="hobbies">Hobbies:</label>
                    <textarea id="hobbies" name="hobbies" maxlength="100"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="ambition">Ambition:</label>
                    <textarea id="ambition" name="ambitions" maxlength="100"></textarea>
                </div>
                <div class="form-group">
                    <label for="experience">Memorable Experience:</label>
                    <textarea id="experience" name="experiences" maxlength="100"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="quotes">Quotes:</label>
                    <textarea id="quotes" name="quotes" maxlength="100"></textarea>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>

</html>
