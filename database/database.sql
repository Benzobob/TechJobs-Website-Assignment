-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- PHP Version: 7.0.26


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database Details --

CREATE DATABASE IF NOT EXISTS `sql2227593` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sql2227593`;


-- Table Structure for CompanyLogins -- 

CREATE TABLE `CompanyLogins` (
	`CompanyID` 		int AUTO_INCREMENT,
	`AccountEmail` 		varchar(255) UNIQUE,
	`Password` 		varchar(100) NOT NULL,
	`Banned`		tinyint,
	PRIMARY KEY(CompanyID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- Table Structure for Logins --

CREATE TABLE `UserLogins` (
	`UserID` 		int AUTO_INCREMENT,
	`AccountEmail` 	varchar(255) UNIQUE,
	`Password` 		varchar(100) NOT NULL,
	`AdminStatus`	tinyint,
	`Banned`		tinyint,
	PRIMARY KEY(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table Structure for Users --


CREATE TABLE `Users` (
	`UserID` 		int NOT NULL,
	`Firstname`		varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Surname`		varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	`PhoneNum`		varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Status`		tinyint,
	`PersonalBio`	text DEFAULT NULL,
	PRIMARY KEY(UserID),
	FOREIGN KEY(UserID) REFERENCES UserLogins(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table Structure for Connections --

CREATE TABLE `Connections` (
	`CID` 			int AUTO_INCREMENT,
	`UserID1`		int NOT NULL,
	`UserID2`		int NOT NULL,
	`CStatus`		tinyint NOT NULL,
	PRIMARY KEY(CID),
	FOREIGN KEY(UserID1) REFERENCES Users(UserID),
	FOREIGN KEY(UserID2) REFERENCES Users(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table Structure for UserProjects --

CREATE TABLE `UserProjects` (
	`ProjectID`		int AUTO_INCREMENT,
	`UserID` 		int NOT NULL,
	`LinkToCode`	text DEFAULT NULL,
	PRIMARY KEY(ProjectID),
	FOREIGN KEY(UserID) REFERENCES Users(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table Structure for Skills --

CREATE TABLE `Skills` (
	`SID`			int AUTO_INCREMENT,
	`STitle`		varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY(SID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table Structure for UserSkills

CREATE TABLE `UserSkills` (
	`UserID` 		int NOT NULL,
	`SID`			int NOT NULL,
	PRIMARY KEY(UserID, SID),
	FOREIGN KEY(UserID) REFERENCES Users(UserID),
	FOREIGN KEY(SID) REFERENCES Skills(SID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table Structure for Companies --

CREATE TABLE `Companies` (
	`CompanyID`			 int AUTO_INCREMENT,
	`CompanyName`		 varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Address`			 varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
	`CompanyEmail`  	 varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
	`CompanyDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
	`ContactNum`		 varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Employees`			 int NOT NULL,
	PRIMARY KEY(CompanyID),
	FOREIGN KEY(CompanyID) REFERENCES CompanyLogins(CompanyID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table Structure for WorkHistory --

CREATE TABLE `WorkHistory` (
	`WHID` 			 int AUTO_INCREMENT,
	`UserID` 		 int NOT NULL,
	`StartDate`		 date DEFAULT NULL,
	`EndDate`		 date DEFAULT NULL,
	`JobDescription` text DEFAULT NULL,
	`CompanyName`    varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY(WHID),
	FOREIGN KEY(UserID) REFERENCES Users(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table Structure for AcademicDegrees --

CREATE TABLE `AcademicDegrees` (
	`ADID`			int AUTO_INCREMENT,
	`ADTitle`		varchar(100),
	`ADDescription` text DEFAULT NULL,
	PRIMARY KEY(ADID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- Table Structure for UserDegrees --

CREATE TABLE `UserDegrees` (
	`UDID`			int AUTO_INCREMENT,
	`UserID` 		int NOT NULL,
	`ADID`			int NOT NULL,
	`DateObtained`	date DEFAULT NULL,
	PRIMARY KEY(UDID),
	FOREIGN KEY(UserID) REFERENCES Users(UserID),
	FOREIGN KEY(ADID) REFERENCES AcademicDegrees(ADID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table Structure for Vacancies --

CREATE TABLE `Vacancies` (
	`VID`			int AUTO_INCREMENT,
	`CompanyID` 	int NOT NULL,
	`VTitle`		varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	`VDescription`  text DEFAULT NULL,
	`RequiredExp`	text DEFAULT NULL,
	PRIMARY KEY(VID),
	FOREIGN KEY(CompanyID) REFERENCES Companies(CompanyID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table Structure for SkillsForVacancy --

CREATE TABLE `SkillsForVacancy` (
	`VID`		int NOT NULL,
	`SID`		int NOT NULL,
	PRIMARY KEY (VID, SID),
	FOREIGN KEY(VID) REFERENCES Vacancies(VID),
	FOREIGN KEY(SID) REFERENCES Skills(SID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;