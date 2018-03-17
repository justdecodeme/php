-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2018 at 11:10 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `x_connect_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE IF NOT EXISTS `batch` (
`id` int(11) NOT NULL,
  `batch_code` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_students` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `batch_code`, `start_date`, `end_date`, `name`, `total_students`) VALUES
(1, 'bc180305', '0000-00-00', '0000-00-00', 'Bootcamp', 10),
(2, 'u180325', '2018-03-25', '2018-05-06', 'Unity', 3),
(3, 'gr180325', '2018-03-25', '2018-04-29', 'Graphic Design', 15);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
`id` int(11) NOT NULL,
  `batch_code` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `room_code` varchar(255) NOT NULL,
  `instructor_code` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `batch_code`, `date`, `class_code`, `room_code`, `instructor_code`, `start_time`, `end_time`) VALUES
(1, 'gr180325', '2018-03-25', 'gr1', 'a', 'ins_rakesh', '11:30:00', '13:30:00'),
(2, 'gr180325', '2018-04-01', 'gr2', 'a', 'ins_vinay', '09:00:00', '11:00:00'),
(3, 'gr180325', '2018-04-01', 'gr3', 'a', 'ins_varsha', '11:30:00', '13:30:00'),
(40, 'gr180325', '2018-04-08', 'grp1', 'a', 'ins_vinay', '09:00:00', '11:00:00'),
(41, 'gr180325', '2018-04-08', 'gr4', 'a', 'ins_pallavi', '11:30:00', '13:30:00'),
(42, 'gr180325', '2018-04-15', 'gr6', 'a', 'ins_rakesh', '11:30:00', '13:30:00'),
(43, 'gr180325', '2018-04-15', 'gr5', 'a', 'ins_vinay', '09:00:00', '11:00:00'),
(44, 'gr180325', '2018-04-22', 'grp2', 'a', 'ins_vinay', '09:00:00', '11:00:00'),
(45, 'gr180325', '2018-04-22', 'gr7', 'a', 'ins_rakesh', '11:30:00', '13:30:00'),
(46, 'gr180325', '2018-04-29', 'gr8', 'a', 'ins_vinay', '09:00:00', '11:00:00'),
(68, 'php180325', '2018-03-06', 'php8', 'a', 'ins_vinay', '09:00:00', '11:00:00'),
(70, 'php180325', '2018-03-13', 'phpp2', 'a', 'ins_vinay', '09:00:00', '11:00:00'),
(71, 'php180325', '2018-03-16', 'phpp3', 'a', 'ins_asha', '09:00:00', '11:00:00'),
(72, 'php180325', '2018-03-20', 'phpp4', 'a', 'ins_vinay', '09:00:00', '11:00:00'),
(73, 'php180325', '2018-03-23', 'phpp5', 'a', 'ins_asha', '09:00:00', '11:00:00'),
(74, 'u180325', '2018-03-11', 'up1', 'b', 'ins_varsha', '09:00:00', '11:00:00'),
(75, 'u180325', '2018-03-11', 'ue1', 'b', 'ins_varsha', '11:30:00', '13:30:00'),
(76, 'u180325', '2018-03-25', 'u1', 'b', 'ins_varsha', '09:00:00', '11:00:00'),
(77, 'u180325', '2018-03-25', 'ur1', 'b', 'ins_varsha', '11:30:00', '13:30:00'),
(96, 'bc180305a', '2018-03-05', 'bc48', 'a', 'ins_vinay', '09:00:00', '11:00:00'),
(97, 'bc180305a', '2018-03-05', 'bc49', 'a', 'ins_pallavi', '11:30:00', '13:30:00'),
(98, 'bc180305a', '2018-03-07', 'bc51', 'a', 'ins_rakesh', '11:30:00', '13:30:00'),
(99, 'bc180305a', '2018-03-12', 'bc55', 'a', 'ins_vinay', '11:30:00', '13:30:00'),
(100, 'bc180305a', '2018-03-14', 'bc57', 'a', 'ins_asha', '11:30:00', '13:30:00'),
(101, 'bc180305a', '2018-03-15', 'bc59', 'a', 'ins_asha', '11:30:00', '13:30:00'),
(102, 'php180325', '2018-03-09', 'phpp1', 'a', 'ins_asha', '09:00:00', '09:00:00'),
(103, 'bc180305a', '2018-03-07', 'bc50', 'a', 'ins_vinay', '09:00:00', '09:00:00'),
(104, 'bc180305a', '2018-03-08', 'bc52', 'a', 'ins_vinay', '09:00:00', '09:00:00'),
(105, 'bc180305a', '2018-03-12', 'bc54', 'a', 'ins_asha', '09:00:00', '09:00:00'),
(106, 'bc180305a', '2018-03-14', 'bc56', 'a', 'ins_vinay', '09:00:00', '09:00:00'),
(107, 'bc180305a', '2018-03-15', 'bc58', 'a', 'ins_asha', '09:00:00', '09:00:00'),
(108, 'bc180305a', '2018-03-19', 'bc60', 'a', 'ins_asha', '09:00:00', '09:00:00'),
(109, 'bc180305b', '2018-03-05', 'bc18', 'b', 'ins_asha', '09:00:00', '11:00:00'),
(110, 'bc180305b', '2018-03-07', 'bc20', 'b', 'ins_asha', '09:00:00', '11:00:00'),
(111, 'bc180305b', '2018-03-08', 'bc22', 'b', 'ins_asha', '09:00:00', '11:00:00'),
(112, 'bc180305b', '2018-03-12', 'bc24', 'b', 'ins_varsha', '09:00:00', '11:00:00'),
(113, 'bc180305b', '2018-03-14', 'bc26', 'b', 'ins_aish', '09:00:00', '11:00:00'),
(114, 'bc180305b', '2018-03-15', 'bc28', 'b', 'ins_aish', '09:00:00', '11:00:00'),
(115, 'bc180305b', '2018-03-19', 'bc30', 'b', 'ins_varsha', '09:00:00', '11:00:00'),
(116, 'bc180305b', '2018-03-21', 'bc32', 'b', 'ins_aish', '09:00:00', '11:00:00'),
(117, 'bc180305b', '2018-03-22', 'bc34', 'b', 'ins_asha', '09:00:00', '11:00:00'),
(118, 'bc180305a', '2018-03-08', 'bc53', 'a', 'ins_pallavi', '11:30:00', '13:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `doj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `batch_code` varchar(255) NOT NULL,
  `student_code` varchar(255) NOT NULL,
  `instructor_code` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `username`, `email`, `password`, `image`, `role`, `gender`, `doj`, `batch_code`, `student_code`, `instructor_code`) VALUES
(1, '', '', 'a', 'a@gmail.com', 'a', 'a.jpg', 'admin', 'male', '2018-03-08 07:23:00', '', '', ''),
(2, '', '', 'rakesh', 'rakesh@gmail.com', 'r', 'rakesh.jpg', 'instructor', 'male', '2018-03-09 13:38:04', '', '', 'ins_rakesh'),
(3, '', '', 'c', 'c@gmail.com', 'c', 'c.jpg', 'student', 'male', '2018-03-09 13:25:39', 'gr180325', 'std_c', ''),
(4, '', '', 'varsha', 'varsha@gmail.com', 'v', 'v.jpg', 'instructor', 'female', '2018-03-09 13:25:50', '', '', 'ins_varsha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
