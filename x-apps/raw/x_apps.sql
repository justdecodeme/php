-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2019 at 04:52 PM
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
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(100) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_category_id` int(100) NOT NULL,
  `book_stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_title`, `book_author`, `book_category_id`, `book_stock`) VALUES
(2, 'Misbehaving', 'Rechard H. Thaler', 10, 6),
(5, 'The leader who has no title', 'Robin Sharma', 10, 10),
(6, 'The Fifth Discipline', 'Peter M. Senge', 1, 1),
(9, 'Winning', 'Jack Welch', 10, 2),
(11, 'Nudge', 'na', 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(100) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_code`) VALUES
(1, 'Uncategorised', 'uc'),
(8, 'Autobiography', 'ab'),
(10, 'Self Help', 'sh'),
(12, 'Leadership', 'ls');

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `id` int(11) NOT NULL,
  `library_user_id` int(11) NOT NULL,
  `library_book_id` int(11) NOT NULL,
  `library_issue_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `library_due_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `library_return_date` timestamp NULL DEFAULT NULL,
  `library_approved_by_user_id` int(11) NOT NULL,
  `library_confirmed_by_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`id`, `library_user_id`, `library_book_id`, `library_issue_date`, `library_due_date`, `library_return_date`, `library_approved_by_user_id`, `library_confirmed_by_user_id`) VALUES
(4, 60, 9, '2019-03-07 15:47:51', '2019-03-02 18:30:00', NULL, 35, NULL),
(6, 27, 6, '2019-03-07 15:47:58', '2019-03-13 18:30:00', NULL, 33, NULL),
(8, 32, 2, '2019-03-07 15:50:50', '2019-03-30 18:30:00', '2019-03-14 18:30:00', 1, 35),
(11, 2, 11, '2019-03-07 15:48:00', '2019-03-13 18:30:00', NULL, 33, NULL),
(12, 2, 6, '2019-03-07 18:30:00', '2019-03-14 18:30:00', NULL, 35, NULL),
(13, 54, 2, '2019-03-07 15:47:56', '2019-03-13 18:30:00', NULL, 33, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `quote` varchar(700) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `author` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote`, `author`) VALUES
(10, 'Whatever the mind of man can conceive and believe, it can achieve.', 'Napoleon Hill'),
(11, 'Strive not to be a success, but rather to be of value.', 'Albert Einstein'),
(12, 'Two roads diverged in a wood, and Iâ€”I took the one less traveled by, And that has made all the difference.', 'Robert Frost'),
(13, 'I attribute my success to this: I never gave or took any excuse.', 'Florence Nightingale'),
(14, 'You miss 100% of the shots you donâ€™t take.', 'Wayne Gretzky'),
(15, 'Iâ€™ve missed more than 9000 shots in my career. Iâ€™ve lost almost 300 games. 26 times Iâ€™ve been trusted to take the game winning shot and missed. Iâ€™ve failed over and over and over again in my life. And that is why I succeed.', 'Michael Jordan'),
(16, 'The most difficult thing is the decision to act, the rest is merely tenacity.', 'Amelia Earhart'),
(17, 'Every strike brings me closer to the next home run.', 'Babe Ruth'),
(18, 'Definiteness of purpose is the starting point of all achievement.', 'W. Clement Stone'),
(19, 'We must balance conspicuous consumption with conscious capitalism.', 'Kevin Kruse'),
(20, 'Life is what happens to you while youâ€™re busy making other plans.', 'John Lennon'),
(21, 'We become what we think about.', 'Earl Nightingale'),
(22, 'Twenty years from now you will be more disappointed by the things that you didnâ€™t do than by the ones you did do, so throw off the bowlines, sail away from safe harbor, catch the trade winds in your sails.  Explore, Dream, Discover.', 'Mark Twain'),
(23, 'Life is 10% what happens to me and 90% of how I react to it.', 'Charles Swindoll'),
(24, 'The most common way people give up their power is by thinking they donâ€™t have any.', 'Alice Walker'),
(25, 'The mind is everything. What you think you become.', 'Buddha'),
(26, 'The best time to plant a tree was 20 years ago. The second best time is now.', 'Chinese Proverb'),
(27, 'An unexamined life is not worth living.', 'Socrates'),
(28, 'Eighty percent of success is showing up.', 'Woody Allen'),
(29, 'Your time is limited, so donâ€™t waste it living someone elseâ€™s life.', 'Steve Jobs'),
(30, 'Winning isnâ€™t everything, but wanting to win is.', 'Vince Lombardi'),
(31, 'I am not a product of my circumstances. I am a product of my decisions.', 'Stephen Covey'),
(32, 'Every child is an artist.  The problem is how to remain an artist once he grows up.', 'Pablo Picasso'),
(33, 'You can never cross the ocean until you have the courage to lose sight of the shore.', 'Christopher Columbus'),
(34, 'Iâ€™ve learned that people will forget what you said, people will forget what you did, but people will never forget how you made them feel.', 'Maya Angelou'),
(35, 'Either you run the day, or the day runs you.', 'Jim Rohn'),
(36, 'Whether you think you can or you think you canâ€™t, youâ€™re right.', 'Henry Ford'),
(37, 'The two most important days in your life are the day you are born and the day you find out why.', 'Mark Twain'),
(38, 'Whatever you can do, or dream you can, begin it.  Boldness has genius, power and magic in it.', 'Johann Wolfgang von Goethe'),
(39, 'The best revenge is massive success.', 'Frank Sinatra'),
(40, 'People often say that motivation doesnâ€™t last. Well, neither does bathing.  Thatâ€™s why we recommend it daily.', 'Zig Ziglar'),
(41, 'Life shrinks or expands in proportion to oneâ€™s courage.', 'Anais Nin'),
(42, 'If you hear a voice within you say â€œyou cannot paint,â€ then by all means paint and that voice will be silenced.', 'Vincent Van Gogh'),
(43, 'There is only one way to avoid criticism: do nothing, say nothing, and be nothing.', 'Aristotle'),
(44, 'Ask and it will be given to you; search, and you will find; knock and the door will be opened for you.', 'Jesus'),
(45, 'The only person you are destined to become is the person you decide to be.', 'Ralph Waldo Emerson'),
(46, 'Go confidently in the direction of your dreams.  Live the life you have imagined.', 'Henry David Thoreau'),
(47, 'When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.', 'Erma Bombeck'),
(48, 'Few things can help an individual more than to place responsibility on him, and to let him know that you trust him.', 'Booker T. Washington'),
(49, 'Certain things catch your eye, but pursue only those that capture the heart.', ' Ancient Indian Proverb'),
(50, 'Believe you can and youâ€™re halfway there.', 'Theodore Roosevelt'),
(51, 'Everything youâ€™ve ever wanted is on the other side of fear.', 'George Addair'),
(52, 'We can easily forgive a child who is afraid of the dark; the real tragedy of life is when men are afraid of the light.', 'Plato'),
(53, 'Teach thy tongue to say, â€œI do not know,â€ and thous shalt progress.', 'Maimonides'),
(54, 'Start where you are. Use what you have.  Do what you can.', 'Arthur Ashe'),
(55, 'When I was 5 years old, my mother always told me that happiness was the key to life.  When I went to school, they asked me what I wanted to be when I grew up.  I wrote down â€˜happyâ€™.  They told me I didnâ€™t understand the assignment, and I told them they didnâ€™t understand life.', 'John Lennon'),
(56, 'Fall seven times and stand up eight.', 'Japanese Proverb'),
(57, 'When one door of happiness closes, another opens, but often we look so long at the closed door that we do not see the one that has been opened for us.', 'Helen Keller'),
(58, 'Everything has beauty, but not everyone can see.', 'Confucius'),
(59, 'How wonderful it is that nobody need wait a single moment before starting to improve the world.', 'Anne Frank'),
(60, 'When I let go of what I am, I become what I might be.', 'Lao Tzu'),
(61, 'Life is not measured by the number of breaths we take, but by the moments that take our breath away.', 'Maya Angelou'),
(62, 'Happiness is not something readymade.  It comes from your own actions.', 'Dalai Lama'),
(63, 'If youâ€™re offered a seat on a rocket ship, donâ€™t ask what seat! Just get on.', 'Sheryl Sandberg'),
(64, 'First, have a definite, clear practical ideal; a goal, an objective. Second, have the necessary means to achieve your ends; wisdom, money, materials, and methods. Third, adjust all your means to that end.', 'Aristotle'),
(65, 'If the wind will not serve, take to the oars.', 'Latin Proverb'),
(66, 'You canâ€™t fall if you donâ€™t climb.  But thereâ€™s no joy in living your whole life on the ground.', 'Unknown'),
(67, 'We must believe that we are gifted for something, and that this thing, at whatever cost, must be attained.', 'Marie Curie'),
(68, 'Too many of us are not living our dreams because we are living our fears.', 'Les Brown'),
(69, 'Challenges are what make life interesting and overcoming them is what makes life meaningful.', 'Joshua J. Marine'),
(70, 'If you want to lift yourself up, lift up someone else.', 'Booker T. Washington'),
(71, 'I have been impressed with the urgency of doing. Knowing is not enough; we must apply. Being willing is not enough; we must do.', 'Leonardo da Vinci'),
(72, 'Limitations live only in our minds.  But if we use our imaginations, our possibilities become limitless.', 'Jamie Paolinetti'),
(73, 'You take your life in your own hands, and what happens? A terrible thing, no one to blame.', 'Erica Jong'),
(74, 'Whatâ€™s money? A man is a success if he gets up in the morning and goes to bed at night and in between does what he wants to do.', 'Bob Dylan'),
(75, 'I didnâ€™t fail the test. I just found 100 ways to do it wrong.', 'Benjamin Franklin'),
(76, 'In order to succeed, your desire for success should be greater than your fear of failure.', 'Bill Cosby'),
(77, 'A person who never made a mistake never tried anything new.', ' Albert Einstein'),
(78, 'The person who says it cannot be done should not interrupt the person who is doing it.', 'Chinese Proverb'),
(79, 'There are no traffic jams along the extra mile.', 'Roger Staubach'),
(80, 'It is never too late to be what you might have been.', 'George Eliot'),
(81, 'You become what you believe.', 'Oprah Winfrey'),
(82, 'I would rather die of passion than of boredom.', 'Vincent van Gogh'),
(83, 'A truly rich man is one whose children run into his arms when his hands are empty.', 'Unknown'),
(84, 'It is not what you do for your children, but what you have taught them to do for themselves, that will make them successful human beings.', 'Ann Landers'),
(85, 'If you want your children to turn out well, spend twice as much time with them, and half as much money.', 'Abigail Van Buren'),
(86, 'Build your own dreams, or someone else will hire you to build theirs.', 'Farrah Gray'),
(87, 'The battles that count arenâ€™t the ones for gold medals. The struggles within yourselfâ€“the invisible battles inside all of usâ€“thatâ€™s where itâ€™s at.', 'Jesse Owens'),
(88, 'Education costs money.  But then so does ignorance.', 'Sir Claus Moser'),
(89, 'I have learned over the years that when oneâ€™s mind is made up, this diminishes fear.', 'Rosa Parks'),
(90, 'It does not matter how slowly you go as long as you do not stop.', 'Confucius'),
(91, 'If you look at what you have in life, youâ€™ll always have more. If you look at what you donâ€™t have in life, youâ€™ll never have enough.', 'Oprah Winfrey'),
(92, 'Remember that not getting what you want is sometimes a wonderful stroke of luck.', 'Dalai Lama'),
(93, 'You canâ€™t use up creativity.  The more you use, the more you have.', 'Maya Angelou'),
(94, 'Dream big and dare to fail.', 'Norman Vaughan'),
(95, 'Our lives begin to end the day we become silent about things that matter.', 'Martin Luther King Jr.'),
(96, 'Do what you can, where you are, with what you have.', 'Teddy Roosevelt'),
(97, 'If you do what youâ€™ve always done, youâ€™ll get what youâ€™ve always gotten.', 'Tony Robbins'),
(98, 'Dreaming, after all, is a form of planning.', 'Gloria Steinem'),
(99, 'Itâ€™s your place in the world; itâ€™s your life. Go on and do all you can with it, and make it the life you want to live.', 'Mae Jemison'),
(100, 'You may be disappointed if you fail, but you are doomed if you donâ€™t try.', 'Beverly Sills'),
(101, 'Remember no one can make you feel inferior without your consent.', 'Eleanor Roosevelt'),
(102, 'Life is what we make it, always has been, always will be.', 'Grandma Moses'),
(103, 'The question isnâ€™t who is going to let me; itâ€™s who is going to stop me.', 'Ayn Rand'),
(104, 'When everything seems to be going against you, remember that the airplane takes off against the wind, not with it.', 'Henry Ford'),
(105, 'Itâ€™s not the years in your life that count. Itâ€™s the life in your years.', 'Abraham Lincoln'),
(106, 'Change your thoughts and you change your world.', 'Norman Vincent Peale'),
(107, 'Either write something worth reading or do something worth writing.', 'Benjamin Franklin'),
(108, 'Nothing is impossible, the word itself says, â€œIâ€™m possible!â€', 'Audrey Hepburn'),
(109, 'The only way to do great work is to love what you do.', 'Steve Jobs'),
(110, 'If you can dream it, you can achieve it.', 'Zig Ziglar'),
(115, 'Life isnâ€™t about getting and having, itâ€™s about giving and being.', 'Kevin Kruse');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(100) NOT NULL,
  `role_code` varchar(255) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_code`, `role_name`) VALUES
(1, 'ad', 'Admin'),
(2, 'st', 'Student'),
(5, 'em', 'Employee'),
(6, 'sb', 'Subscriber'),
(11, 'aa', 'aa'),
(12, 'bb', 'bb');

-- --------------------------------------------------------

--
-- Table structure for table `todays_quote_id`
--

CREATE TABLE `todays_quote_id` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todays_quote_id`
--

