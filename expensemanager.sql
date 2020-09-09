-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2020 at 11:16 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expensemanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(120) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `no_of_people` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`b_id`, `b_name`, `start_date`, `end_date`, `amount`, `no_of_people`, `user_id`) VALUES
(21, 'Hope', '2020-09-10', '2020-09-18', 1000, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `e_id` int(11) NOT NULL,
  `e_name` varchar(120) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `dateed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`e_id`, `e_name`, `b_id`, `user_id`, `amount`, `dateed`) VALUES
(52, 'First expense', 21, 8, 100, '2020-09-20'),
(53, 'First expense', 21, 8, 800, '2020-09-20'),
(54, 'First expense', 21, 8, 200, '2020-09-20'),
(55, 'hello', 21, 7, 50, '2020-09-17'),
(56, '1', 21, 8, 0, '2020-09-12');

-- --------------------------------------------------------

--
-- Table structure for table `remaining`
--

CREATE TABLE `remaining` (
  `r_id` int(11) NOT NULL,
  `b_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `rem_amt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `remaining`
--

INSERT INTO `remaining` (`r_id`, `b_id`, `amount`, `rem_amt`) VALUES
(6, 21, 1000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `s_id` int(11) NOT NULL,
  `b_id` int(11) DEFAULT NULL,
  `p_name` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shares`
--

INSERT INTO `shares` (`s_id`, `b_id`, `p_name`) VALUES
(41, 21, 'suraj'),
(42, 21, 'kriti');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `NAME` varchar(120) NOT NULL,
  `EMAIL` varchar(120) NOT NULL,
  `PASSWORD` varchar(120) NOT NULL,
  `PHONE` int(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `NAME`, `EMAIL`, `PASSWORD`, `PHONE`) VALUES
(6, 'Avineet ', 'avineet@gmail.com', '123', 797979797),
(7, 'suraj', 'suraj@gmail.com', '1234', 2147483647),
(8, 'kriti', 'k@gmail.com', '12345', 93492932);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `b_id` (`b_id`);

--
-- Indexes for table `remaining`
--
ALTER TABLE `remaining`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `p_name` (`p_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD KEY `EMAIL` (`EMAIL`),
  ADD KEY `NAME` (`NAME`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `remaining`
--
ALTER TABLE `remaining`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`USER_ID`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `budget` (`b_id`) ON DELETE CASCADE;

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `shares_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `budget` (`b_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shares_ibfk_2` FOREIGN KEY (`p_name`) REFERENCES `users` (`NAME`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
