<!-- Template used for w3 validator, which will be included in EVERY page. -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php

	/*
	Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
	Date: September 29, 2017
	Course: WEBD3201

	Brief Description: This is the header file which will be required for every page of our website.
	*/

	/* This line pulls in the functions that you need.
	* Make sure you upload the file functions.inc to your
	* working directory on the server.
	*/
	require "includes/functions.php";
	
	require "includes/constants.php";
	require "includes/db.php";
	
	ob_start();
	session_start();
	
	$title = "Tach | User Login";
	
	if (isset($_SESSION['user']))
	{
		$button = '<li id="logout"><a href="user-logout.php" class="btn-signin">Sign Out</a></li>';
		
		if (trim($_SESSION['user']['user_type']) == 'a')
		{
			$header_links = array('<li><a href="user-dashboard.php" class="a-main"/>Dashboard</li>',
											   '<li><a href="profile-create.php" class="a-main"/>Update Profile</li>',
											   '<li><a href="disabled-users.php" class="a-main"/>Disabled Users</li>',
											   '<li><a href="user-password-change.php" class="a-main"/>Change Password</li>',
											   '<li><a href="profile-images.php" class="a-main"/>Upload Photos</li>',
											   '<li id="logout-title"><a href="profile-create.php" class="a-main"/>' . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] . '</li>');
		}
		else if (trim($_SESSION['user']['profile_status']) == 'COMPLETE')
		{
			$header_links = array('<li><a href="user-dashboard.php" class="a-main"/>Dashboard</li>',
											   '<li><a href="profile-create.php" class="a-main"/>Update Profile</li>',
											   '<li><a href="profile-city-select.php" class="a-main"/>Search for people</li>',
											   '<li><a href="user-password-change.php" class="a-main"/>Change Password</li>',
											   '<li><a href="interests.php" class="a-main"/>Interests</li>',
											   '<li><a href="profile-images.php" class="a-main"/>Upload Photos</li>',
											   '<li id="logout-title"><a href="profile-create.php" class="a-main"/>' . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] . '</li>');
		}
		else
		{
			$header_links = array('<li><a href="user-dashboard.php" class="a-main"/>Dashboard</li>',
											   '<li><a href="profile-create.php" class="a-main"/>Create your profile</li>',
											   '<li><a href="profile-city-select.php" class="a-main"/>Search for people</li>',
											   '<li><a href="user-password-change.php" class="a-main"/>Change Password</li>',
											   '<li><a href="profile-images.php" class="a-main"/>Upload Photos</li>',
											    '<li id="logout-title"><a href="profile-create.php" class="a-main"/>' . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] . '</li>');
		}
	}
	else
	{
		$button = '<li id="login"><a href="user-login.php" class="btn-signin">Sign In</a></li>';
		
		$header_links = array('<li><a href="user-register.php" class="a-main"/>Register</li>');
	}	
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="./css/webd3201.css" />	<!-- Link to my CSS page -->
	
	<!-- Getting the fonts to be used on our site -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
	
	<!-- Setting the icon for the tab -->
	<link rel="icon" href="./images/tach_thumb.png">
	
	<script src='https://code.jquery.com/jquery-3.1.0.min.js'></script>
	<script src="./js/main.js"></script>
	<script src="./external/jquery/jquery.js"></script>
	<script src="jquery-ui.min.js"></script>
	<link rel="stylesheet" href="jquery-ui.min.css">
	
	<style type="text/css">	<!-- CS in line for border references --></style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $title; ?></title>
</head>

<!-- Starting the body of the website -->
<body>
	<div class="header">
		<div class="container">
		
			<ul class="nav">		
				<li><a href="index.php" ><img class="header-logo" src="./images/tach_logo.png"></a></li>
				<?php 
					foreach($header_links as $value)
					{
						echo $value;
					}
					echo $button;
				?>
			</ul>
			
		</div>
	</div>