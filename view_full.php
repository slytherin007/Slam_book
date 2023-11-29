<?php
include('config.php');

if (isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch user details from the database based on the user ID
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

        // Output user details using HTML template
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <link rel="stylesheet" href="view_full.css"> <!-- Include your CSS file for styling -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
        </head>
        <body>
            <div class="container">
                <h2>User Details</h2>
                <div class="user-details">
                    <p><strong>Name:</strong> <?php echo $name; ?></p>
                    <p><strong>Age:</strong> <?php echo $age; ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo $dob; ?></p>
                    <p><strong>Contact:</strong> <?php echo $contact; ?></p>
                    <p><strong>Address:</strong> <?php echo $address; ?></p>
                    <p><strong>Hobbies:</strong> <?php echo $hobbies; ?></p>
                    <p><strong>Ambitions:</strong> <?php echo $ambitions; ?></p>
                    <p><strong>Experiences:</strong> <?php echo $experiences; ?></p>
                    <p><strong>Quotes:</strong> <?php echo $quotes; ?></p>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        // User not found, handle the error
        echo "User not found";
    }
} else {
    // ID parameter not set, handle the error
    echo "ID parameter not set";
}
?>
