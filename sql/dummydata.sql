CREATE TABLE Users (
	name VARCHAR(200) NOT NULL, 
	email VARCHAR(200) NOT NULL,
	password VARCHAR(200) NOT NULL,
	id INTEGER NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id));
CREATE TABLE Class (
	name VARCHAR(200),
 	id INTEGER NOT NULL AUTO_INCREMENT,
 	PRIMARY KEY (id));
CREATE TABLE Teacher (
	name VARCHAR(200),
 	id INTEGER NOT NULL AUTO_INCREMENT,
 	PRIMARY KEY (id));
CREATE TABLE Semester (
	name VARCHAR(10),
 	id INTEGER NOT NULL AUTO_INCREMENT,
 	PRIMARY KEY (id));
CREATE TABLE DocType (
	name VARCHAR(50),
 	id INTEGER NOT NULL AUTO_INCREMENT,
 	PRIMARY KEY (id));
CREATE TABLE Extension (
	name VARCHAR(5),
 	id INTEGER NOT NULL AUTO_INCREMENT,
 	PRIMARY KEY (id));
CREATE TABLE Document (
	num INTEGER,
 	iteration INTEGER,
 	class INTEGER,
 	teacher INTEGER,
 	semester INTEGER,
 	doctype INTEGER,
	extension INTEGER,
	uploader INTEGER,
 	id INTEGER NOT NULL AUTO_INCREMENT,
 	PRIMARY KEY (id));

INSERT INTO Users (name, email, password) VALUES("ahessler", "ahessler@hawk.iit.edu", "password");
INSERT INTO Extension (name) VALUES (".pdf");
INSERT INTO Class (name) VALUES("Software Engineering");
INSERT INTO Teacher (name) VALUES("Hood, Dennis");
INSERT INTO Semester (name) VALUES("F16"),("F15");
INSERT INTO DocType (name) VALUES("Exam");
INSERT INTO Document (num, iteration, class, teacher, semester, doctype, extension, uploader) VALUES(1, 1, 1, 1, 1, 1, 1, 1),(1,1,1,1,2,1,1, 1);
