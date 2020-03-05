<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	
	
	<link href="css/test.css" rel="stylesheet"/> </link>
</head>


	<div>
	<?php
			include('db.php'); 
			
			$sql="SELECT * FROM categories ORDER BY category_title ASC";
			$res=mysqli_query($link,$sql) or die(mysqli_error());
			$categories= "";
			
			if(mysqli_num_rows($res)>0){

				while($row = mysqli_fetch_assoc($res)){ 
					$id=$row['id'];
					$title=$row['category_title'];
					$description=$row['category_description'];
					$categories .= "<a href='#' class='categor_link'>".$title." - <font size='-1'> "  . $description.  "</font></a>";
				
	} 

				     echo $categories;
				
				
				
				
				
				
			
				
			}
			else{
				
				
				
			}
			
			
				
			
			
			?>
		
		</div>

<body>
</body>
</html>