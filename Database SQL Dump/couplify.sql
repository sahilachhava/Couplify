-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 02, 2021 at 01:38 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `couplify`
--
CREATE DATABASE IF NOT EXISTS `couplify` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `couplify`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`city`, `state`, `country`, `userID`) VALUES
('Toronto', 'ON', 'Canada', 1),
('London', 'ON', 'Canada', 2),
('Quebec City', 'QC', 'Canada', 3),
('Vancouver', 'BC', 'Canada', 4),
('Ottawa', 'ON', 'Canada', 5),
('Vancouver', 'BC', 'Canada', 6),
('Montreal', 'QC', 'Canada', 7),
('Toronto', 'ON', 'Canada', 8),
('Vancouver', 'BC', 'Canada', 9),
('Ottawa', 'ON', 'Canada', 10),
('London', 'ON', 'Canada', 11),
('Toronto', 'ON', 'Canada', 12),
('London', 'ON', 'Canada', 13),
('Victoria', 'BC', 'Canada', 14),
('Regina', 'SK', 'Canada', 15),
('Victoria', 'BC', 'Canada', 16),
('Regina', 'SK', 'Canada', 17),
('Toronto', 'ON', 'Canada', 18),
('Montreal', 'QC', 'Canada', 19),
('Toronto', 'ON', 'Canada', 20),
('Quebec City', 'QC', 'Canada', 21),
('Vancouver', 'BC', 'Canada', 22),
('Montreal', 'QC', 'Canada', 23),
('Victoria', 'BC', 'Canada', 24),
('Vancouver', 'BC', 'Canada', 25),
('Toronto', 'ON', 'Canada', 26),
('London', 'ON', 'Canada', 27),
('Toronto', 'ON', 'Canada', 28),
('Quebec City', 'QC', 'Canada', 29),
('Peterborough', 'ON', 'Canada', 30),
('Toronto', 'ON', 'Canada', 31),
('Toronto', 'ON', 'Canada', 33),
('Montreal', 'QC', 'Canada', 32);

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

