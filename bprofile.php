<?php 
$conn = mysqli_connect('localhost','RN','123','readerneeds');
if(!$conn){
    echo 'connection error :'. mysqli_conncet_error();
}
   

    session_start();

    $userid = $_SESSION['user'];
    $id = $userid['user_id'];
    
    $sql = "SELECT * FROM post as p right JOIN user as u on p.user_id=u.user_id  WHERE u.user_id = $id order by created_at DESC ";

    

    $result = mysqli_query($conn,$sql);
    $post = mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_free_result($result);
    
    


?>

<!DOCTYPE html>
<html lang="en">
   <?php include('templete/header.php');?>
    <div id="time">

        <form id="poarea" action="save.php" method="POST" enctype="multipart/form-data">
            
            <div id="po1">
                <img src=<?php echo $post['0']['image'] ?> alt="profile">
                <textarea name="postdata" cols="10" rows="5" placeholder="write somthing"></textarea>
            </div>
        
            <div id="po2">
            <input type="file" name="file" id="file">
            <button type="submit" name="submit" value="Submit">Post</button>
            </div>
                
         </form>

         <?php foreach($post as $p)  : if($p['p_id']!="") : $pid = $p['p_id']; ?>

        
        
         <div class="post">
            <div class="pro">
                <div class="align1">
                <img src="<?php echo $p['image']?>" alt="profile">
                <div class="proname">
                <p class="tbold"><?php echo $p['user_name']?></p>
                <p class="tbold"><?php echo $p['created_at']?></p>
              </div>
            </div>
              <form class="options" action="delete.php" method="info">
                <Button class="optionButton" type="submit" name="info" value="submit"><?php $_SESSION['p_id'] = $p['p_id']?>Delete Post</Button>
              </form>  
            </div>

           <p class="pwrite"><?php echo $p['post']?> </p>   
            

           <?php if($p['p_image']!="Post/img/" and $p['p_image']!=null ) : ?>
           <div class="postImgdiv">
            <img class="postImg" src=<?php echo $p['p_image']?> alt="image">
           </div> 
           <?php endif;?>
            
            
           <form class="bp" action="info.php" method="POST" >
                 <?php 
                
                $sqlLike = "SELECT COUNT(likes) as 'likes' FROM `react` WHERE p_id = $pid and likes is not null and likes = 1 ";
                $resultLike = mysqli_query($conn,$sqlLike);
                $likes = mysqli_fetch_all($resultLike,MYSQLI_ASSOC);
                $l = $likes['0']['likes'];
                mysqli_free_result($resultLike);

                $sqldisLike = "SELECT COUNT(dislikes) as 'dislikes' FROM `react` WHERE p_id = $pid and dislikes is not null and dislikes = 1 ";
                $resultdisLike = mysqli_query($conn,$sqldisLike);
                $dislikes = mysqli_fetch_all($resultdisLike,MYSQLI_ASSOC);
                $d = $dislikes['0']['dislikes'];
                mysqli_free_result($resultdisLike);
                 
                
                


                ?> 
                <button class="pbutton" name="like" value="Submit" ><img class="react" src=<?php echo 'reaction/like.png' ?> alt=""><?php echo $l?> Likes</Button>
                <Button class="pbutton" name="dislike" value="Submit" ><img class="react" src=<?php echo 'reaction/dislike.png' ?> alt=""> <?php echo $d?> Dislikes</Button>
                <input class="pass" type="text" name="postid" value="<?php echo $p['p_id'] ?>">
                <input class="pass" type="text" name="header" value="bprofile.php">
                <Button class="pbutton" name="Comment" value="Submit" ><img class="react" src=<?php echo 'reaction/comment.png' ?> alt=""> Comment</Button>

            </form>


        </div>
        <?php endif; endforeach; ?>


    
    </div>
</body>
</html>