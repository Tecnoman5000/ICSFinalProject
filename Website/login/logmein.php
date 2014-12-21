<?php		
	//Donated by Noah Burrell
    $logingood = false;

    include 'logincheck.php';
    include 'conn.php';

    if(!$loggedin){
        if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $result = mysqli_query($con,"SELECT id,user,password FROM users");
        while($row = mysqli_fetch_array($result)) {
                if(($_POST['user'] == $row['user']) && ($_POST['pass'] == $row['password'])){
                        $logingood = true;
                        $user = $row['user'];
                        $pass = $row['password'];
                        $id = $row['id'];
                        break; 
                }
        }


        if($logingood){	  		  
          $sig = hash_hmac('sha256', $id, $pass);
          setcookie("ramekinslogin", $sig, time()+ 7200);
          header("Location: index.php");
        }else{
          header("Location: login.php?err=Bad%20Login,%20Please%20Try%20Again.");
        }

        mysqli_close($con);
    }else{
        echo 'What\'re you trying to do mate? I\'ll sock ya mum.<br />Try <a href="logout.php">logging out</a> first...';
    }
