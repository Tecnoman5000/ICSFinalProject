<?php

	function Connection(){
		$server="localhost";
		$user="root";
		$pass="bigman";
		$db="sensor_temp";
	   	
		$conn = mysql_connect($server, $user, $pass);

		if (!$conn) {
	    	die('MySQL ERROR: ' . mysql_error());
			echo("Bad connection");
		}
		
		mysql_select_db($db) or die( 'MySQL ERROR: '. mysql_error() );

		return $conn;
	}
?>
