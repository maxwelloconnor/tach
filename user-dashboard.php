<?php 
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: September 29, 2017
Course: WEBD3201

Brief Description: This is a static page. This will be modified in future deliverables. The user will be redirected here upon a sucessful login.
*/

include "header.php";

if (isset($_SESSION['user']))
{
	isDisabled(trim($_SESSION['user']['profile_status']));

	$firstName = $_SESSION['user']['first_name'];
	$lastName = $_SESSION['user']['last_name'];
	$lastAccess = $_SESSION['user']['last_access'];
	
	$output = "Welcome, " . $firstName . " " . $lastName . ". The last time you logged in was " . $lastAccess . ".";

}

else
{
	$output = "You are not yet logged in.";
}

?>

<div class="body">
	<div class="container">
		<!-- Tell the user their login was successful -->
		<p><?php echo $output;?> </p>
	</div>
</div>

<?php 
include "footer_f.php";
?>