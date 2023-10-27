<?php
include('templete/connect.php');
if(isset($_POST['CommentDelete']))
{
    $rid = $_POST['deleteComment'];
    $pid = $_POST['post'];
$sql1 = "Delete from react where react_id = '$rid'";
session_start();
$_SESSION['pid'] = $pid; 
 mysqli_query($conn,$sql1);

 header('location: info.php');


}
