<?include('db.php'); ?>

<?php

session_start();

if (isset($_SESSION['signInUserName']) || isset($_SESSION['signUpUserName']) || isset($_COOKIE["signInUserName"])) {
    header('location: homepage.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log In</title>
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
<body style="background-color: #dbdcdd; color: black">

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
      </div>
  </div>
</div>

<div class="container" style="margin-top: -50px">
    <div class="row">
    	<div class="col-lg-4 col-md-2 col-sm-2 col-xs-1"></div>
    	<div class="col-lg-4 col-md-8 col-sm-8 col-xs-10 signInContainer">
    		<form method="post" action="login.php">
    			<div class="signIn" style="color: black">Log In</div>
                <?php include('registrationerrors.php'); ?>
    			<br>
    			<div class="input-group" style="border: 2px solid gray;">
    			  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    			  <input id="signInUserName" type="text" class="form-control" name="signInUserName" placeholder="Enter username or email">
    			</div>
                <div><label style="color: white"><?php echo $username_req; ?></label></div>
    			<br>
    			<div class="input-group" style="border: 2px solid gray;">
    			  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    			  <input id="signInPassword" type="password" class="form-control" name="signInPassword" placeholder="Enter password">
    			</div>
    			<div><label style="color: white"><?php echo $password_req; ?></label></div>
    			<div class="checkbox">
    			  <label class="textInLogSign" style="color: black;"><input type="checkbox" name="remember" value="1"> Remember me</label>
    			</div>
    			<button type="submit" class="btn btn-danger btn-block" name="singInButton">Log In</button>
    			<br>
    			<div class="textCen"><a href="registration.php" style="text-decoration:none; color: black;" class="textInLogSign createAccountHover">Create Account?</a></div>
    		</form>
    	</div>
    	<div class="col-lg-4 col-md-2 col-sm-2 col-xs-1"></div>
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
