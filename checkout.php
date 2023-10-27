<?php
require('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $items = $_POST['items'];
    $totalAmount = $_POST['Total_Amount'];
    $note = $_POST['note'];

   session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userId = $user['user_id'];
        
        // Use prepared statements to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO book_order (user_id, address, items, total_amount, note) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt) {
            $stmt->bind_param("issss", $userId, $address, $items, $totalAmount, $note);
            
            if ($stmt->execute()) {
                header("Location: index.php");
            } else {
                echo "Error: " . $stmt->error;
            }
            
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
        
        $conn->close();
    }
}
?>
