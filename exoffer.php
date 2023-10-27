

<?php

include('templete/connect.php');
session_start();
$user = $_SESSION['user'];
$sql = "SELECT *,u.image  as profile ,b.image as bimg FROM `exchange` as e left join books as b on e.b_id=b.b_id join user as u on b.user_id = u.user_id";
$result = mysqli_query($conn,$sql);
$ex = mysqli_fetch_all($result,MYSQLI_ASSOC);


if(isset($_POST['F'])){
    header('location: contact.php');


}







?>

<!DOCTYPE html>
<html lang="en">
  <?php include('templete/header.php'); ?>
    <div id="timeline">
        <form action="offerdone.php" id ="PostForm" method="POST" enctype="multipart/form-data" >
            <div class="total">
            <div id="div1">
            <img src=<?php echo $user['image']?> alt="">
            <h3><?php echo $user['user_name'];?></h3>
            </div>
            <div id="add">
            <input type="text" name="title" placeholder="Title....">
            </div>
            <div id="add">
            <input type="text" name="author" placeholder="Author....">
            </div>
            <div id="add">
            <textarea name="des" cols="30" rows="4" placeholder="Write Description...."></textarea>
            </div>
            <div id="add1">
            <input type="file" name="file" id="file" >
            <input type="text" name="e_id" class="pass" value=<?php echo $_POST['e_id']; ?>>
            <Button type="submit" name="submit" >Offer Book</Button>
            </div>
            <div id="add1">
               

            </div>




            </div>
            
               
            
        </form>





        
           
            





</body>
</html>