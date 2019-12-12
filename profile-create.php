<?php 
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: October 20, 2017
Course: WEBD3201

*/

include "header.php";

if(isset($_SESSION['user']))
{
	isDisabled(trim($_SESSION['user']['profile_status']));
}

//Output and error messages initialized as empty strings
$profile_created = false;
$is_valid = true;

$error_db = "";
$error_gender = "";
$error_gender_s = "";
$error_city = "";
$error_headline = "";
$error_self_description = "";
$error_match_description = "";
$error_max_distance = "";
$error_min_age = "";
$error_max_age = "";
$error_astrological = "";
$error_height = "";
$error_height = "";
$error_body = "";
$error_pets = "";
$error_kids = "";
$error_married = "";

$output = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$gender = $_POST["gender"];
	$gender_sought = $_POST["gender_sought"];
	$city = $_POST["city"];
	$max_distance = $_POST["max_distance"];
	$max_age = $_POST["max_age"];
	$min_age = $_POST["min_age"];
	$astrological_sign = $_POST["astrological_sign"];
	$height = $_POST["height"];
	$body_type = $_POST["body_type"];
	$pets = $_POST["pets"];
	$kids = $_POST["kids"];
	$married = $_POST["married"];
	$headline = trim($_POST["headline"]);
	$self_description = trim($_POST["self_description"]);
	$match_description = trim($_POST["match_description"]);
	
	//Make radio buttons and dropdowns sticky
	/*if (isset($_POST['']))
	{
		$ = $_POST[''];
	}*/
	
	if ($dbconn == false)
	{
		$db_error = "<p>Cannot connect to the database.</p>";
	}
	else
	{
		if (is_null($gender))
		{
			$error_gender = "You must select a gender.<br/>";
			$is_valid = false;
			
		}
		else if ($gender == "Male")
		{
			//replace the value of gender to be numeric in the db. 
			$gender = 1;
		}
		else if ($gender == "Female")
		{
			//replace the value of gender to be numeric in the db. 
			$gender = 2;
		}
		
		if (is_null($gender_sought))
		{
			$error_gender_s = "<br/>You must select a gender sought. <br/>";
			$is_valid = false;
		}
		else if ($gender_sought == "Male")
		{
			$gender_sought = 1;
		}
		else if ($gender_sought == "Female")
		{
			$gender_sought = 2;
		}
		
		if ($city == "Select an option...")
		{
			$error_city = "<br/>You must select a city. <br/>";
			$is_valid = false;
		}
		else if ($city == "Whitby")
		{
			$city = 1;
		}
		else if ($city == "Oshawa")
		{
			$city = 2;
		}
		else if ($city == "Ajax")
		{
			$city = 3;
		}
		else if ($city == "Pickering")
		{
			$city = 4;
		}
		
		//Max distance
		if ($max_distance == "Select an option...")
		{
			$error_max_distance = "<br/>You must select a maximum distance. <br/>";
			$is_valid = false;
		}
		else if ($max_distance == "10")
		{
			$max_distance = 1;
		}
		else if ($max_distance == "20")
		{
			$max_distance = 2;
		}
		else if ($max_distance == "30")
		{
			$max_distance = 3;
		}
		else if ($max_distance == "40")
		{
			$max_distance = 4;
		}
		else if ($max_distance == "50")
		{
			$max_distance = 5;
		}
		else if ($max_distance == "60")
		{
			$max_distance = 6;
		}
		else if ($max_distance == "70")
		{
			$max_distance = 7;
		}
		else if ($max_distance == "80")
		{
			$max_distance = 8;
		}
		else if ($max_distance == "90")
		{
			$max_distance = 9;
		}
		else if ($max_distance == "100")
		{
			$max_distance = 10;
		}
		else if ($max_distance == "No Maximum")
		{
			$max_distance = 11;
		}
		
		//Minimum Age
		if ($min_age == "Select an option...")
		{
			$error_min_age= "<br/>You must select a minimum age sought. <br/>";
			$is_valid = false;
		}
		else if ($min_age == "18")
		{
			$min_age = 1;
		}
		else if ($min_age == "20")
		{
			$min_age = 2;
		}
		else if ($min_age == "25")
		{
			$min_age = 3;
		}
		else if ($min_age == "30")
		{
			$min_age = 4;
		}
		else if ($min_age == "35")
		{
			$min_age = 5;
		}
		else if ($min_age == "40")
		{
			$min_age = 6;
		}
		else if ($min_age == "45")
		{
			$min_age = 7;
		}
		else if ($min_age == "50")
		{
			$min_age = 8;
		}
		else if ($min_age == "60")
		{
			$min_age = 9;
		}
		
		//Maximum Age
		if ($max_age == "Select an option...")
		{
			$error_max_age= "<br/>You must select a maximum age sought. <br/>";
			$is_valid = false;
		}
		else if ($max_age == "18")
		{
			$max_age = 1;
		}
		else if ($max_age == "20")
		{
			$max_age = 2;
		}
		else if ($max_age == "25")
		{
			$max_age = 3;
		}
		else if ($max_age == "30")
		{
			$max_age = 4;
		}
		else if ($max_age == "35")
		{
			$max_age = 5;
		}
		else if ($max_age == "40")
		{
			$max_age = 6;
		}
		else if ($max_age == "45")
		{
			$max_age = 7;
		}
		else if ($max_age == "50")
		{
			$max_age = 8;
		}
		else if ($max_age == "60")
		{
			$max_age = 9;
		}
		
		//Astrological Sign
		if ($astrological_sign == "Select an option...")
		{
			$error_astrological = "<br/>You must select an astrological_sign. <br/>";
			$is_valid = false;
		}
		else if ($astrological_sign == "Aquarius")
		{
			$astrological_sign = 1;
		}
		else if ($astrological_sign == "Pisces")
		{
			$astrological_sign = 2;
		}else if ($astrological_sign == "Aries")
		{
			$astrological_sign = 3;
		}else if ($astrological_sign == "Taurus")
		{
			$astrological_sign = 4;
		}
		else if ($astrological_sign == "Gemini")
		{
			$astrological_sign = 5;
		}
		else if ($astrological_sign == "Cancer")
		{
			$astrological_sign = 6;
		}
		else if ($astrological_sign == "Leo")
		{
			$astrological_sign = 7;
		}
		else if ($astrological_sign == "Virgo")
		{
			$astrological_sign = 8;
		}
		else if ($astrological_sign == "Libra")
		{
			$astrological_sign = 9;
		}
		else if ($astrological_sign == "Scorpio")
		{
			$astrological_sign = 10;
		}
		else if ($astrological_sign == "Sagittarius")
		{
			$astrological_sign = 11;
		}
		else if ($astrological_sign == "Capricorn")
		{
			$astrological_sign = 12;
		}
		
		//height
		if ($height == "Select an option...")
		{
			$error_height = "<br/>You must select a height. <br/>";
			$is_valid = false;
		}
		else if ($height == "Less than 5 feet.")
		{
			$height = 1;
		}
		else if ($height == "5'0")
		{
			$height = 2;
		}
		
		else if ($height == "5'1")
		{
			$height = 3;
		}
		else if ($height == "5'2")
		{
			$height = 4;
		}
		else if ($height == "5'3")
		{
			$height = 5;
		}
		else if ($height == "5'4")
		{
			$height = 6;
		}
		else if ($height == "5'5")
		{
			$height = 7;
		}
		else if ($height == "5'6")
		{
			$height = 8;
		}
		else if ($height == "5'7")
		{
			$height = 9;
		}
		else if ($height == "5'8")
		{
			$height = 10;
		}
		else if ($height == "5'9")
		{
			$height = 11;
		}
		else if ($height == "5'10")
		{
			$height = 12;
		}
		else if ($height == "5'11")
		{
			$height = 13;
		}
		else if ($height == "6'0")
		{
			$height = 14;
		}
		else if ($height == "6'1")
		{
			$height = 15;
		}
		else if ($height == "6'2")
		{
			$height = 16;
		}
		else if ($height == "6'3")
		{
			$height = 17;
		}
		else if ($height == "6'4")
		{
			$height = 18;
		}
		else if ($height == "6'5")
		{
			$height = 19;
		}
		else if ($height == "6'6")
		{
			$height = 20;
		}
		else if ($height == "6'7")
		{
			$height = 21;
		}
		else if ($height == "6'8")
		{
			$height = 22;
		}
		else if ($height == "6'9")
		{
			$height = 23;
		}
		else if ($height == "6'10")
		{
			$height = 24;
		}
		else if ($height == "6'11")
		{
			$height = 25;
		}
		else if ($height == "7 feet or taller")
		{
			$height = 26;
		}
		
		
		//body Type
		if ($body_type == "Select an option...")
		{
			$error_body= "<br/>You must select a body type. <br/>";
			$is_valid = false;
		}
		else if ($body_type == "Thin")
		{
			$body_type = 1;
		}
		else if ($body_type == "Average")
		{
			$body_type = 2;
		}
		else if ($body_type == "Athletic")
		{
			$body_type = 3;
		}
		else if ($body_type == "A little extra")
		{
			$body_type = 4;
		}
		else if ($body_type == "Overweight")
		{
			$body_type = 5;
		}
		
		//pets
		if ($pets == "Select an option...")
		{
			$error_pets = "<br/>You must select a pet option. <br/>";
			$is_valid = false;
		}
		else if ($pets == "Does not have pets")
		{
			$pets = 1;
		}
		else if ($pets == "Has dog(s)")
		{
			$pets = 2;
		}
		else if ($pets == "Has cat(s)")
		{
			$pets = 3;
		}
		else if ($pets == "Has dog(s) and cat(s)")
		{
			$pets = 4;
		}
		else if ($pets == "Other")
		{
			$pets = 5;
		}
		
		//kids
		if ($kids == "Select an option...")
		{
			$error_kids = "<br/>You must select an option for kids. <br/>";
			$is_valid = false;
		}
		else if ($kids == "Not sure")
		{
			$kids = 1;
		}
		else if ($kids == "I want to have children'")
		{
			$kids = 2;
		}
		else if ($kids == "I never want children")
		{
			$kids = 3;
		}
		else if ($kids == "I already have children")
		{
			$kids = 4;
		}
		
		//married
		if ($married == "Select an option...")
		{
			$error_married = "<br/>You must select a marriage option. <br/>";
			$is_valid = false;
		}
		else if ($married == "Not Sure")
		{
			$married = 1;
		}
		else if ($married == "I want to get married")
		{
			$married = 2;
		}
		else if ($married == "I never want to get married")
		{
			$married = 3;
		}
		
		
		//headline
		if ($headline == "")
		{
			$error_headline = "<br/>You must input a headline. <br/>";
			$is_valid = false;
		}
		else if (strlen($headline) > MAXIMUM_HEADLINE)
		{
			$error_headline = "<br/>The headline cannot be greater than ". MAXIMUM_HEADLINE ."characters. <br/>";
			$is_valid = false;
		}
		
		//self description
		if ($self_description== "")
		{
			$error_self_description = "<br/>You must input a self description. <br/>";
			$is_valid = false;
		}
		else if (strlen($self_description) > MAXIMUM_DESCRIPTION)
		{
			$error_self_description = "<br/>The self description cannot be greater than ". MAXIMUM_DESCRIPTION ."characters. <br/>";
			$is_valid = false;
		}
		
		//match description
		if ($match_description== "")
		{
			$error_match_description = "<br/>You must input a match description. <br/>";
			$is_valid = false;
		}
		else if (strlen($match_description) > MAXIMUM_DESCRIPTION)
		{
			$error_match_description= "<br/>The self description cannot be greater than ". MAXIMUM_DESCRIPTION ."characters. <br/>";
			$is_valid = false;
		}
		
		//input is valid
		if ($is_valid)
		{
			$images = 1;
			$user_id = "KeithM";
			//images is empty right now, but inserted into dbas
			//get property is called when outputting the user info, not inserting?
			//insert into profiles all info for user. Based on property number picked.
			$sql = "INSERT INTO profiles(user_id, gender, gender_sought, city, images, headline, self_description, match_description, max_distance, min_age, max_age, astrological_sign, height, body_type, pets, kids, married) Values('$user_id', '$gender', '$gender_sought', '$city', '$images', '$headline', '$self_description', '$match_description', '$max_distance', '$min_age', '$max_age', '$astrological_sign', '$height', '$body_type', '$pets', '$kids', '$married')";
			
			$results = pg_query($dbconn, $sql);
			
			//BUG TESTING
			//make sure it gets to the is_valid if statement if it is valid. Logic error?
			//Make default values in profiles for each user. Then, UPDATE all fields where user_id is equal to the current user.
			//Foreign key/primary key in profiles table?? In the profiles table, under the requirements it says to make user_id foregin key, but we couldnt get the script to work making it a foreign key. It's a primary key in our script.
		}
	}
}

