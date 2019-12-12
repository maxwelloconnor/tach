-- DROP'ping tables clear out any existing data
DROP TABLE IF EXISTS users;

--Create the users table, with required fields for user login
CREATE table users(
	user_id CHAR(20) PRIMARY KEY, 		--user id for login, primary key
	password CHAR(32) NOT NULL,	  		--password for the corresponding user id, to be hashed using md5
	user_type CHAR (2) NOT NULL,		--user's privilege type
	email_address CHAR(256) NOT NULL,	--user's email address
	first_name CHAR(128) NOT NULL,		--user's first name
	last_name CHAR(128) NOT NULL,		--user's last name
	birth_date DATE NOT NULL,			--user's birthday
	enrol_date DATE NOT NULL, 			--the date the user enrolled 
	last_access DATE NOT NULL,
	profile_status CHAR(10) NOT NULL
);

--Insert user info and login details for Keith into users table
INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access, profile_status)VALUES(
	'KeithM',
	'972141bcbcb6a0acc96e92309175b3c5', --testpass unhashed
	'a',
	'keith.mathur@dcmail.ca',
	'Keith',
	'Mathur',
	'1996-01-01',
	'2017-01-01',
	'2017-01-01',
	'INCOMPLETE');
	
--Insert user info and login details for Liam into users table
INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access, profile_status)VALUES(
	'LiamS',
	'8e454ae3e4687a689155607d1ba896b3', --testpass2 unhashed
	'a',
	'liam.stachiw@dcmail.ca',
	'Liam',
	'Stachiw',
	'1997-02-22',
	'2017-01-01',
	'2017-01-01',
	'INCOMPLETE');	

--Insert user info and login details for Miguel into users table
INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access, profile_status)VALUES(
	'MiguelM',
	'b82321816dc1682e282623f02824272a', --testpass3 unhashed
	'a',
	'miguel.maccoicchi@dcmail.ca',
	'Miguel',
	'Macciocchi',
	'1995-03-03',
	'2017-01-01',
	'2017-01-01',
	'INCOMPLETE');
	
--Insert user info and login details for Max into users table
INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access, profile_status)VALUES(
	'MaxO',
	'5262910271da4e038f0072a6b7a23865', --testpass4 unhashed
	'a',
	'max.oconnor@dcmail.ca',
	'Maxwell',
	'O''Connor',
	'1996-01-01',
	'2017-01-01',
	'2017-01-01',
	'INCOMPLETE');

--END users table

--Profiles table
DROP TABLE IF EXISTS profiles;

CREATE table profiles(
user_id VARCHAR(20) PRIMARY KEY,
gender SMALLINT NOT NULL,
gender_sought SMALLINT NOT NULL,
city INTEGER NOT NULL,
images SMALLINT NOT NULL,
headline VARCHAR(100) NOT NULL,
self_description VARCHAR(1000) NOT NULL,
match_description VARCHAR(1000) NOT NULL,
max_distance INTEGER NOT NULL,
min_age INTEGER NOT NULL,
max_age INTEGER NOT NULL, 
astrological_sign INTEGER NOT NULL,
height INTEGER NOT NULL,
body_type INTEGER NOT NULL,
pets INTEGER NOT NULL,
kids INTEGER NOT NULL,
married INTEGER NOT NULL
);
--END profiles table


--gender table
DROP TABLE IF EXISTS gender;

