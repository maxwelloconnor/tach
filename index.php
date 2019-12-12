<?php 
/*
Group 22
Date Created: September 20, 2017
Course: WEBD3201

Brief Description:
*/


$title = "Tach | Get Attached To New People";
$filename = "index.php";
$date = date("Y");

include "header.php";
?>

<div class="jumbotron">
	<div class="container">
		<div class ="main">
			<h1>Get Attached To New People</h1>
			<h2>Start Searching Tach Today!</h2>
			<a class="btn-main" href="user-register.php">Sign Up</a>
		</div>
	</div>
</div>

<div class="hide-me">
	<div class="about-banner">
		<div class="about">
			<div class="container">
				<h1>About Tach</h1>
				<p>
					Tach is here for you to meet the partner of your dreams! We ensure to pair you with the most compatible people with the help of our efficient matching algorithm.
				</p>
				<p>
					This site was created to demonstrate the skills learned during the WEBD3201 course at Durham College. 
					The site authors are the following from Group 22: Max O'Connor, Miguel Macciocchi, Keith Mathur, and Liam Stachiw.
				</p>
			</div>
		</div>
	</div>
</div>

<div class="hide-me">
	<div class="supporting">
		<div class="container">
			
			<div class="col">
				<img src="./images/design.svg">
				<h2>Edit Info</h2>
				<p>Edit profile photos and add a unique bio.<p>
				<a class="btn-default" href="profile-create.php">Learn more</a>				
			</div>
			
			<div class="col">
				<img src="./images/heart_logo.jpg">
				<h2>Get Matches</h2>
				<p>View profiles and connect with others.</p>
				<a class="btn-default" href="profile-search.php">Learn more</a>
			</div>
			
			<div class="col">
				<img src="./images/message_logo.png">
				<h2>Chat</h2>
				<p>Chat with matches and build relationships.</p>
				<a class="btn-default" href="profile-search-results.php">Learn more</a>				
			</div>
					
		<div class="clearfix"></div>
			
		</div>
	</div>
</div>
<?php 
include "footer.php";
?>