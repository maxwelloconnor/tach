<?php
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: September 29, 2017
Modified: October 12, 2017
Course: WEBD3201

Brief Description: Holds all functions that will be used in our website
*/

/*
	this function should be passed an integer power of 2, and any 
	decimal number,	it will return true (1) if the power of 2 is 
	contain as part of the decimal argument
*/
function isBitSet($power, $decimal) 
{
	if((pow(2,$power)) & ($decimal)) 
		return 1;
	else
		return 0;
} 

/*
	this function can be passed an array of numbers 
	(like those submitted as part of a named[] check 
	box array in the $_POST array).
*/
function sumCheckBox($array)
{
	$num_checks = count($array); 
	$sum = 0;
	for ($i = 0; $i < $num_checks; $i++)
	{
	  $sum += $array[$i]; 
	}
	return $sum;
}

function displayCopyrightInfo() {
	
	$date = date("Y");
	
	$copy = '&#169;' . $date . ' Group 22 - WEBD3201 - <a target="_blank" href="http://www.durhamcollege.ca/" class="footer-copyright">Durham College</a> - <a href="privacy_policy.php" class="footer-copyright">Privacy Policy</a> - <a href="aup.php" class="footer-copyright">ACCEPTABLE USE POLICY</a>';
	return $copy;
}

function isDisabled($userStatus) {
		if ($userStatus == 'DISABLED')
		{
			$_SESSION['error'] = "<p>Your account is denied access to the system for having an offensive profile</p>";
			header("Location: acceptable-use.php");
		}
}

function calculateAge($dateEntered)	{
		
	$today = date("Y-m-d");
	
	$today = date_create($today);
	$dateOfBirth = date_create($dateEntered);
	
	$age = date_diff($dateOfBirth, $today);
	
	return floor($age->format('%a')/365);
}

?>