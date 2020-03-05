<?php

session_start();






if(isset($_POST['choice'])){
	
if(isset($_POST['polla'])){
	
	
	
	$t= $_POST['choice'];
	$r= $_POST['polla'];
	
	$userd=$_SESSION["username"];
	
	echo $user;
	echo $r;
	echo $t;
	
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$errors=array();
	$db = 'projectf';

$link = mysqli_connect($host, $user, $password, $db);
	
	$sql="INSERT INTO poll_answers(UserName,polls_id,poll_choices_id) VALUES('".$userd."','".$r."','".$t."')";
	
	 	 $res=mysqli_query($link,$sql) or die(mysqli_error());
		 
		  if(($res)){
			 
			  header('location:viewcategory.php');
			 
		 }
	else{
		
		echo "Sorry error occured";
	}
	
}
	
	
}



?>