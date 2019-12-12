<?php 
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: 
Course: WEBD3201
Brief Description: 
*/

include "header.php";

$account_created = false;
$is_valid = true;

$status = "INCOMPLETE";
$enrol = date("Y-m-d",time());
$access = date("Y-m-d",time());
$client_type = 'i';

$db_error = "";
$user_error = "";
$pass_error = "";
$first_name_error = "";
$age_error = "";
$last_name_error = "";
$email_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{	
	$login = trim($_POST["user_id"]);
	$pass = trim($_POST["password"]);
	$conf_pass = trim($_POST["password_conf"]);
	$DOB = trim($_POST["DOB"]);
	$first = trim($_POST["first_name"]);
	$last = trim($_POST["last_name"]);
	$email = trim($_POST["email_address"]);
	
	$user_age = calculateAge($DOB);
	
	if ($dbconn == false)
	{
		$db_error = "<p>Cannot connect to the database.</p>";
	}
	else
	{
		$id_available = pg_prepare($dbconn, "user_id_query", $sql_user_id);
		$id_available = pg_execute($dbconn, "user_id_query", array($login));
		
		if (pg_num_rows($id_available) > 0)
		{
			$user_error = "The user ID '$login' has already been taken. Please use a different ID.<br/>";
			$is_valid = false;
			$_POST['user_id'] = "";
		}
		
		if (strlen($login) < MINIMUM_ID_LENGTH || strlen($login) > MAXIMUM_ID_LENGTH)
		{
			$user_error = "User ID must be at least " . MINIMUM_ID_LENGTH . " characters and no greater than " . MAXIMUM_ID_LENGTH . " characters.<br/>";
			$is_valid = false;
			$_POST['user_id'] = "";
		}
		
		if (strlen($pass) < MINIMUM_PASSWORD_LENGTH || strlen($pass) > MAXIMUM_PASSWORD_LENGTH)
		{
			$pass_error = "Password must be at least " . MINIMUM_PASSWORD_LENGTH . " characters and no greater than " . MAXIMUM_PASSWORD_LENGTH . " characters.<br/>";
			$is_valid = false;
			$_POST['password'] = "";
			$_POST['password_conf'] = "";
		}
		else if (strcmp($pass, $conf_pass) != 0)
		{
			$pass_error = "Passwords do not match.<br/>";
			$is_valid = false;
			$_POST['password'] = "";
			$_POST['password_conf'] = "";
		}
		
		if (strlen($first) == 0 || strlen($first) > MAX_FIRST_NAME_LENGTH)
		{
			$first_name_error = "Please enter a first name no greater than " . MAX_FIRST_NAME_LENGTH . "characters.<br/>";
			$is_valid = false;
			$_POST['first_name'] = "";
		}
		
		if ($user_age < MINIMUM_USER_AGE)
		{
			$age_error = "Minimum age requirement is " . MINIMUM_USER_AGE . ".<br/>";
			$is_valid = false;
		}
		
		if (strlen($last) == 0 || strlen($last) > MAX_LAST_NAME_LENGTH)
		{
			$last_name_error = "Please enter a last name no greater than " . MAX_LAST_NAME_LENGTH . "characters.<br/>";
			$is_valid = false;
			$_POST['last_name'] = "";
		}
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			if (strlen($email) > MAXIMUM_EMAIL_LENGTH)
			{
				$email_error = "Email is too long. Can't be over " . MAXIMUM_EMAIL_LENGTH . "characters.<br/>";
				$is_valid = false;
				$_POST['email_address'] = "";
			}
		}
		else
		{
			$email_error = "The following email address provided: ". $email . ", is not a valid email address.<br/>";
			$is_valid = false;
			$_POST['email_address'] = "";
		}
		
		if ($is_valid)
		{
			//Hash the users password with a salt
			$hashed_pass = md5(SALT . $pass);
			$hashed_pass = trim($hashed_pass);
			
			$create_user = pg_prepare($dbconn, "register_query", $sql_user_register);
			$create_user = pg_execute($dbconn, "register_query", array($login, $hashed_pass, $client_type, $email, $first, $last, $DOB, $enrol, $access, $status));
			
			if ($create_user == false)
			{
				$db_error = "<p>Sorry, but we could not create your account. Please try again later.</p>";
			}
			else
			{
				$account_created = true;
			}
		}
	}
}
?>

<div class="body">
	<div class="container">
	
	<h2>Get attached to new people today! </h2>
	<h1>Register Now!</h1>
	
	<?php 
		echo $db_error;
		
		if ($account_created === true)
		{
			$_SESSION['account_create'] = "<p>Congratulations! You have successfully created your account.</p>";
			header("Location: user-login.php");
		}
	?>
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">
			
			<?php if ($user_error != "") { echo $user_error; } ?>
			<!-- User Id text box. The user will enter their user id here. -->
			<label for="user_id" class="form-label">User ID</label>
			<input type="text" name="user_id" class="form-input" value="<?php if (isset($_POST['user_id'])) { echo $_POST['user_id']; } ?>">
			
			<br>
			
			<?php if ($pass_error != "") { echo $pass_error; } ?>
			<label for="password" class="form-label"> Password </label>
			<input type="password" name="password" class="form-input" value="<?php if (isset($_POST['password'])) { echo $_POST['password']; } ?>">
			
			<br>
			
			<label for="password_conf" class="form-label"> Verify Password </label>
			<input type="password" name="password_conf" class="form-input" value="<?php if (isset($_POST['password_conf'])) { echo $_POST['password_conf']; } ?>">
			
			<br>
			
			<?php if ($age_error != "") { echo $age_error; } ?>
			<label for="DOB" class="form-label">Date of Birth </label>
			<input type="date" class="form-input" name="DOB" value="<?php if (isset($_POST['DOB'])) { echo $_POST['DOB']; } ?>">
			
			<br>
			
			<?php if ($email_error != "") { echo $email_error; } ?>
			<label for="email_address" class="form-label"> Email Address </label>
			<input type="text" name="email_address" class="form-input" value="<?php if (isset($_POST['email_address'])) { echo $_POST['email_address']; } ?>">
			
			<br>
			
			<?php if ($first_name_error != "") { echo $first_name_error; } ?>
			<label for="first_name" class="form-label"> First Name </label>
			<input type="text" name="first_name" class="form-input" value="<?php if (isset($_POST['first_name'])) { echo $_POST['first_name']; } ?>">

			<br>
			
			<?php if ($last_name_error != "") { echo $last_name_error; } ?>
			<label for="last_name" class="form-label"> Last Name </label>
			<input type="text" name="last_name" class="form-input" value="<?php if (isset($_POST['last_name'])) { echo $_POST['last_name']; } ?>">
		
			<br>
		
		  <!-- The user will click this button to attempt to run teir login info against the database. -->
			<button type ="submit" class="btn-default">Register</button>			
		</form>
	
	</div>
</div>

<?php include "footer.php"; ?>