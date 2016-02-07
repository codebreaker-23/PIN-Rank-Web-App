<?php

require 'connection.php';

if(isset($_POST['pincode']))
	{
		$pincode=$_POST['pincode'];
		
		$pid=$_POST['pid'];

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

			$pinval=$pincode;
			$cat=$itemcat;

			require 'score.php';

			echo "<br><br><br><center><h1>The Ranked Score is : ";
			echo $score;
			echo "<br></h1></center>";

			//echo $ans;

			if($score != 0 &&($score >= 4.0 || $ans == 1))
			{
					//header("Location: buynow.php");

					include "buynow.php";
			}
			else
			{
					//header("Location: notify.php");
					include "notify.php";
			}


			# set threshold score values

			
		}
		else
		{
			echo "<br><br><h1>Enter valid pin</h1>";
		}

		
	}
	else
	{
	//	echo "Enter Pincode";
	}


?>

<html>
	<head>
		<title>newmain1</title>
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

		<!-- Header -->
			<header id="header" class="skels-layers-fixed">
				<img src="sd.png" alt="snapdeal" height="150" width="155">
			</header>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">
				
			<section>
							<h2>Validate Pincode</h2>
							<form method="POST" action="newmain1.php">
								<div class="row uniform 50%">
									<div class="6u 12u$(xsmall)">
										<input type="text" name="pid" id="name" placeholder="Product ID" />
									</div>
									<div class="6u$ 12u$(xsmall)">
										<input type="text" name="pincode" id="email"  placeholder="Pincode" />
									</div>
									
									<div class="12u$">
										<ul class="actions" align="center">
											<li><input type="submit" value="Check" class="special"/></li>
										</ul>
									</div>

								</div>
							</form>
			</section>

	</body>
</html>