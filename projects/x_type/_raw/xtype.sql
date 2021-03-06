-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2018 at 07:04 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xtype`
--

-- --------------------------------------------------------

--
-- Table structure for table `scoreboard`
--

CREATE TABLE `scoreboard` (
  `sb_id` int(11) NOT NULL,
  `sb_user_name` varchar(100) NOT NULL,
  `sb_test_time` int(11) NOT NULL,
  `sb_errors` int(11) NOT NULL,
  `sb_char_typed` int(11) NOT NULL,
  `sb_gwpm` int(11) NOT NULL,
  `sb_nwpm` int(11) NOT NULL,
  `sb_accuracy` int(11) NOT NULL,
  `sb_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scoreboard`
--

INSERT INTO `scoreboard` (`sb_id`, `sb_user_name`, `sb_test_time`, `sb_errors`, `sb_char_typed`, `sb_gwpm`, `sb_nwpm`, `sb_accuracy`, `sb_date_time`) VALUES
(1, 'a', 1, 3, 435, 45, 45, 43, '0000-00-00 00:00:00'),
(2, 'a@gmail.com', 1, 0, 5, 20, 20, 100, '0000-00-00 00:00:00'),
(10, 'rakesh', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_role` varchar(100) NOT NULL,
  `user_f_name` varchar(100) NOT NULL,
  `user_l_name` varchar(100) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `user_phone` varchar(100) NOT NULL,
  `user_doj` date NOT NULL,
  `user_gender` varchar(100) NOT NULL,
  `user_highest_wpm` int(100) NOT NULL,
  `user_total_char_typed` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_role`, `user_f_name`, `user_l_name`, `user_image`, `user_phone`, `user_doj`, `user_gender`, `user_highest_wpm`, `user_total_char_typed`) VALUES
(1, 'rakko', 'a@gmail.com', 'a', 'admin', 'Rakesh', 'Kumar', 'plane.png', '67890', '0000-00-00', 'male', 0, 0),
(2, 'nadir', 'b@gmail.com', 'b', 'employee', 'Nadir', 'sangrar', 'b.jpg', '7411134887', '0000-00-00', 'male', 0, 0),
(3, 'nagraj', 'c@gmail.com', 'c', 'student', 'Nagraj', 'singh', 'c.jpg', '1234567890', '0000-00-00', 'male', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scoreboard`
--
ALTER TABLE `scoreboard`
  ADD PRIMARY KEY (`sb_id`),
  ADD UNIQUE KEY `typing_user_name` (`sb_user_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scoreboard`
--
ALTER TABLE `scoreboard`
  MODIFY `sb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
