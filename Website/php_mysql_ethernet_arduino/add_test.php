<?php
   	include("connect.php");
   	
   	$link=Connection();

	$temp1=$_POST["temp"];
	$timestamp1=$_POST["timestamp"];

	$query = "INSERT INTO `temp_log` (`temp`, `timestamp`); 
		VALUES ('22', '10')";
	
   	mysql_query($query,$link);
	mysql_close($link);

   	header("Location: index.php");
?>
