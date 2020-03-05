<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Create Post</title>
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

    <?php
    include("config.php");

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
            move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$name);

        }

    }
    ?>

		<?php

 $sql = " select image from images where id in (Select MAX(id) from images)";
 $result = mysqli_query($con,$sql);
 $row = mysqli_fetch_array($result);

 $image_src2 = $row['image'];
?>
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

                  <?php if($usernameGlob != "") : ?>
                     <li class="nav-item">
                         <img src="<?php echo $row[9] ?>" class="img-circle" alt="User" width="40px" height="40px">
                     </li>
                     <li class="nav-item" style="margin-left: -10px">
                         <a href="privatepage.php"style="color: white;"><?php echo $usernameGlob ?></a>
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
		 <div class="col-md-6">


			 <form>
  <div class="form-group">
    <label for="Title">Post Title</label>
    <input type="text" class="form-control" id="title" name="postTitle"  placeholder="Title">
  </div>

  <div class="form-group">
    <label for="body">Post Body</label>
    <textarea class="form-control" id="body" name="postBody" rows="10"></textarea>
  </div>
		<br>
		<br>
		<form method="post" action="" enctype='multipart/form-data'>
        <input type='file' name='file' />
        <input type='submit' value='Save name' name='but_upload'>

		  <div class="clsAutoFit">
			<img class="img-responsive clsImg" src='<?php echo $image_src2; ?>'>
			</div>

<div class="form-group">

	<input type="submit" class="form-control btn btn-primary" value="Post">

</div>
</form>


		  </div>


		 </div>

	  </div>




    <div class="footerId"></div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>

<script type="text/javascript">
    $(function(){
        $(".headerId").load("header.php");
    });


</script>

<script type="text/javascript">

    $(function(){
        $(".footerId").load("footer.php");
    });
</script>
