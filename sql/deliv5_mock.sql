UPDATE users SET profile_status = 'COMPLETE' WHERE user_id ='KeithM';
UPDATE users SET profile_status = 'COMPLETE' WHERE user_id ='MaxO';
UPDATE users SET profile_status = 'COMPLETE' WHERE user_id ='MiguelM';
UPDATE users SET profile_status = 'COMPLETE' WHERE user_id ='LiamS';

INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('KeithM', 'MiguelM', '2018-01-08');
INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('KeithM', 'MaxO', '2018-01-08');
INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('MaxO', 'MiguelM', '2018-01-08');
INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('MaxO', 'KeithM', '2018-01-08');
INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('MaxO', 'LiamS', '2018-01-08');
INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('LiamS', 'MiguelM', '2018-01-08');
INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('LiamS', 'KeithM', '2018-01-08');
INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('LiamS', 'MaxO', '2018-01-08');
INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('KeithM', 'LiamS', '2018-01-08');
INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('MiguelM', 'MaxO', '2018-01-08');
INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('MiguelM', 'LiamS', '2018-01-08');
INSERT INTO interests (user_id_interested, user_id_interested_in, date_interested) VALUES ('MiguelM', 'KeithM', '2018-01-08');

INSERT INTO users (user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access, profile_status) VALUES ('disableduser', '972141bcbcb6a0acc96e92309175b3c5', 'c', 'test@test.com', 'Disabled', 'User', '1995-01-01', '2018-01-01', 'DISABLED');