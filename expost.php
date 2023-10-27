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
    $type = $_POST['EF'];
    

    $sql1 ="INSERT INTO `books`( user_id,`title`, `author`, `price`, `quantity`, `status`, `image`, `condition`) VALUES ($id,'$title','$author','0','1','$type','$img','Average')";
    
    



    
   
    if(mysqli_query($conn,$sql1)){

    }else{
        echo 'query error: ' . mysqli_error($conn);

    }
    


    $sql = "SELECT * FROM `books` WHERE user_id = '$id' and title like '$title'";
    $result = mysqli_query($conn,$sql);
    $books = mysqli_fetch_all($result,MYSQLI_ASSOC); 
    $bookid = $books[0]['b_id'];


    $sql2 = "INSERT INTO `exchange`(`b_id`, `user_id`, `description`, `image`) VALUES ($bookid,'$id','$des','$img')";
    if(mysqli_query($conn,$sql2)){
        header('location: exchange.php');
    } 
    else {
     echo 'query error: ' . mysqli_error($conn);
    } 





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>