//validate the input for mandatory fields

//validate the input for non-mandatory fields. Blank fields are allowed.
?>
	
<div class="body">
	<div class="container">
	
		<?php 
			
			echo $error_db;
			
		?>
	
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		
			<?php 
			
			//How are these connected to the variables that are trying to submit to the db???
			
				if ($error_gender != "") { echo $error_gender; }
				echo buildRadio('gender', 'Gender'); 
				
				if ($error_gender_s != "") { echo $error_gender_s; }
				echo buildRadio('gender_sought', 'Gender Sought');
				
				if ($error_city != "") { echo $error_city; }
				echo buildDropDown('city', 'City');
				
				if ($error_max_distance != "") { echo $error_max_distance; }
				echo buildDropDown('max_distance', 'Maximum Distance');
				
				if ($error_min_age != "") { echo $error_min_age; }
				echo buildDropDown('min_age', 'Minimum Age Sought');
				
				if ($error_max_age != "") { echo $error_max_age; }
				echo buildDropDown('max_age', 'Maximum Age Sought');
				
				if ($error_astrological != "") { echo $error_astrological; }
				echo buildDropDown('astrological_sign', 'Astrological Sign');
				
				if ($error_height != "") { echo $error_height; }
				echo buildDropDown('height', 'Height');
				
				if ($error_body != "") { echo $error_body; }
				echo buildDropDown('body_type', 'Body Type');
				
				if ($error_pets != "") { echo $error_pets; }
				echo buildDropDown('pets', 'Has Pets');
				
				if ($error_kids != "") { echo $error_kids; }
				echo buildDropDown('kids', 'Wants Kids');
				
				if ($error_married != "") { echo $error_married; }
				echo buildDropDown('married', 'Wants to get Married');
			?>
			
			<?php if ($error_headline != "") { echo $error_headline; } ?>
			<!-- mandatory field -->
			<label class="form-label">Headline: </label>
			<input type="text" name="headline" class="form-input" value="<?php if (isset($_POST['headline'])) { echo $_POST['headline']; } ?>">
			
			<br>
			
			<?php if ($error_self_description != "") { echo $error_self_description; } ?>
			<!-- mandatory field -->
			<label class="form-label">Self Description: </label>
			<input type="text" name="self_description" class="form-input" value="<?php if (isset($_POST['self_description'])) { echo $_POST['self_description']; } ?>">
			
			<br>
			
			<?php if ($error_match_description != "") { echo $error_match_description; } ?>
			<!-- mandatory field -->
			<label class="form-label">Match Description: </label>
			<input type="text" name="match_description" class="form-input" value="<?php if (isset($_POST['match_description'])) { echo $_POST['match_description']; } ?>">
			
			<br>
			
			<button type="submit" class="btn-default">Save</button>
			
			<!-- logic after pressing button will be here -->
			
		</form>	
		
	</div>
</div>


<?php 
include "footer.php";
?>