<?include('db.php'); ?>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="css/customStyle.css" rel="stylesheet"/> </link>
  </link>
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

                <li class="nav-item">
                      <a class="nav-link" href="login.php?logout='1'" style="color: white;">Log In</a>
                </li>

            </ul>
        </div>
    </div>
</div>

<div class="container" style="color: black">
	<div class="col-md-3 col-sm-2 col-xs-0"></div>
	<div class="col-md-6 col-sm-8 col-xs-12">
		<form method="post" action="registration.php" class="signUpContainer">
		<!--	<?php include('registrationerrors.php'); ?> -->
			<div class="signUp" style="color: blue">Sign Up</div>
			<br>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <input type="singUpFirstName" class="form-control" id="signUpFirstName" placeholder="FirstName" name="firstName">
					  <div><label style="color: white"><?php echo $first_name_error; ?></label></div>
					</div>

				</div>
				<div class="col-md-6">
					<div class="form-group">
  					 <input type="signUpLastName" class="form-control" id="signUpLastName" placeholder="LastName" name="lastName">
					 <div><label style="color: white"><?php echo $last_name_error; ?></label></div>
					</div>
				</div>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="signUpUserName" type="text" class="form-control" placeholder="Username" name="signUpUserName" value="<?php echo $usernameExists_error?>">
			</div>
			<div><label style="color: white"><?php echo $username_error; ?></label></div>

			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				<input id="email" type="text" class="form-control" placeholder="Email" name="email" value="">
			</div>
			<div><label style="color: white"><?php echo $email_error; ?></label></div>

			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input id="signUpPassword" type="password" class="form-control" placeholder="Password" name="signUpPassword">
			</div>
			<div><label style="color: white"><?php echo $password_error; ?></label></div>

			<button type="submit" name="signupbutton" class="btn btn-primary btn-block">Sign Up</button>
			<br>
			<div class="textCen textInLogSign">Already have account? <a href="login.php" style="text-decoration:none" class="logInLink">Log in</a></div>
		</form>

	</div>
	<div class="col-md-3 col-sm-2 col-xs-0"></div>
    </div>
    <div class="footerId"></div>



    </body>
    </html>

    <script type="text/javascript">
        $(function(){
            $(".footerId").load("footer.php");
        });


    </script>
