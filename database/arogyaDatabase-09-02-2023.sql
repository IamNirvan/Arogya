-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2023 at 05:08 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allergies`
--

INSERT INTO `allergies` (`allergyID`, `name`, `patientID`) VALUES
(3, 'Peanuts', 2),
(4, 'Eggs', 2),
(5, 'Milk', 2),
(7, 'Crustaceans', 2),
(10, 'Pollen', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentID`, `bookedDate`, `startTime`, `endTime`, `description`, `patientID`, `employeeID`, `appointmentStatus`) VALUES
(11, '2022-12-20', '16:44:27', '16:59:27', 'Small checkup', 2, 11, 'open'),
(34, '2022-12-02', '16:10:00', '17:10:00', 'Testing', 2, 8, 'open'),
(36, '2022-12-08', '17:10:00', '18:10:00', 'Check up', 2, 9, 'close'),
(37, '2022-12-08', '17:10:00', '18:10:00', 'Check up', 2, 9, 'open'),
(38, '2022-12-08', '17:10:00', '18:10:00', 'Check up', 2, 9, 'close'),
(40, '2022-12-29', '18:57:00', '19:57:00', 'Check up', 2, 8, 'close'),
(42, '2022-12-28', '18:13:00', '19:13:00', 'Asthma', 2, 8, 'close'),
(45, '2023-01-18', '13:51:05', '16:59:27', 'Asthma', 3, 9, 'open'),
(50, '2023-02-10', '07:43:00', '09:43:00', 'Check up', 3, 8, 'open'),
(51, '2023-02-11', '12:00:00', '12:45:00', 'Regular checkup', 3, 14, 'close'),
(52, '2023-02-09', '09:45:00', '10:30:00', 'Regular checkup', 2, 9, 'open');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `firstName`, `middleName`, `lastName`, `contactNumber`, `gender`, `specialization`) VALUES
(8, 'Jason', NULL, 'Pastrana', '0712253645', 'male', 'Oncologist'),
(9, 'Janice', NULL, 'McRaven', '0711253646', 'female', 'Neurosurgeon'),
(10, 'Colt', NULL, 'McHalister', '0766256356', 'male', 'receptionist'),
(11, 'Jackie', 'Colonel', 'Sanders', '0986653546', 'female', 'Gynecologist'),
(12, 'Jacob', '', 'Pastrana', '9987653456', 'male', 'Radiologist'),
(13, 'Samuel', '', 'Butterfingers', '6653789098', 'male', 'receptionist'),
(14, 'Marshal', '', 'Mathers', '0887635467', 'male', 'Psychiatrist'),
(15, 'Ben', '', 'Mathews', '0876676354', 'male', 'receptionist'),
(16, 'Dave', '', 'McHalister', '0711234536', 'male', 'Radiologist'),
(17, 'Olivia', '', 'Cassidy', '0776525344', 'female', 'receptionist');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeeaccount`
--

INSERT INTO `employeeaccount` (`employeeAccountID`, `username`, `password`, `accountType`, `employeeID`) VALUES
(4, 'batman', 'batman123', 'administrator', 8),
(5, 'joker', 'joker123', 'doctor', 9),
(6, 'TheGreatColt', 'colt123', 'receptionist', 10),
(7, 'Jackie', 'Jacki123', 'doctor', 11),
(8, 'BillyTheKid', 'Billy123', 'doctor', 12),
(9, 'Sam', 'Sam123456', 'receptionist', 13),
(10, 'Marshal', 'marshal12345', 'doctor', 14),
(11, 'Benzino', 'Ben12345', 'receptionist', 15),
(12, 'Davie', 'Davis123', 'doctor', 16),
(13, 'Pogo', 'Pogo123456', 'receptionist', 17);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examinations`
--

INSERT INTO `examinations` (`examinationID`, `name`, `examinationDate`, `outcome`, `patientID`, `appointmentID`) VALUES
(3, 'kidney function test', '2022-12-08', 'Nothing of concern', 2, 38),
(4, 'gastric fluid analysis', '2022-12-29', 'Nothing of concern', 2, 40);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immunizations`
--

INSERT INTO `immunizations` (`immunizationID`, `name`, `immunizationDate`, `patientID`, `appointmentID`) VALUES
(6, 'Hepatitis B.', '2022-12-20', 2, 11),
(7, 'Hepatitis A.', '2022-12-28', 2, 42);

-- --------------------------------------------------------

--
-- Table structure for table `operatingroom`
--

CREATE TABLE `operatingroom` (
  `operatingRoomID` int(10) NOT NULL,
  `roomNumber` int(10) NOT NULL,
  `dailyCost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operatingroom`
--

INSERT INTO `operatingroom` (`operatingRoomID`, `roomNumber`, `dailyCost`) VALUES
(4, 201, '50000.00'),
(5, 202, '50000.00'),
(6, 203, '50000.00'),
(7, 204, '50000.00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operatingroomschedule`
--

