<?php
// Database configuration
require('connect.php');
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the provided email and password exist in the signup table
    $sql = "SELECT * FROM user WHERE email = '$email' AND pass = '$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
    // Login successful
    $user = $result->fetch_assoc();
    session_start();
    $_SESSION['user'] = $user;
    var_dump($user);
    header("Location: index.php"); // Redirect to index.php
    exit();
    } else {
    // Login failed
    echo "Invalid email or password.";
}
    // Close the database connection
    $conn->close();
}
?>