INSERT INTO `todays_quote_id` (`id`) VALUES
(106);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_f_name` varchar(255) NOT NULL,
  `user_l_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_role_id` varchar(255) NOT NULL,
  `user_gender` varchar(255) NOT NULL,
  `user_doj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_batch_code` varchar(255) NOT NULL,
  `user_student_code` varchar(255) NOT NULL,
  `user_instructor_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_f_name`, `user_l_name`, `user_name`, `user_email`, `user_password`, `user_image`, `user_role_id`, `user_gender`, `user_doj`, `user_batch_code`, `user_student_code`, `user_instructor_code`) VALUES
(1, 'Videsh', 'Kharvi', 'v_kharvi', 'v_kharvi@gmail.com', 'v_kharvi', 'a.jpg', '1', 'male', '2018-03-08 07:23:00', '', '', ''),
(2, 'Pallavi', 'Rajput', 'km_pallavi', 'km_pallavi@gmail.com', 'km_pallavi', 'km_pallavi.jpg', '5', 'male', '2018-03-09 13:38:04', '', '', 'ins_rakesh'),
(25, 'Student', '', 'student', 'student@gmail.com', 'student', 'https://s3.amazonaws.com/uifaces/faces/twitter/woodydotmx/128.jpg', '2', 'female', '2017-09-12 08:14:37', 'u180325', 'std_71392', ''),
(26, 'Subscriber', '', 'subscriber', 'subscriber@gmail.com', 'subscriber', 'https://s3.amazonaws.com/uifaces/faces/twitter/orkuncaylar/128.jpg', '6', 'male', '2018-02-20 22:57:15', 'u180325', 'std_60090', ''),
(27, 'Amod', 'Kumar', 'amod_k', 'amod_k@gmail.com', 'amod_k', 'https://s3.amazonaws.com/uifaces/faces/twitter/envex/128.jpg', '5', 'male', '2017-09-27 19:28:24', 'u180325', 'std_21531', ''),
(32, 'Rakesh', 'Kumar', 'r_kumar', 'r_kumar@gmail.com', 'r_kumar', 'https://s3.amazonaws.com/uifaces/faces/twitter/buleswapnil/128.jpg', '5', 'male', '2018-03-06 18:50:57', 'wd180325', 'std_21298', ''),
(33, 'Eric', 'Matsumura', 'eric_m', 'eric_m@gmail.com', 'eric_m', 'https://s3.amazonaws.com/uifaces/faces/twitter/jeremyworboys/128.jpg', '1', 'male', '2018-01-17 17:49:50', 'wd180325', 'std_34312', ''),
(35, 'Hiroki', 'Yamada', 'h_yamada', 'h_yamada@gmail.com', 'h_yamada', 'https://s3.amazonaws.com/uifaces/faces/twitter/blakehawksworth/128.jpg', '1', 'female', '2017-09-10 11:28:06', 'wd180325', 'std_86544', ''),
(38, 'Elissa', 'Romaguera', 'Abdiel52', 'Emanuel_Wolf@gmail.com', '101', 'https://s3.amazonaws.com/uifaces/faces/twitter/jehnglynn/128.jpg', '6', 'male', '2017-12-07 01:47:21', 'php180325', 'std_71967', ''),
(40, 'Eloy', 'Ebert', 'Elena.Rutherford14', 'Matt.Berge82@gmail.com', '327', 'https://s3.amazonaws.com/uifaces/faces/twitter/vladarbatov/128.jpg', '6', 'female', '2017-09-09 19:49:06', 'php180325', 'std_77139', ''),
(41, 'Cruz', 'Kuvalis', 'Karli.Deckow', 'Cierra96@hotmail.com', '226', 'https://s3.amazonaws.com/uifaces/faces/twitter/longlivemyword/128.jpg', '6', 'male', '2017-09-13 01:42:20', 'php180325', 'std_30918', ''),
(42, 'Kaden', 'Kerluke', 'Karlie86', 'Enid75@gmail.com', '685', 'https://s3.amazonaws.com/uifaces/faces/twitter/stushona/128.jpg', '6', 'female', '2017-06-15 04:37:09', 'php180325', 'std_2585', ''),
(43, 'Darrin', 'Romaguera', 'Kailyn.Schumm6', 'Lilly_Ziemann@hotmail.com', '488', 'https://s3.amazonaws.com/uifaces/faces/twitter/klimmka/128.jpg', '6', 'male', '2017-10-14 06:17:59', 'php180325', 'std_10487', ''),
(44, 'Eileen', 'O\'Reilly', 'Clara_Dooley', 'Cornell.Nikolaus@gmail.com', '103', 'https://s3.amazonaws.com/uifaces/faces/twitter/buleswapnil/128.jpg', '6', 'male', '2017-06-28 05:23:18', 'php180325', 'std_65512', ''),
(46, 'Gracie', 'Lebsack', 'Josiah.Hoppe1', 'Weston.Haag8@hotmail.com', '432', 'https://s3.amazonaws.com/uifaces/faces/twitter/samihah/128.jpg', '6', 'male', '2018-03-11 01:20:37', 'php180325', 'std_40953', ''),
(47, 'Dorris', 'Lockman', 'Hubert45', 'Chester.Bahringer@yahoo.com', '15', 'https://s3.amazonaws.com/uifaces/faces/twitter/moynihan/128.jpg', '6', 'female', '2017-12-01 19:18:40', 'php180325', 'std_71095', ''),
(48, 'Augustus', 'Nicolas', 'Stacy29', 'Tamia.Gibson19@hotmail.com', '653', 'https://s3.amazonaws.com/uifaces/faces/twitter/antonyryndya/128.jpg', '6', 'male', '2017-09-21 16:56:00', 'wd180325', 'std_52723', ''),
(49, 'Flavie', 'D\'Amore', 'Chesley78', 'Guadalupe_Orn34@gmail.com', '947', 'https://s3.amazonaws.com/uifaces/faces/twitter/vikashpathak18/128.jpg', '6', 'female', '2017-08-02 02:05:23', 'wd180325', 'std_69520', ''),
(50, 'Lukas', 'Witting', 'Al_Parker66', 'Ernestina.Terry@yahoo.com', '328', 'https://s3.amazonaws.com/uifaces/faces/twitter/osvaldas/128.jpg', '6', 'female', '2017-05-29 03:20:28', 'wd180325', 'std_70503', ''),
(51, 'Duncan', 'Barton', 'Javon_Wisoky88', 'Marcella66@yahoo.com', '659', 'https://s3.amazonaws.com/uifaces/faces/twitter/motionthinks/128.jpg', '6', 'female', '2017-07-10 20:04:52', 'wd180325', 'std_49106', ''),
(52, 'Elinore', 'Roberts', 'Katheryn.Schinner41', 'Verona62@yahoo.com', '498', 'https://s3.amazonaws.com/uifaces/faces/twitter/jeremiaha/128.jpg', '6', 'female', '2018-02-03 04:37:25', 'wd180325', 'std_23125', ''),
(53, 'Eriberto', 'Kiehn', 'Hudson_Goyette', 'Darrel.Luettgen80@yahoo.com', '458', 'https://s3.amazonaws.com/uifaces/faces/twitter/juangomezw/128.jpg', '6', 'male', '2017-11-26 15:14:09', 'wd180325', 'std_84652', ''),
(54, 'Abu', 'Shahir', 'a_shahir', 'a_shahir@gmail.com', 'a_shahir', 'https://s3.amazonaws.com/uifaces/faces/twitter/traneblow/128.jpg', '5', 'male', '2018-02-21 10:11:03', 'wd180325', 'std_59332', ''),
(55, 'Kitty', 'Kutch', 'Sydney_Volkman', 'Lukas56@yahoo.com', '271', 'https://s3.amazonaws.com/uifaces/faces/twitter/langate/128.jpg', '6', 'male', '2017-05-27 02:13:19', 'wd180325', 'std_14531', ''),
(56, 'Jailyn', 'Leuschke', 'Mateo21', 'Elfrieda90@yahoo.com', '471', 'https://s3.amazonaws.com/uifaces/faces/twitter/scottiedude/128.jpg', '6', 'male', '2017-11-28 15:25:37', 'wd180325', 'std_95416', ''),
(57, 'Lincoln', 'Feil', 'Gordon.Barrows58', 'Amanda_Maggio@yahoo.com', '567', 'https://s3.amazonaws.com/uifaces/faces/twitter/mikebeecham/128.jpg', '6', 'female', '2017-11-09 20:33:06', 'wd180325', 'std_56182', ''),
(58, 'Madisyn', 'Baumbach', 'Mellie94', 'Karolann52@hotmail.com', '499', 'https://s3.amazonaws.com/uifaces/faces/twitter/joemdesign/128.jpg', '6', 'female', '2017-07-13 22:36:10', 'wd180325', 'std_29794', ''),
(59, 'Simeon', 'Hagenes', 'Misael_Collins63', 'Kaleb_Schroeder@gmail.com', '447', 'https://s3.amazonaws.com/uifaces/faces/twitter/flashmurphy/128.jpg', '6', 'male', '2018-02-09 21:07:38', 'wd180325', 'std_10419', ''),
(60, 'Anita', 'Shahoo', 'a_shahoo', 'a_shahoo@gmail.com', 'a_shahoo', 'https://s3.amazonaws.com/uifaces/faces/twitter/_yardenoon/128.jpg', '5', 'male', '2017-08-12 20:46:29', 'wd180325', 'std_65301', ''),
(61, 'Vickie', 'Kilback', 'Fritz31', 'Brielle.Barrows49@gmail.com', '452', 'https://s3.amazonaws.com/uifaces/faces/twitter/mateaodviteza/128.jpg', '6', 'female', '2017-05-09 07:20:13', 'wd180325', 'std_87373', ''),
(62, 'Della', 'Funk', 'Holly14', 'Cora.Osinski@gmail.com', '705', 'https://s3.amazonaws.com/uifaces/faces/twitter/alexandermayes/128.jpg', '6', 'female', '2017-11-18 05:42:44', 'wd180325', 'std_99700', ''),
(63, 'Retha', 'Prosacco', 'Rocio.Cormier42', 'Cassandre.Mills59@gmail.com', '313', 'https://s3.amazonaws.com/uifaces/faces/twitter/cocolero/128.jpg', '6', 'male', '2018-01-19 19:19:47', 'wd180325', 'std_63464', ''),
(64, 'Blanche', 'Heidenreich', 'Larry64', 'Brittany85@gmail.com', '723', 'https://s3.amazonaws.com/uifaces/faces/twitter/michigangraham/128.jpg', '6', 'female', '2017-08-16 17:16:38', 'wd180325', 'std_3675', ''),
(65, 'Tony', 'Gerhold', 'Lavonne_Spinka38', 'Grady6@gmail.com', '123', 'https://s3.amazonaws.com/uifaces/faces/twitter/sdidonato/128.jpg', '6', 'female', '2017-10-27 23:25:37', 'gr180325', 'std_44309', ''),
(66, 'Vincent', 'Stehr', 'Hassie_Ebert81', 'Clarabelle_Herman@yahoo.com', '332', 'https://s3.amazonaws.com/uifaces/faces/twitter/alan_zhang_/128.jpg', '6', 'male', '2017-05-07 00:05:56', 'gr180325', 'std_9944', ''),
(67, 'Carolina', 'Schuster', 'Damaris.Bahringer', 'Alfonso.Ruecker32@hotmail.com', '50', 'https://s3.amazonaws.com/uifaces/faces/twitter/cynthiasavard/128.jpg', '6', 'female', '2017-12-28 22:21:12', 'gr180325', 'std_15877', ''),
(68, 'Jerome', 'Rowe', 'Brian.Sipes', 'Enrico69@yahoo.com', '418', 'https://s3.amazonaws.com/uifaces/faces/twitter/dimaposnyy/128.jpg', '6', 'female', '2017-06-03 23:04:46', 'gr180325', 'std_49117', ''),
(69, 'Rashawn', 'O\'Hara', 'Allen_Feil', 'Pearl.Towne57@gmail.com', '371', 'https://s3.amazonaws.com/uifaces/faces/twitter/thekevinjones/128.jpg', '6', 'female', '2017-11-22 06:32:41', 'gr180325', 'std_35520', ''),
(70, 'Michel', 'Lind', 'Gus36', 'Ryley_Tremblay77@gmail.com', '385', 'https://s3.amazonaws.com/uifaces/faces/twitter/mirfanqureshi/128.jpg', '6', 'female', '2017-10-09 06:02:19', 'gr180325', 'std_72732', ''),
(71, 'Karl', 'Bruen', 'Aleen.Hermann', 'Treva87@yahoo.com', '707', 'https://s3.amazonaws.com/uifaces/faces/twitter/andrewofficer/128.jpg', '6', 'female', '2017-05-23 16:43:45', 'gr180325', 'std_67250', ''),
(72, 'Gabe', 'Kessler', 'Johan_Farrell', 'Eryn84@yahoo.com', '449', 'https://s3.amazonaws.com/uifaces/faces/twitter/ZacharyZorbas/128.jpg', '6', 'female', '2018-01-06 19:46:31', 'gr180325', 'std_81522', ''),
(73, 'Ora', 'Wilkinson', 'Wilson_Luettgen44', 'Marjolaine79@hotmail.com', '753', 'https://s3.amazonaws.com/uifaces/faces/twitter/fabbrucci/128.jpg', '6', 'female', '2017-12-02 01:56:00', 'bc180305b', 'std_85142', ''),
(74, 'Jocelyn', 'Brekke', 'Kim.Hagenes', 'Monserrate32@yahoo.com', '623', 'https://s3.amazonaws.com/uifaces/faces/twitter/_dwite_/128.jpg', '6', 'female', '2017-05-29 21:13:08', 'bc180305b', 'std_35011', ''),
(75, 'Rashawn', 'Botsford', 'Alexandro.DuBuque', 'Dorian.Connelly@gmail.com', '283', 'https://s3.amazonaws.com/uifaces/faces/twitter/nastya_mane/128.jpg', '6', 'female', '2017-07-05 23:00:03', 'bc180305b', 'std_6516', ''),
(76, 'Melba', 'Toy', 'Sydnie61', 'Nikko.Mosciski@yahoo.com', '182', 'https://s3.amazonaws.com/uifaces/faces/twitter/bighanddesign/128.jpg', '6', 'male', '2017-06-16 20:55:34', 'bc180305b', 'std_36606', ''),
(78, 'Dusty', 'Larkin', 'Shanny.Dibbert', 'Torey.Marvin79@gmail.com', '244', 'https://s3.amazonaws.com/uifaces/faces/twitter/opnsrce/128.jpg', '6', 'female', '2017-11-23 10:29:20', 'bc180305b', 'std_39119', ''),
(79, 'Annamarie', 'Kling', 'Kristina20', 'Claudie_Johnson@gmail.com', '767', 'https://s3.amazonaws.com/uifaces/faces/twitter/miguelkooreman/128.jpg', '6', 'female', '2017-11-21 20:00:42', 'bc180305b', 'std_61873', ''),
(80, 'Steve', 'Abshire', 'Tavares35', 'Abby15@hotmail.com', '716', 'https://s3.amazonaws.com/uifaces/faces/twitter/robbschiller/128.jpg', '6', 'female', '2017-12-12 05:51:35', 'bc180305b', 'std_19463', ''),
(81, 'Kian', 'Harvey', 'Maximus87', 'Ruby_Denesik86@gmail.com', '587', 'https://s3.amazonaws.com/uifaces/faces/twitter/ajaxy_ru/128.jpg', '6', 'male', '2017-07-13 13:21:04', 'bc180305b', 'std_22039', ''),
(83, 'Alvah', 'Conroy', 'Cristopher14', 'Tiana_Crist27@yahoo.com', '247', 'https://s3.amazonaws.com/uifaces/faces/twitter/agromov/128.jpg', '6', 'female', '2017-12-24 02:45:32', 'bc180305b', 'std_58214', ''),
(85, 'Ceasar', 'Blanda', 'Kieran.Emard', 'Jake_Herman41@yahoo.com', '628', 'https://s3.amazonaws.com/uifaces/faces/twitter/doronmalki/128.jpg', '6', 'female', '2017-06-14 09:44:23', 'bc180305a', 'std_82582', ''),
(87, 'Dena', 'McGlynn', 'Scottie_Feil', 'Pedro6@yahoo.com', '137', 'https://s3.amazonaws.com/uifaces/faces/twitter/tweetubhai/128.jpg', '6', 'female', '2017-10-01 16:38:03', 'bc180305a', 'std_90199', ''),
(89, '', '', 'b', 'b@gmail.com', 'b', '', '6', '', '2019-02-12 13:22:52', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
