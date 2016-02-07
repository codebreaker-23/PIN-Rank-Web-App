<?php

require 'connection.php';

if(isset($_POST['pincode']) && isset($_POST['pid']))
	{
		$pincode=$_POST['pincode'];
		$pid=$_POST['pid'];
		$amazon=$_POST['amazon'];
		$flipkart=$_POST['flipkart'];
		$itemcat=0;

		if(!empty($pincode) && !empty($pid))
		{ # pick from here .... update values
			$query="SELECT itemcat FROM prod WHERE pid=$pid"; 
			if($query_run=mysqli_query($mysql_con,$query))
			{
				$query_number=mysqli_num_rows($query_run);


				if($query_number!=0)
				{
					$row = $query_run->fetch_assoc();
					$itemcat=$row["itemcat"];
				}

			}

			//echo $amazon;
			//echo $flipkart;

			$ans=0;

			if($amazon == true)
			{
				$ans += 2.5;
			}

			if($flipkart == true)
			{
				$ans += 2.5;
			}

			$query="UPDATE internal SET comps=$ans WHERE pin=$pincode AND itemcat=$itemcat"; 
			if($query_run=mysqli_query($mysql_con,$query))
			{
				header("Location: s_added.html");
			}			
			
		}

		echo "<h1>Enter valid pin</h1>";
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

<h1>Competition Entry</h1>

<form action="competition.php" method="POST">


<input type="text" name="pincode" placeholder="Pincode"></input>
<br>
<input type="text" name="pid" placeholder="product ID" ></input>
<br>

<div class="6u 12u$(small)">
	<input type="checkbox" id="copy" name="amazon">
	<label for="copy">Amazon</label>
</div>
<div class="6u$ 12u$(small)">
	<input type="checkbox" id="human" name="flipkart" checked>
	<label for="human">Flipkart</label>
</div>

<br>

<input type="submit" value="Submit data" />

</form>
</div>
</section>
</body>

</html>