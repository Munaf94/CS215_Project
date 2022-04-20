//Login page validation

//global variables to check  status of element valiation while submit event occurs.
var isUsernameVerified;
var isPasswordVerified;
var isScreenNameVerified;
var isDateOfBirthverified;
var isPasswordMatched;

//validating username function
function validateUsername(event)
{
    
    var username=event.currentTarget;
    isUsernameVerified=checkUsername(username);
   
}

function checkUsername(username)
{
    var regex=username.value.search(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/i);
    var usernameError=document.getElementById(username.id+"_error1")
    
    var element=document.getElementById(username.id);

    

    if(regex !=0)
    {
        //show the error
        usernameError.style.display="inline";
        element.style.borderColor="red";
        
        return false;
    }
    else
    {
        //hide the error
        usernameError.style.display="none";
        element.style.borderColor="green";

     
        return true;

    }
    
}

//validating password function
function validatePassword(event)
{
    var password=event.currentTarget;
    var isPasswordVerified=checkPassword(password);
   

}
function checkPassword(password)
{
    var regex=password.value.search(/[^\w\s]/i);
    var passwordError1=document.getElementById(password.id+"_error1");
    var passwordError2=document.getElementById(password.id+"_error2");
    var element=document.getElementById(password.id);
        
    var status=true;
    if(regex < 0)
    {

        //show the error
        passwordError1.style.display="inline";
       
        
        
        status=false;        
    }
    else
    {
        passwordError1.style.display="none";
    }

    if(password.value.length < 8)
    {
          

        //show the error
        passwordError2.style.display="inline";   
        
        
        status=false;
    }
    else
    {
        passwordError2.style.display="none";  
    }
    if(status)
    {
        
       element.style.borderColor="green";
        passwordError2.style.display="none";
        passwordError1.style.display="none";
        
    }
    else
    {
        element.style.borderColor="red";
        
    }
    return status;
   
}

//screenname validation

function validateScreenname(event)
{
    var sName=event.currentTarget;
    var isScreenNameVerified=checkScreenName(sName);
   
}

function checkScreenName(sName)
{
    var ScreenNameError=document.getElementById("ScreenName_error");


    var regex=(/^[A-Za-z0-9\_]+$/);
    if(regex.test(sName.value)==true)
    {
        ScreenNameError.style.display="none";
        sName.style.borderColor="green";
        return false;

    }
    else
    {
        ScreenNameError.style.display="inline";
        sName.style.borderColor="red";
        return true;
    }

}

//validate date of birth function

function validateDOB(event)
{
    var dateOfBirth=event.currentTarget;
    var isDateOfBirthverified=checkDOB(dateOfBirth);

}

function checkDOB(dateOfBirth)
{
    var dob_error=document.getElementById("DOB_msg");


    var regex=(/^(\d{1,2})-(\d{1,2})-(\d{4})$/);
    if(regex.test(dateOfBirth.value)==false)
    {
        dob_error.style.display="inline";
        dateOfBirth.style.borderColor="red";
        return false;

    }
    else
    {
        dob_error.style.display="none";
        dateOfBirth.style.borderColor="green";
        return true;

    }
}

//matching password validation

function matchPassword(event)
{
    var Passwd=document.getElementById("Password");
    var repeatPasswd=document.getElementById("CPassword");
    var isPasswordMatched=checkPasswordRepeated( Passwd, repeatPasswd);
}

function checkPasswordRepeated( passwd,repeatPasswd)
{
    var unMatched=document.getElementById("CPassword_msg");
    if(passwd.value.length>0 && repeatPasswd.value.length>0)
    {

        if(repeatPasswd.value != passwd.value)
        {
            unMatched.style.display="inline";
            repeatPasswd.style.borderColor="red";
            return false;
    
        }
        else
        {
            unMatched.style.display="none";
            repeatPasswd.style.borderColor="green";
            return true;
        }
    }
   
}


//validating login form upon submit event

