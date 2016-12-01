CREATE DATABASE server_homepage;
USE server_homepage;
 
CREATE TABLE users(
	id BIGINT NOT NULL AUTO_INCREMENT,
	username VARCHAR(50),
	password VARCHAR(40),
	email VARCHAR(100),
	signup_date DATETIME,
	admin INT,
	blocked INT,
	user_key VARCHAR(20),
	PRIMARY KEY (id)
)ENGINE=INNODB;