<?php
	
    if(!isset($_SESSION['user_otp'])){
	    session_destroy();
		
		header( "Location:index");
		exit;
	}
	
	
	if(!isset($_SESSION['user_email'])){
	    session_destroy();
		
		header( "Location:index");
		exit;
	}
	 
?>