<?include('db.php'); ?>

<?php
session_start();
$usernameGlob = "";
$_SESSION['cidGlob']="";

$host = 'localhost';
$user = 'root';
$password = '';
$errors=array();
$db = 'projectf';
$link = mysqli_connect($host, $user, $password, $db);
$path="";

//
$messageCheck = "";

if(isset($_COOKIE["signInUserName"])){
    $usernameGlob = $_COOKIE["signInUserName"];
	$_SESSION["username"]=$usernameGlob;
/*    $sql = "Select * From user_info Where username='$usernameGlob'";
    $result = mysqli_query($link, $sql);
    $noOfData = mysqli_num_rows($result);

    $row = mysqli_fetch_row($result);
    $usernameGlob = $row[1];
    $full_name = $row[2]." ".$row[3];
    $email = $row[4];
    $country = $row[6];
    $r_date = $row[8];
    $path = $row[9];*/
}
else if (!isset($_SESSION['signInUserName']) && !isset($_SESSION['signUpUserName'])) {
    header('location: contactwithoutlogin.php');
}
else if (isset($_SESSION['signUpUserName'])) {
    $usernameGlob = $_SESSION['signUpUserName'];
	$_SESSION["username"]=$usernameGlob;
}
else if (isset($_SESSION['signInUserName'])) {
    $usernameGlob = $_SESSION['signInUserName'];
/*	$_SESSION["username"]=$usernameGlob;
    $sql = "Select * from user_info Where username = '$usernameGlob' Or email = '$usernameGlob'";
    $result = mysqli_query($link, $sql);
    $noOfData = mysqli_num_rows($result);
    $row = mysqli_fetch_row($result);
    $usernameGlob = $row[1];*/
}

