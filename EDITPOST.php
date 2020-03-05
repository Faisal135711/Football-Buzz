<?php
session_start();
$usernameGlob = "";
$_SESSION['cidGlob']="";
$_SESSION['n'] = "0";

$host = 'localhost';
$user = 'root';
$password = '';
$errors=array();
$db = 'projectf';

$link = mysqli_connect($host, $user, $password, $db);

if(isset($_COOKIE["signInUserName"])){
    $usernameGlob = $_COOKIE["signInUserName"];
	$_SESSION["username"]=$usernameGlob;
}
else if (!isset($_SESSION['signInUserName']) && !isset($_SESSION['signUpUserName'])) {
    header('location: homepagewithoutlogin.php');
}
else if (isset($_SESSION['signUpUserName'])) {
    $usernameGlob = $_SESSION['signUpUserName'];
	$_SESSION["username"]=$usernameGlob;
}
else if (isset($_SESSION['signInUserName'])) {
    $usernameGlob = $_SESSION['signInUserName'];
	$_SESSION["username"]=$usernameGlob;
    $sql = "Select * from user_info Where username = '$usernameGlob' Or email = '$usernameGlob'";
    $result = mysqli_query($link, $sql);
    $noOfData = mysqli_num_rows($result);
    $row = mysqli_fetch_row($result);
    $usernameGlob = $row[1];
}

$sql = "Select * From user_info Where username='$usernameGlob'";
$result = mysqli_query($link, $sql);
$noOfData = mysqli_num_rows($result);

$row = mysqli_fetch_row($result);
$usernameGlob = $row[1];
$full_name = $row[2]." ".$row[3];
$email = $row[4];
$country = $row[6];
$r_date = $row[8];
$path = $row[9];

if (isset($_GET['logout'])) {
    session_destroy();
    setcookie("signInUserName", $_POST["signInUserName"], time()-3600);
	setcookie("signInPassword", $_POST["signInPassword"], time()-3600);
    unset($_SESSION['signUpUserName']);
    unset($_SESSION['signInUserName']);
    header("location: contact.php");
}

if (!isset($_SESSION['signInUserName']) && !isset($_SESSION['signUpUserName'])) {
	header('location: homepagewithoutlogin.php');
 	exit();
}


$currentURL=$_SERVER['REQUEST_URI'];

$unwantedURL="/y2j/EDITPOST.php";

$_SESSION["editpost_tid"]="";

$_SESSION["editpost_tid"]=$_SESSION["view_topic_tid"];

if($currentURL == $unwantedURL){
			header('location: homepagewithoutlogin.php');
     	exit();
}
if(isset($_SERVER['HTTP_REFERER'])) {
    //echo $_SERVER['HTTP_REFERER'];
	$_SESSION["gobackToviewTopic"]=$_SERVER['HTTP_REFERER'];
}



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
	<meta charset="utf-8">
	<meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!--<link href="css/homepage.css" rel="stylesheet"/>-->
	<link href="css/test.css" rel="stylesheet"/>
    <link href="css/customStyle.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet">
    <title>Edit Post</title>
  </head>
  <body style="background-color: #dbdcdd">

	  <div class="container-fluid">
      	 <div class="row" style="height: auto">
      		 <div class="col-md-8 col-lg-8 col-sm-8 col-xs-7 topRowF">Football</div>
      		 <div class="col-md-4 col-lg-4 col-sm-4 col-xs-5 topRowS">BUZZ</div>
      	 </div>
       </div>
       <div class="navbar navbar-inverse navbar-static-top navbar-expand-md mb-5">
      	 <div class="container naigation">
      		 <a class="navbar-brand" href="#"></a>
      		 <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
      			 <span class="icon-bar"></span>
      			 <span class="icon-bar"></span>
      			 <span class="icon-bar"></span>
      		 </button>
      		 <div class="collapse navbar-collapse navHeaderCollapse">
      			 <ul class="nav navbar-nav navbar-left">
      				 <li class="nav-item"><a class="nav-link" href="homepage.php">Home</a></li>
      				 <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      				 <li class="nav-item"><a href="about.php">About</a></li>
      			 </ul>
      			 <ul class="nav navbar-nav navbar-right">

      				 <?php if($usernameGlob != "") : ?>

      					<li class="nav-item" style="margin-left: -10px; margin-top:-10px">
      						<a href="privatepage.php"style="color: white;"><img src="<?php echo $path ?>" class="img-circle" alt="User" width="40px" height="40px"><?php echo $usernameGlob ?></a>
      					</li>
      					<li class="nav-item">
      						<a class="nav-link" href="login.php?logout='1'" style="color: white;">Log Out</a>
      					</li>
                        <li class="nav-item">
                         <form method='post' action='sort.php'>
                               &nbsp;
                               <input type='text'  placeholder='Search..' name='search' style='width: 100px; margin-top: 10px'>
                               <button type='submit' name='searchButton'><span class='glyphicon glyphicon-search'></span></button>
                         </form>
                     </li>
      				<?php else : ?>
      					<li class="nav-item">
      					   <a class="nav-link" href="login.php?logout='1'" style="color: white;">Log In</a>
      				   </li>
      				 <?php endif; ?>
      			 </ul>
      		 </div>
      	 </div>
       </div>





	 <div class="container">
			  <div class="row">
				 <div class="col-md-6">


					 <form action="edit_post_parse.php" method="post">
		  <div class="form-group">
		    <label for="Title">Post Title</label>
		    <input type="text" class="form-control" id="title" name="post_title"  placeholder=" Post Title">
		  </div>

		  <div class="form-group">
		    <label for="body">Post Body</label>
		    <textarea class="form-control" id="body" name="post_body" rows="10"></textarea>
		  </div>


		<div class="form-group">

			<input type="submit" class="form-control btn btn-primary" value="Edit Post" name="post_edit">

		</div>
		</form>


		</div>



		 </div>


	 </div>

	 <div class="footerId"></div>

</body>
</html>

<script type="text/javascript">
  $(function(){
	  $(".footerId").load("footer.php");
  });


</script>