CREATE TABLE gender(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO gender (value, property) VALUES (1, 'Male');
INSERT INTO gender (value, property) VALUES (2, 'Female');
--END gender table


-- gender_sought table
DROP TABLE IF EXISTS gender_sought;

CREATE TABLE gender_sought(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO gender_sought (value, property) VALUES (1, 'Male');
INSERT INTO gender_sought (value, property) VALUES (2, 'Female');
--END gender_sought table


-- city table
DROP TABLE IF EXISTS city;

CREATE TABLE city(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO city(value, property) VALUES (0, 'Select an option...');
INSERT INTO city(value, property) VALUES (1, 'Whitby');
INSERT INTO city(value, property) VALUES (2, 'Oshawa');
INSERT INTO city(value, property) VALUES (3, 'Ajax');
INSERT INTO city(value, property) VALUES (4, 'Pickering');
--END city table

-- max_distance table
DROP TABLE IF EXISTS max_distance;

CREATE TABLE max_distance(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO max_distance(value, property) VALUES (0, 'Select an option...');
INSERT INTO max_distance(value, property) VALUES (1, '10');
INSERT INTO max_distance(value, property) VALUES (2, '20');
INSERT INTO max_distance(value, property) VALUES (3, '30');
INSERT INTO max_distance(value, property) VALUES (4, '40');
INSERT INTO max_distance(value, property) VALUES (5, '50');
INSERT INTO max_distance(value, property) VALUES (6, '60');
INSERT INTO max_distance(value, property) VALUES (7, '70');
INSERT INTO max_distance(value, property) VALUES (8, '80');
INSERT INTO max_distance(value, property) VALUES (9, '90');
INSERT INTO max_distance(value, property) VALUES (10, '100');
INSERT INTO max_distance(value, property) VALUES (11, 'No Maximum');
--END max_distance table


-- min_age table
DROP TABLE IF EXISTS min_age;

CREATE TABLE min_age(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO min_age(value, property) VALUES (0, 'Select an option...');
INSERT INTO min_age(value, property) VALUES (1, '18');
INSERT INTO min_age(value, property) VALUES (2, '20');
INSERT INTO min_age(value, property) VALUES (3, '25');
INSERT INTO min_age(value, property) VALUES (4, '30');
INSERT INTO min_age(value, property) VALUES (5, '35');
INSERT INTO min_age(value, property) VALUES (6, '40');
INSERT INTO min_age(value, property) VALUES (7, '45');
INSERT INTO min_age(value, property) VALUES (8, '50');
INSERT INTO min_age(value, property) VALUES (9, '60');
--END min_age table


-- max_age table
DROP TABLE IF EXISTS max_age;

CREATE TABLE max_age(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO max_age(value, property) VALUES (0, 'Select an option...');
INSERT INTO max_age(value, property) VALUES (1, '18');
INSERT INTO max_age(value, property) VALUES (2, '20');
INSERT INTO max_age(value, property) VALUES (3, '25');
INSERT INTO max_age(value, property) VALUES (4, '30');
INSERT INTO max_age(value, property) VALUES (5, '35');
INSERT INTO max_age(value, property) VALUES (6, '40');
INSERT INTO max_age(value, property) VALUES (7, '45');
INSERT INTO max_age(value, property) VALUES (8, '50');
INSERT INTO max_age(value, property) VALUES (9, '60');
--END max_age table


-- astrological_sign table
DROP TABLE IF EXISTS astrological_sign;

CREATE TABLE astrological_sign(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO astrological_sign(value, property) VALUES (0, 'Select an option...');
INSERT INTO astrological_sign(value, property) VALUES (1, 'Aquarius');
INSERT INTO astrological_sign(value, property) VALUES (2, 'Pisces');
INSERT INTO astrological_sign(value, property) VALUES (3, 'Aries');
INSERT INTO astrological_sign(value, property) VALUES (4, 'Taurus');
INSERT INTO astrological_sign(value, property) VALUES (5, 'Gemini');
INSERT INTO astrological_sign(value, property) VALUES (6, 'Cancer');
INSERT INTO astrological_sign(value, property) VALUES (7, 'Leo');
INSERT INTO astrological_sign(value, property) VALUES (8, 'Virgo');
INSERT INTO astrological_sign(value, property) VALUES (9, 'Libra');
INSERT INTO astrological_sign(value, property) VALUES (10, 'Scorpio');
INSERT INTO astrological_sign(value, property) VALUES (11, 'Sagittarius');
INSERT INTO astrological_sign(value, property) VALUES (12, 'Capricorn');

--END astrological_sign table


-- height table
DROP TABLE IF EXISTS height;

CREATE TABLE height(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO height(value, property) VALUES (0, 'Select an option...');
INSERT INTO height(value, property) VALUES (1, 'Less than 5 feet.');
INSERT INTO height(value, property) VALUES (2, '5''0"');
INSERT INTO height(value, property) VALUES (3, '5''1"');
INSERT INTO height(value, property) VALUES (4, '5''2"');
INSERT INTO height(value, property) VALUES (5, '5''3"');
INSERT INTO height(value, property) VALUES (6, '5''4"');
INSERT INTO height(value, property) VALUES (7, '5''5"');
INSERT INTO height(value, property) VALUES (8, '5''6"');
INSERT INTO height(value, property) VALUES (9, '5''7"');
INSERT INTO height(value, property) VALUES (10, '5''8"');
INSERT INTO height(value, property) VALUES (11, '5''9"');
INSERT INTO height(value, property) VALUES (12, '5''10"');
INSERT INTO height(value, property) VALUES (13, '5''11"');
INSERT INTO height(value, property) VALUES (14, '6''0"');
INSERT INTO height(value, property) VALUES (15, '6''1"');
INSERT INTO height(value, property) VALUES (16, '6''2"');
INSERT INTO height(value, property) VALUES (17, '6''3"');
INSERT INTO height(value, property) VALUES (18, '6''4"');
INSERT INTO height(value, property) VALUES (19, '6''5"');
INSERT INTO height(value, property) VALUES (20, '6''6"');
INSERT INTO height(value, property) VALUES (21, '6''7"');
INSERT INTO height(value, property) VALUES (22, '6''8"');
INSERT INTO height(value, property) VALUES (23, '6''9"');
INSERT INTO height(value, property) VALUES (24, '6''10"');
INSERT INTO height(value, property) VALUES (25, '6''11"');
INSERT INTO height(value, property) VALUES (26, '7 feet or taller');

--END height table


-- body type table
DROP TABLE IF EXISTS body_type;

CREATE TABLE body_type(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO body_type(value, property) VALUES (0, 'Select an option...');
INSERT INTO body_type(value, property) VALUES (1, 'Thin');
INSERT INTO body_type(value, property) VALUES (2, 'Average');
INSERT INTO body_type(value, property) VALUES (3, 'Athletic');
INSERT INTO body_type(value, property) VALUES (4, 'A little extra');
INSERT INTO body_type(value, property) VALUES (5, 'Overweight');
--END body_type table


-- pets table
DROP TABLE IF EXISTS pets;

CREATE TABLE pets(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO pets(value, property) VALUES (0, 'Select an option...');
INSERT INTO pets(value, property) VALUES (1, 'Does not have pets');
INSERT INTO pets(value, property) VALUES (2, 'Has dog(s)');
INSERT INTO pets(value, property) VALUES (3, 'Has cat(s)');
INSERT INTO pets(value, property) VALUES (4, 'Has dog(s) and cat(s)');
INSERT INTO pets(value, property) VALUES (5, 'Other');
--END pets table


-- kids table
DROP TABLE IF EXISTS kids;

CREATE TABLE kids(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO kids(value, property) VALUES (0, 'Select an option...');
INSERT INTO kids(value, property) VALUES (1, 'Not sure');
INSERT INTO kids(value, property) VALUES (2, 'I want to have children');
INSERT INTO kids(value, property) VALUES (3, 'I never want children');
INSERT INTO kids(value, property) VALUES (4, 'I already have children');
--END kids table


-- married table
DROP TABLE IF EXISTS married;

CREATE TABLE married(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO married(value, property) VALUES (0, 'Select an option...');
INSERT INTO married(value, property) VALUES (1, 'Not sure');
INSERT INTO married(value, property) VALUES (2, 'I want to get married');
INSERT INTO married(value, property) VALUES (3, 'I never want to get married');
--END married table 

--Interests table
DROP TABLE IF EXISTS interests;

CREATE table interests(
listing_id SERIAL PRIMARY KEY,
user_id_interested VARCHAR(20) NOT NULL,
user_id_interested_in VARCHAR(20) NOT NULL,
date_interested DATE NOT NULL
);
--END profiles table

--Interests table
DROP TABLE IF EXISTS offensives;

CREATE table offensives(
listing_id SERIAL PRIMARY KEY,
profile_reported VARCHAR(20) NOT NULL,
profile_reported_by VARCHAR(20) NOT NULL,
date_reported DATE NOT NULL
);
--END profiles table