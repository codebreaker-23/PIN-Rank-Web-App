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

			# set threshold score values

			//echo $score;

			if($score >= 4.0)
			{
				header("Location: buynow.php");
			}
			else
			{
				header("Location: notify.php");
			}
			
		}

		echo "Enter valid pin";
	}
	else
	{
		echo "Enter Pincode";
	}


?>


<html>

<head>
</head>

<body>

<h1> Item1</h1>

<form action="main.php" method="POST">

<br>
<input type="text" name="pincode" placeholder="Pincode"></input>
<br>
<input type="text" name="pid" placeholder="Product ID"></input>
<br>
<input type="submit" value="Check" />

</form>


</body>

</html>