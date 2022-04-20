function updateData()
{
     var xhr=new XMLHttpRequest();

     xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {

        var str1=xhr.responseText;
        for(i=0;i<str1.length;i++)
        {
        var str_postid=JSON.parse(xhr.responseText)[i].pid;
        var str_likes=JSON.parse(xhr.responseText)[i].Countoflikes;
        var str_dislike=JSON.parse(xhr.responseText)[i].Countofdislikes;
        
        document.getElementById("numOfLikes_" + str_postid).innerHTML=str_likes;
        document.getElementById("numOfDislikes_" + str_postid).innerHTML= str_dislike;
        console.log("Page Refreshed"); 
    }
        }  
     }
    

    xhr.open("GET","timerJsCall.php",true);
    xhr.send(null);
 

        
       
}

setInterval(updateData, 50000); //50000ms=50s