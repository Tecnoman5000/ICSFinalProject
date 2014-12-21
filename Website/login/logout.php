<?php
	//Donated by Noah Burrell
  if (isset($_COOKIE["ramekinslogin"])){
		setcookie('ramekinslogin', null, -1);
	}
	header("Location: index.php");
