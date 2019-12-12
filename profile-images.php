<?php
	include "header.php";

	if (isset($_SESSION['user']))
	{
		isDisabled(trim($_SESSION['user']['profile_status']));
		
		if ($_SESSION['user']['profile_status'] == 'INCOMPLETE')
		{
			$_SESSION['error'] = "<p>Sorry, but you must complete updating your profile information before viewing this page.</p>";
			header("Location: user-logout.php");
			exit;
		}
	}
	else
	{
		$_SESSION['error'] = "<p>Sorry, but you must be signed in to view this page.</p>";
		header("Location: user-login.php");
		exit;
	}
	
	$error = "";
			
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if (is_dir('includes/'. $_SESSION['user']['user_id'] .'/' == false))
		{
			mkdir('includes/'. $_SESSION['user']['user_id'] .'/');
		}
		
		$target_dir ='var/www/html/webd3201/group22/includes'. $_SESSION['user']['user_id'] .'/';
		
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false || $check < 100000) {
				if (exif_imagetype($_FILES["fileToUpload"]["tmp_name"]) == IMAGETYPE_JPEG)
				{
					$error = "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
					move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir);
				}
			} else {
				$error = "File is not an image.";
				$uploadOk = 0;
			}
		}
	}	
?>

<div class="body">
	<div class="container">
	
		<?php echo $error; ?>
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submit">
		</form>
		
	</div>
</div>

<?php
include "footer_f.php";
?>