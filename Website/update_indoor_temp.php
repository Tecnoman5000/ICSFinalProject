<?php
	function get_temp(){
		//include("connect.php");
		$conn=Connection();

		//data to enter into MySQL (table = temp_log; column = temp; data_to_enter = 22;)
		$query = "SELECT temp FROM temp_log";
		$result = mysql_query($query, $conn);
		$row = mysql_fetch_assoc($result);
		
		//if the query is successful echo
		if (mysql_query($query, $conn)) {
			$temp = (string)$row["temp"];
			//echo $temp;
		} else { //if not present the error
			echo "Error: " . $query . "<br>" . mysql_error($conn);
		}
		
		//close the connection
		//mysql_close($conn);
		
		return $temp;
	}
	//get_temp();
?>