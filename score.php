<!-- set $pinval and $cat initially  -->
<!-- assumes you established connection -->

<?php
	
	$ans=0;

	$soceco=0.15;
	$intcon=0.1;
	$delrev=0.1;
	$urev=0.05;
	$comps=0.4;
	$delsuc=0.15;
	$deltime=0.05;


	$first=0.7;
	$second=0.3;

	$v_soceco=0;
	$v_intcon=0;
	$v_delrev=0;
	$v_urev=0;
	$v_comps=0;
	$v_delsuc=0;
	$v_deltime=0;
	$v_simil=0;

	$tier=0;




	$query="SELECT * FROM internal WHERE pin=$pinval AND itemcat=$cat";

	$score=0;

	if($query_run=mysqli_query($mysql_con,$query))
	{
		$query_number=mysqli_num_rows($query_run);


		if($query_number!=0)
		{
			$row = $query_run->fetch_assoc();

			$v_comps= $comps*$row["comps"];
			$v_delsuc= 5*$delsuc*$row["delsuc"];
			$v_delrev= $delrev*$row["delrev"];
			$v_deltime= 5*(($deltime*$row["deltime"])/($row["success"]+$row["fail"]));
			$v_urev= $urev*$row["urev"];
		}

	}


	$query="SELECT * FROM external WHERE pin=$pinval";

	if($query_run=mysqli_query($mysql_con,$query))
	{
		$query_number=mysqli_num_rows($query_run);


		if($query_number!=0)
		{
			$row = $query_run->fetch_assoc();

			$v_soceco=$soceco*$row["soeco"];
			$v_intcon=$intcon*$row["internet"];
			$tier=$row["tier"];
		}

	}

	$query="SELECT * FROM similarity WHERE pin=$pinval AND itemcat=$cat";

	$sim=0;

	if($query_run=mysqli_query($mysql_con,$query))
	{
		$query_number=mysqli_num_rows($query_run);


		if($query_number!=0)
		{
			$row = $query_run->fetch_assoc();

			$sim=$row["simval"];
		}

	}

	$query="SELECT MAX(delsuc) AS max FROM similarity WHERE simval=$sim AND itemcat=$cat";

	$max_val_ratio=0;

if($query_run=mysqli_query($mysql_con,$query))
	{
		$query_number=mysqli_num_rows($query_run);


		if($query_number!=0)
		{
			$row = $query_run->fetch_assoc();

			$max_val_ratio=$row['max'];
		}

	}

	

	$v_simil=$max_val_ratio*$second*5;


	if($tier == 5)
	{
		$ans=1;
	}

	/*echo $v_urev;
	echo "<br>";
	echo $v_comps;
		echo "<br>";
	echo $v_deltime;
		echo "<br>";
	echo $v_delsuc;
		echo "<br>";
	echo $v_delrev;

	echo " second set<br>";

	echo $v_simil;
	echo "<br>";
	echo $v_intcon;
	echo "<br>";
	echo $v_soceco;*/

	
	$score = $score + $v_soceco + $v_intcon;
	$score = $score + $v_urev + $v_comps + $v_deltime + $v_delsuc + $v_delrev;
	$score = $score*$first + $v_simil;

	$score = $score*2;
	
	
?>