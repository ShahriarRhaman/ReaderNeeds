<?php 
include('templete/connect.php');
if(isset($_POST['delete'])){
    $bid = $_POST['del'];
    $sql6 = "DELETE FROM `books` WHERE b_id = $bid";
    
    mysqli_query($conn,$sql6);
   header('location: SellBook.php');
    
}
?>