INSERT INTO `operatingroomschedule` (`operatingRoomScheduleID`, `bookedDate`, `startTime`, `endTime`, `patientID`, `employeeID`, `operatingRoomID`) VALUES
(6, '2023-02-07', '02:48:00', '05:48:00', 2, 9, 5),
(7, '2023-02-10', '15:00:00', '18:00:00', 3, 9, 4),
(8, '2023-02-20', '09:00:00', '12:00:00', 4, 9, 5);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `firstName`, `middleName`, `lastName`, `gender`, `contactNumber`, `nationality`, `address`, `patientNIC`) VALUES
(2, 'Jason', '', 'Wyatt', 'male', '0746567467', 'Sri Lankan', '18 Gregorys Road, Colombo 00700', '942281632v'),
(3, 'Suranga', '', 'Silva', 'male', '8827766457', 'Sri Lankan', 'Acquest (Pvt) Ltd, Level 16, Access Tower II, 278 Union Pl, Colombo 00200', '88273647567v'),
(4, 'Micheal', '', 'Bower', 'male', '0725536456', 'American', '24 Staple St, Colombo 00200', '99283746578v'),
(15, 'John', '', 'Wick', 'male', '0998876635', 'Sri Lankan', 'WR5X+XQH, 19th Ln, Colombo 00300', '88878764563v');

-- --------------------------------------------------------

--
-- Table structure for table `patientaccount`
--

CREATE TABLE `patientaccount` (
  `patientAccountID` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `patientID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientaccount`
--

INSERT INTO `patientaccount` (`patientAccountID`, `username`, `password`, `patientID`) VALUES
(1, 'google_was_my_idea', 'bigDaddy123', 2),
(2, 'superman', 'superman123', 3),
(12, 'averagestudent', 'john12345', 15);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(10) NOT NULL,
  `roomNumber` varchar(10) NOT NULL,
  `roomTypeID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomoccupancy`
--

INSERT INTO `roomoccupancy` (`occupancyID`, `startDate`, `startTime`, `endDate`, `endTime`, `roomID`, `patientID`, `occupancyStatus`) VALUES
(8, '2023-02-15', '18:00:00', '2023-02-18', '21:00:00', 3, 2, 'active'),
(9, '2023-02-10', '09:00:00', '2023-02-15', '12:00:00', 2, 4, 'active'),
(10, '2023-02-10', '06:00:00', '2023-02-20', '06:00:00', 1, 15, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `roomTypeID` int(10) NOT NULL,
  `typeName` varchar(50) NOT NULL,
  `dailyCost` decimal(10,2) NOT NULL,
  `maxOccupants` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`roomTypeID`, `typeName`, `dailyCost`, `maxOccupants`) VALUES
(1, 'Deluxe', '8000.00', 2),
(2, 'Royal Suite', '50000.00', 3),
(3, 'Orchid', '20000.00', 1),
(4, 'Premium', '12000.00', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surgeries`
--

INSERT INTO `surgeries` (`surgeryID`, `name`, `surgeryDate`, `outcome`, `patientID`, `appointmentID`) VALUES
(1, 'Appendectomy', '2022-12-08', 'Successful', 2, 36),
(2, 'Cataract surgery', '2022-12-02', 'Successful', 2, 34),
(3, 'Carotid endarterectomy', '2022-12-08', 'Successful', 2, 37);

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
  MODIFY `allergyID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `employeeaccount`
--
ALTER TABLE `employeeaccount`
  MODIFY `employeeAccountID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `examinationID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `immunizations`
--
ALTER TABLE `immunizations`
  MODIFY `immunizationID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `operatingroom`
--
ALTER TABLE `operatingroom`
  MODIFY `operatingRoomID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `operatingroomschedule`
--
ALTER TABLE `operatingroomschedule`
  MODIFY `operatingRoomScheduleID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patientaccount`
--
ALTER TABLE `patientaccount`
  MODIFY `patientAccountID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roomoccupancy`
--
ALTER TABLE `roomoccupancy`
  MODIFY `occupancyID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `roomTypeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surgeries`
--
ALTER TABLE `surgeries`
  MODIFY `surgeryID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allergies`
--
ALTER TABLE `allergies`
  ADD CONSTRAINT `patientIDFK6` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE;

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `employeeIDFK3` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`),
  ADD CONSTRAINT `patientIDFK4` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE;

--
-- Constraints for table `employeeaccount`
--
ALTER TABLE `employeeaccount`
  ADD CONSTRAINT `employeeIDFK1` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`);

--
-- Constraints for table `examinations`
--
ALTER TABLE `examinations`
  ADD CONSTRAINT `appointmentIDFK3` FOREIGN KEY (`appointmentID`) REFERENCES `appointment` (`appointmentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `patientIDFK8` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE;

--
-- Constraints for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD CONSTRAINT `appointmentIDFK2` FOREIGN KEY (`appointmentID`) REFERENCES `appointment` (`appointmentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `patientIDFK7` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE;

--
-- Constraints for table `operatingroomschedule`
--
ALTER TABLE `operatingroomschedule`
  ADD CONSTRAINT `employeeIDFK2` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `operatingRoomIDFK1` FOREIGN KEY (`operatingRoomID`) REFERENCES `operatingroom` (`operatingRoomID`) ON DELETE CASCADE,
  ADD CONSTRAINT `patientIDFK2` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE;

--
-- Constraints for table `patientaccount`
--
ALTER TABLE `patientaccount`
  ADD CONSTRAINT `patientIDFK1` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `roomTypeIDFK1` FOREIGN KEY (`roomTypeID`) REFERENCES `roomtype` (`roomTypeID`);

--
-- Constraints for table `roomoccupancy`
--
ALTER TABLE `roomoccupancy`
  ADD CONSTRAINT `patientIDFK3` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE,
  ADD CONSTRAINT `roomIDFK1` FOREIGN KEY (`roomID`) REFERENCES `room` (`roomID`) ON DELETE CASCADE;

--
-- Constraints for table `surgeries`
--
ALTER TABLE `surgeries`
  ADD CONSTRAINT `appointmentIDFK1` FOREIGN KEY (`appointmentID`) REFERENCES `appointment` (`appointmentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `patientIDFK5` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
