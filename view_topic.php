<?include('db.php'); ?>

<script>

//alert on delete

function confirm_alert(node) {

    return confirm("You are about to permanently delete a Post. Click OK to continue or CANCEL to quit.");

}

</script>

<?php


$currentURL=$_SERVER['REQUEST_URI'];
$unwantedURL="/y2j/view_topic.php";

if($currentURL==$unwantedURL){
	 header("location: homepagewithoutlogin.php");

}





session_start();
$usernameGlob = "";
$_SESSION['cidGlob']="";

$host = 'localhost';
$user = 'root';
$password = '';
$errors=array();
$db = 'projectf';

$link = mysqli_connect($host, $user, $password, $db);
$_SESSION["username"]=$usernameGlob;
if(isset($_COOKIE["signInUserName"])){
    $usernameGlob = $_COOKIE["signInUserName"];
	$_SESSION["username"]=$usernameGlob;
}
else if (!isset($_SESSION['signInUserName']) && !isset($_SESSION['signUpUserName'])) {
    //header('location: homepagewithoutlogin.php');
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

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['signUpUserName']);
    unset($_SESSION['signInUserName']);
    header("location: homepagewithoutlogin.php");
}

	$_SESSION["view_topic_tid"]="";
    $_SESSION["view_topic_cid"]="";


	$_SESSION["view_topic_tid"]=$_GET['tid'];
    $_SESSION["view_topic_cid"]=$_SESSION["view_category_cateid"];



?>


