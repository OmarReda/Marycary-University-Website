CREATE DATABASE Registrations;

CREATE TABLE Department (
    Dept_ID int NOT NULL,
    Name varchar(255) NOT NULL,
    Description varchar(255) NOT NULL,
    UNIQUE(Dept_ID),
    UNIQUE(Name),   
    PRIMARY KEY (Dept_ID)
);

CREATE TABLE User(
	User_ID int NOT NULL,
	Email varchar(255) NOT NULL,
	Username varchar(255) NOT NULL,
	Password varchar(255) NOT NULL,
	Registration_Date TIMESTAMP NOT NULL,
	Dept_ID int,
	UNIQUE(User_ID),
	UNIQUE(Username),
	PRIMARY KEY (Username),
    FOREIGN KEY (Dept_ID) REFERENCES Department(Dept_ID)
);

CREATE TABLE Course(
	Course_ID int NOT NULL,
	Course_Name varchar(255) NOT NULL,
	Course_Description varchar(255) NOT NULL,
	Instructor_Name varchar(255) NOT NULL,
	Credit_Hours int NOT NULL,
	Dept_ID int,
	UNIQUE(Course_ID),
	UNIQUE(Course_Name),
	PRIMARY KEY (Course_ID),
    FOREIGN KEY (Dept_ID) REFERENCES Department(Dept_ID)
);


