<?php

require 'connection.php';

if(isset($_POST['pincode']) && isset($_POST['pid']))
	{
		$pincode=$_POST['pincode'];
		$pid=$_POST['pid'];
		


		if(!empty($pincode) && !empty($pid))
		{ # pick from here .... update values

			$success=$_POST['success'];
			$td=$_POST['time'];
			$rating=$_POST['stars'];
			$itemcat=0;
			$s=0;
			$f=0;
			$t=0;

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

			$query="SELECT * FROM internal WHERE pin=$pincode AND itemcat=$itemcat"; 
			if($query_run=mysqli_query($mysql_con,$query))
			{
				$query_number=mysqli_num_rows($query_run);


				if($query_number!=0)
				{
					$row = $query_run->fetch_assoc();
					$f=$row["fail"];
					$s=$row["success"];
					$t=$row["deltime"];
				}

			}

			if($td == true)
			{
				$t += 1;
			}

			if($success == "1")
			{
				$s += 1;

				$sr=$s/($s + $f);

				$query="UPDATE internal SET success=$s , delsuc=$sr , deltime=$t , delrev=$rating WHERE pin=$pincode AND itemcat=$itemcat"; 
							if($query_run=mysqli_query($mysql_con,$query))
							{
								//header("Location: deltaken.html");
							}	
			}
			else
			{
				$f += 1;

				$sr=$s/($s + $f);

				$query="UPDATE internal SET fail=$f , delsuc=$sr , deltime=$t , delrev=$rating WHERE pin=$pincode AND itemcat=$itemcat"; 
							if($query_run=mysqli_query($mysql_con,$query))
							{
								//header("Location: deltaken.html");
							}	
			}

			$query="UPDATE similarity SET delsuc=$sr WHERE pin=$pincode AND itemcat=$itemcat"; 
							if($query_run=mysqli_query($mysql_con,$query))
							{
								header("Location: deltaken.html");
							}	
		}

		echo "<h1>Enter valid pin<h1>";
	}
	else
	{
		
	}

?>

<html>

<head>

<script>

function validateForm() {

    var x = document.forms["address"]["pincode"].value;
    
    if (isNaN(x) || x == null || x == "") {
        alert("Enter Valid House Number");
        return false;
    }

    return true;
}

</script>

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
<h1> Enter Delivery Review</h1>

<form action="delivery.php" method="POST" onsubmit="return validateForm()">


<input type="text" name="pincode" placeholder="Pincode"></input>
<br>
<input type="text" name="pid" placeholder="Product ID"></input>

<br />

<label>Success?</label>

<div class="4u 12u$(xsmall)">
	<input type="radio" id="priority-low" name="success" value="1" checked>
	<label for="priority-low">YES</label>
</div>
<div class="4u 12u$(xsmall)">
	<input type="radio" id="priority-normal" name="success" value="0">
	<label for="priority-normal">NO</label>
</div>

<br />

<label>Timely Delivery?</label>

<div class="4u 12u$(xsmall)">
	<input type="radio" id="priority-low1" name="time" value="1" checked>
	<label for="priority-low1">YES</label>
</div>
<div class="4u 12u$(xsmall)">
	<input type="radio" id="priority-normal1" name="time" value="0">
	<label for="priority-normal1">NO</label>
</div>


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