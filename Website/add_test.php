<?php
   	include("connect.php");
   	
   	$conn=Connection();
	
	// sql to create table
	$sql = "CREATE TABLE exception_log (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	exception_text VARCHAR(30) NOT NULL,
	reg_date TIMESTAMP
	)";
	
	if (mysql_query($sql, $conn)) {
		echo "Table 'motion' created successfully";
	} else {
		echo "Error creating table: " . mysql_error($conn);
	}

	//data to enter into MySQL (table = temp_log; column = temp; data_to_enter = 22;)
	/*$query = "INSERT INTO temp_log (temp)
		VALUES (22)";
	
	//if the query is successful echo
	if (mysql_query($query, $conn)) {
    echo "New record created successfully";
	} else { //if not present the error
		echo "Error: " . $query . "<br>" . mysql_error($conn);
	}*/
	
   	//close the connection
	mysql_close($conn);

	//return to the main page
   	//header("Location: index.php");
?>
