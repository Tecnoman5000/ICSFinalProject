<?php
	//include("connect.php");
	$conn = Connection();
	//close the connection
	//mysql_close($conn);
	
	function get_exception_id(){
		$query = "SELECT id FROM exception_log ORDER BY id DESC LIMIT 1;";
		$result = mysql_query($query, $GLOBALS['conn']);
		$row = mysql_fetch_assoc($result);
		
		
		//if the query is successful echo
		if (mysql_query($query, $GLOBALS['conn'])) {
			$id = (string)$row["id"];
		} else { //if not present the error
			echo "Error: " . $query . "<br>" . mysql_error($GLOBALS['conn']);
		}
		return (int)$id;
	}
	function get_exception_text(){
		$query = "SELECT exception_text FROM exception_log ORDER BY id DESC LIMIT 1;";
		$result = mysql_query($query, $GLOBALS['conn']);
		$row = mysql_fetch_assoc($result);
		
		//if the query is successful echo
		if (mysql_query($query, $GLOBALS['conn'])) {
			$exception_text = (string)$row["exception_text"];
		} else { //if not present the error
			echo "Error: " . $query . "<br>" . mysql_error($GLOBALS['conn']);
		}
		return $exception_text;
	}
	function get_exception_timestamp(){
		$query = "SELECT reg_date FROM exception_log ORDER BY id DESC LIMIT 1;";
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
