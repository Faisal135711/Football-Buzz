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

$full_name = "";
$email = "";
$country = "";
$r_date = "";
$extError = "";

if(isset($_COOKIE["signInUserName"])){
    $usernameGlob = $_COOKIE["signInUserName"];
	$_SESSION["username"]=$usernameGlob;
    $sql = "Select * From user_info Where username='$usernameGlob'";
    $result = mysqli_query($link, $sql);
    $noOfData = mysqli_num_rows($result);

    $row = mysqli_fetch_row($result);
    $usernameGlob = $row[1];
    $full_name = $row[2]." ".$row[3];
    $email = $row[4];
    $country = $row[6];
    $r_date = $row[8];
}
else if (!isset($_SESSION['signInUserName']) && !isset($_SESSION['signUpUserName'])) {
    header('location: homepagewithoutlogin.php');
}
else if (isset($_SESSION['signUpUserName'])) {
    $usernameGlob = $_SESSION['signUpUserName'];
	$_SESSION["username"]=$usernameGlob;

    $sql = "Select * From user_info Where username='$usernameGlob'";
    $result = mysqli_query($link, $sql);
    $noOfData = mysqli_num_rows($result);

    $row = mysqli_fetch_row($result);
    $usernameGlob = $row[1];
    $full_name = $row[2]." ".$row[3];
    $email = $row[4];
    $country = $row[6];
    $r_date = $row[8];
}
else if (isset($_SESSION['signInUserName'])) {
    $usernameGlob = $_SESSION['signInUserName'];
	$_SESSION["username"]=$usernameGlob;
    $sql = "Select * from user_info Where username = '$usernameGlob' Or email = '$usernameGlob'";
    $result = mysqli_query($link, $sql);
    $noOfData = mysqli_num_rows($result);

    $row = mysqli_fetch_row($result);
    $usernameGlob = $row[1];
    $full_name = $row[2]." ".$row[3];
    $email = $row[4];
    $country = $row[6];
    $r_date = $row[8];
    $path = $row[9];
//    print_r($row);
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

if(isset($_POST["insert"])){
   //  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
     $file = $_FILES['file'];
   //  echo print_r($file);
     $filename = $file['name'];
     $fileerror = $file['error'];
     $filetmp = $file['tmp_name'];
     $fileext = explode('.', $filename);
     $filecheck = strtolower(end($fileext));
     $fileextstored = array('jpg', 'png', 'jpeg');

     if($file == ""){
         echo '<script>alert("Please select a image first")</script>';
     }
     else if(in_array($filecheck, $fileextstored)){
         $destinationfile = 'images/'.$filename;
         move_uploaded_file($filetmp, $destinationfile);
         $query = "Update user_info set img_name = '$destinationfile' where username = '$usernameGlob'";
         if(mysqli_query($link, $query))
         {
            echo '<script>alert("Image inserted successfully.")</script>';
            $row['9'] = $destinationfile;
         }
     }
     else{
         $extError = "Please select a jpg, png or jpeg image";
     }
    // print_r($filename);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>

  <?php
   echo $usernameGlob;
   ?>

  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="css/customStyle.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet"/>


</head>
<body style="background-color: #dbdcdd">

 <div class="container-fluid" style="width: 100%">
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
                           <a href="#"style="color: white;"><?php echo $usernameGlob ?></a>
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
        <div class="col-md-4 col-lg-4 col-sm-3 col-xs-1"></div>
        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-10">

            <form method="post" enctype="multipart/form-data">
                 <img src="<?php echo $row['9'] ?>" class="img-circle" alt="User" width="304" height="236">
                 <label><?php echo $extError ?></label>
                 <input type="file" name="file" id="image" />
                 <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info btn-block" />
            </form>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-3 col-xs-1"></div>


    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-3 col-xs-2"></div>

        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-8" style = "font-size: 18px; color: black; margin-top: 20px; text-align: center">
            <label>Username: <?php echo $usernameGlob?></label><br>
            <label>Full Name: <?php echo $full_name ?></label><br>
            <label>Email: <?php echo $email ?></label><br>
            <label>Country: <?php echo $country ?></label><br>
            <label>Registered: <?php echo $r_date ?></label><br>
            <a href="update.php"><button type="submit" class="btn btn-danger btn-primary btn-block" name="updateButton">Update</button></a>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-3 col-xs-2"></div>

    </div>
</div>
<br><br>

    <div class="footerId"></div>



    </body>
    </html>

    <script type="text/javascript">
        $(function(){
            $(".footerId").load("footer.php");
        });


    </script>
<!--Country: <select>
        <option value="AF">Afghanistan</option>
        <option value="AX">Åland Islands</option>
        <option value="AL">Albania</option>
        <option value="DZ">Algeria</option>
        <option value="AS">American Samoa</option>
        <option value="AD">Andorra</option>
        <option value="AO">Angola</option>
        <option value="AI">Anguilla</option>
        <option value="AQ">Antarctica</option>
        <option value="AG">Antigua and Barbuda</option>
        <option value="AR">Argentina</option>
        <option value="AM">Armenia</option>
        <option value="AW">Aruba</option>
        <option value="AU">Australia</option>
        <option value="AT">Austria</option>
        <option value="AZ">Azerbaijan</option>
        <option value="BS">Bahamas</option>
        <option value="BH">Bahrain</option>
        <option value="BD">Bangladesh</option>
        <option value="BB">Barbados</option>
        <option value="BY">Belarus</option>
        <option value="BE">Belgium</option>
        <option value="BZ">Belize</option>
        <option value="BJ">Benin</option>
        <option value="BM">Bermuda</option>
        <option value="BT">Bhutan</option>
        <option value="BO">Bolivia, Plurinational State of</option>
        <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
        <option value="BA">Bosnia and Herzegovina</option>
        <option value="BW">Botswana</option>
        <option value="BV">Bouvet Island</option>
        <option value="BR">Brazil</option>
        <option value="IO">British Indian Ocean Territory</option>
        <option value="BN">Brunei Darussalam</option>
        <option value="BG">Bulgaria</option>
        <option value="BF">Burkina Faso</option>
        <option value="BI">Burundi</option>
        <option value="KH">Cambodia</option>
        <option value="CM">Cameroon</option>
        <option value="CA">Canada</option>
        <option value="CV">Cape Verde</option>
        <option value="KY">Cayman Islands</option>
        <option value="CF">Central African Republic</option>
        <option value="TD">Chad</option>
        <option value="CL">Chile</option>
        <option value="CN">China</option>
        <option value="CX">Christmas Island</option>
        <option value="CC">Cocos (Keeling) Islands</option>
        <option value="CO">Colombia</option>
        <option value="KM">Comoros</option>
        <option value="CG">Congo</option>
        <option value="CD">Congo, the Democratic Republic of the</option>
        <option value="CK">Cook Islands</option>
        <option value="CR">Costa Rica</option>
        <option value="CI">Côte d'Ivoire</option>
        <option value="HR">Croatia</option>
        <option value="CU">Cuba</option>
        <option value="CW">Curaçao</option>
        <option value="CY">Cyprus</option>
        <option value="CZ">Czech Republic</option>
        <option value="DK">Denmark</option>
        <option value="DJ">Djibouti</option>
        <option value="DM">Dominica</option>
        <option value="DO">Dominican Republic</option>
        <option value="EC">Ecuador</option>
        <option value="EG">Egypt</option>
        <option value="SV">El Salvador</option>
        <option value="GQ">Equatorial Guinea</option>
        <option value="ER">Eritrea</option>
        <option value="EE">Estonia</option>
        <option value="ET">Ethiopia</option>
        <option value="FK">Falkland Islands (Malvinas)</option>
        <option value="FO">Faroe Islands</option>
        <option value="FJ">Fiji</option>
        <option value="FI">Finland</option>
        <option value="FR">France</option>
        <option value="GF">French Guiana</option>
        <option value="PF">French Polynesia</option>
        <option value="TF">French Southern Territories</option>
        <option value="GA">Gabon</option>
        <option value="GM">Gambia</option>
        <option value="GE">Georgia</option>
        <option value="DE">Germany</option>
        <option value="GH">Ghana</option>
        <option value="GI">Gibraltar</option>
        <option value="GR">Greece</option>
        <option value="GL">Greenland</option>
        <option value="GD">Grenada</option>
        <option value="GP">Guadeloupe</option>
        <option value="GU">Guam</option>
        <option value="GT">Guatemala</option>
        <option value="GG">Guernsey</option>
        <option value="GN">Guinea</option>
        <option value="GW">Guinea-Bissau</option>
        <option value="GY">Guyana</option>
        <option value="HT">Haiti</option>
        <option value="HM">Heard Island and McDonald Islands</option>
        <option value="VA">Holy See (Vatican City State)</option>
        <option value="HN">Honduras</option>
        <option value="HK">Hong Kong</option>
        <option value="HU">Hungary</option>
        <option value="IS">Iceland</option>
        <option value="IN">India</option>
        <option value="ID">Indonesia</option>
        <option value="IR">Iran, Islamic Republic of</option>
        <option value="IQ">Iraq</option>
        <option value="IE">Ireland</option>
        <option value="IM">Isle of Man</option>
        <option value="IL">Israel</option>
        <option value="IT">Italy</option>
        <option value="JM">Jamaica</option>
        <option value="JP">Japan</option>
        <option value="JE">Jersey</option>
        <option value="JO">Jordan</option>
        <option value="KZ">Kazakhstan</option>
        <option value="KE">Kenya</option>
        <option value="KI">Kiribati</option>
        <option value="KP">Korea, Democratic People's Republic of</option>
        <option value="KR">Korea, Republic of</option>
        <option value="KW">Kuwait</option>
        <option value="KG">Kyrgyzstan</option>
        <option value="LA">Lao People's Democratic Republic</option>
        <option value="LV">Latvia</option>
        <option value="LB">Lebanon</option>
        <option value="LS">Lesotho</option>
        <option value="LR">Liberia</option>
        <option value="LY">Libya</option>
        <option value="LI">Liechtenstein</option>
        <option value="LT">Lithuania</option>
        <option value="LU">Luxembourg</option>
        <option value="MO">Macao</option>
        <option value="MK">Macedonia, the former Yugoslav Republic of</option>
        <option value="MG">Madagascar</option>
        <option value="MW">Malawi</option>
        <option value="MY">Malaysia</option>
        <option value="MV">Maldives</option>
        <option value="ML">Mali</option>
        <option value="MT">Malta</option>
        <option value="MH">Marshall Islands</option>
        <option value="MQ">Martinique</option>
        <option value="MR">Mauritania</option>
        <option value="MU">Mauritius</option>
        <option value="YT">Mayotte</option>
        <option value="MX">Mexico</option>
        <option value="FM">Micronesia, Federated States of</option>
        <option value="MD">Moldova, Republic of</option>
        <option value="MC">Monaco</option>
        <option value="MN">Mongolia</option>
        <option value="ME">Montenegro</option>
        <option value="MS">Montserrat</option>
        <option value="MA">Morocco</option>
        <option value="MZ">Mozambique</option>
        <option value="MM">Myanmar</option>
        <option value="NA">Namibia</option>
        <option value="NR">Nauru</option>
        <option value="NP">Nepal</option>
        <option value="NL">Netherlands</option>
        <option value="NC">New Caledonia</option>
        <option value="NZ">New Zealand</option>
        <option value="NI">Nicaragua</option>
        <option value="NE">Niger</option>
        <option value="NG">Nigeria</option>
        <option value="NU">Niue</option>
        <option value="NF">Norfolk Island</option>
        <option value="MP">Northern Mariana Islands</option>
        <option value="NO">Norway</option>
        <option value="OM">Oman</option>
        <option value="PK">Pakistan</option>
        <option value="PW">Palau</option>
        <option value="PS">Palestinian Territory, Occupied</option>
        <option value="PA">Panama</option>
        <option value="PG">Papua New Guinea</option>
        <option value="PY">Paraguay</option>
        <option value="PE">Peru</option>
        <option value="PH">Philippines</option>
        <option value="PN">Pitcairn</option>
        <option value="PL">Poland</option>
        <option value="PT">Portugal</option>
        <option value="PR">Puerto Rico</option>
        <option value="QA">Qatar</option>
        <option value="RE">Réunion</option>
        <option value="RO">Romania</option>
        <option value="RU">Russian Federation</option>
        <option value="RW">Rwanda</option>
        <option value="BL">Saint Barthélemy</option>
        <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
        <option value="KN">Saint Kitts and Nevis</option>
        <option value="LC">Saint Lucia</option>
        <option value="MF">Saint Martin (French part)</option>
        <option value="PM">Saint Pierre and Miquelon</option>
        <option value="VC">Saint Vincent and the Grenadines</option>
        <option value="WS">Samoa</option>
        <option value="SM">San Marino</option>
        <option value="ST">Sao Tome and Principe</option>
        <option value="SA">Saudi Arabia</option>
        <option value="SN">Senegal</option>
        <option value="RS">Serbia</option>
        <option value="SC">Seychelles</option>
        <option value="SL">Sierra Leone</option>
        <option value="SG">Singapore</option>
        <option value="SX">Sint Maarten (Dutch part)</option>
        <option value="SK">Slovakia</option>
        <option value="SI">Slovenia</option>
        <option value="SB">Solomon Islands</option>
        <option value="SO">Somalia</option>
        <option value="ZA">South Africa</option>
        <option value="GS">South Georgia and the South Sandwich Islands</option>
        <option value="SS">South Sudan</option>
        <option value="ES">Spain</option>
        <option value="LK">Sri Lanka</option>
        <option value="SD">Sudan</option>
        <option value="SR">Suriname</option>
        <option value="SJ">Svalbard and Jan Mayen</option>
        <option value="SZ">Swaziland</option>
        <option value="SE">Sweden</option>
        <option value="CH">Switzerland</option>
        <option value="SY">Syrian Arab Republic</option>
        <option value="TW">Taiwan, Province of China</option>
        <option value="TJ">Tajikistan</option>
        <option value="TZ">Tanzania, United Republic of</option>
        <option value="TH">Thailand</option>
        <option value="TL">Timor-Leste</option>
        <option value="TG">Togo</option>
        <option value="TK">Tokelau</option>
        <option value="TO">Tonga</option>
        <option value="TT">Trinidad and Tobago</option>
        <option value="TN">Tunisia</option>
        <option value="TR">Turkey</option>
        <option value="TM">Turkmenistan</option>
        <option value="TC">Turks and Caicos Islands</option>
        <option value="TV">Tuvalu</option>
        <option value="UG">Uganda</option>
        <option value="UA">Ukraine</option>
        <option value="AE">United Arab Emirates</option>
        <option value="GB">United Kingdom</option>
        <option value="US">United States</option>
        <option value="UM">United States Minor Outlying Islands</option>
        <option value="UY">Uruguay</option>
        <option value="UZ">Uzbekistan</option>
        <option value="VU">Vanuatu</option>
        <option value="VE">Venezuela, Bolivarian Republic of</option>
        <option value="VN">Viet Nam</option>
        <option value="VG">Virgin Islands, British</option>
        <option value="VI">Virgin Islands, U.S.</option>
        <option value="WF">Wallis and Futuna</option>
        <option value="EH">Western Sahara</option>
        <option value="YE">Yemen</option>
        <option value="ZM">Zambia</option>
        <option value="ZW">Zimbabwe</option>
    </select><label>
<!--

if($_SESSION['uid']){
    echo "<tr><td colspan='2'><input type='submit' value='Add Reply' onClick=\"window.location='post_reply.php?cid=".$cid."&tid=".$tid."'\" /><hr />";
}
else{
    echo "<tr><td colspan='2'><p>Please log in to add your reply.</p><hr /></td></tr>";
}


-->
