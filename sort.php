<?php

$sort_flag = "";
session_start();
if(isset($_POST['sort_button'])){
    $sort_flag = $_POST['sort'];
    echo $sort_flag;
    $_SESSION['sortAs'] = $_POST['sort'];
    echo $_SESSION['sortAs'];
    header('location: asc.php');
}

if(isset($_POST['searchButton'])){
    $_SESSION['filter'] = $_POST['search'];
    header('location: search_user.php');
}

if(isset($_POST['contact_btn'])){
    $_SESSION['cnt'] = $_POST['c_message'];
    echo $_SESSION['cnt'];
    header('location: contact.php');

}


?>
