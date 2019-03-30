CREATE DATABASE movielisting;

use movielisting;

CREATE TABLE movies (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	director VARCHAR(30) NOT NULL,
	movietitle VARCHAR(50) NOT NULL,
	releasedate VARCHAR(30),
    genre VARCHAR(30),
	date TIMESTAMP
);