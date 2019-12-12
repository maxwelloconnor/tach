<?php 
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: September 29, 2017
Course: WEBD3201

Brief Description: This is a static page. This will be modified in future deliverables to show the list of users that exist in the database, and match what the user searched for.
				   The list of users will be clickable links that redirect to the corresponding profiles.
*/

include "header.php";

if(isset($_SESSION['user']))
{
	isDisabled(trim($_SESSION['user']['profile_status']));
}
?>

<div class="body">
	<div class="container">
		
		<?php
		
		?>
		
	</div>
</div>

<?php 
include "footer_f.php";
?>

