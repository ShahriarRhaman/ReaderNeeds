<?php 

include('templete/connect.php');
session_start();
 $user = $_SESSION['user'];
 $id= $user['user_id'];
 $title = $_POST['title'];
 $author = $_POST['author'];
 $des = $_POST['des'];
 $name = $_FILES['file']['name'];
 $img = $_FILES['file']['tmp_name'];
 move_uploaded_file($img,'Books/image/'.$name);
 $img = 'Books/image/'.$name;
 
 

 $sql1 ="INSERT INTO `books`( user_id,`title`, `author`, `price`, `quantity`, `status`, `image`, `condition`) VALUES ($id,'$title','$author','0','1','E','$img','Average')";
 
 



 

 if(mysqli_query($conn,$sql1)){


 }else{
     echo 'query error: ' . mysqli_error($conn);

 }
 


 $sql = "SELECT * FROM `books` WHERE user_id = '$id' and title like '$title'";
 $result = mysqli_query($conn,$sql);
 $books = mysqli_fetch_all($result,MYSQLI_ASSOC); 
 $bookid = $books[0]['b_id'];
 $e_id = $_POST['e_id'];


 $sql = "INSERT INTO `offerbook`( `e_id`, `b_id`, `user_id`) VALUES ('$e_id','$bookid','$id')";
 mysqli_query($conn,$sql);
    header('Location: exchange.php');
 





?>