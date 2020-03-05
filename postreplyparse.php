
<?php
session_start();
?>

<?php
$oldreplies=0;
$_SESSION["postreplyparse_tid"]="";
$_SESSION["postreplyparse_cid"]="";

$_SESSION["postreplyparse_tid"]=$_SESSION["postreply_tid"];
$_SESSION["postreplyparse_cid"]=$_SESSION["postreply_cid"];

$url=$_SESSION["goback"];


if(isset($_POST['reply_content_submit'])){
	 include('db.php'); 
	
	$_SESSION["postreplyparse_tid"]=$_SESSION["postreply_tid"];
$_SESSION["postreplyparse_cid"]=$_SESSION["postreply_cid"];
		 
	$cid=$_SESSION["postreplyparse_cid"];
	
	$tid=$_SESSION["postreplyparse_tid"];
	
	$commentcreator=$_SESSION["username"];
	
	$commentcontent=$_POST['reply_content'];
	
	echo    $cid ;
	echo	$tid ;
	echo	$commentcreator ;
	echo	$commentcontent;
	
	$sql="INSERT into comment(category_id,topic_id,comment_creator,comment_content,comment_date) 
	 VALUES('".$cid."','".$tid."','".$commentcreator."','".$commentcontent."',now()) ";
	
	 $res=mysqli_query($link,$sql) or die(mysqli_error());
	
	if($res){
		 include('db.php'); 
		
		/*echo"<p> Your reply has been successfully posted.<a href='view_topic.php?cid=".$cid."&tid".$tid."'>Click here to return to the post.</a></p>";*/
		
		$sql2="Select *from topics where id='".$tid."'";
		$res2=mysqli_query($link,$sql2) or die(mysqli_error());
		
			while($row=mysqli_fetch_assoc($res2)){
				
				$oldreplies=$row['topic_replies'];
			}
		  
		  $newreplies=$oldreplies+1;
		
		$sql3="Update topics Set topic_replies='".$newreplies."' where id='".$tid."'";
		$res3=mysqli_query($link,$sql3) or die(mysqli_error());
		$url=$_SESSION["goback"];
		header("location: ".$url);
		
		
		echo"<p> Your reply has been successfully posted.<a href='view_topic.php'>Click here to return to the post.</a></p>";
				
	}
	
	
	else{
		
		
		echo"<p>There was a problem posting your comment.Try later</p>";
	}
	
}



?>