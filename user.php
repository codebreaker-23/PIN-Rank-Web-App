<?php

require 'connection.php';

if(isset($_POST['pincode']))
	{
		$pincode=$_POST['pincode'];
		$pid=$_POST['pid'];

		$rating=$_POST['stars'];

		$itemcat=0;

		if(!empty($pincode))
		{
			$query="SELECT * FROM prod WHERE pid=$pid"; 
			if($query_run=mysqli_query($mysql_con,$query))
			{
				$query_number=mysqli_num_rows($query_run);


				if($query_number!=0)
				{
					$row = $query_run->fetch_assoc();
					$itemcat=$row["itemcat"];
				}
				else
				{
					echo "Product Not available";
				}

			}

			$query="UPDATE internal SET urev=$rating WHERE pin=$pincode AND itemcat=$itemcat"; 
			if($query_run=mysqli_query($mysql_con,$query))
			{
				header("Location: utaken.html");
			}	
		}	
	}
	else
	{
		
	}


?>

<html>

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>

</head>


<body>

<section id="main" class="wrapper">
				<div class="container">

<h1> Enter user Review</h1>

<form action="user.php" method="POST">


<input type="text" name="pincode" placeholder="Pincode"></input>
<br>
<input type="text" name="pid" placeholder="Product ID"></input>

<br />

<label>Overall Rating</label>

<div class="12u$">
<div class="select-wrapper">
	<select name="stars" id="category">
		<option value="1">Poor</option>
		<option value="2">Average</option>
		<option value="3">Moderate</option>
		<option value="4">Good</option>
		<option value="5">Excellent</option>
	</select>
</div>
</div>

<br />

<input type="submit" value="Submit Review" />

</form>

</div>
</section>
</body>

</html>