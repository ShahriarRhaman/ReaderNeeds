<?php
require('connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $items = $_POST['items'];
    $totalAmount = $_POST['total_amount'];
    $return_by = $_POST['return_by'];
    $note = $_POST['note'];
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $userId = $user['user_id'];
        // Prepare and execute the SQL query
        $sql = "INSERT INTO rent_order (user_id, address, items, total_amount, order_at, return_at, return_by, note)
                VALUES ($userId,'$address', '$items', '$totalAmount',NOW(),DATE_ADD(NOW(), INTERVAL 10 DAY), '$return_by', '$note')";
            
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}
?>

        