<?php

$host = 'localhost';
$user = 'root';
$password = '';
$errors=array();
$db = 'project';

$link = mysqli_connect($host, $user, $password, $db);

$username = "";
$email = "";
$password = "";
$first_name = "";
$last_name = "";

//errors messages;
$first_name_error = "";
$last_name_error = "";
$password_error = "";
$email_error = "";
$username_error = "";
$usernameExists_error = "";
$emailExists_error = "";
$invalid = "";
$password_req = "";
$username_req = "";

if(isset($_POST['signupbutton'])){
	$username=$_POST['signUpUserName'];
	$first_name=$_POST['firstName'];
	$last_name=$_POST['lastName'];
	$email=$_POST['email'];
	$password=$_POST['signUpPassword'];

	if(empty($first_name)){
		array_push($errors, "First name is required");
		$first_name_error = "First name is required";
	}
	else if(empty($last_name)){
		array_push($errors, "Last name is required");
		$last_name_error = "Last name is required";
	}
	else if(empty($username)){
		array_push($errors, "Username is required");
		$username_error = "Username name is required";
	}
	else if(empty($email)){
		array_push($errors, "Email is required");
		$email_error = "Email is required";
	}
	else if(empty($password)){
		array_push($errors, "Password is required");
		$password_error = "Password is required";
	}

	$usernameCheck = "Select * From user_info Where username = '$username'";
	$emailCheck = "Select * From user_info Where email = '$email'";

	if(!empty($email) && mysqli_num_rows(mysqli_query($link, $usernameCheck)) > 0){
		$username_error = "This username is already taken";
	}
	else if(!empty($email) && mysqli_num_rows(mysqli_query($link, $emailCheck)) > 0){
		$email_error = "Already registered";
	}
	else if(count($errors) == 0){
		//$password = md5($password);
		$d = date("m/d/y");
		$default_img = "images/default.jpg";
		$sql = "Insert Into user_info(username, first_name, last_name, email, password, registration_time, img_name)
							   Values('$username', '$first_name', '$last_name', '$email', '$password', '$d', '$default_img')";

		mysqli_query($link, $sql);
		$_SESSION['signUpUserName'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: homepage.php');
	}
}

if(isset($_POST['singInButton'])){
	$usernameOrPass = $_POST['signInUserName'];
	$password = $_POST['signInPassword'];

	if(empty($usernameOrPass)){
		array_push($errors, "Username or email is required");
        $username_req = "username or email is required";
	}
	else if(empty($password)){
		array_push($errors, "Password is required");
        $password_req = "password is required";
	}

    $sql = "Select * From user_info Where (username = '$usernameOrPass' Or email = '$usernameOrPass') And password = '$password'";

	if(!empty($usernameOrPass) && !empty($password) && mysqli_num_rows(mysqli_query($link, $sql)) <= 0){
		$invalid = "Invalid login or password. Please try again.";
	}
	else if(!empty($usernameOrPass) && !empty($password)){
		$_SESSION['signInUserName'] = $usernameOrPass;
		$_SESSION['success'] = "You are now logged in";

		if(!empty($_POST['remember'])){
		//	header('location:contact.php');
			setcookie("signInUserName", $_POST["signInUserName"], time()+120);
			setcookie("signInPassword", $_POST["signInPassword"], time()+120);
			header('location: homepage.php');
		}
		else{
			header('location: homepage.php');
		}
	}
}

if(isset($_GET['logout'])){
//	session_destroy();
	setcookie("signInUserName", $_POST["signInUserName"], time()-3600);
	setcookie("signInPassword", $_POST["signInPassword"], time()-3600);
	unset($_SESSION['signUpUserName']);
	unset($_SESSION['signInUserName']);
	header('location: login.php');
}

?>
