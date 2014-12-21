<?php
	//Donated by Noah Burrell
  include 'conn.php';
  global $loggedin;
  if (isset($_COOKIE["ramekinslogin"])){
	$login_result = mysqli_query($con,"SELECT id,user,password FROM users");
	while($login_row = mysqli_fetch_array($login_result)) {
	  $sig = hash_hmac('sha256', $login_row['id'], $login_row['password']);
	  if($sig == $_COOKIE["ramekinslogin"]){
		$loggedin = true;
		break; 
	  }
	}		
  } else {
	$loggedin = false;
  }
