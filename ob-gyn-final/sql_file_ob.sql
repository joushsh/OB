SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- ----------------------------------
-- ----------------------------------
-- ADMIN TABLE
-- ----------------------------------
-- ----------------------------------

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO `admin` (`admin_email`, `admin_password`) VALUES
('admin@gmail.com', '12345678');

-- ----------------------------------
-- ----------------------------------
-- APPOINTMENT TABLE
-- ----------------------------------
-- ----------------------------------

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) DEFAULT NULL,
  `appointment_num` int(3) DEFAULT NULL,
  `schedule_id` int(10) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  PRIMARY KEY (`appointment_id`),
  KEY `patient_id` (`patient_id`),
  KEY `schedule_id` (`schedule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `appointment` (`appointment_id`, `patient_id`, `appointment_num`, `schedule_id`, `appointment_date`) VALUES
(1, 1, 1, 1, '2022-06-03');

-- ----------------------------------
-- ----------------------------------
-- SECRETARY TABLE
-- ----------------------------------
-- ----------------------------------

DROP TABLE IF EXISTS `secretary`;
CREATE TABLE IF NOT EXISTS `secretary` (
  `secretary_id` int(11) NOT NULL AUTO_INCREMENT,
  `secretary_email` varchar(255) DEFAULT NULL,
  `secretary_name` varchar(255) DEFAULT NULL,
  `secretary_password` varchar(255) DEFAULT NULL,
  `secretary_tel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`secretary_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `secretary` (`secretary_id`, `secretary_email`, `secretary_name`, `secretary_password`, `secretary_tel`) VALUES
(1, 'secretary@gmail.com', 'Secretary', '12345678', '09123456789');

-- ----------------------------------
-- ----------------------------------
-- PATIENT TABLE
-- ----------------------------------
-- ----------------------------------

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_email`varchar(255) DEFAULT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `patient_password` varchar(255) DEFAULT NULL,
  `patient_address` varchar(255) DEFAULT NULL,
  `patient_dateofbirth` date DEFAULT NULL,
  `patient_tel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `patient` (`patient_id`, `patient_email`, `patient_name`, `patient_password`, `patient_address`, `patient_dateofbirth`, `patient_tel`) VALUES
(1, 'patient@gmail.com', 'Dummy Patient', '123', 'sa may kanto', '2001-01-01', '09123456789'),
(2, 'bibat@gmail.com', 'Vince Bibat', '123', 'Cordon', '2002-02-02', '09123456789');

-- ----------------------------------
-- ----------------------------------
-- SCHEDULE TABLE
-- ----------------------------------
-- ----------------------------------

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `secretary_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `schedule_time` time DEFAULT NULL,
  `number_of_patients` int(4) DEFAULT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `secretary_id` (`secretary_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `schedule` (`schedule_id`, `secretary_id`, `title`, `schedule_date`, `schedule_time`, `number_of_patients`) VALUES
(1, '1', 'Test Session', '2025-12-25', '20:00:00', 10),
(2, '1', '2nd Test Session', '2023-02-25', '20:00:00', 5);

-- ----------------------------------
-- ----------------------------------
-- USER TABLE
-- ----------------------------------
-- ----------------------------------

DROP TABLE IF EXISTS `webuser`;
CREATE TABLE IF NOT EXISTS `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@gmail.com', 'a'),
('secretary@gmail.com', 's'),
('patient@gmail.com', 'p'),
('bibat@gmail.com', 'p');
COMMIT;
