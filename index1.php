<?php
session_start();
?>


<?php
	$_SESSION["index1_cateid"]="";
	$_SESSION["index1_cateid"]=$_SESSION["view_category_cateid"];

	if (!isset($_SESSION['signInUserName']) && !isset($_SESSION['signUpUserName'])) {
		header('location: homepagewithoutlogin.php');
     	exit();
    }

    if($_SESSION["index1_cateid"]=""){
		header('location: homepagewithoutlogin.php');
	    exit();
    }
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


?>

<!doctype html>
<html>
<head>

	  <!-- Required meta tags -->
	<title>Create Post</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!--<link href="css/homepage.css" rel="stylesheet"/>-->
	<link href="css/test.css" rel="stylesheet"/>
    <link href="css/customStyle.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet">

</head>



<body style="background-color: #dbdcdd">



    <?php
    include("config.php");

$_SESSION["index1_cateid"]=$_SESSION["view_category_cateid"];

    if(isset($_POST['but_upload'])){
        $name = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){

            // Convert to base64
            $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            // Insert record
            $query = "insert into images(name,image) values('".$name."','".$image."')";

            mysqli_query($con,$query) or die(mysqli_error($con));

            // Upload file
          //  move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$name);

        }

    }
    ?>

 <?php

 $sql = "select *from images where id in (Select MAX(id) from images)";
 $result = mysqli_query($con,$sql);
 $row = mysqli_fetch_array($result);

?>

 <?php if(isset($_POST['but_upload'])){
	$image_src2 = $row['image'];
	$image_name=$row['name'];

	$_SESSION["imagesrc"]=$image_src2;
	$_SESSION["imagename"]=$image_name;
}
else{
		$image_src2="images/purewhite.png";
        $image_name=$row['name'];
		$_SESSION["imagesrc"]=$image_src2;
        $_SESSION["imagename"]=$image_name;
}

?>


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
		  <div class="col-md-3 col-lg-3 col-sm-2 col-xs-2"></div>
		 <div class="col-md-6 col-lg-6 col-sm-8 col-xs-8">

    <label for="PostImage">Post's Image</label>

    <form method="post" action="" enctype='multipart/form-data'>
        <input type='file' value='Choose Post Image' name='file'/>
        <input type='submit' value='Save Image' name='but_upload'>
		</form>


				<!--	<div class="clsAutoFit">

  <img class="img-responsive clsImg" src='<?php echo $image_src2; ?>'>
	</div> -->







			<form action="create_topic_parse.php" method="post">
  <div class="form-group">


    <label for="Title">Post Title</label>
    <input type="text" class="form-control" id="title" name="topic_title"  placeholder=" Post Title">
  </div>

  <div class="form-group">
    <label for="body">Post Body</label>
    <textarea class="form-control" id="body" name="topic_content" rows="10"></textarea>

  </div>


<div class="form-group">

	<input type="submit" class="form-control btn btn-primary" value="Post" name="topic_submit">

</div>
</form>





		  </div>

		   <div class="col-md-3 col-lg-3 col-sm-2 col-xs-2"></div>



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
