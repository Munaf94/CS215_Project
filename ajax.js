
function send_ajax_request(event)
{
   
     var x=event.currentTarget.id;
     
     
    var str=x.split("_");
    //console.log(str[0]);
    var xhr=new XMLHttpRequest();
    
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if(str[0]=="like")
          {
            document.getElementById("numOfLikes_" + str[1]).innerHTML= JSON.parse(this.responseText).Countoflikes;
            document.getElementById("numOfDislikes_" + str[1]).innerHTML= JSON.parse(this.responseText).Countofdislikes;
          
          }
          else if(str[0]=="dislike")
          {
           document.getElementById("numOfDislikes_" + str[1]).innerHTML= JSON.parse(this.responseText).Countofdislikes;
           document.getElementById("numOfLikes_" + str[1]).innerHTML= JSON.parse(this.responseText).Countoflikes;
           
          }
       
        }
      };

    xhr.open("POST", "ajax.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("fname=" + x);

    
}
