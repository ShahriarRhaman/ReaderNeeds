<?php
$chats=[];

session_start();
$user  = $_SESSION['user'];
$id = $user['user_id'];
include('templete/connect.php');
if(isset($_POST['contact']))
{
    $R_id =  $_POST['R_id'];
    $sql5 = "Select * from inbox where user_id = $R_id and Reciver_id is Null" ;
    $result5 = mysqli_query($conn,$sql5);
    $c5 = mysqli_fetch_all($result5,MYSQLI_ASSOC);
    if(empty($c5)){
    $sql5 = "INSERT INTO `inbox`( `user_id`) VALUES ('$R_id')"  ;
    
    mysqli_query($conn,$sql5);
    }

    $sql4 = "Select * from inbox where (user_id = $id and Reciver_id = $R_id) OR (user_id = $R_id and Reciver_id = $id)";
    $result4 = mysqli_query($conn,$sql4);
    $c = mysqli_fetch_all($result4,MYSQLI_ASSOC);
    if(empty($c)){

    $sql2 = "INSERT INTO `inbox`( `user_id`,Reciver_id) VALUES ('$R_id','$id')";
    mysqli_query($conn,$sql2);
}



}



$sql = "Select * from inbox where (user_id = $id OR Reciver_id = $id)";
$result = mysqli_query($conn,$sql);
$chat = mysqli_fetch_all($result,MYSQLI_ASSOC);
if(empty($chat)){
    $sql1 = "INSERT INTO `inbox`( `user_id`) VALUES ('$id')";
    mysqli_query($conn,$sql1);
}

if(isset($_POST['msg'])){
    $inbox = $_POST['chatid'];

$sql7 = "SELECT * FROM `conversation` WHERE msg is not null and i_id = $inbox order by time ASC ";
$result7 = mysqli_query($conn,$sql7);
$chats = mysqli_fetch_all($result7,MYSQLI_ASSOC);
if(empty($chats)){
    $sql1 = "INSERT INTO `conversation`(`i_id`,sender_id) VALUES ($inbox,$id)";
    mysqli_query($conn,$sql1);
}

}
if(isset($_POST['send'])){
    $inbox = $_POST['c'];
    $msg = $_POST['sent'];
    $sql8 = "INSERT INTO `conversation`(`i_id`, `msg`,`sender_id`) VALUES ('$inbox','$msg','$id')";
    mysqli_query($conn,$sql8);
    $sql7 = "SELECT * FROM `conversation` WHERE msg is not null and i_id = $inbox order by time ASC";
    $result7 = mysqli_query($conn,$sql7);
    $chats = mysqli_fetch_all($result7,MYSQLI_ASSOC);
    
}










?>

<!DOCTYPE html>
<html lang="en">
  <?php include('templete/header.php'); ?>
    <div id="timeline">
        <form action="contact.php" id ="chats" method="POST" >
        <?php foreach($chat as $c):  ?> 
            <?php if(($c['Reciver_id']==null or $c['user_id']==null) ): ?>
            <?php continue; endif;?>   
            <?php 
            if($c['user_id']==$id){
                $sql = "Select image as p,user_name as name from user where user_id =".$c['Reciver_id'];

            }
            else{
                $sql = "Select image as p,user_name as name from user where user_id =".$c['user_id'];

            }
            
            $result = mysqli_query($conn,$sql);
            $chat = mysqli_fetch_all($result,MYSQLI_ASSOC);
            $profile = $chat['0']['p'];
            $name = $chat['0']['name'];
            
            
            ?>
        <div class="cb">
                <div class="cb1">
                <img src=<?php echo $profile?> alt="">
               <div>
               <p><?php echo $name ?></p>
               </div>
              
               <input type="text" name="chatid" class="pass" value="<?php echo $c['i_id']?>">
               
               <button name="msg">Message</button>
               </div>

            </div> 
            
            <?php endforeach;?> 


                  
            
            
        </form>
       
       <form action="contact.php" id ="chat" method="POST" >

       <?php foreach($chats as $c):?>

        <?php if($c['sender_id']== $id):?>
       <div class="message">
        
       <div class="s">
        <div class="con">
        <p><?php echo $c['msg']; ?></p>
        </div>
       </div>
       </div>
       <?php else: ?>

       <div class="message">
        
        <div class="g">
         <div class="con">
         <p><?php echo $c['msg']; ?></p>
         </div>
        </div>
        </div>
        <?php endif; endforeach;?>

       </div>
       <div class="sent">
       <input type="text" name="c" value=<?php echo $c['i_id']?> class="pass" >
        <input type="text" name="sent" required>
        <button name="send">Send</button>

       </div>
       

      

       </form>
        
      





    </div>
</body>
</html>