<?php
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: September 29, 2017
Course: WEBD3201

Description: This file will allow the user to login to the site with their user id and password. 
*/

include "header.php";

//output end error messages initalized as empty strings
$output = "";
$error = "";

//Testing boolean validation set to defaults of false, invalid.
$login = false;
$pass = false;
$logged_in = false;

//If the server request method is 'POST'
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	//Find the value the user entered for user id, and check if it exists in the database.
	if (isset($_POST["user_id"]) === true && strlen(trim($_POST["user_id"])) > "ZERO")
	{
		//login is valid, and the value entered will saty sticky in the form if password is incorrect.	
		$login = trim($_POST["user_id"]);
		
	}
	//no user ID is given
	else
	{
		$error .= "No username given.<br/>";
	}
	
	//Checks to see if password is entered, and valid
	if (isset($_POST["password"]) === true && strlen(trim($_POST["password"])) > "ZERO")
	{
		//password is valid
		$pass = trim($_POST["password"]);
	}
	//no password is given
	else
	{
		$error .= "No password given.<br/>";
	}
	
	
	//if both text boxes have inputs, no errors
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
			$hashed_pass = md5(SALT . $pass);
			$hashed_pass = trim($hashed_pass);

			//perform the prepare and execute statements. These will read in the values entered in the textboxes, and run them against the database.
			$results = pg_prepare($dbconn, "login_query", $sql_user_login);
			$results = pg_execute($dbconn, "login_query", array($login, $hashed_pass));
			
			
			//if a row is fetched from the database.
			if (pg_num_rows($results) > 0)
			{
				
				//updates the last login date to current time for the user ID
				$update = pg_prepare($dbconn, "login_update", $sql_user_update);
				$update = pg_execute($dbconn, "login_update", array($login));
				
				if ($update == false)
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
					setcookie("LoginCookie", $user['user_id'], time() + MAX_LOGIN_DAYS);
				}
			}
			
			// if the user ID and password do not match any records
			else 
			{
				$error .="Login Failed - Invalid Username or Password.<br/>";
			}
		}
	}
}
	

?> 

<div class="body">
	<div class="container">
	
		<?php 
			if (isset($_SESSION['logout']))
			{
				echo $_SESSION['logout'];
				unset($_SESSION['logout']);
			}
			if (isset($_SESSION['account_create']))
			{
				echo $_SESSION['account_create'];
				unset($_SESSION['account_create']);
			}
			if (isset($_SESSION['error']))
			{
				echo $_SESSION['error'];
				unset($_SESSION['error']);
			}
		?>
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
			<!-- User Id text box. The user will enter their user id here. -->
			<label for="user_id" class="form-label">Username</label>
			<input  class="form-input" type="text" name="user_id" value="<?php if (isset($_POST['user_id'])) { echo $_POST['user_id']; } ?>">
			<br/>

			<!-- Password text box. The user will enter their password here. -->
			<label for="password" class="form-label">Password</label>
			<input class="form-input" type="password" name="password"> 
			<br/>

		  <!-- The user will click this button to attempt to run teir login info against the database. -->
		  <button type ="submit" class="btn-default">Login</button>
		  
		  <p><?php echo $error;?></p>	<!-- Displays error messages. Nothing will be displayed if there are no errors -->
		  
		  <?php 
			
			//displays welcome message
			if ($logged_in === true)
			{			
				$userType = trim($_SESSION['user']['user_type']);
				$userStatus = trim($_SESSION['user']['profile_status']);
				
				if ($userType == 'a')
				{
					header("Location: admin.php"); //login is successful, redirect the user to the admin page
				}
				else if ($userStatus == 'DISABLED')
				{
						$_SESSION['error'] = "<p>Your account is denied access to the system for having an offensive profile</p>";
						header("Location: acceptable-use.php");
				}
				else
				{
					header("Location: user-dashboard.php"); //login is successful, redirect the user to the user dashboard
				}
			}
			
		  ?>
		  
		</form>
		
	</div>
</div>	

<?php include "footer_f.php";?>