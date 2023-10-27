<?php
$conn = mysqli_connect('localhost','RN','123','readerneeds');
if(!$conn){
    echo 'connection error :'. mysqli_conncet_error();
    
}

session_start();
    $user = $_SESSION['user'];
    $id = $user['user_id'];
    $data = $_POST['postdata'];
    
    $path = "";
    if(isset($_FILES)){
     $name = $_FILES['file']['name'];
    $img = $_FILES['file']['tmp_name'];
    move_uploaded_file($img,'Post/img/'.$name);
    $path = 'Post/img/'.$name;

    }
    $sql = "INSERT INTO `post`(`post`,`user_id`, `p_image`) VALUES ('$data','$id','$path')";
    if(mysqli_query($conn,$sql)){
        header('location: bprofile.php');
    } 
    else {
     echo 'query error: ' . mysqli_error($conn);
    } 

?>