DROP TABLE IF EXISTS `cuisines`;
CREATE TABLE `cuisines` (
  `cuisineID` int(11) NOT NULL,
  `cuisine` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuisines`
--

INSERT INTO `cuisines` (`cuisineID`, `cuisine`) VALUES
(1, 'French Cuisine'),
(2, 'Chinese Cuisine'),
(3, 'Japanese Food'),
(4, 'Italian Food'),
(5, 'Greek Food'),
(6, 'Spanish Food'),
(7, 'Lebanese Cuisine'),
(8, 'Moroccan Cuisine'),
(9, 'Mediterranean Cuisine'),
(10, 'Turkish Cuisine'),
(11, 'Thai Cuisine'),
(12, 'Indian Cuisine'),
(13, 'Cajun Food'),
(14, 'Mexican Cuisine'),
(15, 'Caribbean Cuisine'),
(16, 'German Food'),
(17, 'Russian Cuisine'),
(18, 'Hungarian Cuisine'),
(19, 'American Food');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
CREATE TABLE `favourites` (
  `userID` int(11) NOT NULL,
  `favouritedUserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hobbies`
--

DROP TABLE IF EXISTS `hobbies`;
CREATE TABLE `hobbies` (
  `hobbyID` int(11) NOT NULL,
  `hobby` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hobbies`
--

INSERT INTO `hobbies` (`hobbyID`, `hobby`) VALUES
(1, 'Singing'),
(2, 'Dancing'),
(3, 'Reading'),
(4, 'Cooking'),
(5, 'Gaming'),
(6, 'Painting'),
(7, 'Photography'),
(8, 'Sports'),
(9, 'Yoga'),
(10, 'Workout'),
(11, 'Teaching'),
(12, 'Swimming'),
(13, 'Travelling'),
(14, 'Fishing'),
(15, 'Surfing');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `jobID` int(11) NOT NULL,
  `job` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobID`, `job`) VALUES
(1, 'IT Professional'),
(2, 'Doctor'),
(3, 'Lawyer'),
(4, 'Scientist'),
(5, 'Dentist'),
(6, 'Businessperson'),
(7, 'Entrepreneur'),
(8, 'Professor'),
(9, 'Operations Manager'),
(10, 'Truck Driver'),
(11, 'Chef'),
(12, 'Food Server'),
(13, 'Police Officer'),
(14, 'Marketing Specialist'),
(15, 'Registered Nurse'),
(16, 'Electrician'),
(17, 'Carpenter'),
(18, 'Mechanic'),
(19, 'Bookkeeper'),
(20, 'Construction Worker'),
(21, 'Medical Assistant'),
(22, 'Line Supervisor'),
(23, 'Administrative Assistant'),
(24, 'Office Clerk'),
(25, 'Customer Service Representative'),
(26, 'Laborer'),
(27, 'Stocking Associate'),
(28, 'Retail Sales Associate'),
(29, 'Bartender'),
(30, 'Janitor'),
(31, 'Food Preparation Worker'),
(32, 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `languageID` int(11) NOT NULL,
  `language` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`languageID`, `language`) VALUES
(1, 'Chinese'),
(2, 'Spanish'),
(3, 'English'),
(4, 'Arabic'),
(5, 'Hindi'),
(6, 'Portuguese'),
(7, 'Russian'),
(8, 'Japanese'),
(9, 'German'),
(10, 'Urdu'),
(11, 'Vietnamese'),
(12, 'French'),
(13, 'Korean'),
(14, 'Italian');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `timeStamp` datetime NOT NULL,
  `isRead` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `userID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `timeStamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notificationSettings`
--

DROP TABLE IF EXISTS `notificationSettings`;
CREATE TABLE `notificationSettings` (
  `userID` int(11) NOT NULL,
  `allNotification` int(11) NOT NULL DEFAULT '1',
  `addFavourite` int(11) NOT NULL DEFAULT '1',
  `removeFavourite` int(11) NOT NULL DEFAULT '1',
  `messages` int(11) NOT NULL DEFAULT '1',
  `winks` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notificationSettings`
--

INSERT INTO `notificationSettings` (`userID`, `allNotification`, `addFavourite`, `removeFavourite`, `messages`, `winks`) VALUES
(22, 1, 1, 1, 1, 1),
(26, 1, 1, 1, 1, 1),
(9, 1, 1, 1, 1, 1),
(5, 1, 1, 1, 1, 1),
(27, 1, 1, 1, 1, 1),
(8, 1, 1, 1, 1, 1),
(32, 1, 1, 1, 1, 1),
(13, 1, 1, 1, 1, 1),
(7, 1, 1, 1, 1, 1),
(16, 1, 1, 1, 1, 1),
(19, 1, 1, 1, 1, 1),
(14, 1, 1, 1, 1, 1),
(20, 1, 1, 1, 1, 1),
(18, 1, 1, 1, 1, 1),
(23, 1, 1, 1, 1, 1),
(11, 1, 1, 1, 1, 1),
(33, 1, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 1),
(31, 1, 1, 1, 1, 1),
(1, 1, 1, 1, 1, 1),
(4, 1, 1, 1, 1, 1),
(21, 1, 1, 1, 1, 1),
(3, 1, 1, 1, 1, 1),
(28, 1, 1, 1, 1, 1),
(25, 1, 1, 1, 1, 1),
(6, 1, 1, 1, 1, 1),
(10, 1, 1, 1, 1, 1),
(29, 1, 1, 1, 1, 1),
(30, 1, 1, 1, 1, 1),
(24, 1, 1, 1, 1, 1),
(15, 1, 1, 1, 1, 1),
(17, 1, 1, 1, 1, 1),
(12, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `premiumPlan`
--

DROP TABLE IF EXISTS `premiumPlan`;
CREATE TABLE `premiumPlan` (
  `userID` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `planType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userCuisines`
--

DROP TABLE IF EXISTS `userCuisines`;
CREATE TABLE `userCuisines` (
  `cuisine` varchar(100) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userCuisines`
--

INSERT INTO `userCuisines` (`cuisine`, `userID`) VALUES
('German Food', 18),
('Chinese Cuisine', 18),
('Russian Cuisine', 18),
('Thai Cuisine', 18),
('Thai Cuisine', 23),
('Hungarian Cuisine', 23),
('Russian Cuisine', 23),
('Mediterranean Cuisine', 23),
('Lebanese Cuisine', 6),
('French Cuisine', 6),
('Moroccan Cuisine', 6),
('Cajun Food', 7),
('French Cuisine', 7),
('Indian Cuisine', 7),
('Turkish Cuisine', 15),
('Caribbean Cuisine', 15),
('Cajun Food', 15),
('Mexican Cuisine', 15),
('Moroccan Cuisine', 26),
('French Cuisine', 26),
('German Food', 26),
('American Food', 26),
('French Cuisine', 28),
('Mediterranean Cuisine', 28),
('Cajun Food', 28),
('Hungarian Cuisine', 8),
('Italian Food', 8),
('Moroccan Cuisine', 8),
('Moroccan Cuisine', 29),
('American Food', 29),
('Russian Cuisine', 29),
('American Food', 2),
('Cajun Food', 2),
('Greek Food', 2),
('Indian Cuisine', 2),
('French Cuisine', 10),
('Moroccan Cuisine', 10),
('Chinese Cuisine', 10),
('Japanese Food', 1),
('Caribbean Cuisine', 1),
('French Cuisine', 1),
('Spanish Food', 1),
('German Food', 1),
('Caribbean Cuisine', 12),
('Greek Food', 12),
('American Food', 12),
('Chinese Cuisine', 12),
('Hungarian Cuisine', 12),
('Cajun Food', 4),
('American Food', 4),
('Italian Food', 4),
('Mexican Cuisine', 3),
('Moroccan Cuisine', 3),
('Mediterranean Cuisine', 3),
('Japanese Food', 3),
('American Food', 5),
('Greek Food', 5),
('Russian Cuisine', 5),
('Indian Cuisine', 5),
('Mexican Cuisine', 21),
('Caribbean Cuisine', 21),
('Japanese Food', 21),
('Spanish Food', 21),
('Hungarian Cuisine', 21),
('Turkish Cuisine', 27),
('Indian Cuisine', 27),
('Thai Cuisine', 27),
('Lebanese Cuisine', 22),
('Russian Cuisine', 22),
('Caribbean Cuisine', 22),
('Mediterranean Cuisine', 22),
('Moroccan Cuisine', 22),
('American Food', 9),
('Moroccan Cuisine', 9),
('Greek Food', 9),
('American Food', 17),
('Mexican Cuisine', 17),
('Greek Food', 17),
('Moroccan Cuisine', 17),
('Caribbean Cuisine', 19),
('Japanese Food', 19),
('French Cuisine', 19),
('Moroccan Cuisine', 19),
('Moroccan Cuisine', 13),
('Spanish Food', 13),
('American Food', 13),
('French Cuisine', 16),
('Mexican Cuisine', 16),
('Spanish Food', 16),
('Caribbean Cuisine', 16),
('Greek Food', 16),
('French Cuisine', 11),
('Hungarian Cuisine', 11),
('Turkish Cuisine', 11),
('German Food', 20),
('American Food', 20),
('Chinese Cuisine', 20),
('Turkish Cuisine', 20),
('Cajun Food', 30),
('Greek Food', 30),
('Italian Food', 30),
('Chinese Cuisine', 30),
('Caribbean Cuisine', 30),
('Thai Cuisine', 25),
('Russian Cuisine', 25),
('Chinese Cuisine', 25),
('Caribbean Cuisine', 25),
('Mediterranean Cuisine', 25),
('Thai Cuisine', 31),
('Mediterranean Cuisine', 31),
('American Food', 31),
('Greek Food', 31),
('Italian Food', 31),
('Thai Cuisine', 24),
('Russian Cuisine', 24),
('Chinese Cuisine', 24),
('Mexican Cuisine', 24),
('French Cuisine', 24),
('Hungarian Cuisine', 14),
('American Food', 14),
('Indian Cuisine', 14),
('Caribbean Cuisine', 14),
('Cajun Food', 14),
('Chinese Cuisine', 33),
('Japanese Food', 33),
('Mexican Cuisine', 33),
('American Food', 33),
('French Cuisine', 32),
('Chinese Cuisine', 32),
('Indian Cuisine', 32),
('Mexican Cuisine', 32),
('American Food', 32);

-- --------------------------------------------------------

--
-- Table structure for table `userDetails`
--

DROP TABLE IF EXISTS `userDetails`;
CREATE TABLE `userDetails` (
  `userID` int(11) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPassword` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `profilePhoto` varchar(100) DEFAULT 'assets/profilePhotos/default.jpg',
  `gender` varchar(10) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `aboutMe` varchar(250) DEFAULT NULL,
  `lookingFor` varchar(10) DEFAULT NULL,
  `maritalStatus` varchar(15) DEFAULT NULL,
  `totalChildren` int(11) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `isOnline` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userDetails`
--

INSERT INTO `userDetails` (`userID`, `userEmail`, `userPassword`, `firstName`, `lastName`, `profilePhoto`, `gender`, `dateOfBirth`, `aboutMe`, `lookingFor`, `maritalStatus`, `totalChildren`, `job`, `isOnline`) VALUES
(1, 'bulma@maildrop.cc', '9752a4423f0db504eda5f45a630f945c', 'Brief', 'Bulma', 'assets/profilePhotos/1.jpg', 'Female', '1970-08-18', 'I want to inspire and be inspired.', 'Male', 'Divorced', 2, 'IT Professional', 0),
(2, 'asuna@maildrop.cc', '2ca63d7ec09bef617bb3c5b1125d8907', 'Yuuki', 'Asuna', 'assets/profilePhotos/2.jpg', 'Female', '2001-09-30', 'I am here to find love and give love in return.', 'Male', 'Single', 0, 'Electrician', 0),
(3, 'luffy@maildrop.cc', 'bc0062c11767b7edaebb887c547180e0', 'Luffy', 'Monkey D.', 'assets/profilePhotos/3.jpg', 'Male', '2002-05-05', 'I won\'t run away in the storms.', 'Female', 'Single', 0, 'Dentist', 0),
(4, 'natsu@maildrop.cc', '6c5a5580dfe73198b2c20e3e39a2be1d', 'Dragneel', 'Natsu', 'assets/profilePhotos/4.jpg', 'Male', '2003-07-07', 'Nice guys finish last? Let\'s prove that wrong.', 'Female', 'Single', 0, 'Cashier', 0),
(5, 'touka@maildrop.cc', '47f8593731de3421082483f9a674894e', 'Kirishima', 'Touka', 'assets/profilePhotos/5.jpg', 'Female', '2002-07-01', 'I\'m going to make the rest of my life the best of my life. Care to share it with me?', 'Male', 'Single', 0, 'Line Supervisor', 0),
(6, 'meliodas@maildrop.cc', 'e7579e5d35978b238fa11e2ca4de7504', 'Liones', 'Meliodas', 'assets/profilePhotos/6.jpg', 'Male', '1990-07-25', 'I am old fashioned sometimes. I still believe in romance, in roses, in holding hands.', 'Female', 'Single', 1, 'IT Professional', 0),
(7, 'mitsuha@maildrop.cc', 'c44ca1673f4bbbd9878eaf575aa7c592', 'Miyamizu', 'Mitsuha', 'assets/profilePhotos/7.jpg', 'Female', '1995-12-01', 'I am someone who will kiss you in the rain.', 'Male', 'Single', 0, 'Administrative Assistant', 0),
(8, 'mikasa@maildrop.cc', '012e5f1fb1c6948874207b35d54fa1f0', 'Ackerman', 'Mikasa', 'assets/profilePhotos/8.jpg', 'Female', '1997-02-10', 'What I am is good enough.', 'Male', 'Single', 0, 'Marketing Specialist', 0),
(9, 'vegeta@maildrop.cc', '4a49d749426eea6f5f157006627fd512', 'Vegeta', 'Prince', 'assets/profilePhotos/9.jpg', 'Male', '1969-11-12', 'I am well-balanced and stable, but willing to let you knock me off my feet.', 'Female', 'Divorced', 2, 'Registered Nurse', 0),
(10, 'nami@maildrop.cc', '267497fbe6669c78effefe9f0284bb31', 'Nami', 'Cat Burglar', 'assets/profilePhotos/10.jpg', 'Female', '2000-07-03', 'I can guarantee you won\'t find anybody else like me.', 'Male', 'Single', 0, 'Bartender', 0),
(11, 'erza@maildrop.cc', '0b3a0f7609e059035e2dfd3cb4ecc8e1', 'Scarlet', 'Erza', 'assets/profilePhotos/11.jpg', 'Female', '1995-10-23', 'I am strong enough to protect you and soft enough to melt your heart.', 'Male', 'Single', 0, 'Janitor', 0),
(12, 'light@maildrop.cc', '5e6eada8327ab1c8a569a579bbadc381', 'Yagami', 'Light', 'assets/profilePhotos/12.jpg', 'Male', '1986-02-28', 'If I could rate my personality, I\'d say good looking!', 'Female', 'Widowed', 0, 'Marketing Specialist', 0),
(13, 'taki@maildrop.cc', '1071b452f8eb9ea1667d0e84b64b90b4', 'Tachibana', 'Taki', 'assets/profilePhotos/13.jpg', 'Male', '1998-12-01', 'As long as you think I\'m awesome, we will get along just fine.', 'Female', 'Single', 0, 'Lawyer', 0),
(14, 'misha@maildrop.cc', '2083f9f29cfa206f42aeacbb610bee2e', 'Necron', 'Misha', 'assets/profilePhotos/14.jpg', 'Female', '2001-07-28', 'I am just one small person in this big world trying to find real love.', 'Male', 'Single', 0, 'Construction Worker', 0),
(15, 'goku@maildrop.cc', 'e9e9097c5fe00b549e067c1b6dd36604', 'Goku', 'Son', 'assets/profilePhotos/15.jpg', 'Male', '1974-04-18', 'I live my life without stress and worries.', 'Female', 'Single', 2, 'Retail Sales Associate', 0),
(16, 'sanji@maildrop.cc', '80b0cf1f023fb03db241d686bc31fbc1', 'Sanji', 'Vinsmoke', 'assets/profilePhotos/16.jpg', 'Male', '1998-03-02', 'Once I\'ve found my special someone, my life will be complete.', 'Female', 'Single', 0, 'Construction Worker', 0),
(17, 'lucy@maildrop.cc', '6614460fd20bcc573f254838804183f9', 'Heartfelia', 'Lucy', 'assets/profilePhotos/17.jpg', 'Female', '2003-07-01', 'I\'m not here to be an average partner, I\'m here to be an awesome partner.', 'Male', 'Single', 0, 'Operations Manager', 0),
(18, 'misa@maildrop.cc', '1905f43bedad2cc15d197faf1c878bba', 'Amane', 'Misa', 'assets/profilePhotos/18.jpg', 'Female', '1984-12-15', 'I\'m a tidy person, with a few messy habits.', 'Male', 'Widowed', 0, 'Medical Assistant', 0),
(19, 'chichi@maildrop.cc', 'c49b6f59cc669c5c95f5a94038119487', 'Chichi', 'Son', 'assets/profilePhotos/19.jpg', 'Female', '1980-11-05', 'I appreciate the little things.', 'Male', 'Single', 2, 'Businessperson', 0),
(20, 'robin@maildrop.cc', '272b9079e39dd0a05e427c71ae290c26', 'Robin', 'Nico', 'assets/profilePhotos/20.jpg', 'Female', '1990-02-06', 'I\'ve learned to stop rushing things that need time to grow.', 'Male', 'Single', 0, 'Food Preparation Worker', 0),
(21, 'jellal@maildrop.cc', 'c4275b6596820c545a6bb6bae9881401', 'Fernandez', 'Jellal', 'assets/profilePhotos/21.jpg', 'Male', '1993-06-21', 'Being both strong and soft is a combination I have mastered.', 'Female', 'Single', 0, 'Truck Driver', 0),
(22, 'elizabeth@maildrop.cc', '4d30dbc3852c89c5aa99cd1ccfcb1dcb', 'Liones', 'Elizabeth', 'assets/profilePhotos/22.jpg', 'Female', '1991-06-12', 'I\'m trusting, and I\'ll never try to tell you what you can and can\'t do.', 'Male', 'Single', 1, 'Police Officer', 0),
(23, 'hancock@maildrop.cc', '0add4fcd3e0d2cf79c127d4fdeb0327d', 'Hancock', 'Boa', 'assets/profilePhotos/23.jpg', 'Female', '1990-09-02', 'I\'m willing to work hard to make you happy in life.', 'Male', 'Single', 0, 'IT Professional', 0),
(24, 'gray@maildrop.cc', 'd29d626ddbb1b31feac32d8c5050ba86', 'Fullbuster', 'Gray', 'assets/profilePhotos/24.jpg', 'Male', '2002-02-13', 'Forget what hurt you in the past. It wasn\'t me. I\'m like the opposite of that person!', 'Female', 'Single', 0, 'Scientist', 0),
(25, 'kirito@maildrop.cc', 'a7883b1d9a3fbb77135470d5e6547d90', 'Kirigaya', 'Kirito', 'assets/profilePhotos/25.jpg', 'Male', '1999-10-07', 'I\'m loving, and I\'ll always look forward to seeing you at the end of each day.', 'Female', 'Single', 0, 'Scientist', 0),
(26, 'eren@maildrop.cc', '5cdc1cc49e527bffe0d18c745254b90a', 'Yeager', 'Eren', 'assets/profilePhotos/26.jpg', 'Male', '1997-03-30', 'I am the one your mother warned you about.', 'Female', 'Single', 0, 'Truck Driver', 0),
(27, 'anos@maildrop.cc', '9815ef5cf0211e228c7499e3032a29b9', 'Voldigoad', 'Anos', 'assets/profilePhotos/27.jpg', 'Male', '1999-11-22', 'I am too positive to be doubtful, too optimistic to be fearful, and too determined to be defeated.', 'Female', 'Single', 0, 'Lawyer', 0),
(28, 'juvia@maildrop.cc', 'cfcbf7213ddb7b3eddbc14fc1d51b27d', 'Lockster', 'Juvia', 'assets/profilePhotos/28.jpg', 'Female', '2000-11-13', 'Don\'t let idiots ruin your day, date me instead!', 'Male', 'Single', 0, 'Medical Assistant', 0),
(29, 'zoro@maildrop.cc', 'ebce0d3e88907dccaac79f9d66cd91a9', 'Zoro', 'Roronoa', 'assets/profilePhotos/29.jpg', 'Male', '1999-11-11', 'WiFi, sake, my bed, snuggles. Perfection.', 'Female', 'Single', 0, 'Customer Service Representative', 0),
(30, 'kaneki@maildrop.cc', 'b7b1f206beeafc0328769d4c8132b7a0', 'Kaneki', 'Ken', 'assets/profilePhotos/30.jpg', 'Male', '2000-12-20', 'I don\'t smoke, drink or party every weekend. I don\'t play around or start drama to get attention. Yes, we do still exist!', 'Female', 'Single', 0, 'Businessperson', 0),
(31, 'gojo@maildrop.cc', '46edea2ffa7fb51a932ba6357a6f2515', 'Gojo', 'Satoru', 'assets/profilePhotos/31.jpg', 'Male', '1989-12-07', 'I find that having a dirty mind makes ordinary conversations much more interesting.', 'Female', 'Single', 0, 'Cashier', 0),
(32, 'sahil@maildrop.cc', 'e8c8f45019430b6f79862746e96d6e70', 'Sahil', 'Achhava', 'assets/profilePhotos/32.jpg', 'Male', '1997-11-26', 'I like watching anime', 'Female', 'Single', 0, 'IT Professional', 0),
(33, 'rimuru@maildrop.cc', '6414bd9887c7495a98930e554a4aeaa5', 'Tempest', 'Rimuru', 'assets/profilePhotos/33.jpg', 'Male', '1995-04-17', 'I am the ruler of Jura Forest and leader of the Jura Tempest Federation.', 'Female', 'Single', 0, 'Entrepreneur', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userHobbies`
--

DROP TABLE IF EXISTS `userHobbies`;
CREATE TABLE `userHobbies` (
  `hobby` varchar(50) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userHobbies`
--

INSERT INTO `userHobbies` (`hobby`, `userID`) VALUES
('Cooking', 18),
('Fishing', 18),
('Workout', 18),
('Sports', 18),
('Painting', 18),
('Travelling', 23),
('Fishing', 23),
('Swimming', 23),
('Yoga', 23),
('Painting', 6),
('Photography', 6),
('Swimming', 6),
('Yoga', 7),
('Surfing', 7),
('Fishing', 7),
('Surfing', 15),
('Singing', 15),
('Dancing', 15),
('Travelling', 15),
('Yoga', 15),
('Travelling', 26),
('Painting', 26),
('Fishing', 26),
('Teaching', 28),
('Travelling', 28),
('Workout', 28),
('Reading', 8),
('Cooking', 8),
('Singing', 8),
('Dancing', 8),
('Fishing', 8),
('Workout', 29),
('Yoga', 29),
('Dancing', 29),
('Surfing', 29),
('Swimming', 29),
('Surfing', 2),
('Painting', 2),
('Photography', 2),
('Workout', 10),
('Teaching', 10),
('Sports', 10),
('Gaming', 10),
('Fishing', 10),
('Singing', 1),
('Yoga', 1),
('Photography', 1),
('Surfing', 12),
('Photography', 12),
('Sports', 12),
('Travelling', 12),
('Workout', 4),
('Cooking', 4),
('Singing', 4),
('Reading', 4),
('Travelling', 4),
('Painting', 3),
('Surfing', 3),
('Singing', 3),
('Travelling', 5),
('Fishing', 5),
('Yoga', 5),
('Teaching', 5),
('Yoga', 21),
('Painting', 21),
('Swimming', 21),
('Surfing', 21),
('Sports', 21),
('Travelling', 27),
('Yoga', 27),
('Cooking', 27),
('Surfing', 27),
('Dancing', 22),
('Cooking', 22),
('Teaching', 22),
('Workout', 9),
('Surfing', 9),
('Photography', 9),
('Singing', 17),
('Workout', 17),
('Travelling', 17),
('Photography', 17),
('Gaming', 19),
('Teaching', 19),
('Cooking', 19),
('Reading', 19),
('Teaching', 13),
('Dancing', 13),
('Painting', 13),
('Surfing', 13),
('Cooking', 13),
('Photography', 16),
('Surfing', 16),
('Singing', 16),
('Workout', 11),
('Gaming', 11),
('Swimming', 11),
('Teaching', 11),
('Painting', 11),
('Yoga', 20),
('Photography', 20),
('Dancing', 20),
('Gaming', 20),
('Singing', 20),
('Gaming', 30),
('Travelling', 30),
('Fishing', 30),
('Reading', 30),
('Reading', 25),
('Sports', 25),
('Fishing', 25),
('Painting', 31),
('Singing', 31),
('Yoga', 31),
('Travelling', 31),
('Workout', 24),
('Cooking', 24),
('Fishing', 24),
('Painting', 24),
('Dancing', 14),
('Painting', 14),
('Yoga', 14),
('Gaming', 14),
('Gaming', 33),
('Sports', 33),
('Teaching', 33),
('Swimming', 33),
('Travelling', 33),
('Singing', 32),
('Cooking', 32),
('Gaming', 32),
('Teaching', 32),
('Travelling', 32);

-- --------------------------------------------------------

--
-- Table structure for table `userLanguages`
--

DROP TABLE IF EXISTS `userLanguages`;
CREATE TABLE `userLanguages` (
  `language` varchar(50) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userLanguages`
--

INSERT INTO `userLanguages` (`language`, `userID`) VALUES
('Chinese', 18),
('German', 18),
('Hindi', 18),
('Hindi', 23),
('Chinese', 23),
('Russian', 23),
('Vietnamese', 23),
('Spanish', 6),
('Russian', 6),
('English', 6),
('Portuguese', 6),
('Urdu', 6),
('Hindi', 7),
('English', 7),
('Korean', 7),
('Chinese', 15),
('Hindi', 15),
('German', 15),
('Arabic', 15),
('Vietnamese', 26),
('Spanish', 26),
('Hindi', 26),
('English', 26),
('Italian', 28),
('Vietnamese', 28),
('Japanese', 28),
('Spanish', 28),
('Vietnamese', 8),
('Hindi', 8),
('Spanish', 8),
('Urdu', 8),
('Korean', 8),
('Japanese', 29),
('Russian', 29),
('Arabic', 29),
('Urdu', 2),
('French', 2),
('Russian', 2),
('Portuguese', 10),
('Spanish', 10),
('Hindi', 10),
('German', 10),
('Russian', 10),
('Japanese', 1),
('French', 1),
('Hindi', 1),
('Korean', 12),
('Russian', 12),
('Vietnamese', 12),
('French', 12),
('Japanese', 4),
('Portuguese', 4),
('Italian', 4),
('Hindi', 4),
('Spanish', 4),
('Chinese', 3),
('German', 3),
('English', 3),
('Vietnamese', 5),
('Portuguese', 5),
('Spanish', 5),
('Japanese', 5),
('English', 5),
('Portuguese', 21),
('French', 21),
('Japanese', 21),
('Hindi', 21),
('English', 27),
('Italian', 27),
('Korean', 27),
('Japanese', 27),
('French', 22),
('English', 22),
('Spanish', 22),
('Vietnamese', 22),
('German', 9),
('Japanese', 9),
('Vietnamese', 9),
('Arabic', 9),
('French', 17),
('Hindi', 17),
('Arabic', 17),
('Korean', 17),
('Urdu', 17),
('Japanese', 19),
('Russian', 19),
('French', 19),
('Russian', 13),
('Spanish', 13),
('Korean', 13),
('Korean', 16),
('Hindi', 16),
('Vietnamese', 16),
('Chinese', 16),
('German', 16),
('Urdu', 11),
('Japanese', 11),
('Chinese', 11),
('Russian', 11),
('Italian', 20),
('Hindi', 20),
('French', 20),
('Urdu', 20),
('English', 20),
('Russian', 30),
('Hindi', 30),
('Japanese', 30),
('Russian', 25),
('Spanish', 25),
('Vietnamese', 25),
('Vietnamese', 31),
('French', 31),
('Hindi', 31),
('Chinese', 31),
('Vietnamese', 24),
('Japanese', 24),
('English', 24),
('Spanish', 24),
('Vietnamese', 14),
('French', 14),
('Urdu', 14),
('English', 33),
('Japanese', 33),
('French', 33),
('English', 32),
('Hindi', 32);

-- --------------------------------------------------------

--
-- Table structure for table `userPhotos`
--

DROP TABLE IF EXISTS `userPhotos`;
CREATE TABLE `userPhotos` (
  `photo` varchar(250) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userPhotos`
--

INSERT INTO `userPhotos` (`photo`, `userID`) VALUES
('1.jpg', 6),
('2.jpg', 6),
('3.jpg', 6),
('4.jpg', 6),
('1.jpg', 15),
('2.jpg', 15),
('3.jpg', 15),
('4.jpg', 15),
('5.jpg', 15),
('1.jpg', 18),
('2.jpg', 18),
('3.jpg', 18),
('1.jpg', 8),
('2.jpg', 8),
('3.jpeg', 8),
('4.jpg', 8),
('1.jpg', 29),
('2.jpg', 29),
('3.jpg', 29),
('4.jpg', 29),
('1.jpeg', 1),
('2.png', 1),
('3.jpg', 1),
('4.png', 1),
('5.jpg', 1),
('1.png', 28),
('2.jpg', 28),
('3.jpg', 28),
('1.png', 17),
('2.jpg', 17),
('3.jpeg', 17),
('4.jpg', 17),
('5.jpg', 17),
('1.jpg', 30),
('2.jpeg', 30),
('3.jpg', 30),
('1.jpeg', 4),
('2.jpg', 4),
('3.jpg', 4),
('4.jpg', 4),
('1.jpg', 3),
('2.jpg', 3),
('3.jpg', 3),
('4.jpg', 3),
('5.jpg', 3),
('1.png', 11),
('2.jpg', 11),
('3.jpg', 11),
('4.jpg', 11),
('1.jpg', 12),
('2.jpg', 12),
('1.jpg', 14),
('2.jpg', 14),
('3.jpg', 14),
('1.jpg', 5),
('2.png', 5),
('3.jpg', 5),
('1.jpg', 21),
('2.jpg', 21),
('1.jpg', 24),
('2.jpg', 24),
('3.jpg', 24),
('4.jpg', 24),
('5.jpg', 24),
('1.jpg', 27),
('2.jpg', 27),
('3.jpg', 27),
('4.jpg', 27),
('1.jpg', 9),
('2.jpg', 9),
('3.png', 9),
('4.jpg', 9),
('1.jpg', 26),
('2.jpeg', 26),
('3.jpg', 26),
('1.png', 7),
('2.png', 7),
('3.jpg', 7),
('4.png', 7),
('5.jpg', 7),
('1.jpg', 16),
('2.jpg', 16),
('3.jpg', 16),
('4.jpg', 16),
('5.jpg', 16),
('1.jpeg', 22),
('2.jpg', 22),
('3.jpg', 22),
('4.jpg', 22),
('5.jpg', 22),
('1.jpg', 23),
('2.jpg', 23),
('3.jpg', 23),
('4.png', 23),
('1.jpg', 31),
('2.jpg', 31),
('3.jpg', 31),
('4.jpg', 31),
('5.jpg', 31),
('1.jpg', 2),
('2.png', 2),
('3.jpg', 2),
('4.jpg', 2),
('5.jpg', 2),
('1.png', 20),
('2.png', 20),
('3.jpg', 20),
('4.png', 20),
('5.jpg', 20),
('1.jpg', 19),
('2.jpg', 19),
('3.png', 19),
('1.png', 10),
('2.jpg', 10),
('3.jpg', 10),
('4.jpeg', 10),
('1.png', 25),
('2.jpg', 25),
('3.jpg', 25),
('4.jpg', 25),
('5.jpg', 25),
('1.jpg', 13),
('2.jpg', 13),
('3.jpg', 13),
('My photo.jpg', 32),
('Photo.jpg', 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD KEY `addressUserID` (`userID`);

--
-- Indexes for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD PRIMARY KEY (`cuisineID`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD KEY `favouriteUserID` (`userID`),
  ADD KEY `favouritedUserID` (`favouritedUserID`);

--
-- Indexes for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`hobbyID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobID`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`languageID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD KEY `senderUserID` (`senderID`),
  ADD KEY `receiverUserID` (`receiverID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD KEY `notificationUserID` (`userID`),
  ADD KEY `notificationReceiverID` (`receiverID`);

--
-- Indexes for table `notificationSettings`
--
ALTER TABLE `notificationSettings`
  ADD KEY `notificationSettingsUserID` (`userID`);

--
-- Indexes for table `premiumPlan`
--
ALTER TABLE `premiumPlan`
  ADD KEY `premiumUserID` (`userID`);

--
-- Indexes for table `userCuisines`
--
ALTER TABLE `userCuisines`
  ADD KEY `cuisineUserID` (`userID`);

--
-- Indexes for table `userDetails`
--
ALTER TABLE `userDetails`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `userHobbies`
--
ALTER TABLE `userHobbies`
  ADD KEY `hobbyUserID` (`userID`);

--
-- Indexes for table `userLanguages`
--
ALTER TABLE `userLanguages`
  ADD KEY `languageUserID` (`userID`);

--
-- Indexes for table `userPhotos`
--
ALTER TABLE `userPhotos`
  ADD KEY `photoUserID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `cuisineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `hobbyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `languageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `userDetails`
--
ALTER TABLE `userDetails`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `addressUserID` FOREIGN KEY (`userID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favouriteUserID` FOREIGN KEY (`userID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favouritedUserID` FOREIGN KEY (`favouritedUserID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `receiverUserID` FOREIGN KEY (`receiverID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `senderUserID` FOREIGN KEY (`senderID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notificationReceiverID` FOREIGN KEY (`receiverID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notificationUserID` FOREIGN KEY (`userID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notificationSettings`
--
ALTER TABLE `notificationSettings`
  ADD CONSTRAINT `notificationSettingsUserID` FOREIGN KEY (`userID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `premiumPlan`
--
ALTER TABLE `premiumPlan`
  ADD CONSTRAINT `premiumUserID` FOREIGN KEY (`userID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userCuisines`
--
ALTER TABLE `userCuisines`
  ADD CONSTRAINT `cuisineUserID` FOREIGN KEY (`userID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userHobbies`
--
ALTER TABLE `userHobbies`
  ADD CONSTRAINT `hobbyUserID` FOREIGN KEY (`userID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userLanguages`
--
ALTER TABLE `userLanguages`
  ADD CONSTRAINT `languageUserID` FOREIGN KEY (`userID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userPhotos`
--
ALTER TABLE `userPhotos`
  ADD CONSTRAINT `photoUserID` FOREIGN KEY (`userID`) REFERENCES `userDetails` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
