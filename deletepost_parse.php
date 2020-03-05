<?php
session_start();
?>


 <?php
	  
	 if(isset($_POST['delete_post'])){


	  $urll=$_SERVER["HTTP_REFERER"];

		  
		  include('db.php');
		 
		$tid=$_SESSION["view_topic_tid"];
		 
		 
		/* while(1){
			
			 echo $content;
			 
		 }*/

	  

			
		 $sql2="DELETE from comment where topic_id='".$tid."' ";
		 
		 
		 
		  $res2=mysqli_query($link,$sql2) or die(mysqli_error());
		  
		  $sql="DELETE from topics where id='".$tid."'";
	
		  
		  $res=mysqli_query($link,$sql) or die(mysqli_error());
		  
		  if($res){
			  
		header("location: ".$urll);
		  }
		  else{
			  
			  echo "There was a problem while editing your post.Please try later";
		  }
			
			
			
	 }
	 
	  
	  
	  
	  ?>