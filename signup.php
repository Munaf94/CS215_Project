<?php
     
     
$validate = true;
$error = "";
$error_email="";
$error_Pswd="";
$error_Bday="";
$error_Sname="";
$error_img="";
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/i";
$reg_Pswd = "/[^\w\s]/";
$reg_Bday = "/^(\d{1,2})-(\d{1,2})-(\d{4})$/";
$reg_Sname = "/^[A-Za-z0-9\_]+$/";
$email = "";
$date = "";

$target_dir = "uploads/";
$target_file = $target_dir.basename($_FILES["profileImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    
if (isset($_POST["submitted"]) && $_POST["submitted"])
{
    $email = trim($_POST["UserName"]);
    $date = trim($_POST["Dob"]);
    $password = trim($_POST["Password"]);
    $Sname = trim($_POST["ScreenName"]);

    


       
    $db = new mysqli("localhost", "muw219", "*munaf*@", "muw219");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }
    
    $q1 = "SELECT * FROM Users WHERE email = '$email'";
    $r1 = $db->query($q1);
  
    // if the email address is already taken.
    if($r1->num_rows > 0)
    {
        $validate = false;
        $error_email="Email addres already used";
    }
    else
    {
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false)
        {
            $validate = false;
            $error_email="Email should be in correct format and not null.";
        }

        $snameMatch = preg_match($reg_Sname, $Sname );
        if( $Sname == null ||  $Sname == "" || $snameMatch == false)
        {
            $validate = false;
            $error_Sname="ScreenName should not have any symbol or space.";
        }
        
              
        $pswdLen = strlen($password);
        $pswdMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen< 8 || $pswdMatch == false)
        {
            $validate = false;
            $error_Pswd="Password should be less than 8 characters." . "It should have atleast one symbol";
        }

        $bdayMatch = preg_match($reg_Bday, $date);
        if($date == null || $date == "" || $bdayMatch == false)
        {
            $validate = false;
            $error_Bday="Birthday should be of form mm-dd-yyyy and not null.";
        }



        // Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
   if($check !== false) {
       echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        $error_img= "File is not an image.";
       $uploadOk = 0;
      }
    }
    
    
      // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $error_img= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    $validate=false;
    }

    // Check if file already exists
if (file_exists($target_file)) { 
    $uploadOk = 0;
    $validate=false;
    $error_img="Sorry, file already exists.";
  }

    }

    if($validate == true)
    {
        // // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["profileImage"]["name"])). " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }

        $dateFormat = date("Y-m-d", strtotime($date));
      
       $q2="INSERT INTO User(u_email,u_sname,u_dob,u_passwd,u_img) VALUES ('$email','$Sname','$dateFormat','$password','$target_file')";
       $r2 = $db->query($q2);

        if ($r2 === true)
        {
            header("Location: login.php");
            $db->close();
            exit();
        }
       
    }
    else
    {
        $error = "Signup failed.";
        $db->close();
    }

}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml" lang="en">
<head>
   
    <title>Signup  Page</title>
    <!--<meta charset="utf-8"/>-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <link rel="stylesheet" href="style.css"/>
    <script type="text/javascript" src="validate.js"> </script> 

  
</head>
<body class="signupbody">
    <div class="grid-container1">
        <div class="grid-container1-navigation  navhover">
          
        <p class="navelements logo"> QuickPost</p>

        </div>
        <div class="grid-container1-navigation  ">
           
        </div>

        <div class="grid-container1-navigation  ">
           
        </div>

        <div class="grid-container1-navigation  ">
            
        </div>

        <div class="grid-container1-navigation  navhover">
            <p class="navelements"><a href="http://www2.cs.uregina.ca/~muw219/MyWebsite/login.php">Sign-in</a></p>
        </div>

    <aside class="register">
    <p class="signupfailed" ><?=$error?></p>
        <form id="register" action="signup.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="submitted" value="1"/>

            <p class="caption2">Register</p>
           

            <table class="signupform">
              <tr>
                    <td></td>
                    <td><label   id="ScreenName_error" class="errormessages">ScreenName should not have space or non word Character.</label></td>
                </tr>              
                    
                <tr>
                    <td><label for="ScreenName" >ScreenName:</label>
                      </td>
                    <td>  <input class="styleinput" type="text" name="ScreenName" id="ScreenName" autocomplete="off"/> <?=$error_Sname?>
                    </td>                   
                </tr>
                <tr>
                    <td></td>
                    <td><label id="UserName_error1"  class="errormessages">Please enter valid email address like someone@uregina.</label></td>
                </tr>              
                    
                <tr>
                    <td><label  for="UserName">Email:</label>
                        </td>
                    <td><input type="text" class="styleinput" name="UserName"  id="UserName" autocomplete="off" /><?=$error_email?>
                    </td>                    
                </tr>
                <tr>
                    <td></td>
                    <td><label id="DOB_msg"  class="errormessages">Please enter valid date format "mm-dd-yyyy."</label></td>
                </tr>
                <tr>
                    <td><label for="Dob">DOB:</label>
                        </td>
                    <td><input class="styleinput" type="text"  placeholder="mm-dd-yyyy"   name="Dob" id="DOB"/><?=$error_Bday?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><label id="Password_error1"  class="errormessages">Atleast 1 symbol required.</label>
                        <label id="Password_error2"  class="errormessages">Password should be atleast 8 character length.</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="Password">Password:</label>
                        </td>
                    <td><input class="styleinput" type="password" name="Password" id="Password"/><?=$error_Pswd?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><label id="CPassword_msg"  class="errormessages">Passwords do not match!</label></td>
                </tr>
                <tr>
                    <td><label for="CPassword">Conform Password:</label>
                        </td>
                    <td><input type="password" class="styleinput" name="CPassword" id="CPassword"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><label ></label></td>
                </tr>
                <tr>
                    <td ><label for="profileImage"  >Profile picture:</label>
                        </td>
                    <td class="selectImage" ><input  class="selectImageInput" type="file" id="UserImage" class="styleinput" name="profileImage" /><?=$error_img?>
                    </td>
                </tr>
                <tr >
                    <td></td>
                    <td><input  id="buttonstyle" type="submit"  value="Submit"  /><br/></td>

                </tr>
                <tr>
                    <td></td>
                    <td >
                        <div  id="signupContainer" class="SignupRequiredMessages">
                            <p class="signupErrorText" id="screennameRequired">ScreenName is required</p>
                            <p class="signupErrorText" id="emailRequired">Email is required</p>
                            <p class="signupErrorText" id="DOBRequired">Date Of birth is required</p>
                            <p  class="signupErrorText" id="passwordRequired">password is required</p>
                            <p  class="signupErrorText" id="CpasswordRequired">Confirm Password is required</p>
                            <p  class="signupErrorText" id="UserprofileRequired">User profile is required</p>
                        </div>
                       

                    </td>
                </tr>
            </table>
        </form>
    </aside>   
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
    

</body>
<script type="text/javascript" src="call_validate2.js"> </script> 
</html>