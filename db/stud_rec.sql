-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 04:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stud_rec`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `midName` text NOT NULL,
  `surname` text NOT NULL,
  `gender` text NOT NULL,
  `birthdate` date NOT NULL,
  `compAddress` text NOT NULL,
  `motherName` varchar(255) NOT NULL,
  `motherOccupation` varchar(255) NOT NULL,
  `fatherName` varchar(255) NOT NULL,
  `fatherOccupation` varchar(255) NOT NULL,
  `guardianName` varchar(255) NOT NULL,
  `guardianPhone` text NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `firstName`, `midName`, `surname`, `gender`, `birthdate`, `compAddress`, `motherName`, `motherOccupation`, `fatherName`, `fatherOccupation`, `guardianName`, `guardianPhone`, `remarks`) VALUES
(1, 'Ryniel', 'Mark', 'Lovino', 'Male', '2024-05-08', 'Blk53 Lot12 Bella vista subdivision', 'Asd', 'Asd', 'Asda', 'Adas', 'Aasda', '09164660950', ''),
(7888, 'Ryniel', 'Mark', 'Lovino', 'Male', '2024-05-22', 'Blk53 Lot12 Bella vista subdivision', 'Rh;asd', 'ASDAS', 'ADASD', 'ASDA', 'ASDAD', '09164660950', ''),
(123123, 'Ed', 'Ere', 'Adsad', 'Male', '2024-05-09', 'Blk53 Lot12 Bella vista subdivision', 'Asdsa', 'Asd', 'Asda', 'Asdas', 'Asda', '09164660950', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `full-name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `full-name`, `username`, `password`, `status`) VALUES
(1, 'ryniel mark lovino 123456', 'rynielmark15', '$2y$10$jvI9etTqdoAP0I1TVdqznOcaCpRo2RoTKOf2YOk4TCNLB2f2j156O', 'unlocked'),
(12345, 'ryniel mark lovino 123456', 'ryniel02', '$2y$10$uOWSHJrHefYmX3/SXPNw6OSO/MyvnxQAZWdXXmaGV9s2cJVA5NG3O', 'blocked'),
(123456, 'ryniel123123', 'rynielmark02', '$2y$10$UFlJqn8EoPcbaF9ZGEdKPuUu4aM.0qjza8Js4x/isEXkdtMrRpf06', 'unlocked'),
(789456, 'ryniel mark lovino', 'rynielmark123', '$2y$10$gAq5YV3yQbmZt0.MKkaUJOq5CXWGtDHPx4GuiX3kCIaTWZBexisrq', 'unlocked'),
(12312312, 'ryniel', 'rynielmark14', '$2y$10$xX7WSD.Z0t4F9', 'blocked'),
(12312313, 'ryniel mark lovino', 'rynielmark02', 'rynielmark123', 'unlocked'),
(12345444, 'Rynielllll', 'rynielmark02', '$2y$10$w.w/0ncpkEklRko5c2NCYOGvHJZGmKYbh3Mq2Y61wuo5JK1.L8XSG', 'unlocked');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12345445;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
