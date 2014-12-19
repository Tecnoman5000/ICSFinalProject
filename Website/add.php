<?php
   	include("connect.php");
   	
   	$conn=Connection();

	//$temp=$_POST["temp"];

	//data to enter into MySQL (table = temp_log; column = temp; data_to_enter = 22;)
	$query = "INSERT INTO temp_log (temp)
		VALUES ('".$_GET["temperature"]."')";
	
	//if the query is successful echo
	if (mysql_query($query, $conn)) {
		echo "New record created successfully";
	} else { //if not present the error
		echo "Error: " . $query . "<br>" . mysql_error($conn);
	}
	
   	//close the connection
	mysql_close($conn);

	//return to the main page
   	header("Location: index.php");
?>
