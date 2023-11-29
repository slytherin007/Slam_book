
<?php
session_start(); // Start the session

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('config.php');
// Initialize variables
$user_id = $name = $age = $dob = $contact = $address = $hobbies = $ambitions = $experiences = $quotes = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $updatedName = mysqli_real_escape_string($conn, $_POST['name']);
    $updatedAge = mysqli_real_escape_string($conn, $_POST['age']);
    $updatedDob = mysqli_real_escape_string($conn, $_POST['dob']);
    $updatedAddress = mysqli_real_escape_string($conn, $_POST['address']);
    $updatedContact = mysqli_real_escape_string($conn, $_POST['contact']);
    $updatedHobbies = mysqli_real_escape_string($conn, $_POST['hobbies']);
    $updatedAmbitions = mysqli_real_escape_string($conn, $_POST['ambitions']);
    $updatedExperiences = mysqli_real_escape_string($conn, $_POST['experiences']);
    $updatedQuotes = mysqli_real_escape_string($conn, $_POST['quotes']);


    // Get and sanitize other fields similarly

    $updateSql = "UPDATE user_details SET name='$updatedName', age='$updatedAge',dob='$updatedDob',address='$updatedAddress',contact='$updatedContact', hobbies='$updatedHobbies', ambitions='$updatedAmbitions', experiences='$updatedExperiences', quotes='$updatedQuotes' WHERE id='$user_id'";
    if ($conn->query($updateSql) === TRUE) {
        // Data updated successfully, redirect to the dashboard
        header("Location: dashboard.html");
        exit();
    } else {
        // Error occurred while updating data, handle the error
        echo "Error updating record: " . $conn->error;
        exit();
    }
}

if (isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM user_details WHERE id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $age = $row['age'];
        $dob = $row['dob'];
        $contact = $row['contact'];
        $address = $row['address'];
        $hobbies = $row['hobbies'];
        $ambitions = $row['ambitions'];
        $experiences = $row['experiences'];
        $quotes = $row['quotes'];


        // Get and set other fields similarly
    } else {
        // User not found, handle the error
        echo "User not found";
        exit();
    }
} else {
    // ID parameter not set, handle the error
    echo "ID parameter not set";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="add_form.css">
    <!-- your head content here -->
</head>

<body>
    <div class="container">
        <h2 style="color: #4caf50;">Update Your Details Here: </h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" required value="<?php echo $age; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number:</label>
                    <input type="tel" id="contact" name="contact" pattern="[0-9]{10}" inputmode="numeric" maxlength="10" required>
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
                <input type="submit" value="update">
            </div>
        </form>
    </div>
</body>

</html>
