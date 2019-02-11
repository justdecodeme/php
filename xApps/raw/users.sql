-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2019 at 05:40 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `x_apps`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `doj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `batch_code` varchar(255) NOT NULL,
  `student_code` varchar(255) NOT NULL,
  `instructor_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `username`, `email`, `password`, `image`, `role`, `gender`, `doj`, `batch_code`, `student_code`, `instructor_code`) VALUES
(1, 'Admin', '', 'admin', 'admin@gmail.com', 'admin', 'a.jpg', 'admin', 'male', '2018-03-08 07:23:00', '', '', ''),
(2, 'Employee', '', 'employee', 'employee@gmail.com', 'employee', 'rakesh.jpg', 'employee', 'male', '2018-03-09 13:38:04', '', '', 'ins_rakesh'),
(25, 'Student', '', 'student', 'student@gamil.com', 'student', 'https://s3.amazonaws.com/uifaces/faces/twitter/woodydotmx/128.jpg', 'student', 'female', '2017-09-12 08:14:37', 'u180325', 'std_71392', ''),
(26, 'Subscriber', '', 'subscriber', 'subscriber@gmail.com', 'subscriber', 'https://s3.amazonaws.com/uifaces/faces/twitter/orkuncaylar/128.jpg', 'subscriber', 'male', '2018-02-20 22:57:15', 'u180325', 'std_60090', ''),
(27, 'Elwyn', 'Crooks', 'Kaley4', 'Sabrina_Rice@hotmail.com', '102', 'https://s3.amazonaws.com/uifaces/faces/twitter/envex/128.jpg', 'student', 'male', '2017-09-27 19:28:24', 'u180325', 'std_21531', ''),
(32, 'Ernest', 'Kutch', 'Jamison_Schmitt21', 'Richie.Altenwerth47@gmail.com', '747', 'https://s3.amazonaws.com/uifaces/faces/twitter/buleswapnil/128.jpg', 'student', 'male', '2018-03-06 18:50:57', 'wd180325', 'std_21298', ''),
(33, 'Myrl', 'Hintz', 'Amir_Brekke82', 'Nils58@gmail.com', '138', 'https://s3.amazonaws.com/uifaces/faces/twitter/jeremyworboys/128.jpg', 'student', 'male', '2018-01-17 17:49:50', 'wd180325', 'std_34312', ''),
(34, 'Horace', 'Bernier', 'Kattie25', 'Maynard.Boehm66@hotmail.com', '691', 'https://s3.amazonaws.com/uifaces/faces/twitter/osmond/128.jpg', 'student', 'female', '2017-05-14 21:58:37', 'wd180325', 'std_82390', ''),
(35, 'Keegan', 'Harvey', 'Kiara91', 'Neil.Daugherty@gmail.com', '644', 'https://s3.amazonaws.com/uifaces/faces/twitter/blakehawksworth/128.jpg', 'student', 'female', '2017-09-10 11:28:06', 'wd180325', 'std_86544', ''),
(38, 'Elissa', 'Romaguera', 'Abdiel52', 'Emanuel_Wolf@gmail.com', '101', 'https://s3.amazonaws.com/uifaces/faces/twitter/jehnglynn/128.jpg', 'student', 'male', '2017-12-07 01:47:21', 'php180325', 'std_71967', ''),
(39, 'Stephen', 'Hilpert', 'Abby10', 'Gerhard.Ledner@yahoo.com', '289', 'https://s3.amazonaws.com/uifaces/faces/twitter/xamorep/128.jpg', 'student', 'male', '2017-11-23 16:16:30', 'php180325', 'std_37726', ''),
(40, 'Eloy', 'Ebert', 'Elena.Rutherford14', 'Matt.Berge82@gmail.com', '327', 'https://s3.amazonaws.com/uifaces/faces/twitter/vladarbatov/128.jpg', 'student', 'female', '2017-09-09 19:49:06', 'php180325', 'std_77139', ''),
(41, 'Cruz', 'Kuvalis', 'Karli.Deckow', 'Cierra96@hotmail.com', '226', 'https://s3.amazonaws.com/uifaces/faces/twitter/longlivemyword/128.jpg', 'student', 'male', '2017-09-13 01:42:20', 'php180325', 'std_30918', ''),
(42, 'Kaden', 'Kerluke', 'Karlie86', 'Enid75@gmail.com', '685', 'https://s3.amazonaws.com/uifaces/faces/twitter/stushona/128.jpg', 'student', 'female', '2017-06-15 04:37:09', 'php180325', 'std_2585', ''),
(43, 'Darrin', 'Romaguera', 'Kailyn.Schumm6', 'Lilly_Ziemann@hotmail.com', '488', 'https://s3.amazonaws.com/uifaces/faces/twitter/klimmka/128.jpg', 'student', 'male', '2017-10-14 06:17:59', 'php180325', 'std_10487', ''),
(44, 'Eileen', 'O\'Reilly', 'Clara_Dooley', 'Cornell.Nikolaus@gmail.com', '103', 'https://s3.amazonaws.com/uifaces/faces/twitter/buleswapnil/128.jpg', 'student', 'male', '2017-06-28 05:23:18', 'php180325', 'std_65512', ''),
(46, 'Gracie', 'Lebsack', 'Josiah.Hoppe1', 'Weston.Haag8@hotmail.com', '432', 'https://s3.amazonaws.com/uifaces/faces/twitter/samihah/128.jpg', 'student', 'male', '2018-03-11 01:20:37', 'php180325', 'std_40953', ''),
(47, 'Dorris', 'Lockman', 'Hubert45', 'Chester.Bahringer@yahoo.com', '15', 'https://s3.amazonaws.com/uifaces/faces/twitter/moynihan/128.jpg', 'student', 'female', '2017-12-01 19:18:40', 'php180325', 'std_71095', ''),
(48, 'Augustus', 'Nicolas', 'Stacy29', 'Tamia.Gibson19@hotmail.com', '653', 'https://s3.amazonaws.com/uifaces/faces/twitter/antonyryndya/128.jpg', 'student', 'male', '2017-09-21 16:56:00', 'wd180325', 'std_52723', ''),
(49, 'Flavie', 'D\'Amore', 'Chesley78', 'Guadalupe_Orn34@gmail.com', '947', 'https://s3.amazonaws.com/uifaces/faces/twitter/vikashpathak18/128.jpg', 'student', 'female', '2017-08-02 02:05:23', 'wd180325', 'std_69520', ''),
(50, 'Lukas', 'Witting', 'Al_Parker66', 'Ernestina.Terry@yahoo.com', '328', 'https://s3.amazonaws.com/uifaces/faces/twitter/osvaldas/128.jpg', 'student', 'female', '2017-05-29 03:20:28', 'wd180325', 'std_70503', ''),
(51, 'Duncan', 'Barton', 'Javon_Wisoky88', 'Marcella66@yahoo.com', '659', 'https://s3.amazonaws.com/uifaces/faces/twitter/motionthinks/128.jpg', 'student', 'female', '2017-07-10 20:04:52', 'wd180325', 'std_49106', ''),
(52, 'Elinore', 'Roberts', 'Katheryn.Schinner41', 'Verona62@yahoo.com', '498', 'https://s3.amazonaws.com/uifaces/faces/twitter/jeremiaha/128.jpg', 'student', 'female', '2018-02-03 04:37:25', 'wd180325', 'std_23125', ''),
(53, 'Eriberto', 'Kiehn', 'Hudson_Goyette', 'Darrel.Luettgen80@yahoo.com', '458', 'https://s3.amazonaws.com/uifaces/faces/twitter/juangomezw/128.jpg', 'student', 'male', '2017-11-26 15:14:09', 'wd180325', 'std_84652', ''),
(54, 'Donna', 'Kreiger', 'Armand42', 'Mitchell25@gmail.com', '240', 'https://s3.amazonaws.com/uifaces/faces/twitter/traneblow/128.jpg', 'student', 'male', '2018-02-21 10:11:03', 'wd180325', 'std_59332', ''),
(55, 'Kitty', 'Kutch', 'Sydney_Volkman', 'Lukas56@yahoo.com', '271', 'https://s3.amazonaws.com/uifaces/faces/twitter/langate/128.jpg', 'student', 'male', '2017-05-27 02:13:19', 'wd180325', 'std_14531', ''),
(56, 'Jailyn', 'Leuschke', 'Mateo21', 'Elfrieda90@yahoo.com', '471', 'https://s3.amazonaws.com/uifaces/faces/twitter/scottiedude/128.jpg', 'student', 'male', '2017-11-28 15:25:37', 'wd180325', 'std_95416', ''),
(57, 'Lincoln', 'Feil', 'Gordon.Barrows58', 'Amanda_Maggio@yahoo.com', '567', 'https://s3.amazonaws.com/uifaces/faces/twitter/mikebeecham/128.jpg', 'student', 'female', '2017-11-09 20:33:06', 'wd180325', 'std_56182', ''),
(58, 'Madisyn', 'Baumbach', 'Mellie94', 'Karolann52@hotmail.com', '499', 'https://s3.amazonaws.com/uifaces/faces/twitter/joemdesign/128.jpg', 'student', 'female', '2017-07-13 22:36:10', 'wd180325', 'std_29794', ''),
(59, 'Simeon', 'Hagenes', 'Misael_Collins63', 'Kaleb_Schroeder@gmail.com', '447', 'https://s3.amazonaws.com/uifaces/faces/twitter/flashmurphy/128.jpg', 'student', 'male', '2018-02-09 21:07:38', 'wd180325', 'std_10419', ''),
(60, 'Camron', 'Lueilwitz', 'August29', 'Oceane.Kris2@yahoo.com', '113', 'https://s3.amazonaws.com/uifaces/faces/twitter/_yardenoon/128.jpg', 'student', 'male', '2017-08-12 20:46:29', 'wd180325', 'std_65301', ''),
(61, 'Vickie', 'Kilback', 'Fritz31', 'Brielle.Barrows49@gmail.com', '452', 'https://s3.amazonaws.com/uifaces/faces/twitter/mateaodviteza/128.jpg', 'student', 'female', '2017-05-09 07:20:13', 'wd180325', 'std_87373', ''),
(62, 'Della', 'Funk', 'Holly14', 'Cora.Osinski@gmail.com', '705', 'https://s3.amazonaws.com/uifaces/faces/twitter/alexandermayes/128.jpg', 'student', 'female', '2017-11-18 05:42:44', 'wd180325', 'std_99700', ''),
(63, 'Retha', 'Prosacco', 'Rocio.Cormier42', 'Cassandre.Mills59@gmail.com', '313', 'https://s3.amazonaws.com/uifaces/faces/twitter/cocolero/128.jpg', 'student', 'male', '2018-01-19 19:19:47', 'wd180325', 'std_63464', ''),
(64, 'Blanche', 'Heidenreich', 'Larry64', 'Brittany85@gmail.com', '723', 'https://s3.amazonaws.com/uifaces/faces/twitter/michigangraham/128.jpg', 'student', 'female', '2017-08-16 17:16:38', 'wd180325', 'std_3675', ''),
(65, 'Tony', 'Gerhold', 'Lavonne_Spinka38', 'Grady6@gmail.com', '123', 'https://s3.amazonaws.com/uifaces/faces/twitter/sdidonato/128.jpg', 'student', 'female', '2017-10-27 23:25:37', 'gr180325', 'std_44309', ''),
(66, 'Vincent', 'Stehr', 'Hassie_Ebert81', 'Clarabelle_Herman@yahoo.com', '332', 'https://s3.amazonaws.com/uifaces/faces/twitter/alan_zhang_/128.jpg', 'student', 'male', '2017-05-07 00:05:56', 'gr180325', 'std_9944', ''),
(67, 'Carolina', 'Schuster', 'Damaris.Bahringer', 'Alfonso.Ruecker32@hotmail.com', '50', 'https://s3.amazonaws.com/uifaces/faces/twitter/cynthiasavard/128.jpg', 'student', 'female', '2017-12-28 22:21:12', 'gr180325', 'std_15877', ''),
(68, 'Jerome', 'Rowe', 'Brian.Sipes', 'Enrico69@yahoo.com', '418', 'https://s3.amazonaws.com/uifaces/faces/twitter/dimaposnyy/128.jpg', 'student', 'female', '2017-06-03 23:04:46', 'gr180325', 'std_49117', ''),
(69, 'Rashawn', 'O\'Hara', 'Allen_Feil', 'Pearl.Towne57@gmail.com', '371', 'https://s3.amazonaws.com/uifaces/faces/twitter/thekevinjones/128.jpg', 'student', 'female', '2017-11-22 06:32:41', 'gr180325', 'std_35520', ''),
(70, 'Michel', 'Lind', 'Gus36', 'Ryley_Tremblay77@gmail.com', '385', 'https://s3.amazonaws.com/uifaces/faces/twitter/mirfanqureshi/128.jpg', 'student', 'female', '2017-10-09 06:02:19', 'gr180325', 'std_72732', ''),
(71, 'Karl', 'Bruen', 'Aleen.Hermann', 'Treva87@yahoo.com', '707', 'https://s3.amazonaws.com/uifaces/faces/twitter/andrewofficer/128.jpg', 'student', 'female', '2017-05-23 16:43:45', 'gr180325', 'std_67250', ''),
(72, 'Gabe', 'Kessler', 'Johan_Farrell', 'Eryn84@yahoo.com', '449', 'https://s3.amazonaws.com/uifaces/faces/twitter/ZacharyZorbas/128.jpg', 'student', 'female', '2018-01-06 19:46:31', 'gr180325', 'std_81522', ''),
(73, 'Ora', 'Wilkinson', 'Wilson_Luettgen44', 'Marjolaine79@hotmail.com', '753', 'https://s3.amazonaws.com/uifaces/faces/twitter/fabbrucci/128.jpg', 'student', 'female', '2017-12-02 01:56:00', 'bc180305b', 'std_85142', ''),
(74, 'Jocelyn', 'Brekke', 'Kim.Hagenes', 'Monserrate32@yahoo.com', '623', 'https://s3.amazonaws.com/uifaces/faces/twitter/_dwite_/128.jpg', 'student', 'female', '2017-05-29 21:13:08', 'bc180305b', 'std_35011', ''),
(75, 'Rashawn', 'Botsford', 'Alexandro.DuBuque', 'Dorian.Connelly@gmail.com', '283', 'https://s3.amazonaws.com/uifaces/faces/twitter/nastya_mane/128.jpg', 'student', 'female', '2017-07-05 23:00:03', 'bc180305b', 'std_6516', ''),
(76, 'Melba', 'Toy', 'Sydnie61', 'Nikko.Mosciski@yahoo.com', '182', 'https://s3.amazonaws.com/uifaces/faces/twitter/bighanddesign/128.jpg', 'student', 'male', '2017-06-16 20:55:34', 'bc180305b', 'std_36606', ''),
(78, 'Dusty', 'Larkin', 'Shanny.Dibbert', 'Torey.Marvin79@gmail.com', '244', 'https://s3.amazonaws.com/uifaces/faces/twitter/opnsrce/128.jpg', 'student', 'female', '2017-11-23 10:29:20', 'bc180305b', 'std_39119', ''),
(79, 'Annamarie', 'Kling', 'Kristina20', 'Claudie_Johnson@gmail.com', '767', 'https://s3.amazonaws.com/uifaces/faces/twitter/miguelkooreman/128.jpg', 'student', 'female', '2017-11-21 20:00:42', 'bc180305b', 'std_61873', ''),
(80, 'Steve', 'Abshire', 'Tavares35', 'Abby15@hotmail.com', '716', 'https://s3.amazonaws.com/uifaces/faces/twitter/robbschiller/128.jpg', 'student', 'female', '2017-12-12 05:51:35', 'bc180305b', 'std_19463', ''),
(81, 'Kian', 'Harvey', 'Maximus87', 'Ruby_Denesik86@gmail.com', '587', 'https://s3.amazonaws.com/uifaces/faces/twitter/ajaxy_ru/128.jpg', 'student', 'male', '2017-07-13 13:21:04', 'bc180305b', 'std_22039', ''),
(82, 'Alford', 'Welch', 'Alana_Kunde', 'Herta.Hane@gmail.com', '701', 'https://s3.amazonaws.com/uifaces/faces/twitter/mizko/128.jpg', 'student', 'female', '2017-07-20 09:03:03', 'bc180305b', 'std_19065', ''),
(83, 'Alvah', 'Conroy', 'Cristopher14', 'Tiana_Crist27@yahoo.com', '247', 'https://s3.amazonaws.com/uifaces/faces/twitter/agromov/128.jpg', 'student', 'female', '2017-12-24 02:45:32', 'bc180305b', 'std_58214', ''),
(85, 'Ceasar', 'Blanda', 'Kieran.Emard', 'Jake_Herman41@yahoo.com', '628', 'https://s3.amazonaws.com/uifaces/faces/twitter/doronmalki/128.jpg', 'student', 'female', '2017-06-14 09:44:23', 'bc180305a', 'std_82582', ''),
(87, 'Dena', 'McGlynn', 'Scottie_Feil', 'Pedro6@yahoo.com', '137', 'https://s3.amazonaws.com/uifaces/faces/twitter/tweetubhai/128.jpg', 'student', 'female', '2017-10-01 16:38:03', 'bc180305a', 'std_90199', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
