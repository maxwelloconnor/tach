<script type="text/javascript">
<!--
	/*NOTE: for the following function to work, on your page
			you have to create a checkbox id'ed as city_toggle
				
	<input type="checkbox"  id="city_toggle" onclick="cityToggleAll();" name="city[]" value="0">
			
		and each city checkbox element has to be an named as an 
		array (specifically named "city[]")
		e.g.
			<input type="checkbox" name="city[]" value="1">Ajax
	*/
	function cityToggleAll()
	{
		//alert("In cityToggleAll()");  //alerts used for de-bugging
		var isChecked = document.getElementById("city_toggle").checked;
		var city_checkboxes = document.getElementsByName("city[]");
		for (var i in city_checkboxes){
		//SAME AS for ( i = 0; i < city_checkboxes.length; i++){
			city_checkboxes[i].checked = isChecked;
		}		
	}
	
//-->
</script>

<?php
/*
Part 1 of a two step process in profile search screen.
contains an image map should be used to choose locations, 
either by a dynamically db built checkbox menu, or by the image map itself. 
The info selected should be placed both into a session and cookie variable,
and then the user be brought to the search screen, 
where the selected locations are displayed at the top, 
along with a link to change the locations 
(in case the users want to expand/narrow their search.
The session variable setup should also be used on the step 2 page,
to determine if a location has been selected, 
if not the user should be automatically sent to the select city page.
 
 To Do:
 -once valid city checked, redirect to the next login page
*/

include "header.php";

/*
session_start();
$_SESSION["cities_selected"] = $city;
$cookie_name = "city";
$cookie_value = $city;
//setcookie($cookie_name, $cookie_value, )
//href to the search screen
*/

if(isset($_SESSION['user']))
{
	isDisabled(trim($_SESSION['user']['profile_status']));
}

if($_SERVER["REQUEST_METHOD"] == "GET")
{
   	$city = 0;
   	if (isset($_GET['value'])) //not triggering
   	{
   		$_SESSION['city'] = array($_GET['value']);
   		redirect("profile-search.php"); //no redirect function
	}
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$city = $_POST["city"];
	
	if(sumCheckBox($city) != 0)
   	{
		if(isset($_SESSION['user']['user_id'])) //session and cookie from login
		{
			setcookie("city", sumCheckBox($city), time() + COOKIE_EXPIRY);	
		}
   		$_SESSION['city'] = $city;
   		redirect("listing-search.php");
   	}
   	else
   	{
   		echo "<br/>Please Choose at least one city.";
   	}
}

if ($dbconn == false)
{
	$db_error = "<p>Cannot connect to the database.</p>";
}
else 
{
	if ($city == "")
	{
		$error_city = "<br/>You must select a city. <br/>";
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
}

?>

<div class="body">
	<div class="container">

	<?php 
		//echo $error_db;	
	?>
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	
		<h2>Please choose the cities you'd like to search in:</h2>
		
		<br>
		
		<?php //echo buildCheckBox('city');?>
	
		<input type="checkbox"  id="city_toggle" onclick="cityToggleAll();" name="city[]" value="0">
			<input type="checkbox" name="city[]" value="1">Whitby
			<input type="checkbox" name="city[]" value="2">Oshawa
			<input type="checkbox" name="city[]" value="3">Ajax
			<input type="checkbox" name="city[]" value="4">Pickering
			<input type="submit" value="Submit"/>
			

			<br><br>

			<center><img src="css/images/map.jpg" /></center>
	
	</div>
</div>

<?php


	

	
include "footer_f.php";
?>