//contact form
if(isset($_SESSION['cnt'])){
    $message = $_SESSION['cnt'];
    $message = str_replace("'", "\'", $message);

    if($message == ""){
        $messageCheck = "Message is required";
    }
    else{
        $sql = "Select * From user_info Where username = '$usernameGlob'";
        $result = mysqli_query($link, $sql);
        $noOfData = mysqli_num_rows($result);
        $row = mysqli_fetch_row($result);
        $userId = $row[0];

        $sql = "Insert Into contact_msg(user_id, username, message)
                Values('$userId', '$usernameGlob', '$message')";
        $result = mysqli_query($link, $sql);
        echo '<script>alert("Your message has been submitted.Thank you.")</script>';
        unset($_SESSION['cnt']);
    }
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
    header("location: contactwithoutlogin.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact</title>
  <meta charset="utf-8">
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
  <style>
     .fa {
         padding: 15px;
         font-size: 15px;
         width: 40px;
         text-align: center;
         text-decoration: none;
         margin: 5px 2px;
         border-radius: 50%;
     }

     .fa:hover {
         opacity: 0.7;
     }

     .fa-facebook {
       background: #3B5998;
       color: white;
     }

     .fa-twitter {
       background: #55ACEE;
       color: white;
     }
     .fa-youtube {
       background: #bb0000;
       color: white;
     }

     .fa-instagram {
       background: #125688;
       color: white;
     }
     .hr1{
         margin-left: 30px;
         margin-right: 30px;
     }
     .cls{
         margin-left: 30px;
         color: white;
         font-size: 15px;
     }

 </style>
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
                  <li class="nav-item active"><a class="nav-link" href="#">Contact</a></li>
                  <li class="nav-item"><a href="about.php">About</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">

                  <?php if($usernameGlob != "") : ?>
                      <li class="nav-item" style="margin-left: -10px; margin-top:-10px">
                          <a href="privatepage.php"style="color: white;"><img src="<?php echo $path ?>" class="img-circle" alt="User" width="40px" height="40px"><?php echo $usernameGlob ?></a>
                      </li>
                     <li class="nav-item">
                         <a class="nav-link" style="color: white" href="login.php?logout='1'">Log Out</a>
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
            			    <a class="nav-link" href="login.php?logout='1'">Log In</a>
            		    </li>
                  <?php endif; ?>
              </ul>
          </div>
      </div>
  </div>

<div style="color: black">
<!--<div class="contactUpperPart"></div>-->

<br><br>
<div><h1 style="text-align: center; margin-top: -25px;">Get in touch with us</h1></div>
    <br>
    <div class="container" style="font-size: 15px">
    	<div class="row">
    		<br><br>
    		<div class="col-md-6 col-lg-6 col-sm-6">
    			<div class="contactHeading">Contact Details:</div>
    			<br><br>
    			<ul>
    				<li>Our Contact Center is ready and willing to help out.</li>
    				<br>
    				<li>You can help us to improve our site.We thank you for having visited us and we invite you to send us your suggestion.</li>
    				<br>
    				<li>Otherwise you can fill out a form explaining the reasons behind your query (available for registered users).<!-- Please,<a href="login.php" target="_blank" style="text-decoration: none"><b> Log In</b></a> or click here to <a href="registration.php" target="_blank" style="text-decoration: none"><b> Sign Up</b></a> for free.</li>-->
    			</ul>
    			<br>
    			<div class="row">
    				<div class="col-md-2 col-lg-2 col-sm-2 col-xs-1"></div>
    				<div class="col-md-8 col-lg-8 col-sm-8 col-xs-10">
    					<span style="background-color: #dbdcdd; color: #003267" class="input-group-addon info"><i class="glyphicon glyphicon-map-marker"></i>  <b><span style="margin-left: 4px"></span>Address</b></span>
    					<label><span style="margin-left: 25px;"></span>Barclay Center<br><span style="margin-left: 25px;"></span>Broklyn, New York</label>
    					<br>
    					<br>
    					<span style="background-color: #dbdcdd; color: #003267" class="input-group-addon info"><i class="glyphicon glyphicon-earphone"></i>  <b><span style="margin-left: 4px;"></span>Phone</b></span>
    					<label><span style="margin-left: 25px;"></span>+123455678</label>
    					<br>
    					<br>
    					<span style="background-color: #dbdcdd; color: #003267" class="input-group-addon info"><i class="glyphicon glyphicon-envelope"></i>  <b><span style="margin-left: 4px;"></span>General Support</b></span>
    					<label><span style="margin-left: 25px;"></span>drinkitinman@gmail.com</label>
    					<br>
    				</div>
    				<div class="col-md-2 col-lg-2 col-sm-2 col-xs-1"></div>
    			</div>
            </div>
    	<!--	<div class="col-md-0 col-lg-0 col-sm-0"><br><br></div> -->
    		<div class="col-md-6 col-lg-6 col-sm-6">
    			<div class="contactHeading">Send Us A Message</div>
    			<br><br>
    			<form action="sort.php" method="post">
    				<div class="form-group">
    					<label for="firstName">Message</label>
    					<textarea type="text" class="form-control" id="mesaage" name="c_message" style="height: 200px"></textarea>
                        <label style="color: red;"><?php echo $messageCheck ?></label>
    				</div>
    				<br>
    				<button type="submit" name="contact_btn" class="btn btn-primary btn-block">Send Message</button>
    			</form>
    		</div>
    	</div>
    </div>

    <br><br><br>
    <div class="container">
    	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2799138154!2d-74.25987514580467!3d40.69767006377277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbd!4v1531468009045" width="100%" height="450" frameborder="0" style="border:2px" allowfullscreen></iframe>
    </div>
</div>

<div style="background-color: #181818; color: white">
    <br>
    <div style="text-align: center; font-size: 20px">Follow us:</div>
    <div style="text-align: center">
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-youtube"></a>
        <a href="#" class="fa fa-instagram"></a>
    </div>
    <hr/ class="hr1">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="text-align: center">
                <a href="#" class="cls">FAQ</a>
                <a href="#" class="cls">Privacy Policy</a>
                <a href="#" class="cls">Cookies</a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="text-align: center">
                <a href="#" class="cls">Support</a>
                <a href="#" class="cls">Work with us</a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="text-align: center">
                <a href="#" class="cls">Request a Feature</a>
                <a href="#" class="cls">Terms and Conditions</a>
            </div>
        </div><br>
        <div style="text-align: center">Copyright &copy; 2018 Football BUZZ</div><br>
    </div>
</div>

</body>

</html>
