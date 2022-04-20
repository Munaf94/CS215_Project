<?php
 session_start();
$validate = true;
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/[^\w\s]/";

$email = "";
$error = "";

if (isset($_POST["submitted"]) && $_POST["submitted"])
{
    
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    
    $db = new mysqli("localhost", "muw219", "*munaf*@", "muw219");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }

    //add code here to select * from table User where email = '$email' AND password = '$password'
    // start with $q = 

    $q="SELECT * FROM  User WHERE u_email = '$email' AND u_passwd ='$password';";
      
    $r = $db->query($q);
    
    $row = $r->fetch_assoc();
   

    if($email != $row["u_email"] && $password != $row["u_passwd"])
    {
       
        $validate = false;
    }
    else
    {
       
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false)
        {
            $validate = false;
        }
        
        $pswdLen = strlen($password);
        $passwordMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen < 8 || $passwordMatch == false)
        {
            $validate = false;
        }
       
    }
    if($validate == true)
    {
       
        $_SESSION["email"] = $row["u_email"];
        $_SESSION["name"] = $row["u_sname"];
        $_SESSION["img"] = $row["u_img"];
        $_SESSION["userID"] = $row["uid"];
        //$_SESSION["rid"]="";
        header("Location: home.php");
        $db->close();
        exit();
    }
    else 
    {
        $error = "The email/password combination was incorrect. Login failed.";
        $db->close();
    }
    
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>

    <title>login Page</title>
    <!-- <meta charset="utf-8"/>-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="validate.js"> </script>  
    <link rel="stylesheet" href="style.css" />


</head>

<body>
    <div class="grid-container1">
        <div class="grid-container1-navigation navhover">

            <p class="navelements logo">QuickPost</p>
        </div>
        <div class="grid-container1-navigation">
            <p class="navelements">
                <a href=""></a>
            </p>
        </div>

        <div class="grid-container1-navigation">
            <p class="navelements">
                <a href=""></a>
            </p>
        </div>

        <div class="grid-container1-navigation">
            <p class="navelements">
                <a href=""></a>
            </p>
        </div>

        <div class="grid-container1-navigation  navhover">
            <p class="navelements"><a href="http://www2.cs.uregina.ca/~muw219/Assignment5/signup.php">Sign-up</a></p>
        </div>

        <!-- body -->

        <div class="leftsidebar">
            <aside class="left">
                <img src="Logo.JPG" alt="logo"/>
                <h1>Connecting people globally</h1>
                <p>Join the world of togetherness</p>
                <p>Join Today</p>
                <p><a class="getstartlink" href="http://www2.cs.uregina.ca/~muw219/MyWebsite/signup.html">Get Started</a></p>
            </aside>



        </div>


        <div class="right">
            <!--rightsidebar class used to create nested grids to form wide horizontal grids to show posts-->
           
                <form id="login" class="loginform" method="Post" action="login.php">
                   
                        <div class="Caption">
                            <h1>Login</h1>
                        </div>
                        <input type="hidden" name="submitted" id="submitted" value="1"/>

                    <div class="email">
                        <span id="username_error1" class="error1">Username should be of type: someone@uregina.ca</span>
                        <input type="text" name="email" id="username" placeholder="Username" value="<?=$email?>" />
                        
                    </div>
                 
                    
                    <div class="passwd">
                        <span id="password_error1" class="error1">atleast 1 symbol required.</span>
                        <span id="password_error2" class="error2">length should be 8 characters</span>
                        <input type="password" name="password" id="password" placeholder="8 digit password"/> 
                        
                    </div>
                   
                    <div class="btn">
                        <input type="submit" name="submit"/>
                    </div>
                    <div class="requiredMessages" id="redBox"> 
                        <p id="usernameRequired" >Username is required!</p>
                        <p id="passwordRequired">Password is required!</p>
                    </div>
                    <div class="newAccountLink"><a href="http://www2.cs.uregina.ca/~muw219/MyWebsite/signup.html">Don't have an account?</a></div>

           


                </form>
           
           

        </div>

      
        


        <div class="footer1 General-footer">
            <p class="footerlinks"><a href="">Terms and servie</a></p>
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
    <script type="text/javascript" src="call_validate1.js"> </script>  
</body>

</html>