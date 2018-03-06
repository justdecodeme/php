-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2018 at 01:33 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rtc_php_ajax`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `date`, `user`) VALUES
(16, 'hi', '2018-03-06 12:16:48', 'Rakko'),
(17, 'how are you', '2018-03-06 12:16:51', 'Rakko'),
(18, 'i''m fine', '2018-03-06 12:16:55', 'Rakko'),
(19, 'you?', '2018-03-06 12:16:59', 'Rakko'),
(20, 'i''m also good', '2018-03-06 12:17:03', 'Rakko'),
(21, 'thank you', '2018-03-06 12:17:08', 'Rakko'),
(22, 'what you doing?', '2018-03-06 12:30:12', 'Rakko'),
(23, 'nothing just relaxing', '2018-03-06 12:30:26', 'Rakko'),
(24, 'cool :)', '2018-03-06 12:30:31', 'Rakko'),
(25, 'what about you?', '2018-03-06 12:30:37', 'Rakko'),
(26, 'm working hehe', '2018-03-06 12:31:22', 'Rakko'),
(27, 'great job dude?', '2018-03-06 12:31:48', 'Rakko'),
(28, 'keep it up.', '2018-03-06 12:31:55', 'Rakko');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
