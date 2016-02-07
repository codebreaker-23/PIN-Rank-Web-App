<?php

$mysql_host='localhost';
$mysql_user='root';
$mysql_pass='';
$mysql_db='snap';

$mysql_con=mysqli_connect($mysql_host,$mysql_user,$mysql_pass);

if(!$mysql_con||!mysqli_select_db($mysql_con,$mysql_db))
{
	die('Error in connection');
}


?>