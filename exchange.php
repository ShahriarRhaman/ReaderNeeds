

<?php

include('templete/connect.php');
session_start();
$user = $_SESSION['user'];
$id = $user['user_id'];
$sql = "SELECT *,u.image  as profile ,b.image as bimg FROM `exchange` as e left join books as b on e.b_id=b.b_id join user as u on b.user_id = u.user_id";
$result = mysqli_query($conn,$sql);
$ex = mysqli_fetch_all($result,MYSQLI_ASSOC);

$sql3 = "SELECT * ,e.user_id as owner,o.user_id offerer,e.b_id as exbook,o.b_id as orbook FROM `offerbook` as o left join exchange as e on o.e_id=e.e_id where e.user_id = $id and e.user_id!=o.user_id";
$result3 = mysqli_query($conn,$sql3);
$offer = mysqli_fetch_all($result3,MYSQLI_ASSOC);


if(isset($_POST['src'])){
    if($_POST['src']=='search'){

    $search = $_POST['srch'];
    $sql5 = "SELECT *,u.image  as profile ,b.image as bimg FROM `exchange` as e left join books as b on e.b_id=b.b_id join user as u on b.user_id = u.user_id where b.title like '%$search%' and b.status";
    $result5 = mysqli_query($conn,$sql5);
    $ex = mysqli_fetch_all($result5,MYSQLI_ASSOC);

    }
    else if ($_POST['src']=='clear'){
        header('location: bprofile.php');
        
    }


}










?>

<!DOCTYPE html>
<html lang="en">
  <?php include('templete/header.php'); ?>
    <div id="timeline">
        <form action="expost.php" id ="PostForm" method="POST" enctype="multipart/form-data" >
            <div class="total">
            <div id="div1">
            <img src=<?php echo $user['image']?> alt="">
            <h3><?php echo $user['user_name'];?></h3>
            </div>
            <div id="add">
            <input type="text" name="title" placeholder="Title...." required>
            </div>
            <div id="add">
            <input type="text" name="author" placeholder="Author...." required>
            </div>
            <div id="add">
            <textarea name="des" cols="30" rows="4" placeholder="Write Description...." required></textarea>
            </div>
            <div id="add1">
                     <label>
                        <input type="radio" name="EF" value="E"required>
                        Exchange
                    </label>
                    <label>
                        <input type="radio" name="EF" value="F" required>
                        Free
                    </label>
            </div>
            <div id="add1">
            <input type="file" name="file" id="file" required >
            <Button type="submit" name="submit" >Post</Button>
            </div>
            <div id="add1">
               

            </div>




            </div>
            
               
            
        </form>





        <form action="exchange.php" id="search" method="POST">
        
       <input type="text" class="search-input" name="srch" placeholder="Search..." required>
        
        


       <div id="searchdiv">
       <button name="src" value="search">Search</button>
       <button name="src" value="clear">Clear Search</button>
    </div>

        </form>
       
       <form action="arr.php" id ="OfferChat" method="POST" >
         

      <?php if(empty($offer) ): ?> 
        <div id="em">
       <h1 id="empty">Empty</h1>
       <img src="templete/wallet.png" id="ew" alt="">
       
       </div>
       <?php  else: foreach ($offer as $o): ?>
        

        <?php
            $exbook =  $o['exbook'];
            $sql = "Select * from books where b_id = $exbook";
            $result4 = mysqli_query($conn,$sql);
            $re4 = mysqli_fetch_all($result4,MYSQLI_ASSOC);
            $exname = $re4['0']['title'];
            $expic = $re4['0']['image'];

            $orbook =  $o['orbook'];
            $sql = "Select * from books where b_id = $orbook";
            $result5 = mysqli_query($conn,$sql);
            $re5 = mysqli_fetch_all($result5,MYSQLI_ASSOC);
            $orname = $re5['0']['title'];
            $orpic = $re5['0']['image'];
            mysqli_close($conn);
            
            ?>
       <div class="offerBox">
        <div class="forExchange">

        
        <img src=<?php echo $expic?> alt="">
        <div>
        <p>For: <?php echo $exname?> </p>
        <p>Exchange: <?php echo $orname?></p>
        </div>
        
        <img src=<?php echo $orpic?> alt="">
        </div>
        <div class="arbutton">
        <input type="text" name="id" class="pass" value=<?php echo $o['id']; ?> >
        <input type="text" name="bid" class="pass" value=<?php echo $o['b_id']; ?> >
        <Button name="accept">Accept</Button>
        <Button name="reject">Reject</Button>

        </div>
        

       </div>
       <?php endforeach; endif;?>
        

       </div>






       </form>
        
        <Div id="wall">
            <?php foreach ($ex as $e): ?>
            <form class="PostEX" action="exoffer.php" method="POST">
                <div class="total">  
                    <div id="div1">
                        <img src=<?php echo $e['profile'] ?> alt="">
                        <h3><?php echo $e['user_name'] ?></h3>
                        <h4><?php echo $e['created_at_exchange'] ?></h4>
                    </div>
                    <div class ="div21" >
                    <img src="<?php echo $e['bimg'] ?>" alt="">
                    <div>
                    <h3 id="title"><?php echo $e['title'] ?></h3>
                    <p class="describe"><?php echo $e['description'] ?>
                    </p>
                    </div>
                </div>
                <div class="Center">
                   <?php if($e['status']=='E'):?>
                    <input type="text" name="e_id" class="pass" value=<?php echo $e['e_id']; ?>>
                   
                    <Button name="E" type="submit" class="offerbtn" value="E" >Offer Book for Exchange</Button>
                    <?php else: ?>
                        <Button name="F" type="submit" class="offerbtn" value="F">Free</Button>
                        <?php endif;?>
                </div>

             
             </div>

             


            </form>
            <?php endforeach;?>
           
            
            








        </Div>





    </div>
</body>
</html>