<!doctype html>
<html lang="en">
  <head>
   <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

    <title>Home</title>
  </head>


	<body style="background-color:#dbdcdd">


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
                      <li class="nav-item">
                          <img src="<?php echo $row[9] ?>" class="img-circle" alt="User" width="40px" height="40px">
                      </li>
                      <li class="nav-item" style="margin-left: -10px">
                           <a href="privatepage.php"style="color: white;"><?php echo $usernameGlob ?></a>
                      </li>
                      <li class="nav-item">
                         <a class="nav-link" href="homepage.php?logout='1'" style="color: white;">Log Out</a>
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



			<div class="container categor_block">
		<div class="row">
            <div class="col-md-2 col-lg-2 col-sm-1 col-xs-1"></div>
			<div class="col-md-8 col-lg-8 col-sm-10 col-xs-10">

				<?php






				$cmnt=" ";
				$temp22;
				$commentcount=0;

				$_SESSION["view_topic_tid"]=$_GET['tid'];
                $_SESSION["view_topic_cid"]=$_SESSION["view_category_cateid"];

				$topics ="";
			    include('db.php');

				$cid=$_SESSION["view_topic_cid"];
				$tid=$_GET['tid'];

				$temp22=$tid;




				$sql="select *from topics where id='".$tid."' LIMIT 1";

				$res=mysqli_query($link,$sql) or die(mysqli_error());


				if(mysqli_num_rows($res)==1){

					echo "<table width='100%'>";



					while($row = mysqli_fetch_assoc($res)){

						$tid=$row['id'];
							$title=$row['topic_title'];
							$views=$row['topic_views'];
							$date=$row['topic_date'];
							$creator=$row['topic_creator'];
							$cateid=$row['category_id'];
							$content=$row['topic_content'];
							$lastuser=$row['topic_last_user'];
							$replydate=$row['topic_reply_date'];
							$status=$row['topic_status'];
							$image=$row['topic_image'];
							$imagename=$row['image_name'];
						$replies=$row['topic_replies'];
							$test=$image;
							$test1=$imagename;
							$temp=$tid;

			            $_SESSION["view_topic_cid"]=$_SESSION["view_category_cateid"];
						$_SESSION["viewtopic_tid"]=$tid;

						$cateid=$_SESSION["view_topic_cid"];



							$old_views=$views;
						$new_views=$old_views+1;
						$sql33="UPDATE topics SET topic_views='".$new_views."' where id='".$tid."' LIMIT 1";
						$res33=mysqli_query($link,$sql33) or die(mysqli_error());


											$topics .= "<table width=100%  border=0 bordercolor=white style='border-collapse:collapse;'>";

	$topics.= " <tr><td colspan='3' style='color:#021526;'>    </td></tr>";

						/*$topics .= "<tr><td colspan='3'><a style='color:black;'  href='homepage.php'>Return to Home Page</a></td></tr>";*/



							
						$topics.= " <tr><td colspan='3' style='color:#021526;'>       </td></tr>";

						$topics .= "<tr style='background-color:red'><td><div style='color:white;'>  Topic Title</div></td><td align='left'>  <div style='color:white;'>   Comments   </div> </td> <td align='center' >  </td><td align='center' >  </td>   <td align='right' >  <div style='color:white;'>   Views    </div> </td></tr>";



							$topics.= " <tr><td colspan='3' style='color:#021526;'>       </td></tr>";


						$topics .= "<tr><td><font size='6'><a style='color:black;' href='view_topic.php? cid=".$cateid."&tid=".$tid."'>".$title."</a><tr><td><div style='margin-top:50px;   width:650px;  height:350px;'>
						<img style='width: 100%;  height: 100%;' src='$image'></div></td><tr><tr><td><a href='homepage.php?cid=".$cateid."&tid=".$tid."'>"."</a><br /><span class='post_info'><div style='color:black;'>Posted by: "."<form action='writer.php' method='post'><input style=' background-color:#dbdcdd; border: 0px; color:black; font-size:22px;  ' type='submit' name='writerName' value='$creator'></form>"." on  ".$date."</div></span></td><td align='center' style='color:black;' >".$replies."</td><th></th><td align='center'style='color:black;' >".$views."</td></tr>";





							$topics.= " <tr><td colspan='3' style='color:#021526;'>       </td></tr>";



									if($creator==$_SESSION["username"]){

								$topics .= "<tr><td>	<form action='EDITPOST.php?eid=3' method='post'>
				<div class='form-group'>
	<input type='submit' class='form-control btn btn-primary' value='Edit Post' name='edit_post'>
</div>
				</form></td><tr>";




								$topics .= "<tr><td><form action='deletepost_parse.php' method='post'
								onsubmit='return confirm('Are you sure you want to delete this post?')'>
				<div class='form-group'>
	<input type='submit' class='form-control btn btn-primary' onclick='return confirm_alert(this);' value='Delete Post' name='delete_post'>
</div>
				</form></td><tr>";





							}



					$topics.= " <tr><td colspan='3' style='color:#021526;'>       </td></tr>";

						    $topics .= "</table>";


						    echo $topics;

echo"<tr><td valign='top' style='border: 1px solid #000000;'><div style='min-height:125px; color:black; font-size: 20px;>'"
	    ."<br /> "." ".""
						."Post Content:"."<br/><br/>" .$row['topic_content']
	   ."</div></td></tr>
	       <tr><td colspan='3' style='color:#021526;'>      </td></tr>";



						$sql44="SELECT *FROM COMMENT WHERE topic_id='".$tid."' ORDER by comment_date ASC";
						$res44=mysqli_query($link,$sql44) or die(mysqli_error());

						if(mysqli_num_rows($res44)>=1){
							$cmnt .="";

							while($row44 = mysqli_fetch_assoc($res44)){

								$commentcount=$commentcount+1;



								$rid=$row44['id'];
								$rcid=$row44['category_id'];
								$rtid=$row44['topic_id'];
								$rcreator=$row44['comment_creator'];
								$rcontent=$row44['comment_content'];
								$rdate=$row44['comment_date'];



							$cmnt .="<table width='100%' border=0 bordercolor=WHITE style='border-collapse: separate; color:black; '>";

							$cmnt .=" <tr><td colspan='3' style='color:#021526;'>       </td></tr>";

							$cmnt .="<tr style='background-color:#dbdcdd;'><td> Comment ".$commentcount."   </td></tr>    ";

								$cmnt .= " <tr><div style=' margin-top:55px;'><td colspan='3' style='color:#021526;'>      </td></div></tr>";

								$cmnt .= " <tr><td><font size='6'>".$rcontent."</td></tr><br /> <br/> <tr><td>

							<br /> <br />	Commented by: ".$rcreator." on  ".$rdate."</td><tr>   ";

							}

							$cmnt .= "</table>";



						}

						else{


						$cmnt .="<h3 style='color:black;'>No one commented in this post.</h3>";
						}

						echo "</table>";

						echo  $cmnt;

						//echo $temp;




						if (!isset($_SESSION['signInUserName']) && !isset($_SESSION['signUpUserName'])) {


						  echo "<tr><td><p>Please log in to add your reply.</p><hr /></td></tr>";

					}

					else{

						 /*echo "<tr><td colspan='2'><input type='submit' value='Add Reply' onClick=\"window.location='post_reply.php?cid=".$cid."&tid=".$tid."'\" /><hr />";*/

					/*echo "	<div class='form-group'>
	<input type='submit' class='form-control btn btn-primary' value='Reply' name='reply_submit'>
</div> " ;*/
					}


					}


							echo "	<form action='postreply.php?prid=2' method='post'>
				<div class='form-group'>
	<input type='submit' class='form-control btn btn-primary' value='Comment' name='reply_submit'>
</div>
				</form> " ;

				}

				else{


					echo "<p>There is no post show</p>";

					echo "<a href='homepage.php'>Return to Home Page</a>";

					echo "</br>";
					echo "</br>";
					echo "</br>";
				}

				?>

			<!--	<form action="postreply.php" method="post">
				<div class="form-group">
	<input type="submit" class="form-control btn btn-primary" value="Comment" name="reply_submit">
</div>
				</form> -->
				</div>
                <div class="col-md-2 col-lg-2 col-sm-1 col-xs-1"></div>
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
		    <hr/>
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
