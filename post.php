<?php

session_start();
		  
//If nobody is logged in, display login and signup page.
if(isset($_SESSION["email"]))
{
   
    echo "Welcome, logged in as:  " .$_SESSION['name'].  "<br />" ;	
    $ScreenName= $_SESSION['name'];
    $Username= $_SESSION['email'];
    $userID=$_SESSION['userID'];
    $profileImage= $_SESSION['img'];
    
 
   
  
  

    if (isset($_POST["submitted"]) && $_POST["submitted"] )
    {
        $postContent=$_POST['postform'];
       

        $db = new mysqli("localhost", "muw219", "*munaf*@", "muw219");
        if ($db->connect_error)
        {
            die ("Connection failed: " . $db->connect_error);
        }
       
        

       
        
        if($_SESSION["rid"] >0)
        {

       
            $RID=$_SESSION['rid'];

      
           $q2="INSERT INTO Post(uid,post_content,rid) VALUES ('$userID', '$postContent','$RID')";
             $r2 = $db->query($q2);

             if ($r2 === true)
             {
                $_SESSION["rid"]=0;
                 header("Location: home.php");
                $db->close();
                 exit();
             }
            
      
        }
        else
        {
            
            $q2="INSERT INTO Post(uid,post_content) VALUES ('$userID', '$postContent')";
             $r2 = $db->query($q2);

             if ($r2 === true)
             {
                 header("Location: home.php");
                $db->close();
                 exit();
             }
            
            
          
        }
     
      
       
    }
   
    
   

//     if($OriginalPostIDForRepost != NULL ||$OriginalPostIDForRepost1=" "  )
//     {

   

//     $db = new mysqli("localhost", "muw219", "*munaf*@", "muw219");
//     if ($db->connect_error)
//     {
//         die ("Connection failed: " . $db->connect_error);
//     }
    
//     $q1="select Post.post_content,Post.post_time,User.u_sname,User.u_email,User.u_img from Post Inner Join User
//     On Post.uid=User.uid where Post.pid= $OriginalPostIDForRepost";
//     $r1=$db->query($q1);



//     $row=$r1->fetch_assoc();
  
//     $PostUsernameOriginal=$row["u_sname"];
//     $PostUserEmailOriginal=$row["u_email"];
//     $PostContentOriginal=$row["post_content"];
//     $PostTimeOriginal=$row["post_time"];
//     $PostUserImg=$row["u_img"];
    
//     $db->close();

// }

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
    <!--<meta charset="utf-8"/>-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script type="text/javascript" src="validate.js"> </script>  
    <link rel="stylesheet" href="style.css"/>

  
</head>
<body class="post-page-body">
    <div class="grid-container1">
        <div class="grid-container1-navigation " >
          
        <p class="navelements logo navhover">QuickPost</p>
        </div>
        <div class="grid-container1-navigation  navhover">
            <p class="navelements"><a  href="http://www2.cs.uregina.ca/~muw219/MyWebsite/home.php">Home</a></p>
        </div>

        <div class="grid-container1-navigation  navhover">
            <p class="navelements"><a href="http://www2.cs.uregina.ca/~muw219/MyWebsite/profile.php">Profile</a></p>
        </div>

        <div class="grid-container1-navigation  navhover">
            <p class="navelements active"><a href="http://www2.cs.uregina.ca/~muw219/MyWebsite/post.php">Post</a></p>
        </div>

        <div class="grid-container1-navigation  navhover">
            <p class="navelements"><a href="http://www2.cs.uregina.ca/~muw219/MyWebsite/logout.php">Logout</a></p>
        </div>

       
        <!-- body -->
        <div> 

        </div>
        
      
     



        <form class="Post-form" action="post.php" method="Post">
        <input type="hidden" name="submitted" value="1"/>
        

            <div class="top-space">     
                  </div>
           
            <div class="form-elements1">
            <div class="left-top postdiv">
                 <input type="hidden" name="repostId" value="<?=$_POST["repost"]?>">
              </div>
              <div></div>
               <textarea name="postform" id="postform" cols="40" rows="7" maxlength="300"  placeholder="Enter some text here"></textarea>
               <h2>Characters remaining: <span  id="count" class="numOfcharacters">256</span></h2>
            </div> 
            
        
            <div class="form-elements2"><input type="submit" value="post"/></div>
           
</form>

        <div> </div>
       
         
        

        


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
    <script type="text/javascript" src="call_validatePost.js"> </script>  

</body>
</html>