<?php 


$conn = mysqli_connect('localhost','RN','123','readerneeds');
if(!$conn){
    echo 'error';
}


echo $_POST['id'];



if(isset($_POST['accept'])){
    $id = $_POST['id'];
    $bid = $_POST['bid'];


    $sql1 =  "UPDATE `books` SET `status`='K' WHERE b_id = $b_id";

    $sql= "delete FROM `offerbook` WHERE id = $id";
    
    if(!mysqli_query($conn,$sql)){
       
    }

    mysqli_query($conn,$sqsl);

    header('location: exchange.php');
    
}

if(isset($_POST['reject'])){
    $id = $_POST['id'];
    $sql= "DELETE FROM `offerbook` WHERE id = $id";
    mysqli_query($conn,$sql);
    header('location: exchange.php');

}


?>