<?php 
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: September 29, 2017
Course: WEBD3201

Brief Description: This is a static page. It will be modified in future deliverables to show the corresponding user profile from the database, based on what profiel the user clicked.
*/

include "header.php";

if(isset($_SESSION['user']))
{
	isDisabled(trim($_SESSION['user']['profile_status']));
}
?>

<!-- This block will contain static, example information of what will be shown in a user profile. -->
<div class="body">
	<div class="container">
	
	
	</div>
</div>

<?php 
include "footer_f.php";
?>
