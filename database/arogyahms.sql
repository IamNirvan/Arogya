-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2023 at 12:40 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arogyahms`
--

-- --------------------------------------------------------

--
-- Table structure for table `allergies`
--

CREATE TABLE `allergies` (
  `allergyID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `patientID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentID` int(10) NOT NULL,
  `bookedDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `description` varchar(255) NOT NULL,
  `patientID` int(10) NOT NULL,
  `employeeID` int(10) NOT NULL,
  `appointmentStatus` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentID`, `bookedDate`, `startTime`, `endTime`, `description`, `patientID`, `employeeID`, `appointmentStatus`) VALUES
(9, '0000-00-00', '13:51:05', '14:51:05', 'I might have asthma', 2, 9, 'closed'),
(10, '2022-12-06', '20:49:38', '21:49:38', 'examination', 2, 8, 'open'),
(11, '2022-12-20', '16:44:27', '16:59:27', 'Small checkup', 2, 10, 'open'),
(34, '2022-12-02', '16:10:00', '17:10:00', 'Testing', 2, 8, 'open'),
(36, '2022-12-08', '17:10:00', '18:10:00', 'Check up', 2, 9, 'open'),
(37, '2022-12-08', '17:10:00', '18:10:00', 'Check up', 2, 9, 'open'),
(38, '2022-12-08', '17:10:00', '18:10:00', 'Check up', 2, 9, 'open'),
(39, '2022-12-12', '18:15:00', '18:30:00', 'sksnckjdns', 2, 8, 'open'),
(40, '2022-12-29', '18:57:00', '19:57:00', 'Check up', 2, 8, 'open'),
(41, '2022-12-27', '16:08:00', '18:08:00', 'mlkmvlkdmkfv', 2, 8, 'open'),
(42, '2022-12-28', '18:13:00', '19:13:00', 'Asthma', 2, 8, 'open'),
(43, '2022-12-31', '19:11:00', '22:11:00', 'vdkfnvjkdf', 2, 8, 'open'),
(44, '2023-01-01', '20:15:00', '22:15:00', 'jscnkjsnd', 2, 8, 'open'),
(45, '2023-01-18', '13:51:05', '16:59:27', 'Asthma', 3, 9, 'open'),
(46, '2023-01-18', '14:40:19', '16:59:27', 'csdcsdcsc', 8, 9, 'open'),
(47, '2023-01-18', '20:49:38', '21:49:38', 'csdcsdcsdc', 12, 8, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) NOT NULL,
  `contactNumber` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `specialization` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `firstName`, `middleName`, `lastName`, `contactNumber`, `gender`, `specialization`) VALUES
(8, 'Jason', NULL, 'Pastrana', '0712253645', 'male', 'Oncologist'),
(9, 'Janice', NULL, 'McRaven', '0711253646', 'female', 'Neurosurgeon'),
(10, 'Colt', NULL, 'McHalister', '0766256356', 'male', 'receptionist');

-- --------------------------------------------------------

--
-- Table structure for table `employeeaccount`
--

