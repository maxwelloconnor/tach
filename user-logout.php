<?php
include "header.php";

if (isset($_SESSION['user'])) 
{
	
	if (isset($_SESSION['error']))
	{
		session_unset();
		session_destroy();	
		session_start();
		$_SESSION['error'] = "<p>Sorry, but you must complete updating your profile information before viewing this page.</p>";
		
		header("Location: user-login.php");
		exit;
	}
	else
	{
		session_unset();
		session_destroy();	
		session_start();
		
		$_SESSION['logout'] = "<p>Logout was successful.</p>";
		header("Location: user-login.php");
		exit;
	}
}

include "footer.php";
?>