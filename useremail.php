<?php include("includes/connection.php");

	//$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $email = $_POST['name'];

    if($email=='')
	{
		$_SESSION['msg']="24"; 
		header( "Location:index.php");
		exit;		 
	}	 
	else
	{
		$qry = "SELECT * FROM tbl_users WHERE email='$email'";

		$result=mysqli_query($mysqli,$qry);		
		
		if(mysqli_num_rows($result) > 0)
		{ 
			header("Location:userverify.php");
			exit;
		}
		else
		{
		    
		    // $qry2 = "INSERT INTO tbl_users (email) VALUES ($email)";
			// $result2 = mysqli_query($mysqli, $qry2);	

			$qry2 = $mysqli->prepare("INSERT INTO tbl_users (email) VALUES (?)");
			$qry2->bind_param("s", $email);
			$result2 = $qry2->execute();
			// $qry2->error;
			$qry2->close();
			
			// print_r($result2);
			// exit();
		
    		if($result2)
    		{ 
    		    $_SESSION['user_email']=$email;
    			header( "Location:userverify.php");
    			exit;
    		}
    		else
    		{
    		   header( "Location:index.php");
    			exit; 
    		}
	 
		}
	}
	

?> 