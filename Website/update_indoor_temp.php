<?php
	//include("connect.php");
	$conn = Connection();
	//close the connection
	//mysql_close($conn);
	
	function get_temp(){
		//data to enter into MySQL (table = temp_log; column = temp; data_to_enter = 22;)
		$query = "SELECT temp FROM temp_log ORDER BY id DESC LIMIT 1;";
		$result = mysql_query($query, $GLOBALS['conn']);
		$row = mysql_fetch_assoc($result);
		
		
		//if the query is successful echo
		if (mysql_query($query, $GLOBALS['conn'])) {
			$temp = (string)$row["temp"];
		} else { //if not present the error
			echo "Error: " . $query . "<br>" . mysql_error($GLOBALS['conn']);
		}
		return $temp;
	}
	function get_temp_timestamp(){
		$query = "SELECT reg_date FROM temp_log ORDER BY id DESC LIMIT 1;";
		$result = mysql_query($query, $GLOBALS['conn']);
		$row = mysql_fetch_assoc($result);
		
		//if the query is successful echo
		if (mysql_query($query, $GLOBALS['conn'])) {
			$timestamp = (string)$row["reg_date"];
		} else { //if not present the error
			echo "Error: " . $query . "<br>" . mysql_error($GLOBALS['conn']);
		}
		return $timestamp;
	}
?>