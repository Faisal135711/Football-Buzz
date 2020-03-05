<?php
session_start();
?>


 <?php
	  
	 if(isset($_POST['post_edit'])){


	  $urll=$_SESSION["gobackToviewTopic"];

		  
		  include('db.php');
		  
		  $title=  $_POST['post_title'];
		  $content= $_POST['post_body'];
		  $tid=  $_SESSION["editpost_tid"];
		 
		 
		/* while(1){
			
			 echo $content;
			 
		 }*/

	  if($title=="" || $content==""){
		  echo "PLEASE FILL OUT ALL THE FIELDS";
	  }

			else{
		
		  
		  $sql="UPDATE topics set topic_title='".$title."',topic_content='".$content."',topic_date=now() where id='".$tid."'";
		  
		  $res=mysqli_query($link,$sql) or die(mysqli_error());
		  
		  if($res){
			  
		header("location: ".$urll);
		  }
		  else{
			  
			  echo "There was a problem while editing your post.Please try later";
		  }
			
			
			}
	 }
	 
	  
	  
	  
	  ?>