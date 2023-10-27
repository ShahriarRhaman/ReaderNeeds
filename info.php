<?php
include('templete/connect.php');
session_start();

    
        if(isset($_POST['postid'])){
            $pid= $_POST['postid'];
        }
        else
        {
            $pid = $_SESSION['pid'];
        }

           
        $user = $_SESSION['user'];
        $id = $user['user_id'];
       
            
            $sql1 = "SELECT * FROM `react` as r JOIN user as u on u.user_id=r.user_id join post as p on r.p_id = p.p_id WHERE r.p_id='$pid' and comment is not null";
            $sql2 = "SELECT * FROM post as p right JOIN user as u on p.user_id=u.user_id  WHERE p.p_id='$pid'";
            $sql3 = "SELECT * FROM  user  WHERE user_id='$id'";
            $result1 = mysqli_query($conn,$sql1);
            $result2 = mysqli_query($conn,$sql2);
            $result3 = mysqli_query($conn,$sql3);
            $react = mysqli_fetch_all($result1,MYSQLI_ASSOC);
            $post = mysqli_fetch_all($result2,MYSQLI_ASSOC);
            $user = mysqli_fetch_all($result3,MYSQLI_ASSOC);

            mysqli_free_result($result2);
            mysqli_free_result($result3);
            

        $p = $post[0];
        $u = $user[0];
    
    

    
        if(isset($_POST['like'])){
           
            

            $sql1 = "SELECT likes,react_id FROM `react` WHERE p_id = $pid and user_id = $id and likes is not null and dislikes is null";            
            $result = mysqli_query($conn,$sql1);
            $rows = mysqli_num_rows($result);
            if($rows==0)
            {
                $sql2 = "INSERT INTO `react`( `p_id`, user_id, `likes`) VALUES ('$pid','$id','1')";
            }
            else
            {
                $like = mysqli_fetch_all($result,MYSQLI_ASSOC);
                mysqli_free_result($result);
                if($like[0]['likes']==1)
                {
                    $rid =$like[0]['react_id'];
                    $sql2 = "UPDATE `react` SET `likes`='0' WHERE react_id = $rid";

                }
                else if($like[0]['likes']==0)
                {
                    $rid = $like[0]['react_id'];
                    $sql2 = "UPDATE `react` SET `likes`='1' WHERE react_id = $rid ";
                }
                
            }
            if(mysqli_query($conn,$sql2)){
                $location =$_POST['header'];
                header("Location: $location");
            }
            else
            {
                echo "mysql";
            }
        
        
        }
        if(isset($_POST['dislike'])){
            
           
            
            $sql1 = "SELECT dislikes,react_id FROM `react` WHERE p_id = $pid and user_id = $id and dislikes is not null and likes is null";            
            $result = mysqli_query($conn,$sql1);
            $rows = mysqli_num_rows($result);
            if($rows==0)
            {
                $sql2 = "INSERT INTO `react`( `p_id`, user_id, `dislikes`) VALUES ('$pid','$id','1')";
            }
            else
            {
                $dislike = mysqli_fetch_all($result,MYSQLI_ASSOC);
                mysqli_free_result($result);
                if($dislike[0]['dislikes']==1)
                {
                    $rid =$dislike[0]['react_id'];
                    $sql2 = "UPDATE `react` SET `dislikes`='0' WHERE  react_id = $rid";

                }
                elseif($dislike[0]['dislikes']==0)
                {
                    $rid =$dislike[0]['react_id'];
                    $sql2 = "UPDATE `react` SET `dislikes`='1' WHERE  react_id = $rid";
                }
                
            }
            if(mysqli_query($conn,$sql2)){
                $location =$_POST['header'];
                    header("Location: $location");
            }
            else
            {
                echo "mysql";
            }
        
        
        }


        
    

    



?>




<!DOCTYPE html>
<html lang="en">
<?php include('templete/header.php'); ?>

<div id="time">
<div class="post">
            <div class="pro">
                <img src=<?php echo $p['image']?> alt="profile">
                <div style="margin-left: 10px;">
                <p class="tbold"><?php echo $p['user_name']?></p>
                <p class="tbold"><?php echo $p['created_at']?></p>
              </div>  
            </div>
            <p class="pwrite"><?php echo $p['post']?></p>

            <?php if($p['p_image']!="Post/img/" and $p['p_image']!=null ) : ?>
            <div class="postImgdiv">
                <img class="postImg" src=<?php echo $p['p_image']?> alt="image">
            </div>
            <?php endif; ?>
            
            <form action="comment.php" method="post" class="commentbox">
                <input class="pass" type="text" name="pid" value=<?php echo $pid?> >
                <input class="pass" type="text" name="id" value=<?php echo $id?> >
                <img class="commentprofile" src=<?php echo $u['image']?> alt="">
                <textarea class="commentarea" name="comment" id="" cols="28" rows="1"></textarea>
                <button type="submit" name="submitcomment" value="submit" class="commentbutton" >Comment</button>
            </form>
            
            <?php foreach($react as $r):?>
            <DIV class="commentbox1">
               
                <div class="commentdiv">
               
                    <img class="commentprofile1" src=<?php echo $r['image']?> alt="">
                   <div style="width:80%;">
                   <p class="tbold1"><?php echo $r['user_name'] ?> <?php echo $r['reacted_at'] ?> </p>

                   </div>
                    
                    <form action="deleteComment.php" method="POST" class="commentDeleteForm">
                        <input class="pass" type="text" name="deleteComment" value=<?php echo $r['react_id']?>>
                        <input class="pass" type="text" name="post" value=<?php echo $r['p_id']?>>
                        <button type="Submit" name="CommentDelete" value="Delete" class="commentbutton1"  >Delete</button>
                    </form>
                </div>
                    <div>
                    <p class="comment"><?php echo $r['comment'] ?></p>
                    </div>
                </DIV>
             <?php endforeach;?>
            



        </div>




</div>
    
</body>
</html>