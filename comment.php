<?php
include('templete/connect.php');
if(isset($_POST['submitcomment']))
{
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $comment = $_POST['comment'];
$sql1 = "INSERT INTO `react`(`p_id`, `user_id`, `comment`) VALUES ('$pid','$id','$comment')";
session_start();
$_SESSION['pid'] = $pid; 
 mysqli_query($conn,$sql1);

 header('location: info.php');


}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <form action=""></form>
</head>
<body>
    
</body>
</html>