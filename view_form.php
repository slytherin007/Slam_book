
<?php
session_start(); // Start the session
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Fetch all user details from the database
$sql = "SELECT * FROM user_details";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="view.css">
</head>

<body>
    <div class="container">
        <h2 style="color: #4caf50;">User Details</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Date of Birth</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Hobbies</th>
                <th>Ambitions</th>
                <th>Experiences</th>
                <th>Quotes</th>
                <th>Actions</th>
            </tr>
            <?php
            // Loop through the database results and display each user's data in a row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>" . $row['dob'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['contact'] . "</td>";
                echo "<td>" . $row['hobbies'] . "</td>";
                echo "<td>" . $row['ambitions'] . "</td>";
                echo "<td>" . $row['experiences'] . "</td>";
                echo "<td>" . $row['quotes'] . "</td>";

                // Add Update and Delete buttons with links to respective pages
                echo "<td><a href='update_form.php?id=" . $row['id'] . "'>Update</a> | <a href='delete_form.php?id=" . $row['id'] . "'>Delete</a> |
                <a href='view_full.php?id=" . $row['id'] . "'>Full View</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>
