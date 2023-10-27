<?php
// Database configuration
require('connect.php');
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    // Handle the uploaded image
    $target_directory = "uploads/"; // Set the directory where you want to store uploaded images
    $target_file = $target_directory . basename($_FILES["new-picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the image file is valid
    if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
        if (move_uploaded_file($_FILES["new-picture"]["tmp_name"], $target_file)) {
            // Image uploaded successfully, now insert data into the database
            $sql = "INSERT INTO user (user_name, email, phone_number, image, pass) VALUES ('$username', '$email', '$phone_number', '$target_file', '$password')";

            if ($conn->query($sql) === TRUE) {
                header("Location: login.html"); // Redirect to login page
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
    }

    // Close the database connection
    $conn->close();
}
?>



<?php
// Database configuration
$host = 'localhost';
$db_user = 'RN';
$db_pass = '123';
$db_name = 'readerneeds';

// Connect to the database
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $password = $_POST['password'];

    // Insert data into the signup table
    $sql = "INSERT INTO user (user_name, email, pass) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === true) {
        // Signup successful
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
