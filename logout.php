<?php

session_destroy();
setcookie("signInUserName", $_POST["signInUserName"], time()-3600);
setcookie("signInPassword", $_POST["signInPassword"], time()-3600);
unset($_SESSION['signUpUserName']);
unset($_SESSION['signInUserName']);
header('location: login.php');

?>
