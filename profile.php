<?
session_start();
if(isset($_SESSION["email"]))
{
    $ScreenName= $_SESSION['name'];
    $Username= $_SESSION['email'];
    $userID=$_SESSION['userID'];
    $profileImage= $_SESSION['img'];
   
    $db = new mysqli("localhost", "muw219", "*munaf*@", "muw219");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }

   


    $q1="SELECT DISTINCT a.pid,a.CountOfLikes,b.CountOfDislikes,c.UserID, c.UserProfile,c.Name,c.UserEmail,a.Content,a.PostTime,a.repost_id
     FROM (SELECT Post.pid AS pid,Post.uid As A_UserId, COUNT(Likes.like_id)  AS CountOfLikes,Post.post_content AS Content,
     Post.post_time AS PostTIME,Post.rid AS repost_id FROM (Post LEFT JOIN Likes ON Post.pid=Likes.pid)  GROUP BY Post.pid) 
     AS a INNER JOIN(SELECT Post.pid AS pid,Count(Dislikes.dislike_id)AS CountOfDislikes FROM Post LEFT JOIN Dislikes
      ON Post.pid=Dislikes.pid GROUP BY Post.pid) as b ON a.pid = b.pid INNER JOIN (SELECT User.uid AS UserID,User.u_img AS UserProfile,
      User.u_sname AS Name,User.u_email  As UserEmail FROM Post LEFT JOIN User ON Post.uid=User.uid GROUP BY Post.pid) as c ON
       a.A_UserId=c.UserID WHERE UserID= $userID ORDER BY PostTime asc;";
      
        $r1 = $db->query($q1);  
        $PostDislikes="";
   
}
else
{	
    header("Location: login.php");

}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml" lang="en">
<head>
   
    <title>Profile  Page</title>
   <!-- <meta charset="utf-8"/>-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="style.css"/>
    <script type="text/javascript" src="ajax.js"></script>
  
   
  