function validateLoginForm(event)
{
    var form=document.getElementById("login");
    var username=document.getElementById("username");
    var password=document.getElementById("password");
    var errroContainer=document.getElementById("redBox");
    var usernameRequired=document.getElementById("usernameRequired");
    var passwordRequired=document.getElementById("passwordRequired");

    if(username.value==null || username.value=="")
    {
        errroContainer.style.display="block";
        usernameRequired.style.display="block";
        event.preventDefault();
    }
    else
    {
        errroContainer.style.display="none";
        usernameRequired.style.display="none";
    }

    if(password.value==null || password.value=="")
    {
        errroContainer.style.display="block";
        passwordRequired.style.display="block";
        event.preventDefault();
    }
    else
    {
        errroContainer.style.display="none";
        passwordRequired.style.display="none";
    }

    
    if(isUsernameVerified ||isPasswordVerified)
    {
        
    }
    else
    {
        form.style.borderColor="red";
        event.preventDefault();
    }     
    
}

//validating signup form upon event

function validateSignupForm(event)
{
    

    //form and elements
    var form=document.getElementById("register");
    var screenname=document.getElementById("ScreenName");
    var username=document.getElementById("UserName");
    var DOB=document.getElementById("DOB");
    var password=document.getElementById("Password");
    var confirmPasswd=document.getElementById("CPassword");
    var userImage=document.getElementById("UserImage");


    //error messages 
    var errroContainer=document.getElementById("signupContainer");
    var usernameRequired=document.getElementById("emailRequired");
    var passwordRequired=document.getElementById("passwordRequired");
    var screennameRequired=document.getElementById("screennameRequired");
    var DOBRequired=document.getElementById("DOBRequired");
    var imageRequired=document.getElementById("UserprofileRequired");
    var CPasswordRequired=document.getElementById("CpasswordRequired");
    var status;


    if(username.value==null || username.value=="")
    {
        usernameRequired.style.display="block";
        status=false;
        event.preventDefault();
        
    }
    else
    {
        usernameRequired.style.display="none";   
        status=true;
    }
   

    if(password.value==null || password.value=="")
    {
        passwordRequired.style.display="block";
        event.preventDefault();
        status=false;

    }
    else
    {
        passwordRequired.style.display="none";
        status=true;
    }

    if(screenname.value==null || screenname.value=="")
    {
        screennameRequired.style.display="block";
        status=false;
        event.preventDefault();
    }
    else
    {
        status=true;
        screennameRequired.style.display="none";
    }
   

    if(DOB.value==null || DOB.value=="")
    {
        DOBRequired.style.display="block";
        status=false;
        event.preventDefault();
    }
    else
    {
        status=true;
        DOBRequired.style.display="none";
    }

    if(confirmPasswd.value==null || confirmPasswd.value=="")
    {
        CPasswordRequired.style.display="block";
        status=false;
        event.preventDefault();
    }
    else
    {
        status=true;
        CPasswordRequired.style.display="none";   
    }

    if(userImage.value==null || userImage.value=="")
    {
        imageRequired.style.display="block";
        status=false;
        event.preventDefault();
    }   
    else
    {
        status=true;
        imageRequired.style.display="none";
    } 

    if(status==false)
    {
        errroContainer.style.display="block";

    }
    else
    {
        errroContainer.style.display="none";
    }
    

    if(isUsernameVerified ||isPasswordVerified || isScreenNameVerified ||isDateOfBirthverified || isPasswordMatched )
    {
        
    }
    else
    {
        form.style.borderColor="red";
        event.preventDefault();
    }     

   

}

//validating post and repost form

function validatePost(event)
{
    var input=document.getElementById("postform").value;
    var counter=document.getElementById("count");
    count=input.length;
    if(count>256)
    {
        counter.innerHTML="Character limit exceeded";
    }
    else
    {
        counter.innerHTML=256-count;
    }
    

}


//validating like and dislike button

function likeBtn(event)
{
  var value=event.currentTarget;
  value.style.backgroundColor="lightblue";
  value.style.borderColor="black";

} 

function disLikeBtn(event)
{
  var value=event.currentTarget;
  value.style.backgroundColor="khaki";
  value.style.borderColor="black";

} 

