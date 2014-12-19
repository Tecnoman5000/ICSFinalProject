<?php

	include("connect.php"); 	
	
	$conn=Connection();

	$result=mysql_query("SELECT * FROM `temp_log` ORDER BY `reg_date` DESC",$conn);
?>

<html>
   <head>
      <title>Sensor Data</title>
   </head>
<body>
   <h1>Temperature / moisture sensor readings</h1>

   <table border="1" cellspacing="1" cellpadding="1">
		<tr>
			<td>&nbsp;Temperature&nbsp;</td>
			<td>&nbsp;Timestamp&nbsp;</td>
		</tr>

      <?php 
		  if($result!==FALSE){
		     while($row = mysql_fetch_array($result)) {
		        printf("<tr><td> &nbsp;%s </td><td> &nbsp;%s&nbsp; </td></tr>", 
		           $row["temp"], $row["reg_date"]);
		     }
		     mysql_free_result($result);
		     mysql_close();
		  }
      ?>

   </table>
</body>
</html>
