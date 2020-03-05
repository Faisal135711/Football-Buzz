<?php

session_start();

if(isset($_COOKIE["signInUserName"])){
    header('location: homepage.php');
}
else if (isset($_SESSION['signInUserName']) || isset($_SESSION['signUpUserName'])) {
    header('location: homepage.php');
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <title>Home</title>
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
                <li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a href="about.php">About</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                   <a class="nav-link" href="login.php?logout='1'" style="color: white">Log In</a>
               </li>

            </ul>
        </div>
    </div>
</div>
<div class="container">
  <div class="row">
	  <div class="col-md-2"> </div>
      <div class="col-md-8">
          <?php
          include('db.php');

          $_SESSION["homepage_cateid"]="";

          $sql="SELECT * FROM categories ORDER BY category_title ASC";
          $res=mysqli_query($link,$sql) or die(mysqli_error());
          $categories= "";

          if(mysqli_num_rows($res)>0){

              while($row = mysqli_fetch_assoc($res)){
                  $id=$row['id'];
                  $title=$row['category_title'];
                  $description=$row['category_description'];
				  	$image_name=$row['image_name'];
					
					$image_source=$row['image_source'];
					
  					$categories .= "<div style='margin-top:10px; margin bottom :300px;   width:575spx;  height:350px;'>
					    <img style='width: 100%;  height: 100%;' src='$image_source'></div style='margin-top:150px;'> <div ></div> <div> <a href='viewcategory.php?cid=".$id."' class='categor_link1' style='color:blue;  display: flex;
	padding: 5px;
	padding-top: 00px;
	padding-bottom: 30px;
	border: 6px black;
	margin-bottom: 0px;
	
	margin-top: 1px;
	background-color:#cccccc;
	color: black;
	width: 100%;
	font-size: 46px;
	font: italic;
	text-decoration-color: azure;     '>".$title."   <font size='-1'>   "."</font></a></div>";
  					$_SESSION['cidGlob']=$id;
					$categories.="<div  style='color:blue;  display: flex;
	padding: 0px;
	padding-top: 00px;
	padding-bottom: 0px;
	border: 6px black;
	margin-bottom: 0px;
	
	margin-top: 0px;
	background-color:#cccccc;
	color: black;
	width: 100%;
	font-size: 16px;
	font: italic;
	text-decoration-color: azure;     '><p>$description</p></div>";
  				}
  				echo $categories;
          }
          else{
          }

          ?>
      </div>
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


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
