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

$first_name = "";
$last_name = "";
$email = "";
$done = "";

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
    $sql = "Select * From user_info Where username='$usernameGlob'";
    $result = mysqli_query($link, $sql);
    $noOfData = mysqli_num_rows($result);
    $row = mysqli_fetch_row($result);
    $usernameGlob = $row[1];
    $email = $row[4];
    $first_name = $row[2];
    $last_name = $row[3];
}
else if (isset($_SESSION['signInUserName'])) {
    $usernameGlob = $_SESSION['signInUserName'];
	$_SESSION["username"]=$usernameGlob;
    $sql = "Select * from user_info Where username = '$usernameGlob' Or email = '$usernameGlob'";
    $result = mysqli_query($link, $sql);
    $noOfData = mysqli_num_rows($result);
    $row = mysqli_fetch_row($result);
    $usernameGlob = $row[1];
    $email = $row[4];
    $first_name = $row[2];
    $last_name = $row[3];
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

if(isset($_POST['done'])){
    $username=$_SESSION["username"];
    $first_name=$_POST['updateFirstName'];
    $last_name=$_POST['updateLastName'];
    $email=$_POST['updateEmail'];
    $password=$_POST['updatePassword'];
    $country=$_POST['selectCountry'];

	$sql = "Update user_info set email = '$email', first_name = '$first_name', last_name = '$last_name' where username = '$username'";
	mysqli_query($link, $sql);

    if($country != ""){
        $sql = "Update user_info set country = '$country' where username = '$username'";
        mysqli_query($link, $sql);
    }

    if($password != ""){
        $sql = "Update user_info set password = '$password' where username = '$username'";
        mysqli_query($link, $sql);
    }
    $done = "Your information updated successfully.";
    unset($_SESSION['done']);
//	header('location: test.php');
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

<div class="container" style="background-color: #dbdcdd">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12"></div>
    	<div class="col-md-4 cold-lg-4 col-sm-3 col-xs-12">
            <form method="post" action="update.php">
                <br>
                <label style="color: red"><?php echo $done ?></label>
    			<div class="row">
    				<div class="col-md-6">
    					<div class="form-group">
                          <label>First Name:</label>
    					  <input type="text" class="form-control" id="updatFirstName" value="<?php echo $first_name; ?>" name="updateFirstName">
    					</div>
    				</div>
    				<div class="col-md-6">
    					<div class="form-group">
                         <label>Last Name:</label>
      					 <input type="text" class="form-control" id="updateLastName" value="<?php echo $last_name;?>" name="updateLastName">
    					</div>
    				</div>
    			</div>
    		<!--	<div class="form-group">
                    <label>Username:</label>
    				<input type="text" class="form-control" id="updateUsername" value="<?php echo $usernameGlob?>" name="updateUsername">
    			</div>-->
    			<div class="form-group">
                    <label>Email:</label>
    				<input type="text" class="form-control" id="email" value="<?php echo $email?>" name="updateEmail">
    			</div>
    			<div class="form-group">
                    <label>New Password:</label>
    				<input type="password" class="form-control" id="udpatePassword" value="" name="updatePassword">
    			</div>
                Country: <select name="selectCountry" value="dkfjk">
                        <option value="" selected="selected"></option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Åland Islands">Åland Islands</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="America">America</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Antigua and Barbuda">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia, Plurinational State of</option>
                        <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                        <option value="Bosnia">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombi">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value=">Costa Rica">Costa Rica</option>
                        <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Curaçao">Curaçao</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republi">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Equatorial Guinea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="England">England</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="GM">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="German">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="GTGuatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                        <option value="Holy See">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle of Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libya<">Libya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="LULuxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
                        <option value="Madagasca">Madagascar</option>
                        <option value="MW">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Réunion">Réunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russia">Russia</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Barthélemy">Saint Barthélemy</option>
                        <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Martin (French part)">Saint Martin (French part)</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                        <option value="South Suda">South Sudan</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="TL">Timor-Leste</option>
                        <option value="TG">Togo</option>
                        <option value="TK">Tokelau</option>
                        <option value="TO">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela, Bolivarian Republic of</option>
                        <option value="Viet Nam">Viet Nam</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands">Virgin Islands, U.S.</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                    <br><br>
                    <button type="submit" name="done" class="btn btn-primary btn-block">Update Your Info</button>
    		</form>

        </div>
    	<div class="col-md-4 col-lg-4 col-sm-3 col-xs-12"></div>
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
