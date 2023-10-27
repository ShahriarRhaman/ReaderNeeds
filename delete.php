<?php
include('templete/connect.php'); 
session_start();

$id = $_SESSION['p_id'];

 
    $sql1 = "DELETE FROM `react` WHERE p_id = '$id'";
    $sql2 = "DELETE FROM `post` WHERE p_id = '$id'";
    if(mysqli_query($conn,$sql1)){
        echo 'done';
    }
    else{
        echo 'not done';
    }
    if(mysqli_query($conn,$sql2)){
        echo 'done';
    }
    else{
        echo 'not done';
    }

    mysqli_close($conn);
    header('Location: bprofile.php');


?>