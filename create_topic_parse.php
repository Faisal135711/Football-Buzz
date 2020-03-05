<?php
session_start();

?>


<?php
$_SESSION["create_topic_parse_cateid"]="";

$_SESSION["create_topic_parse_cateid"]=$_SESSION["index1_cateid"];
	  
	  if (!isset($_SESSION['signInUserName']) && !isset($_SESSION['signUpUserName'])) {
    header('location: homepagewithoutlogin.php');
		  
	  }
		  
?>

<?php

$_SESSION["create_topic_parse_cateid"]=$_SESSION["index1_cateid"];
 if(isset($_POST['topic_submit'])){
	 
	 if($_POST['topic_title'] == "" || $_POST['topic_content']=="" ){
		 
		 echo "YOU DIDN'T FILL BOTH THE FIELDS.PLEASE RETURN TO HOMEPAGE";		 
	 }
	 
	 else{
		 
		 include('db.php'); 
		 
		 $value1="12414144";
		 
		 $sql2 = "INSERT INTO test(name, email, password) Values ('".$value1."','".$value1."','".$value1."') ";
		 
		 $res2=mysqli_query($link,$sql2) or die(mysqli_error());
		 
		/* $cid=$_POST['cid'];
		 $title=$_POST['topic_title'];
		 $views=$_POST['topic_views'];
		 $date=$_POST['topic_date'];
		 $creator=$_POST['topic_creator'];
		 $cateid=$_POST['category_id'];
		 $content=$_POST['topic_content'];
		 $lastuser=$_POST['topic_last_user'];
		 $replydate=$_POST['topic_reply_date'];
		 $status=$_POST['topic_status'];
		 $image=$_POST['topic_image'];
		  $tid=$_POST['id'];
		 
		 
		 $sql = "INSERT INTO topics(category_id, topic_title, topic_content, topic_creator, topic_last_user, topic_date, topic_reply_date, topic_views, topic_status, topic_image) VALUES('".$cid."','".$title."','".$content."','".$creator."','".$lastuser."',now(),now(),'".$views."','".$status."','".$image."' ) ";
		 
		 $res=mysqli_query($link,$sql) or die(mysqli_error());*/
		 
							
		 $title=$_POST['topic_title'];
		 $content=$_POST['topic_content'];
		 $id=rand()%200;
		 $id=$id+201;
		 
		 
		 $title=str_replace("'","\'",$title);
		 $content=str_replace("'","\'",$content);
		 
		 $imgg=$_SESSION["imagesrc"];
		 $imggname=$_SESSION["imagename"];
		 $username=$_SESSION["username"];
		 $cateid=$_SESSION["create_topic_parse_cateid"];
	
		 
	
		 $sql = "INSERT INTO topics(id,topic_title,topic_content,topic_creator,topic_last_user,topic_date,topic_reply_date,topic_image,image_name,category_id) VALUES('".$id."','".$title."','".$content."','".$username."','".$username."',now(),now(),'".$imgg."','".$imggname."','".$cateid."')";
		 
		 $res=mysqli_query($link,$sql) or die(mysqli_error());
		 
		  if(($res)){
			 
			  header('location:homepage.php');
			 
		 }
		 
		 else{
			 
			 
			 echo "There was a problem while creating your post.Please try again.";
		 }
		 
		 
		 echo $cateid;
		 
		 /*$sql33="UPDATE categories SET last_post_date=now(),last_user_posted='".$username."' where id='".$cateid."' ";
		 
		 $res33=mysqli_query($link,$sql33) or die(mysqli_error());
		 
		 if(($res)){
			 
			  header('location:homepage.php');
			 
		 }
		 
		 else{
			 
			 
			 echo "There was a problem while creating your post.Please try again.";
		 }*/
		 
		 
		 
	 }
	 
	 
	 
 }


?>