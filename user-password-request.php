<?php 
/*
Group 22
Date Created: September 20, 2017
Course: WEBD3201

Brief Description:
*/

include "header.php";

$error = "";
$username = "";
$email = "";
$database_email = "";
if (isset($_SESSION['user']))
{
	isDisabled(trim($_SESSION['user']['profile_status']));

	//If the server request method is 'POST'
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST["user_id"]) === true && strlen(trim($_POST["user_id"])) > "ZERO")
		{
			$username = trim($_POST["user_id"]);
			//cannot connect to the database
			if ($dbconn === false) 
			{
				$error .= "Cannot connect to database.<br/>";
			}
			else
			{
				if(isset($_POST["email"]) === true && strlen(trim($_POST["email"])) > "ZERO")
				{
					$user_results = pg_prepare($dbconn, "user_query", $sql_get_user);
					$user_results = pg_execute($dbconn, "user_query", array($username));
					
					if (pg_num_rows($user_results) > 0)
					{
						$user_info = pg_fetch_assoc($user_results, 0);
						$database_email = $user_info['email_address'];
					}
				}
			}
		}
		else
		{
			$error .= "A username must be entered.<br/>";
		}
		
		if(isset($_POST["email"]) === true && strlen(trim($_POST["email"])) > "ZERO")
		{
			$email = trim($_POST["email"]);
			
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$error .= "The email address entered is not valid.<br/>";
				$email = "";
			}
		}
		else
		{
			$error .= "An email address must be entered.<br/>";
		}
		
		if (trim($email) != trim($database_email))
		{
			$error .= "The email address entered does not match the one in the database.<br/>";
		}
			
		if($error = "")
		{
			
			$first_name = $user_info['first_name'];
			$last_name = $user_info['last_name'];
			
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&*';
			$randstring = '';
			for ($i = 0; $i < 8; $i++) 
			{
				$randstring = $characters[rand(0, strlen($characters))];
			}
			
			$email_out = "Hello " . $first_name . " " . $last_name . ". Your password to login to your Tach accout has been changed to " . $randstring . ".";
			
			$hashed_pass = md5($currentPass);
			$hashed_pass = trim($hashed_pass);
			
		//updates the users password
			$changePass = pg_prepare($dbconn, "change_password", $sql_change_password);
			$changePass = pg_execute($dbconn, "change_password", array($hashed_pass, $username));
			
			if ($changePass == false)
			{
				$error .= "Cannot update the database<br/>";
			}
			else
			{			
				//successful login
				$logged_in = true;
				mail(trim($email), "Your new Tach password.", $email_out);
				$_SESSION['message'] = "Your password has been changed sucessfully. Please check your email for your new password.";			
				header("Location: user-dashboard.php"); //password change is successful, redirect the user to the user dashboard
			}			
		}
	}
}

else
{
	header("Location: user-dashboard.php");	//redirect to the index page
}
?>

<div class="body">
	<div class="container">
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
			<!-- User Id text box. The user will enter their user id here. -->
			<label for="user_id" class="form-label">Username:</label>
			<input class="form-input" type="text" name="user_id" value="<?php echo $username; ?>">
			<br/>

			<!-- Password text box. The user will enter their current password here. -->
			<label for="email" class="form-label">Email Address:</label>
			<input class="form-input" type="text" name="email" value="<?php echo $email; ?>"> 
			<br/>

		  <!-- The user will click this button to attempt to run teir login info against the database. -->
		  <button type ="submit" class="btn-default">Request New Password</button>
		  
		  <p><?php echo $error;?></p>	<!-- Displays error messages. Nothing will be displayed if there are no errors -->
		  
		</form>
	</div>
</div>

<?php 
include "footer_f.php";
?>