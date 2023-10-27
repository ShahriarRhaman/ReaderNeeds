<?php
session_start();

if (isset($_SESSION['user'])) {
    // Assuming you have a database connection
    $conn = mysqli_connect("localhost", "RN", "123", "readerneeds");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user_id = $_SESSION['user']['user_id'];

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process form data
        $new_name = $_POST['new-name'];
        $new_email = $_POST['new-email'];

        // Handle profile picture upload (if provided)
        $target_dir = "uploads/"; // Specify the directory where profile pictures will be stored
        $target_file = $target_dir . basename($_FILES["new-picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if a file was uploaded
        if (!empty($_FILES["new-picture"]["tmp_name"])) {
            $check = getimagesize($_FILES["new-picture"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // If the file was uploaded successfully, move it to the target directory
        if ($uploadOk === 1) {
            if (move_uploaded_file($_FILES["new-picture"]["tmp_name"], $target_file)) {
                // Update the user's information in the database
                $update_query = "UPDATE user SET user_name='$new_name', email='$new_email', image='$target_file' WHERE user_id=$user_id";

                if (mysqli_query($conn, $update_query)) {
                    header("Location: profile.php");
                } else {
                    // Error updating the database
                    echo "Error updating profile: " . mysqli_error($conn);
                }
            } else {
                // File upload error
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    mysqli_close($conn);
} else {
    echo "You are not logged in.";
}
?>
