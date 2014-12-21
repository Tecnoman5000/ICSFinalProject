<?php
	//Donated by Noah Burrell
  $message = $_REQUEST['err'];

  require 'template.php';
  require 'logincheck.php';
  global $loggedin;
  $title = "Ramekins Staff Login";
  
  if($loggedin){ //If someone is logged in, redirect them to the main page.
	header("Location: loggedin/index.php");
  } else { //Otherwise if no one is logged in, display the login page
	head();
	echo'
		<br />
		<form name="login" action="logmein.php" method="post">
			<table>
			  <tr>
				  <td>
					  <input type="text" name="user" placeholder="Username:" required>
				  </td>
			  </tr>
			  <tr>
				  <td>
					  <input type="password" name="pass" placeholder="Password:" required>
				  </td>
			  </tr>
			  <tr>
				  <td>
				  	  <br />
					  <div align="right">
						<input type="submit" value="Login">
					  </div>
				  </td>
			  </tr>
		  </table>
	  <form>
	';

	echo '<br /><p class="errmsg">' . $message . '</p>';

	foot();
  }
