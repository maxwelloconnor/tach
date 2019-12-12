<?php 
/*
Group 22
Date Created: November 28, 2017
Course: WEBD3201

Brief Description:
*/

include "header.php";

$error = "";

$success = false;

if (isset($_SESSION['user']))
{
	isDisabled(trim($_SESSION['user']['profile_status']));

	$username = $_SESSION['user']['user_id'];
	
	//If the server request method is 'POST'
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//Find the value the user entered for current password, and check if it exists in the database.
		if (isset($_POST["currentPassword"]) === true && strlen(trim($_POST["currentPassword"])) > "ZERO")
		{
			//current password is valid, store it
			$currentPass = trim($_POST["currentPassword"]);
			
		}
		//no password is given
		else
		{
			$error .= "Current Password can not be left blank.<br/>";
		}
		
		//Checks to see if new password is entered, and valid
		if (isset($_POST["newPassword"]) === true && strlen(trim($_POST["newPassword"])) > "ZERO")
		{
			//password is valid
			$newPass = trim($_POST["newPassword"]);
		}
		//no password is given
		else
		{
			$error .= "New Password can not be left blank.<br/>";
		}
		
		//Checks to see if confirm new password is entered, and valid
		if (isset($_POST["confirmNewPassword"]) === true && strlen(trim($_POST["confirmNewPassword"])) > "ZERO")
		{
			//password is valid
			$confirmNewPass = trim($_POST["confirmNewPassword"]);
		}
		//no password is given
		else
		{
			$error .= "Confirm New Password can not be left blank.<br/>";
		}
		
		if (strlen($newPass) < MINIMUM_PASSWORD_LENGTH || strlen($newPass) > MAXIMUM_PASSWORD_LENGTH)
		{
			$error = "New password must be at least " . MINIMUM_PASSWORD_LENGTH . " characters and no greater than " . MAXIMUM_PASSWORD_LENGTH . " characters.<br/>";
			$_POST['newPassword'] = "";
			$_POST['confirmNewPassword'] = "";
		}
		else if (strcmp($newPass, $confirmNewPass) != 0)
		{
			$error = "Passwords do not match.<br/>";
			$_POST['newPassword'] = "";
			$_POST['confirmNewPassword'] = "";
		}
		
		//if all text boxes have inputs, no errors
		if ($error == "")
		{
			
			//cannot connect to the database
			if ($dbconn === false) 
			{
				$error .= "Cannot connect to database.<br/>";
			}
			//connection was successful
			else 
			{
				//Hash the users password with a salt
				$hashed_pass = md5(SALT . $currentPass);
				$hashed_pass = trim($hashed_pass);

				//perform the prepare and execute statements. These will read in the values entered in the textboxes, and run them against the database.
				$results = pg_prepare($dbconn, "login_query", $sql_user_login);
				$results = pg_execute($dbconn, "login_query", array($username, $hashed_pass));
				
				
				//if a row is fetched from the database.
				if (pg_num_rows($results) > 0)
				{
					
					//Hash the users password with a salt
					$new_hashed_pass = md5(SALT . $newPass);
					$new_hashed_pass = trim($new_hashed_pass);
					
					//updates the users password
					$changePass = pg_prepare($dbconn, "change_password", $sql_change_password);
					$changePass = pg_execute($dbconn, "change_password", array($new_hashed_pass, $username));
					
					if ($changePass == false)
					{
						$error .= "Cannot update the database<br/>";
					}
					else
					{			
						//successful login
						$logged_in = true;
						
						session_unset($_SESSION);
						$user = pg_fetch_assoc($results, 0);						//captures all of the logged in user's data in associative array
						$_SESSION['user'] = $user;
						$_SESSION['message'] = "Password Changed Sucessfully.";
						setcookie("LoginCookie", $user['user_id'], time() + MAX_LOGIN_DAYS);
						
						header("Location: user-dashboard.php"); //password change is successful, redirect the user to the user dashboard
					}
				}
				
				// if the passwords do not match any records
				else 
				{
					$error .="Password Change Failed - Incorrect Current Password.<br/>";
				}
			}
		}
	}	
}

else
{
	$output = "You must be logged in to change your password";
}
?>

<div class="body">
	<div class="container">
		
		<?php
		if (isset($_SESSION['user']))
		{	
		?>
	
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
			<!-- User Id text box. The user will enter their user id here. -->
			<label for="user_id" class="form-label">Username:</label>
			<input class="form-input" type="text" name="user_id" value="<?php echo $username; ?>" readonly>
			<br/>

			<!-- Password text box. The user will enter their current password here. -->
			<label for="currentPassword" class="form-label">Current Password:</label>
			<input class="form-input" type="password" name="currentPassword"> 
			<br/>
			
			<!-- Password text box. The user will enter their new password here. -->
			<label for="newPassword" class="form-label">New Password:</label>
			<input class="form-input" type="password" name="newPassword"> 
			<br/>
			
			<!-- Password text box. The user will confirm their new password here. -->
			<label for="confirmNewPassword" class="form-label">Confirm New Password:</label>
			<input class="form-input" type="password" name="confirmNewPassword"> 
			<br/>

		  <!-- The user will click this button to attempt to run teir login info against the database. -->
		  <button type ="submit" class="btn-default">Change Password</button>
		  
		  <p><?php echo $error;?></p>	<!-- Displays error messages. Nothing will be displayed if there are no errors -->
		  
		</form>
		
		<?php 
		}
		?>
	</div>
</div>

<?php 
include "footer_f.php";
?>