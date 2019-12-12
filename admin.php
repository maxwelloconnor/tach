<?php 
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: December 03, 2017
Course: WEBD3201
*/

include "header.php";

//if a user is logged in
if (isset($_SESSION['user']))
{
	
	$reported = "";
	
	$userType = trim($_SESSION['user']['user_type']);	//get the users account type
	
	//if the user has an admin account
	if($userType == 'a')
	{
		//display a welcome message
		$output = "Welcome, " . $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name'] . ". You are an admin account! The last time you logged in was " . $_SESSION['user']['last_access'] . ".";
	}
		
	//if the user is not an admin
	else
	{
		header("Location: user-dashboard.php");	//redirect to the index page
	}

	$users_reported = pg_prepare($dbconn, "users_reported_query", $sql_reported_users);
	$users_reported = pg_execute($dbconn, "users_reported_query", array());
	
	if (pg_num_rows($users_reported) > 0)
	{
		$user = pg_fetch_result($users_reported, 0);
		
		$users_reported_by = pg_prepare($dbconn, "users_reported_by_query", $sql_reported_by);
		$users_reported_by = pg_execute($dbconn, "users_reported_by_query", array());
		$reported_by = pg_fetch_result($users_reported_by, 0);
	}
	else
	{
		$output = "There are no more reported users.";
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	
	
		if (trim($_POST["decision"]) == "disable")
		{
			$disable_user = pg_prepare($dbconn, "disbale_user_query", $sql_disable_user);
			$disable_user = pg_execute($dbconn, "disbale_user_query", array($user));
			$output = "The user has been disabled and removed from the offensives table.";
		}
		else
		{
			$output = "The user has been dismissed and removed from the offensives table.";
		}
		
		$remove_reported = pg_prepare($dbconn, "remove_user_query", $sql_remove_reported);
		$remove_reported = pg_execute($dbconn, "remove_user_query", array($user));	
		
	}	
	
	$users_reported = pg_execute($dbconn, "users_reported_query", array());
	$user = pg_fetch_result($users_reported, 0);		
	$users_reported_by = pg_execute($dbconn, "users_reported_by_query", array());
	$reported_by = pg_fetch_result($users_reported_by, 0);

}
//if the user is not logged in
else
{
	header("Location: index.php");	//redirect to the index page
}

?>

<div class="body">
	<div class="container">
		<!-- Tell the user their login was successful -->
		<p><?php echo $output;?> </p>
		
		<?php if (pg_num_rows($users_reported) > 0){ ?>
		<form method="POST">
			<table align="center" border="1px">
				<tr>
					<th>Reported User</th>
					<th>Reported By</th>
					<th>Select Action</th>
				</tr>
				<tr>
					<td align='center'>
						<a href="profile-display.php"><?php echo $user; ?></a>
					</td>	
					<td align='center'>
						<a href="profile-display.php"><?php echo $reported_by; ?></a>
					</td>	
					<td align='center'>
						<button type="submit" name="decision" value="disable">Disable User</button>
						<button type="submit" name="decision" value="dismiss">Dismiss User</button>				
					</td>
				</tr>
			</table>
		</form>
		<?php  }?>	
	</div>
</div>

<?php 
include "footer_f.php";
?>