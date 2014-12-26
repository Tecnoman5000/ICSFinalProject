<?php
   	include("connect.php");
   	
   	$conn=Connection();
	
	mysql_query("SET SESSION time_zone = '-5:00'"); 

	//data to enter into MySQL
	$query = "INSERT INTO exception_log (exception_text)
		VALUES ('".$_GET["exception"]."')";
	
	//if the query is successful echo
	if (mysql_query($query, $conn)) {
		echo "New record created successfully";
	} else { //if not present the error
		echo "Error: " . $query . "<br>" . mysql_error($conn);
	}
	
   	//close the connection
	mysql_close($conn);

	//return to the main page
   	//header("Location: index.php");
?>
