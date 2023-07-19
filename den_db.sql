-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 19, 2023 at 02:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `den_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `receptionist_id` int(11) NOT NULL,
  `dentist_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `date`, `time`, `receptionist_id`, `dentist_id`, `patient_id`) VALUES
(21, '2023-06-30', '12:00:00', 1, 1, 1),
(24, '2023-07-28', '09:00:00', 2, 15, 5),
(27, '2023-10-26', '08:00:00', 1, 16, 6);

-- --------------------------------------------------------

--
-- Table structure for table `dentists`
--

CREATE TABLE `dentists` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `age` varchar(25) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `occupation` varchar(25) NOT NULL,
  `profile_img` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dentists`
--

INSERT INTO `dentists` (`id`, `name`, `surname`, `age`, `gender`, `email`, `phone`, `occupation`, `profile_img`) VALUES
(1, 'Johan', 'Doe', '38', 'Male', 'john@gmail.com', '0729537072', 'Orthodontist', '4.jpg'),
(15, 'Tristan', 'Storm', '35', 'Male', 'Tristanstorm65@gmail.com', '0729537072', 'Orthodontist', '5.jpg'),
(16, 'Lucy', 'Wits', '29', 'Female', 'lucy@gmail.com', '012 675 3456', 'Cosmetics', '6.jpg'),
(18, 'Sakkie', 'Storm', '50', 'Male', 'leon@trizo.co.za', '537463728', 'Cosmetcs', '10.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `age` varchar(25) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `medical_aid_number` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `profile_img` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `surname`, `age`, `gender`, `medical_aid_number`, `email`, `profile_img`) VALUES
(1, 'Josh', 'Daniels', '36', 'Male', '878656', 'josh@gmail.com', '5.jpg'),
(5, 'Sam', 'Snyders', '25', 'Female', '275475', 'sam@gmail.com', '8.jpg'),
(6, 'Willie', 'van Rooyen', '51', 'Male', '239560', 'willie@gmail.com', '9.jpg'),
(7, 'Wesley', 'Cousins', '60', 'Male', '564738', 'weslry@gmail.com', '12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `receptionists`
--

CREATE TABLE `receptionists` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `rank` varchar(25) NOT NULL,
  `age` varchar(25) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `profile_img` varchar(25) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receptionists`
--

INSERT INTO `receptionists` (`id`, `name`, `surname`, `rank`, `age`, `gender`, `phone_number`, `email`, `password`, `profile_img`, `role`) VALUES
(1, 'Megan', 'Fredricks', '1', '25', 'Female', '012 953 6785', 'mfredricks@gmail.com', '123', '3.jpg', 'Head Receptionist'),
(2, 'Josh', 'Van der Walt', '2', '23', 'Male', '072 953 7072', 'jvdwalt@gmail.com', '123', '1.jpg', 'Receptionist'),
(3, 'Wian', 'Jansen', '3', '27', 'Male', '076 456 7432', 'wjansen@gmail.com', '123', '2.jpg', 'Receptionist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dentist_id` (`dentist_id`),
  ADD UNIQUE KEY `patient_id` (`patient_id`),
  ADD UNIQUE KEY `unique_appointment` (`dentist_id`,`patient_id`,`date`,`time`);

--
-- Indexes for table `dentists`
--
ALTER TABLE `dentists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `dentists`
--
ALTER TABLE `dentists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `receptionists`
--
ALTER TABLE `receptionists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`dentist_id`) REFERENCES `dentists` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
