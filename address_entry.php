
<?php

require 'connection.php';

if(isset($_POST['pincode']))
	{
		$pincode=$_POST['pincode'];
		$city=$_POST['city'];
		

		if(!empty($pincode))
		{

			$query="SELECT * FROM pinname WHERE pin=$pincode AND city=$city"; 
			if($query_run=mysqli_query($mysql_con,$query))
			{
				$query_number=mysqli_num_rows($query_run);


				if($query_number==0)
				{
					echo "<h1>Please enter city name and pincode carefully</h1>";
					header("Location: address_entry.php");
				}

			}

			$query="SELECT `pin` FROM `internal` WHERE `pin`='".$pincode."' "; 
			if($query_run=mysqli_query($mysql_con,$query))
			{
				$query_number=mysqli_num_rows($query_run);


				if($query_number!=0)
				{
					header("Location: orderplaced.php");
				}

			}
			
		}

		echo "<h3>Enter valid pin</h3>";
	}
	else
	{
		
	}

?>

<html>

<head>

<script>

function validateForm() {
    
    var x = document.forms["address"]["hno"].value;
    if (isNaN(x)) {
        alert("Enter Valid House Number");
        return false;
    }

    x=document.forms["address"]["city"].value;

if (x == null || x == "") {
        alert("Enter city");
        return false;
    }

    if (x == null || x == "") {
        alert("Enter city");
        return false;
    }

     x=document.forms["address"]["pincode"].value;

    if (x == null || x == "") {
        alert("Enter pincode");
        return false;
    }

    if(isNaN(x))
    {
    	alert("Enter valid pincode");
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

<h1></h1>

<section id="main" class="wrapper">
				<div class="container">
				
			<section>
							

<h2>Enter Address Details</h2>


<form name="address" action="address_entry.php" method="POST" onsubmit="return validateForm()">

<input type="text" name="hno" placeholder="House number"></input>
<br>
<input type="text" name="streetname" placeholder="Street Name"></input>
<br>
<input type="text" name="city" placeholder="City"></input>
<br>
<select name="state">
<option value="haryana">Haryana</option>
<option value="punjab">Punjab</option>
<option value="himachal">Himachal pradesh</option>
</select>
<br>
<input type="text" name="pincode" placeholder="Pincode"></input>
<br>
<input type="submit" value="Place Order" />

</form>


			</section>


</body>

</html>