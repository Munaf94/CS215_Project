<?php
session_start();
if(isset($_SESSION["email"]))
{
//echo $_POST["fname"];
$userID=$_SESSION['userID'];
$db = new mysqli("localhost", "muw219", "*munaf*@", "muw219");
if ($db->connect_error)
{
    die ("Connection failed: " . $db->connect_error);
    echo "failed";
}
else
{
   $var=preg_split("[_]",$_POST["fname"]);
  
   if($var[0]=="like")
   {
        

         $q1="select * from Likes where pid= $var[1] AND uid=$userID";
         $r1 = $db->query($q1);
         $row1=$r1->fetch_assoc();
         if($row1>0)
         {
             $q2="DELETE FROM Likes WHERE pid=$var[1] AND uid=$userID;";
             $r2 = $db->query($q2);
         }
         else
         {
             $q3="DELETE FROM Dislikes WHERE pid=$var[1] AND uid=$userID;";
             $r3 = $db->query($q3);


             $q4="INSERT INTO Likes(pid,uid) VALUES ($var[1], $userID);";
             $r4 = $db->query($q4);
         }
   }
   else if($var[0]=="dislike")
   {
    

            $q5="select * from Dislikes where pid=$var[1] AND uid=$userID;";
            $r5 = $db->query($q5);

            $row1=$r5->fetch_assoc();
            if($row1>0)
            {
                $q2="DELETE FROM Dislikes WHERE pid=$var[1] AND uid=$userID;";
                $r2 = $db->query($q2);
            }
            else
            {
                $q3="DELETE FROM Likes WHERE pid=$var[1] AND uid=$userID;";
                $r3 = $db->query($q3);


                $q4="INSERT INTO Dislikes(pid,uid) VALUES ($var[1], $userID);";
                $r4 = $db->query($q4);
            }
   }
   else{}

   $q6=" select a.pid,a.Countoflikes,b.Countofdislikes from (select Post.pid,COUNT(Likes.like_id) AS Countoflikes from (Post Left join Likes
    on Post.pid=Likes.pid) Group by Post.pid) As a INNER JOIN(SELECT Post.pid,Count(Dislikes.dislike_id)AS CountOfdislikes FROM Post
     LEFT JOIN Dislikes ON Post.pid=Dislikes.pid GROUP BY Post.pid)as b on a.pid=b.pid where a.pid=$var[1];";

     $result = $db->query($q6);  
     $jsonArray=Array();
     while($row=$result->fetch_assoc())
     {
        $jsonArray=$row;
     }
     echo json_encode( $jsonArray);
     $db->close();


}
}

   
?>