</head>
<body style="background-color: rgb(215, 226, 197);">
    <div class="grid-container1">
        <div class="grid-container1-navigation  navhover">
          
        <p class="navelements logo">QuickPost</p>
        </div>
        <div class="grid-container1-navigation  navhover">
            <p class="navelements"><a  href="http://www2.cs.uregina.ca/~muw219/MyWebsite/home.php">Home</a></p>
        </div>

        <div class="grid-container1-navigation  navhover">
            <p class="navelements active"><a href="http://www2.cs.uregina.ca/~muw219/MyWebsite/profile.php">Profile</a></p>
        </div>

        <div class="grid-container1-navigation  navhover">
            <p class="navelements"><a href="http://www2.cs.uregina.ca/~muw219/MyWebsite/post.php">Post</a></p>
        </div>

        <div class="grid-container1-navigation  navhover">
            <p class="navelements"><a href="http://www2.cs.uregina.ca/~muw219/MyWebsite/logout.php">Logout</a></p>
        </div>

        <!-- body -->

        <div class="leftsidebar">
            <div class="userdetails">
                 <img src="<?=$profileImage?>" alt="avatar-image"/>
                <h2><?=$ScreenName?></h2>
                <span><?=$Username?></span>
            </div>
            
           
           
        </div>



        <div class="rightsidebar"> <!--rightsidebar class used to create nested grids to form wide horizontal grids to show posts-->

        <?php
            while($row1 = $r1->fetch_assoc())
            {
            $PostID="";
            $PostContent=$row1["Content"];
            $PostTime=$row1["PostTime"];
            $PostLikes=$row1["CountOfLikes"];
            $PostDislikes=$row1["CountOfDislikes"];
            $RepostId=$row1["repost_id"];


            if($PostID!=$row1["pid"] &&  ($RepostId==NULL || $RepostId=='') )
            {
        ?>
        
           <div class="show-post-templates">
              <div class="left-top">
                  <img src="<?=$profileImage?>" alt="avatar-image"/>
                <p > <?=$ScreenName?></p>
                <span><?=$Username?></span>
                <p class="time"> <?=$PostTime?></p>
            </div>
              <div class="right-top"><?=$PostContent?></div>
              
              <div class="left-bottom"><span id="numOfLikes_<?=$row1['pid']?>"><?=$PostLikes?></span><input type="submit" id="like_<?=$row1['pid']?>" name="likes"  value="Like"/></div>
             
              <div class="center-bottom"><span id="numOfDislikes_<?=$row1['pid']?>"><?=$PostDislikes?></span> <input type="submit" id="dislike_<?=$row1['pid']?>" name="dislikes"  value="DisLike"/></div>
            
              <div class="right-bottom"> <form action="home.php" method="post">
              <input type="hidden" name="repost" value="<?=$row1['pid']?>"/>
              <input type="submit" name="Repost" value="Repost"/>
              </form> </div>
            
           </div> 
         
           <?php
            }
            else 
            {
              
                $q2="select Post.post_content,Post.post_time,User.u_sname,User.u_email,User.u_img from Post Inner Join User
                 On Post.uid=User.uid where Post.pid=$RepostId;";
               
                $r2 = $db->query($q2);
              
                $row2=$r2->fetch_assoc();
                $PostContentOriginal=$row2["post_content"];
                $PostTimeOriginal=$row2["post_time"];
                $PostUsernameOriginal=$row2['u_sname'];
                $PostUserEmailOriginal=$row2['u_email'];
                $PostUserImg=$row2['u_img'];
              
                
        

            ?>


           <div class="show-post-templates">
            <div class="left-top">
                <img src="<?=$profileImage?>" alt="avatar-image"/>
              <p ><?=$ScreenName?></p>
              <span><?=$Username?></span>
              <p class="time"> <?=$PostTime?></p>
          </div>
            <div class="right-top">This one is a repost content</div>
            <div class="repost-right-middle">
                <div class="left-top">
                    <img src="<?=$PostUserImg?>" alt="avatar-image"/>
                  <p > <?=$PostUserEmailOriginal?></p>
                  <span><?=$PostUsernameOriginal?></span>
                  <p class="time"> <?=$PostTimeOriginal?></p>
              </div>
                <div class="right-top"><?=$PostContentOriginal?>
                </div>
                
            </div>
           
              <div class="left-bottom"><span id="numOfLikes_<?=$row1['pid']?>"><?=$PostLikes?></span> <input type="submit" id="like_<?=$row1['pid']?>" name="likes"  value="Like" /></div>
            
              <div class="center-bottom"><span id="numOfDislikes_<?=$row1['pid']?>"><?=$PostDislikes?></span> <input type="submit" id="dislike_<?=$row1['pid']?>" name="dislikes" value="DisLike"/></div>
           

              <div class="right-bottom"> <form action="home.php" method="post">
              <input type="hidden" name="repost" value="<?=$row1['pid']?>"/>
              <input type="submit" name="Repost" value="Repost"/>
              </form></div>
         </div> 

         <?php
            }

            $PostID=$row1["pid"];
            }
            $db->close();
        ?>
       
        
     

        
           </div>
           

          
         
        

        <div></div>


        <div class="footer1 General-footer">
            <p class="footerlinks"><a  href="">Terms and servie</a></p>
        </div>
        <div class="footer2 General-footer">
            <p class="footerlinks"><a href="">@Copyright</a></p>
        </div>
        <div class="footer3 General-footer">
            <p class="footerlinks"><a href="">@twitter Inc.</a></p>
        </div>
        <div class="footer4 General-footer">
            <p class="footerlinks"><a href="">Somelink</a></p>
        </div>
        <div class="footer5 General-footer">
            <p class="footerlinks"><a href="">specific</a></p>
        </div>
        
    </div>
    <script type="text/javascript" src="ajaxCall.js"></script>
    


   

</body>
</html>