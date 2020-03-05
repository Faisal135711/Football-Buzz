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
    unset($_SESSION['signUpUserName']);
    unset($_SESSION['signInUserName']);
    header("location: homepage.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>About</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="css/customStyle.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet">

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
                <li class="nav-item active"><a href="about.php">About</a></li>
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
    <div><h1 style="font-weight: bold; text-align: center">About</h1></div><br>
    <div class="aboutUs">
        Football BUZZ was founded and launched in the summer of 2016 to provide a platform for upcoming writers and high quality football writing.

        The blog was launched by Faisal Ahmed and Tahmeed Asaad Rahman both are Irish-based Liverpool fan and Read-Madrid fan.
        <br>
        From the beginning, the goal of the blog has been to provide a platform for football writers to write about the beautiful game and have their work seen by the masses, enabling them to further their career.

        <br>FB has featured hundreds of writers, thousands upon thousands of articles, and covered football from every corner of the globe.

        <br>All the latest updates, videos users can post about football, so it is a great platform for a football lovers.

        <br>
        After two years, we continue to provide a strong platform for talented writers. If you want to join the team and take your first step on the road to the world of football writing, get in touch with us in any way you can.
    </div>
    <br><br>
    <div class="container">
        <div><h1 style="font-weight: bold; text-align: center">About Us<hr></h1></div><br>
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ourInfo">

                Tahmeed Asaad Rahman<br>
                Ahsanullah University of Science and Technology<br>
                Email: tahmeedasaad5@gmail.com<br>
                <a href="#">Facebook</a>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><br></div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ourInfo">

                Faisal Ahmed<br>
                Ahsanullah University of Science and Technology<br>
                Email: faisalrtlsnk@gmail.com<br>
                <a href="#">Facebook</a>
            </div>
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
