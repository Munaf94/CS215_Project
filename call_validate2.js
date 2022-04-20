document.getElementById("UserName").addEventListener("change",validateUsername,false);

document.getElementById("Password").addEventListener("change",validatePassword,false);

document.getElementById("ScreenName").addEventListener("change",validateScreenname,false);

document.getElementById("DOB").addEventListener("change",validateDOB,false);


document.getElementById("CPassword").addEventListener("keyup",matchPassword,false);

document.getElementById("Password").addEventListener("keyup",matchPassword,false);



document.getElementById("register").addEventListener("submit",validateSignupForm,false);
