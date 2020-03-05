<?php




$uradasdl=$_SERVER['REQUEST_URI'];
//echo $uradasdl;
$ena="/y2j/viewcategory.php";
if($uradasdl == $ena){


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

if(isset($_COOKIE["signInUserName"])){
    $usernameGlob = $_COOKIE["signInUserName"];
	$_SESSION["username"]=$usernameGlob;
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
    setcookie("signInUserName", $_POST["signInUserName"], time()-3600);
	setcookie("signInPassword", $_POST["signInPassword"], time()-3600);
    unset($_SESSION['signUpUserName']);
    unset($_SESSION['signInUserName']);
    header("location: login.php");
}

/*else{

	header("location:homepagewithoutlogin.php");

}*/





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
					  <li class="nav-item" style="margin-left: -10px; margin-top:-10px">
						  <a href="privatepage.php"style="color: white;"><img src="<?php echo $row[9] ?>" class="img-circle" alt="User" width="40px" height="40px"><?php echo $usernameGlob ?></a>
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
		<div class="col-md-7">
        <?php


		include('db.php');
			$topics ="";
			$cidd="";

			$kateid="";




			$_SESSION["view_category_cateid"]="";
            $_SESSION["ss"] = "";
			$_SESSION["categoryid"]=$cidd;

			$test;
			$test1;


			if (!isset($_SESSION['signInUserName']) && !isset($_SESSION['signUpUserName'])) {
               /*$logged=" |Please log in to create a topic in this category.";
				echo $logged;*/
            }
			else{

				// logged in


				$logged= "<a style='color:black;'  href='index1.php?cid=".$kateid."'><a> ";
				
				
				
				
				$createpost="";
				
				$createpost .= "<tr><td>	<form action='index1.php?cid=".$kateid."' method='post'>
				<div class='form-group'>
	<input type='submit' class='form-control btn btn-primary' value='Click here to Create a Post' name='edit_post'>
</div>
				</form></td><tr>";
				

			//    $eqe="qrqrasfaf";
				
				echo $logged;
			    	echo $createpost;


			}

						if($uradasdl !=$ena){






				$cidd=$_GET['cid'];

						}

				else{
					$cidd=2;

				}
				$_SESSION["categoryid"]=$cidd;
                $_SESSION["ss"] = $cidd;

				$_SESSION["view_category_cateid"]=$cidd;
				$kateid=$_SESSION["view_category_cateid"];

                // logged in



            $sort_view = "";
            if(isset($_COOKIE["signInUserName"]) || isset($_SESSION['signUpUserName']) || isset($_SESSION['signInUserName'])){
                    $sort_view = "<br><br>
                        <form action='sort.php' method='post' style='color: black'>
                                Sort as: &nbsp;
                                <input type='radio' name='sort' value='old'> Oldest &ensp;<input type='radio' name='sort' value='new'> Newest
                                <input type='submit' name='sort_button' value='submit' style='color: black'>
                        </form>";
            }



			if($uradasdl ==$ena){




				 $kateid=2;
				$_SESSION["view_category_cateid"]=2;

			}


			/* $_SESSION["view_category_cateid"]=$_GET['cid'];*/


			$sql="select id from categories where id='".$kateid."' LIMIT 1";

			$res=mysqli_query($link,$sql) or die(mysqli_error());

			if(mysqli_num_rows($res)==1){


				$sql2="select *from topics where category_id='".$_SESSION["view_category_cateid"]."'  Order by topic_reply_date DESC";

				$res2=mysqli_query($link,$sql2) or die(mysqli_error());
				if(mysqli_num_rows($res2)  >0){
						$topics .= "<table width=100%  border=0 bordercolor=white style='border-collapse:collapse;'>";

                //        $topics.= " <tr><td colspan='3' style='color:#021526;'> a   </td></tr>";

					 //   $topics .= "<tr><td colspan='3'><a style='color:white;'  href='homepage.php?cid=".$kateid."'>Return to Home Page</a></td></tr>";

                /*        $topics .= "<tr><td colspan='3'><br><br><label style='color: white'>Sort as: &nbsp;<label>
                                    <form action='viewcategory.php' method='post'>
                                            <input type='radio' name='sort' value='old'> Oldest &ensp;<input type='radio' name='sort' value='new' checked> Newest
                                            <input type='submit' name='sort_button' value='submit'>
                                    </form>
                                    </td></tr>";*/
                        echo $sort_view;




					while($row = mysqli_fetch_assoc($res2)){

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
						$temp="";


						if(isset($_COOKIE["signInUserName"]) || isset($_SESSION['signUpUserName']) || isset($_SESSION['signInUserName'])  ){

							$status=0;
						}



						if($status==0 ){

						$topics.= " <tr><td colspan='3' style='color:#021526;'>       </td></tr>";

						$topics .= "<tr style='background-color:red'><td><div style='color:white;'>  Topic Title</div></td><td align='left'>  <div style='color:white;'>   Comments   </div> </td> <td align='center' >  </td><td align='center' >  </td>   <td align='right' >  <div style='color:white;'>   Views    </div> </td></tr>";


						$topics.= " <tr><td colspan='3' style='color:#021526;'>      </td></tr>";

						$topics .= "<tr><td><font size='6'><a style='color:black;' href='view_topic.php? cid=".$kateid."&tid=".$tid."'>".$title."</a><tr><td><div style='margin-top:50px;   width:575spx;  height:350px;'>
					    <img style='width: 100%;  height: 100%;' src='$image'></div></td><tr><tr><td><a href='homepage.php?cid=".$kateid."&tid=".$tid."'>".$temp."</a><br /><span class='post_info'><div style='color:black;'>Posted by: "."<form action='writer.php' method='post'><input style=' background-color:#dbdcdd    ; border: 0px; color:black; font-size:22px; ' type='submit' name='writerName' value='$creator'></form>"." on  ".$date."</div></span></td><td align='center' style='color:black;' >".$replies."</td><th></th><td align='center'style='color:black;' >".$views."</td></tr>";


						$topics.= " <tr><td colspan='3' style='color:#021526;'>       </td></tr>";

						}
					}

                        //select SUBSTRING(yourcolumnname,0,2000) from yourtablename

                        $n_query = "select * from topics where id = '$tid'";
                        $n_result = mysqli_query($link, $n_query);
                        $n_noOfData = mysqli_num_rows($n_result);
                        $n_row = mysqli_fetch_row($n_result);
                        $fetch_content = $n_row[3];
                        $heading = substr($fetch_content, 0, 30);
                        $heading .= ".......";

						$topics.= " <tr><td colspan='3' style='color:#021526;'>     </td></tr>";


					$topics .= "</table>";
					echo $topics;
                    echo "<br><br>";

				}

				/*else{
					 echo  "<a href='homepage.php?cid=" .$_SESSION["view_category_cateid"]. "'>Return to homepage <a> ";
				     echo "<p>There are no topics in this category yet".$logged."</p>";
				}*/
			}

			else{
				echo  "<a href='homepage.php?cid=".$kateid."'> Return to homepage</a> ";

			}

		?>



	</div>

			<div class="col-md-6"></div>

						<div class="col-md-2">


						<?php



							if(isset($_COOKIE["signInUserName"]) || isset($_SESSION['signUpUserName']) || isset($_SESSION['signInUserName'])  ){





							include('db.php');

								$poll="";

							$sql="SELECT *FROM polls";
							$res=mysqli_query($link,$sql) or die(mysqli_error());

							if(mysqli_num_rows($res)>=1){

								$poll_number=0;

								while($row = mysqli_fetch_assoc($res)){
								  $pid=$row['id'];
								  $qstn=$row['quetion'];
								  $starts=$row['starts'];
								  $ends=$row['ends'];
								  $pimg=$row['poll_image'];

									$poll_number++;

								$poll.=	"<table width=100%  border=0 bordercolor=white style='border-collapse:collapse;'>";

							$poll .=" <tr><td colspan='3' style='color:#021526;'>      </td></tr>";

								$poll .="<tr><h4> POLL:$poll_number</h4><td><div style='margin-top:100px; margin-left:00px;  width:280px; height:200px;'>
						<img style='width: 100%;  height: 100%;' src='$pimg'></div></td><tr>";


							$poll .=" <tr><td colspan='3' style='color:#021526;'>     </td></tr>";

									$poll .= "<tr><td align='center' style='color:black;' ><font size='4'> ".$qstn."</td></tr>";

							$poll .=" <tr><td colspan='3' style='color:#021526;'>      </td></tr>";

									$poll .= "<tr><td align='center' style='color:black;' ><font size='3'>CHOICES  :</td></tr>";

									$sql2="SELECT *FROM poll_choices where poll_id='".$pid."'";
									$res2=mysqli_query($link,$sql2) or die(mysqli_error());
									if(mysqli_num_rows($res2)>=1){

											while($row2 = mysqli_fetch_assoc($res2)){
												 	$pcid=$row2['id'];
													$pollid=$row2['poll_id'];
													$name=$row2['name'];

												$_SESSION["pollchoiceid"]=$pcid;

												$poll .=" <tr><td colspan='3' style='color:#021526;'>       </td></tr>";

												/*$poll .= "<tr><td align='center' style='color:white;' ><font size='4'> ".$name."</td></tr>";

													$poll .=" <tr><td colspan='3' style='color:#021526;'>    a   </td></tr>";*/

												$poll .= "<form action='poll_submit_parse.php' method='post'><tr><td align='center' style='color:black;'>
												<font size='3'><div> <input type='radio' name='choice' id='".$pcid."' value='".$pcid."' ><label for='".$name."'> ".$name."</label></div> </td></tr>
												";


												$sql33="SELECT poll_choices.name,COUNT(poll_answers.id)*100/(SELECT COUNT(*) FROM poll_answers WHERE poll_answers.polls_id='".$pid."') AS percentage from poll_choices LEFT JOIN poll_answers ON poll_choices.id=poll_answers.poll_choices_id WHERE poll_choices.poll_id='".$pid."'  AND poll_choices.id='".$pcid."'   GROUP BY poll_choices.id ";

												$res33=mysqli_query($link,$sql33) or die(mysqli_error());

												if($res33){
													while($row33 = mysqli_fetch_assoc($res33)){

														$percentage=$row33['percentage'];

														$poll.= "<tr><td align='center' style='color:black;'>".$percentage."%</td><tr>";


													}

												}



											}



									}


									$poll .=" <tr><td colspan='3' style='color:#021526;'> </td></tr>";


								$_SESSION["pollid"]=$pid;
								$poll .= "<tr><td align='center' ><input type='submit' name='poll' value='Submit answer'><input type='hidden' name='polla' value='".$pid."'></td></tr></form>";
								}


							}
								$poll .= "</table>";
								echo $poll;

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
