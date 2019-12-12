<?php 
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: 
Course: WEBD3201
Brief Description:
*/

include "header.php";
?>

<div class="body">
	<div class="container">
	
		<?php 
			if (isset($_SESSION['error']))
			{
				echo $_SESSION['error'];
				unset($_SESSION['error']);
			}
		?>
		
	
	</div>
</div>

<?php include "footer_f.php"; ?>