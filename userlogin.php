<?php include("includes/connection.php");


	//$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
 $password = $_POST['password'];
 
    if($password=="")
	{
		$_SESSION['msg']="24"; 
		header( "Location:index.php");
		exit;		 
	}	 
	else
	{
		//$qry="select * from tbl_settings where user_otp='".$password."'";
		$qry="select * from user_otp where otp='".$password."'";
		 
		$result=mysqli_query($mysqli,$qry);		
		
		if(mysqli_num_rows($result) > 0)
		{ 
			$row=mysqli_fetch_assoc($result);
			
		    $_SESSION['user_otp']=$row['otp'];
			  
			header( "Location:userhome.php");
			exit;
				
		}
		else
		{
			$_SESSION['msg']="24"; 
			header( "Location:userverify.php");
			exit;
			 
		}
	}
	

?> 