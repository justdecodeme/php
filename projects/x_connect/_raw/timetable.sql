-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2018 at 02:35 PM
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
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
`id` int(11) NOT NULL,
  `batch_code` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `class` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `instructor_code` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `batch_code`, `date`, `class`, `room`, `instructor_code`, `start_time`, `end_time`, `status`) VALUES
(1, 'gr180325', '2018-03-25', 'GR01', 'A', 'ins_rakesh', '11:30:00', '13:30:00', 'pending'),
(2, 'gr180325', '2018-04-01', 'GR02', 'A', 'ins_vinay', '09:00:00', '11:00:00', 'pending'),
(3, 'gr180325', '2018-04-01', 'GR03', 'A', 'ins_varsha', '11:30:00', '13:30:00', 'pending'),
(4, 'gr180325', '2018-04-08', 'GR01 - GR03(Practice)', 'A', 'ins_vinay', '09:00:00', '11:00:00', 'pending'),
(5, 'gr180325', '2018-04-08', 'GR04', 'A', 'ins_pallavi', '11:30:00', '13:30:00', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