CREATE TABLE `employeeaccount` (
  `employeeAccountID` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accountType` varchar(50) NOT NULL,
  `employeeID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employeeaccount`
--

INSERT INTO `employeeaccount` (`employeeAccountID`, `username`, `password`, `accountType`, `employeeID`) VALUES
(4, 'batman', 'batman123', 'administrator', 8),
(5, 'joker', 'joker123', 'doctor', 9),
(6, 'TheGreatColt', 'colt123', 'receptionist', 10);

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `examinationID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `examinationDate` date NOT NULL,
  `outcome` varchar(50) NOT NULL,
  `patientID` int(10) NOT NULL,
  `appointmentID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `immunizations`
--

CREATE TABLE `immunizations` (
  `immunizationID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `immunizationDate` date NOT NULL,
  `patientID` int(10) NOT NULL,
  `appointmentID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `operatingroom`
--

CREATE TABLE `operatingroom` (
  `operatingRoomID` int(10) NOT NULL,
  `roomNumber` int(10) NOT NULL,
  `dailyCost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `operatingroomschedule`
--

CREATE TABLE `operatingroomschedule` (
  `operatingRoomScheduleID` int(10) NOT NULL,
  `bookedDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `patientID` int(10) NOT NULL,
  `employeeID` int(10) NOT NULL,
  `operatingRoomID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientID` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contactNumber` varchar(10) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `patientNIC` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `firstName`, `middleName`, `lastName`, `gender`, `contactNumber`, `nationality`, `address`, `patientNIC`) VALUES
(2, 'Sammy', '', 'Witwicky', 'male', '0746567467', 'Sri Lankan', 'cdcnskdjcnsdc', '99283746578v'),
(3, 'Suranga', '', 'Silva', 'male', '8827766457', 'Sri Lankan', 'jfvndksfnvkdsnjn', '88273647567v'),
(4, 'Micheal', '', 'Bower', 'male', '0725536456', 'American', 'scnksjdnckjsd', '99283746578v'),
(7, 'Marshall', 'Flemming', 'McRaven', 'male', '0725536456', 'American', '&lt;script&gt;alert(&quot;AHHHH&quot;)&lt;/script&gt;', '17676763545v'),
(8, 'John', '', 'Wick', 'male', '0712234536', 'Canadian', 'Torronto', '88735466746v'),
(9, 'nksndkjcnskdj', 'sdncskjdnckjsn', 'jnkdjsncksjdnck', 'male', '0987654321', 'dskjncskjdnck', 'sdcsdcsdcs', 'hhhhhhhhhhhh'),
(10, 'dfvnkdsfnvkdjfn', 'snslkdclksdmclksdm', 'knkcsdnckjsdnckjn', 'female', '0987878656', 'dkfjnvdksjfnv', 'lkdsmclksdmclksmd', '123456789012'),
(11, 'Jason', 'cs', 'Stormy', 'male', '0987223457', 'sdclsdcmlkmklm', 'sjkdcnkjsdnc', 'hhhhhhddgfty'),
(12, 'Stormy', 'sdmcklms', 'Daniels', 'female', '9876354678', 'mdclksmdcms', 'mlkmsdkl', 'jjdhbfghrtyu'),
(13, 'Stormy', 'sdmcslkdm', 'Daniels', 'female', '9987622534', 'skjdnckjsdncj', 'kmlksdmklc', 'jjhgfbvghcgt'),
(14, 'cjsdncjndjks', 'ksjdnkcsjdnk', 'vndkjnvkdfn', 'male', '8736476657', 'ksdjncksndcn', 'nknknk', 'ggdvvbcnmfhg');

-- --------------------------------------------------------

--
-- Table structure for table `patientaccount`
--

CREATE TABLE `patientaccount` (
  `patientAccountID` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `patientID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patientaccount`
--

INSERT INTO `patientaccount` (`patientAccountID`, `username`, `password`, `patientID`) VALUES
(1, 'bigDaddy', 'bigDaddy123', 2),
(2, 'superman', 'superman123', 3),
(4, 'MarshallTheGreat', 'Marshall123', 7),
(5, 'TheGreatJohn', 'john123456', 8),
(6, 'sdcksdncksjnk', 'kjcnsdkcjnskdjcnk', 8),
(7, 'csdkjcnskdcnn', 'kjncksdjncksjdncksj', 10),
(8, 'Jackie', 'JackieStormy123', 7),
(11, 'dkfnvkdfnv', 'kndkfvndkfnvkjdnf', 14);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(10) NOT NULL,
  `roomNumber` varchar(10) NOT NULL,
  `roomTypeID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomNumber`, `roomTypeID`) VALUES
(1, '112', 1),
(2, '101', 2),
(3, '102', 2);

-- --------------------------------------------------------

--
-- Table structure for table `roomoccupancy`
--

CREATE TABLE `roomoccupancy` (
  `occupancyID` int(10) NOT NULL,
  `startDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endDate` date NOT NULL,
  `endTime` time NOT NULL,
  `roomID` int(10) NOT NULL,
  `patientID` int(10) NOT NULL,
  `occupancyStatus` varchar(8) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roomoccupancy`
--

INSERT INTO `roomoccupancy` (`occupancyID`, `startDate`, `startTime`, `endDate`, `endTime`, `roomID`, `patientID`, `occupancyStatus`) VALUES
(1, '2023-01-18', '14:40:19', '2023-01-19', '15:40:19', 2, 3, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `roomTypeID` int(10) NOT NULL,
  `typeName` varchar(50) NOT NULL,
  `dailyCost` decimal(10,2) NOT NULL,
  `maxOccupants` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`roomTypeID`, `typeName`, `dailyCost`, `maxOccupants`) VALUES
(1, 'Double', '2000.00', 2),
(2, 'Tripple', '1500.00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `surgeries`
--

CREATE TABLE `surgeries` (
  `surgeryID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surgeryDate` date NOT NULL,
  `outcome` varchar(50) NOT NULL,
  `patientID` int(10) NOT NULL,
  `appointmentID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergies`
--
ALTER TABLE `allergies`
  ADD PRIMARY KEY (`allergyID`),
  ADD KEY `patientIDFK6` (`patientID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentID`),
  ADD KEY `employeeIDFK3` (`employeeID`),
  ADD KEY `patientIDFK4` (`patientID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`),
  ADD UNIQUE KEY `contactNumber` (`contactNumber`);

--
-- Indexes for table `employeeaccount`
--
ALTER TABLE `employeeaccount`
  ADD PRIMARY KEY (`employeeAccountID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `employeeIDFK1` (`employeeID`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`examinationID`),
  ADD KEY `appointmentIDFK3` (`appointmentID`),
  ADD KEY `patientIDFK8` (`patientID`);

--
-- Indexes for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD PRIMARY KEY (`immunizationID`),
  ADD KEY `appointmentIDFK2` (`appointmentID`),
  ADD KEY `patientIDFK7` (`patientID`);

--
-- Indexes for table `operatingroom`
--
ALTER TABLE `operatingroom`
  ADD PRIMARY KEY (`operatingRoomID`),
  ADD UNIQUE KEY `roomNumber` (`roomNumber`);

--
-- Indexes for table `operatingroomschedule`
--
ALTER TABLE `operatingroomschedule`
  ADD PRIMARY KEY (`operatingRoomScheduleID`),
  ADD KEY `employeeIDFK2` (`employeeID`),
  ADD KEY `patientIDFK2` (`patientID`),
  ADD KEY `operatingRoomIDFK1` (`operatingRoomID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientID`),
  ADD UNIQUE KEY `contactNumber` (`contactNumber`,`patientNIC`);

--
-- Indexes for table `patientaccount`
--
ALTER TABLE `patientaccount`
  ADD PRIMARY KEY (`patientAccountID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `patientIDFK1` (`patientID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`),
  ADD UNIQUE KEY `roomNumber` (`roomNumber`),
  ADD KEY `roomTypeIDFK1` (`roomTypeID`);

--
-- Indexes for table `roomoccupancy`
--
ALTER TABLE `roomoccupancy`
  ADD PRIMARY KEY (`occupancyID`),
  ADD KEY `roomIDFK1` (`roomID`),
  ADD KEY `patientIDFK3` (`patientID`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`roomTypeID`),
  ADD UNIQUE KEY `typeName` (`typeName`);

--
-- Indexes for table `surgeries`
--
ALTER TABLE `surgeries`
  ADD PRIMARY KEY (`surgeryID`),
  ADD KEY `appointmentIDFK1` (`appointmentID`),
  ADD KEY `patientIDFK5` (`patientID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergies`
--
ALTER TABLE `allergies`
  MODIFY `allergyID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employeeaccount`
--
ALTER TABLE `employeeaccount`
  MODIFY `employeeAccountID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `examinationID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `immunizations`
--
ALTER TABLE `immunizations`
  MODIFY `immunizationID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operatingroom`
--
ALTER TABLE `operatingroom`
  MODIFY `operatingRoomID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `operatingroomschedule`
--
ALTER TABLE `operatingroomschedule`
  MODIFY `operatingRoomScheduleID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patientaccount`
--
ALTER TABLE `patientaccount`
  MODIFY `patientAccountID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roomoccupancy`
--
ALTER TABLE `roomoccupancy`
  MODIFY `occupancyID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `roomTypeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surgeries`
--
ALTER TABLE `surgeries`
  MODIFY `surgeryID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allergies`
--
ALTER TABLE `allergies`
  ADD CONSTRAINT `patientIDFK6` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `employeeIDFK3` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`),
  ADD CONSTRAINT `patientIDFK4` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

--
-- Constraints for table `employeeaccount`
--
ALTER TABLE `employeeaccount`
  ADD CONSTRAINT `employeeIDFK1` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`);

--
-- Constraints for table `examinations`
--
ALTER TABLE `examinations`
  ADD CONSTRAINT `appointmentIDFK3` FOREIGN KEY (`appointmentID`) REFERENCES `appointment` (`appointmentID`),
  ADD CONSTRAINT `patientIDFK8` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

--
-- Constraints for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD CONSTRAINT `appointmentIDFK2` FOREIGN KEY (`appointmentID`) REFERENCES `appointment` (`appointmentID`),
  ADD CONSTRAINT `patientIDFK7` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

--
-- Constraints for table `operatingroomschedule`
--
ALTER TABLE `operatingroomschedule`
  ADD CONSTRAINT `employeeIDFK2` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`),
  ADD CONSTRAINT `operatingRoomIDFK1` FOREIGN KEY (`operatingRoomID`) REFERENCES `operatingroom` (`operatingRoomID`),
  ADD CONSTRAINT `patientIDFK2` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

--
-- Constraints for table `patientaccount`
--
ALTER TABLE `patientaccount`
  ADD CONSTRAINT `patientIDFK1` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `roomTypeIDFK1` FOREIGN KEY (`roomTypeID`) REFERENCES `roomtype` (`roomTypeID`);

--
-- Constraints for table `roomoccupancy`
--
ALTER TABLE `roomoccupancy`
  ADD CONSTRAINT `patientIDFK3` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`),
  ADD CONSTRAINT `roomIDFK1` FOREIGN KEY (`roomID`) REFERENCES `room` (`roomID`);

--
-- Constraints for table `surgeries`
--
ALTER TABLE `surgeries`
  ADD CONSTRAINT `appointmentIDFK1` FOREIGN KEY (`appointmentID`) REFERENCES `appointment` (`appointmentID`),
  ADD CONSTRAINT `patientIDFK5` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
