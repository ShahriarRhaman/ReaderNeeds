<?php 
include('templete/connect.php');

    session_start();
    $user = $_SESSION['user'];
    $sql = "SELECT * FROM post as p left JOIN user as u on p.user_id=u.user_id order by created_at desc";
    

    $result = mysqli_query($conn,$sql);
    $post = mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_free_result($result);
    








?>
<!DOCTYPE html>
<html>
<?php include('templete/header.php'); ?>


<div id="time">
       
        
            
       <?php foreach($post as $p)  :  $pid = $p['p_id'] ?>
         <div class="post">
             <div class="pro">
                 <img src=<?php echo $p['image'] ?> alt="profile">
                 <div style="margin-left: 10px;">
                 <p class="tbold"><?php echo $p['user_name'] ?></p>
                 <p class="tbold"><?php echo $p['created_at']?></p>
               </div>  
             </div>
             <p class="pwrite"><?php echo $p['post']?></p>
             <?php if($p['p_image']!="Post/img/" and  $p['p_image']!=null ) : ?>
            <div class="postImgdiv">
             <img class="postImg" src=<?php echo $p['p_image']?> alt="image">
            </div> 
            <?php endif;?>
             
            <form class="bp" action="info.php" method="POST" >
                 <?php 
                 
                 $sqlLike = "SELECT COUNT(likes) as 'likes' FROM `react` WHERE p_id = $pid and likes = 1 ";
                 $resultLike = mysqli_query($conn,$sqlLike);
                 $likes = mysqli_fetch_all($resultLike,MYSQLI_ASSOC);
                 $l = $likes['0']['likes'];
                 mysqli_free_result($resultLike);
 
                 $sqldisLike = "SELECT COUNT(dislikes) as 'dislikes' FROM `react` WHERE p_id = $pid and dislikes = 1 ";
                 $resultdisLike = mysqli_query($conn,$sqldisLike);
                 $dislikes = mysqli_fetch_all($resultdisLike,MYSQLI_ASSOC);
                 $d = $dislikes['0']['dislikes'];
                 mysqli_free_result($resultdisLike);
                 ?>
                 <button class="pbutton" name="like" value="Submit" ><img class="react" src=<?php echo 'reaction/like.png' ?> alt=""><?php echo $l?> Likes</Button>
                 <Button class="pbutton" name="dislike" value="Submit" ><img class="react" src=<?php echo 'reaction/dislike.png' ?> alt=""> <?php echo $d?> Dislikes</Button>
                 <input class="pass" type="text" name="postid" value="<?php echo $p['p_id'] ?>">
                 <input class="pass" type="text" name="header" value="blog.php">
                 <Button class="pbutton" name="Comment" value="Submit" ><img class="react" src=<?php echo 'reaction/comment.png' ?> alt=""> Comment</Button>
 
             </form>
 
 
 
         </div>
         <?php endforeach; ?>
 
 
   
 
     </div>
    
     
     
    














</body>
</html>
