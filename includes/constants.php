<?php
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: September 29, 2017
Course: WEBD3201

Brief Description: This defines all constants to be used within our website
*/


//Max's local database login
//Used for local database testing
define("TEST_DATABASE_NAME", "oconnorm_db");
define("TEST_DATABASE_USER", "oconnorm");
define("TEST_DATABASE_PASSWORD", "100582023");
define("DATABASE_HOST", "127.0.0.1");


/*
//Liam's local database login
define("TEST_DATABASE_NAME", "stachiwl_db");
define("TEST_DATABASE_USER", "stachiwl");
define("TEST_DATABASE_PASSWORD", "100583664");
define("DATABASE_HOST", "127.0.0.1");

//Miguel's local database login
define("TEST_DATABASE_NAME", "macciocchim_db");
define("TEST_DATABASE_USER", "postgres");
define("TEST_DATABASE_PASSWORD", "macciocchi1");
define("DATABASE_HOST", "127.0.0.1");
*/

/*
//Keith's local database login
define("TEST_DATABASE_NAME", "mathurk_db");
define("TEST_DATABASE_USER", "mathurk_db");
define("TEST_DATABASE_PASSWORD", "budlofsky");
define("DATABASE_HOST", "127.0.0.1");
*/


//Constants used to connect to the database

define("DATABASE_NAME", "group22_db");
define("DATABASE_USER", "group22_admin");
define("DATABASE_PASSWORD", "password");


//Constants defined for different user priveleges 
define("ADMIN", "a");
define("CLIENT", "c");
define("INCOMPLETE", "i");
define("DISABLED", "d");

//Constant defined for salting
define("SALT", "salt");

//Constants defined for validation of login
define("ZERO", 0);
define("USERID_MAX", 20);
define("PASSWORD_MAX", 30);

define("MAX_LOGIN_DAYS", 30);

//validation for registration 
define ('MINIMUM_ID_LENGTH', 6);
define ('MAXIMUM_ID_LENGTH', 20);
define ('MINIMUM_PASSWORD_LENGTH', 6);
define ('MAXIMUM_PASSWORD_LENGTH', 15);
define ('MAX_FIRST_NAME_LENGTH', 20);
define ('MAX_LAST_NAME_LENGTH', 30);
define ('MAXIMUM_EMAIL_LENGTH', 225);
define ('MINIMUM_USER_AGE', 18);

//validation for profile creation
define ('MAXIMUM_HEADLINE', 100);
define ('MAXIMUM_DESCRIPTION', 1000);
?>