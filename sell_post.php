<?php
include('templete/connect.php');

session_start();
$user = $_SESSION['user'];
$id = $user['user_id'];


// Establishing a connection to the database

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




    
    


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $title = $_POST['title'];
    $author = $_POST['author'];
    $condition = $_POST['condition'];
    $price = $_POST['price'];

    // ...
// Check if a file was uploaded
if(isset($_FILES['book-picture']) && $_FILES['book-picture']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['book-picture']['tmp_name'];
    $fileName = $_FILES['book-picture']['name'];

    // Specify the directory where you want to store the uploaded files
    $uploadDirectory = 'uploads/sell_books';

    // Create the directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Generate a unique filename to avoid overwriting existing files
    $uniqueFilename = time() . '_' . $fileName;

    // Construct the full path to the uploaded file
    $targetFilePath = $uploadDirectory . $uniqueFilename;

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
        // File upload was successful
    } else {
        echo "Error moving the uploaded file to the destination directory.";
    }
} else {
    echo "No file was uploaded.";
}

// Start session and retrieve user data

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userId = $user['user_id'];
    $userName = $user['user_name'];
}

// Insert data into the database (outside of the file upload condition)
$sql = "INSERT INTO `books`( `title`, `author`, `price`, `quantity`, `status`, `image`, `condition`,user_id) VALUES ('$title','$author','$price',1,'S','$targetFilePath','$condition','$id')";
if(mysqli_query($conn,$sql)){
   
    header("Location: SellBook.php");
}
else {
    echo mysqli_error(mysqli_query($conn,$sql));
}

// if (!$stmt) {
//     die("Error preparing statement: " . $conn->error);
// }

// Bind parameters including user_id




$conn->close();
}
?>