-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 08, 2024 at 03:34 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bscbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `cf_admin`
--

DROP TABLE IF EXISTS `cf_admin`;
CREATE TABLE IF NOT EXISTS `cf_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `loginid` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `security` varchar(200) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `logintime` timestamp NULL DEFAULT NULL,
  `logouttime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_admin`
--

INSERT INTO `cf_admin` (`id`, `loginid`, `password`, `security`, `status`, `logintime`, `logouttime`) VALUES
(1, 'admin', '619faf41bdf453f65e76626386f774ac', '7e79a3af2634de6635e59c9404d251b3955d39f9', 'OFFLINE', '2024-03-08 15:33:38', '2024-03-08 15:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `cf_classes`
--

DROP TABLE IF EXISTS `cf_classes`;
CREATE TABLE IF NOT EXISTS `cf_classes` (
  `class_id` int(10) NOT NULL AUTO_INCREMENT,
  `classes` varchar(100) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_classes`
--

INSERT INTO `cf_classes` (`class_id`, `classes`) VALUES
(1, 'JSS 1');

-- --------------------------------------------------------

--
-- Table structure for table `cf_crp`
--

DROP TABLE IF EXISTS `cf_crp`;
CREATE TABLE IF NOT EXISTS `cf_crp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fluxtech` varchar(17) DEFAULT NULL,
  `flink` varchar(25) DEFAULT NULL,
  `fedition` varchar(10) DEFAULT NULL,
  `fno` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_crp`
--

INSERT INTO `cf_crp` (`id`, `fluxtech`, `flink`, `fedition`, `fno`) VALUES
(1, 'FLUXTECH CONCEPTS', 'http://www.fluxtechng.com', '4', '08068782879');

-- --------------------------------------------------------

--
-- Table structure for table `cf_logs`
--

DROP TABLE IF EXISTS `cf_logs`;
CREATE TABLE IF NOT EXISTS `cf_logs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) DEFAULT NULL,
  `actdate` timestamp NULL DEFAULT NULL,
  `actby` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cf_promolog`
--

DROP TABLE IF EXISTS `cf_promolog`;
CREATE TABLE IF NOT EXISTS `cf_promolog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `profrom` varchar(100) DEFAULT NULL,
  `proto` varchar(100) DEFAULT NULL,
  `prodate` timestamp NULL DEFAULT NULL,
  `proby` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cf_question`
--

DROP TABLE IF EXISTS `cf_question`;
CREATE TABLE IF NOT EXISTS `cf_question` (
  `que_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(5) DEFAULT NULL,
  `qno` int(5) DEFAULT NULL,
  `question` text,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `correctanswer` varchar(255) NOT NULL,
  PRIMARY KEY (`que_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_question`
--

INSERT INTO `cf_question` (`que_id`, `test_id`, `qno`, `question`, `option1`, `option2`, `option3`, `option4`, `correctanswer`) VALUES
(1, 1, 1, 'What is a noun?', 'I dont know', 'I cant say', 'Name of a person, animal, place or thing', 'Please tell me', 'Name of a person, animal, place or thing'),
(2, 1, 2, 'What is a pronoun?', 'Name used instead of noun', 'I cant say', 'Name of a person', 'Please hint me', 'Name used instead of noun'),
(3, 1, 3, 'What is a verb?', 'Name used instead of noun', 'An action word', 'Name of a person', 'I dont know', 'An action word'),
(4, 1, 4, 'What is an adjective?', 'Adjective nani', 'Words used to qualify a noun', 'You tell me', 'I dont know', 'Words used to qualify a noun'),
(5, 1, 5, 'Official language in Nigeria is ______________', 'Spanish', 'French', 'Arabic', 'English', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `cf_results`
--

DROP TABLE IF EXISTS `cf_results`;
CREATE TABLE IF NOT EXISTS `cf_results` (
  `res_id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` varchar(200) NOT NULL,
  `test_id` int(5) DEFAULT NULL,
  `score` int(3) DEFAULT NULL,
  `tqu` int(5) DEFAULT NULL,
  `mark` int(3) DEFAULT NULL,
  `passmark` varchar(10) NOT NULL,
  `display` varchar(10) NOT NULL,
  `repeatable` varchar(5) DEFAULT NULL,
  `testdate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`res_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cf_subjects`
--

DROP TABLE IF EXISTS `cf_subjects`;
CREATE TABLE IF NOT EXISTS `cf_subjects` (
  `sub_id` int(10) NOT NULL AUTO_INCREMENT,
  `subcode` varchar(20) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_subjects`
--

INSERT INTO `cf_subjects` (`sub_id`, `subcode`, `subtitle`, `class`) VALUES
(1, 'ENG-11', 'English Language', 'JSS 1');

-- --------------------------------------------------------

--
-- Table structure for table `cf_test`
--

DROP TABLE IF EXISTS `cf_test`;
CREATE TABLE IF NOT EXISTS `cf_test` (
  `test_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `sub_id` int(5) NOT NULL,
  `class` varchar(100) NOT NULL,
  `questno` varchar(10) NOT NULL,
  `timemi` varchar(10) NOT NULL,
  `enable` varchar(10) NOT NULL,
  `passmark` varchar(10) NOT NULL,
  `userresult` varchar(10) NOT NULL,
  `repeatable` varchar(10) NOT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_test`
--

INSERT INTO `cf_test` (`test_id`, `name`, `sub_id`, `class`, `questno`, `timemi`, `enable`, `passmark`, `userresult`, `repeatable`) VALUES
(1, 'English Exam First Term', 1, 'JSS 1', '5', '2', 'Enabled', '50', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `cf_testattempt`
--

DROP TABLE IF EXISTS `cf_testattempt`;
CREATE TABLE IF NOT EXISTS `cf_testattempt` (
  `atid` int(11) NOT NULL AUTO_INCREMENT,
  `stdid` int(11) DEFAULT NULL,
  `testid` int(11) DEFAULT NULL,
  `quid` int(11) DEFAULT NULL,
  `ans` varchar(255) DEFAULT NULL,
  `correctans` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`atid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cf_timer`
--

DROP TABLE IF EXISTS `cf_timer`;
CREATE TABLE IF NOT EXISTS `cf_timer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` varchar(50) DEFAULT NULL,
  `testid` int(5) DEFAULT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `stop` timestamp NULL DEFAULT NULL,
  `spent` int(5) DEFAULT NULL,
  `spentold` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cf_users`
--

DROP TABLE IF EXISTS `cf_users`;
CREATE TABLE IF NOT EXISTS `cf_users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `level` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `logintime` timestamp NULL DEFAULT NULL,
  `logouttime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cf_users`
--

INSERT INTO `cf_users` (`user_id`, `fullname`, `username`, `password`, `level`, `gender`, `photo`, `status`, `logintime`, `logouttime`) VALUES
(1, 'Sample User', 'fcn001', '2b351906cf0a43c36c8dda1031168f14', 'JSS 1', 'Male', 'usrimg/sample.jpg', 'OFFLINE', '2024-03-08 15:30:29', '2024-03-08 15:32:27');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
