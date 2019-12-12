<?php
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: September 29, 2017
Course: WEBD3201

Brief Description: This page is static for now. When the submit button is clicked, it will redirect the user to the profile search results page.
*/

include "header.php";

if(isset($_SESSION['user']))
{
	isDisabled(trim($_SESSION['user']['profile_status']));
}

$gender_sought_array = array("Male", "Female");
$max_distance_array = array("10", "20", "30", "40", "50", "60", "70", "80", "90", "100", "No Maximum");
$min_age_array = array("18", "20", "30", "40", "50", "60");
$max_age_array = array("18", "20", "30", "40", "50", "60");
$astrological_array = array("Aquarius", "Pisces", "Aries", "Taurus", "Gemini", "Cancer", "Leo", "Virgo", "Libra", "Scorpio", "Sagittarius", "Capricorn");
$height_array = array("Less than 5 feet.", "5'0", "5'1", "5'2", "5'3", "5'4", "5'5", "5'6", "5'7", "5'8", "5'9", "5'10", "5'11", "6'0", "6'1", "6'2", "6'3", "6'4", "6'5", "6'6", "6'7", "6'8", "6'9", "6'10", "6'11", "7 feet or taller");
$body_type_array = array("Thin", "Average", "Athletic", "A little extra", "Overweight");
$pets_array = array("Does not have pets", "Has dog(s)", "Has cat(s)", "Has dog(s) and cat(s)", "Other");
$kids_array = array("Not sure", "I want to have children'", "I never want children", "I already have children");
$married_array = array("Not Sure", "I want to get married", "I never want to get married");

//pull in profiles where user id is equal to search, profile status is complete, and city is same as chosen

if($_SERVER["REQUEST_METHOD"] == "GET")
{
	$gender_sought = 0;
	$max_distance = 0;
	$min_age = 0;
	$max_age = 0;
	$astrological_sign = 0;
	$height = 0;
	$body_type = 0;
	$pets = 0;
	$kids = 0;
	$married = 0;
}

else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$gender_sought = sumCheckBox($_POST["gender_sought"]);
	$max_distance = sumCheckBox($_POST["max_distance"]);
	$min_age = sumCheckBox($_POST["min_age"]);
	$max_age = $_POST["max_age"];
	$astrological_sign = $_POST["astrological_sign"];
	$height = $_POST["height"];
	$body_type = $_POST["body_type"];
	$pets = $_POST["pets"];
	$kids = $_POST["kids"];
	$married = $_POST["married"];
	
	$post_array = array(
	//"city" => $_SESSION['city'],
	"gender_sought" => $_POST['gender_sought'],
	"max_distance" => $_POST['max_distance'],
	"min_age" => $_POST['min_age'],
	"max_age" => $_POST['max_age'],
	"astrological_sign" => $_POST['astrological_sign'],
	"height" => $_POST['height'],
	"body_type" => $_POST['body_type'],
	"pets" => $_POST['pets'],
	"kids" => $_POST['kids'],
	"married" => $_POST['married']
	);
	
	if ($dbconn != false)
	{
		if (is_null($gender_sought) || $max_distance == "Select an option..." || $min_age == "Select an option..." || $max_age == "Select an option..." || $astrological_sign == "Select an option..." || $height == "Select an option..." || $body_type == "Select an option..." || $pets == "Select an option..." || $kids == "Select an option..." || $married == "Select an option...")
		{
			$error = '<p>ERROR! enter in a field.</p><br/>';
		}
			else{
				
			
			$counter = 0;
			foreach ($gender_sought_array as $value)
			{
				$counter += 1;
				
				if ($gender_sought == $value)
				{
					$gender_sought = $counter;
					break;
				}
			}
			$counter = 0;
			foreach ($max_distance_array as $value)
			{
				$counter += 1;
				
				if ($max_distance == $value)
				{
					$max_distance = $counter;
					break;
				}
			}
			$counter = 0;
			foreach ($min_age_array as $value)
			{
				$counter += 1;
				
				if ($min_age == $value)
				{
					$min_age = $counter;
					break;
				}
			}
			$counter = 0;
			foreach ($max_age_array as $value)
			{
				$counter += 1;
				
				if ($max_age == $value)
				{
					$max_age = $counter;
					break;
				}
			}
			$counter = 0;
			foreach ($astrological_array as $value)
			{
				$counter += 1;
				
				if ($astrological_sign == $value)
				{
					$astrological_sign = $counter;
					break;
				}
			}
			$counter = 0;
			foreach ($height_array as $value)
			{
				$counter += 1;
				
				if ($height == $value)
				{
					$height = $counter;
					break;
				}
			}
			$counter = 0;
			foreach ($body_type_array as $value)
			{
				$counter += 1;
				
				if ($body_type == $value)
				{
					$body_type = $counter;
					break;
				}
			}
			$counter = 0;
			foreach ($pets_array as $value)
			{
				$counter += 1;
				
				if ($pets == $value)
				{
					$pets = $counter;
					break;
				}
			}
			$counter = 0;
			foreach ($kids_array as $value)
			{
				$counter += 1;
				
				if ($kids == $value)
				{
					$kids = $counter;
					break;
				}
			}
			$counter = 0;
			foreach ($married_array as $value)
			{
				$counter += 1;
				
				if ($married == $value)
				{
					$married = $counter;
					break;
				}
			}
			}
			//store values chosen in session/cookie
			//setcookie("");
			
			
		}
	}

?>


<div class="body">
	<div class="container">
	
		<p><?php 
		echo $max_distance;
		echo $gender_sought;
		echo $min_age;
		echo $max_age;
		echo $astrological_sign; 
		echo $height;
		echo $body_type;
		echo $pets;
		echo $kids;
		echo $married;
		?></p>
			
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		
			<?php 
				
				echo buildDropDown('gender_sought', 'Gender Sought');
				echo buildDropDown('max_distance', 'Maximum Distance');
				echo buildDropDown('min_age', 'Minimum Age');
				echo buildDropDown('max_age', 'Maximum Age Sought');
				echo buildDropDown('astrological_sign', 'Astrological Sign');
				echo buildDropDown('height', 'Height');
				echo buildDropDown('body_type', 'Body Type');
				echo buildDropDown('pets', 'Has Pets');
				echo buildDropDown('kids', 'Wants Kids');
				echo buildDropDown('married', 'Wants to get Married');
				
				//select from users where gender is x, distance x, min age x, max age x, stro sign x, height x, body x, pets x, kids x, married x
				//store sql statements in cookie/session to carry over to profile search results
			?>
			
			<button type="submit" class="btn-default" >Search</button>
			 <!-- When this button is clicked, open up profile-search-results.php and display the list of people-->
			
		</form>
	</div>
</div>

<?php 
include "footer.php";
?>