<?php
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: September 29, 2017
Course: WEBD3201

Brief Description: This creates the function that will allow for connections to the database
*/

//function that allows you to connect the database
function db_connect() {	
	$dbconn = pg_connect("host=". DATABASE_HOST ." dbname=". TEST_DATABASE_NAME ." user=". TEST_DATABASE_USER ." password=". TEST_DATABASE_PASSWORD);
	return $dbconn;	
}

$dbconn = db_connect();

//SQL Statements Used In The Site
$sql_user_login = 'SELECT * FROM users WHERE user_id = $1 AND password = $2'; //Finds the userid and password entered in the textboxes, for login.
$sql_user_update = "UPDATE users SET last_access = '" . date("Y-m-d",time()) . "' WHERE users.user_id = $1"; //Updates the users last access in the database	

$sql_user_id = 'SELECT user_id FROM users WHERE user_id = $1';
$sql_user_register = "INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access, profile_status) VALUES($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";

$sql_change_password = 'UPDATE users SET password = $1 WHERE user_id = $2';

$sql_get_user = "SELECT * FROM users WHERE user_id = $1";

$sql_check_disable_user = "SELECT * FROM users WHERE profile_status = $1";

$sql_user_interests = "SELECT * FROM interests WHERE user_id_interested = $1";
$sql_user_interested_in = "SELECT * FROM interests WHERE user_id_interested_in = $1";

$sql_reported_users = "SELECT profile_reported FROM offensives";
$sql_reported_by = "SELECT profile_reported_by FROM offensives";

$sql_remove_reported = "DELETE FROM offensives WHERE profile_reported = $1";

$sql_disable_user = "UPDATE users SET profile_status = 'DISABLED' WHERE user_id = $1";

/*
create a "sticky" checkbox HTML input element based on the property/value pairs in table. 
It should be passed the db table name, and the pre-selected decimal value. 
*/
function buildCheckBox($current_table)
{
	$result = pg_query(db_connect(), "SELECT * FROM " . $current_table);
	
	if($current_table == 'city')
	{
		$checkbox = '<input type="checkbox"  id="city_toggle" onclick="cityToggleAll();" name="city[]" value="0">';
	}
	else
	{
		$checkbox = '<input type="checkbox" id=' . $current_table . '_toggle" name="' . $current_table . '[]" value="0">';
	}
	for($i = 0; i < pg_num_rows($result); $i++)
	{
		$row = pg_fetch_array($result, $i);
		$checkbox .= '<input type="checkbox" name="' . $current_table . '[]" value="'. ($i+1) .'">'. $row[1];
	}
	
}


function buildDropDown($current_table, $current_label) //create a drop down based on the property/value pairs in the table
{
	//pass in the table name, label for the table, and the number to be sticky (1 is sticky, default option "select option...")
	
	$result = pg_query(db_connect(), "SELECT * FROM " . $current_table);
	
	$drop_down = '<label class="form-label" for=' . $current_table . '>'. $current_label . ':</label>';
	$drop_down .= '<select name='. $current_table .' class="form-input">';
	
	for ($i = 0; $i < pg_num_rows($result); $i++)
	{
		$row = pg_fetch_array($result, $i);
		$drop_down .= '<option>'. $row[1] .'</option>';
	}
	
	$drop_down .= '</select>';
	
	$drop_down .= '<br>';
	
	return $drop_down;
}

function buildRadio($current_table, $current_label) //create a radio box based on the property/value pairs in table.
{
	//pass in the table name, label for the table, and the number to be sticky (1 is sticky, default option "select option...")
	
	//$current_table to insert the name of the table to have a drop down made. (city)
	//$current_label to display label for the drop down based on the current table.(City)
	
	$result = pg_query(db_connect(), "SELECT * FROM " . $current_table);
	
	$radio = '<label class="form-label">'. $current_label .':</label>';
	$radio .= '<div class="form-input">';
	$radio .= '<fieldset id='. $current_table .'>';
	
	for ($i = 0; $i < pg_num_rows($result); $i++)
	{
		$row = pg_fetch_array($result, $i);
		$radio .= '<label><input type="radio" name='. $current_table .'>'. $row[1] .'</label>';
	}
	
	$radio .= '</fieldset>';
	$radio .= '</div>';
	
	$radio .= '<br>';
	
	return $radio;
}

// that will take a table name and a value and will return the property for that table. 
function getProperty($current_table, $current_value) //that will take a table name and a value and will return the property for that table. 
{
	
	$result = pg_query(db_connect(), "SELECT property FROM " . $current_table . "WHERE value = " . $current_value); 
	$property = pg_fetch_result($result);
	
	return $property;
}
?>