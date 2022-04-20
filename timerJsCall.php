

<?php
    session_start();
    if(isset($_SESSION["email"]))
    {
   
    $userID=$_SESSION['userID'];
    $db = new mysqli("localhost", "muw219", "*munaf*@", "muw219");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
        echo "failed";
    }
    else
    {

   
     $q6=" select a.pid,a.Countoflikes,b.Countofdislikes from (select Post.pid,COUNT(Likes.like_id) AS Countoflikes from (Post Left join Likes
    on Post.pid=Likes.pid) Group by Post.pid) As a INNER JOIN(SELECT Post.pid,Count(Dislikes.dislike_id)AS CountOfdislikes FROM Post
     LEFT JOIN Dislikes ON Post.pid=Dislikes.pid GROUP BY Post.pid)as b on a.pid=b.pid";
   
   
     $result = $db->query($q6);  
    
     $jsonArray=Array();
     
     while($row=$result->fetch_assoc())
     {
        $jsonArray[]=$row;
     }
  
   
      echo json_encode($jsonArray);
      $db->close();
    }
}
?>