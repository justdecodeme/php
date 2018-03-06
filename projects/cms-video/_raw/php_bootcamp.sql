-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2018 at 07:08 PM
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
-- Database: `php_bootcamp`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_data`
--

CREATE TABLE `blog_data` (
  `blog_id` int(11) NOT NULL,
  `blog_title` text NOT NULL,
  `blog_description` text NOT NULL,
  `blog_date` date NOT NULL,
  `blog_author` text NOT NULL,
  `blog_category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_data`
--

INSERT INTO `blog_data` (`blog_id`, `blog_title`, `blog_description`, `blog_date`, `blog_author`, `blog_category`) VALUES
(1, 'what is HTML?', 'HTML stands for Hyper Text Markup Language, but you already know that and that wont help. I\'ll keep it simple:\r\n\r\nIt is a Language used to write web pages, what ever you see on any website, it has been written in HTML. It is used to make a basic structure of any website, like Ashwin Sharan said it acts as the skeleton for any web page. The images you see, the paragraphs, headings, columns, whatever, it is all written in HTML. Learning HTML is the first step towards web designing. \r\n\r\nAfter HTML comes CSS which out which HTML looks very ugly, hence CSS are the clothes of that skeleton you made using HTML. It is responsible for the design and colors and shape.\r\n', '2018-03-01', 'pallavi', 'html'),
(2, 'What is the difference between CSS and CSS3?', 'The latest version of CSS is the CSS3 version which basically differs from CSS2 in the incorporation of Modules and other changes. Modules enable the designing to be done in a lesser time with more ease while updating individual features and specifications. The CSS3 version supports many more browsers than CSS2, but be sure to test it on all operating systems and browsers.\r\nOther major changes/additions include:\r\n\r\n* New Combinator\r\n* New CSS Selectors\r\n* New Pseudo-elements\r\n* New Style properties\r\n\r\nNow let us discuss these in detail.\r\n\r\nCombinator\r\nNew addition of General Sibling Combinator is done to match sibling elements of a given element through tilde (~) Combinator.\r\n\r\nCSS Selectors\r\nWhile CSS2 had ‘simple selectors’, the new version calls them the components as ‘a sequence of simple selectors’.\r\n\r\nPseudo-Elements\r\nMany Pseudo Elements have been added that allow in-depth yet easy styling and a new convention of double colons ‘::’ has been introduced.\r\n\r\nStyle Properties\r\n\r\nNew Background Style Properties\r\nMultiple Background images can be layered in the box using different elements like background image, position and repeat.\r\n\r\nBorder Style\r\nStyling of borders has been extended to images and rounded designs which includes creating image of the borders and then automatically apply image to the borders through CSS.\r\n\r\nAdditions in Properties\r\n\r\n* Border-radius, image-source, image-slice, and the values for width outset and stretch have been added in CSS3.\r\n* Properties for managing boxes like shadowing, wrapping and breaking have been added.\r\n* CSS3 has done away with complex structures for div tag and makes it easy for hassle free designing of multiple table-less columns. This can be simply done by putting in the number of columns in the browser that need to be added in the body element along with their width, color and height to make the text flow through the columns with ease.\r\n\r\nNew Background Style Properties\r\n\r\n* With the addition of the new ‘local’ value, if the element has a scroll bar then the background scrolls with its content.\r\n* Background-clip, origin, size and style properties have been added.\r\n* Background shorthand property has been added in the size and origin properties.', '2018-03-02', 'rakko', 'css'),
(3, 'What is the best CSS3 tutorial on the Internet?', 'I agree with Doy Cave that Learn to code\r\nfrom Code Academy offers one of the best tutorials on html / css there is although it\'s not specific about CSS3 persé.\r\nIdeally you have to combine several different tutorials because there\'s not one that will teach you everything.\r\nMy first good information about basic html / css I got from watching free video tutorials by Bucky Roberts on his site http://www.thenewboston.com , and also those by Derek Banas on http://www.thenewthinktank.com .\r\nAfter that I went on and read and watched A LOT of other tutorials and played around with css very often to get to know it \"in real life\". I will mention a couple of sites I found usefull that might be interesting for you, but there are much more; too much to mention here!\r\nFor css positioning:\r\nLearn CSS Positioning in Ten Steps\r\nCSS: Setting width/height as Percentage minus pixels\r\nWhy moving elements with translate() is better than pos:abs top/left\r\nCss selectors, their order, and their browser compatibility:\r\nThe 30 CSS Selectors you Must Memorize - Tuts+ Code Tutorial\r\nPseudo-class selectors\r\nTaming Advanced CSS Selectors - Smashing Magazine\r\nWriting efficient CSS selectors\r\nCss filters:\r\nUnderstanding CSS Filter Effects - HTML5 Rocks\r\nCss in form fields:\r\nTextarea Tricks | CSS-Tricks\r\nCSS input boxes and submit buttons\r\nData URI\'s using css and base64 encoding (allthough you should be carefull using these because they can slow down loading of your website sotimes) :\r\nCSS Pattern Generator\r\nCSS Data URIs - Use Them In All Browsers Now!\r\nCss box shadow properties and possibilities:\r\nBox-shadow, one of CSS3?s best new features\r\nshadow: All the CSS3 properties explained\r\nCss font sizing units explained:\r\nCSS Font-Size: em vs. px vs. pt vs. percent\r\nIE conditional formating css:\r\nCSS Specific for Internet Explorer\r\nHTML5 / CSS3 animations and transitions and keyframes:\r\nAnimate your HTML5\r\nCreating fancy CSS3 Fade in / animation on page load using keyframes\r\nCSS transitions, CSS transforms and CSS animation\r\nCSS3 Transitions Without Using :hover\r\nCss only images:\r\nThe Shapes of CSS\r\n\r\nThese are just some highlights of the sites I bookmarked, but again, there are so many, and only combined will they really be able to help you.\r\nI will try and check out some of the ones you guys allready mentioned because some of them I don\'t know yet. Thanks for sharing!', '2018-03-03', 'vinay', 'css'),
(4, 'What is the best way to learn JavaScript?', 'I mostly disagree with answers mentioning Codeacademy, w3schools and jQuery.\r\n\r\nThose are beginner resources, yes, but beginner as in \"you\'re a beginner now\" and also as in \"you\'ll stay a beginner\", and they\'ll never get you above a newbie level. You need practical hands on experience, and there\'s no better way to get that than trial and error. Naturally, if you\'re on the absolute newb level, go through those just to get familiar with the syntax, but discard them as soon as you\'re done.\r\n\r\nThere are numerous real world examples out there, and though my employer would frown upon me for suggesting competition, Nettuts+ does indeed have good writeups. I wrote a couple real world from-scratch examples for SitePoint as well - building Chrome extensions from nothing (Chrome Extension for Diigo Archives - SitePoint), and contributing to an open source Node app by adding a much desired feature (Contributing to Open Source: Dillinger as a Case Study - SitePoint), but the best way would be following the procedure below:\r\n\r\nFind an open source project you\'d like to improve or think up a project you want to build\r\nDecide on a feature to start out with. For example, get a Node app up and running, just a skeleton. Or, add the ability to upload images to the Dillinger markdown app I linked to above. Etc.\r\nStart coding the feature.\r\nWhenever you get stuck, go to StackOverflow and look for a solution to your problem - it undoubtedly already exists.\r\nWhen you\'re happy with what you\'ve done, rinse and repeat, or re-iterate on the solution and try to optimize it.\r\n\r\nI would also add it\'s very important to know what kind of JS you want to focus on. If you\'d like to develop Node apps, jQuery will be less than useful. If you want to develop for frontend, then frontend manipulation libraries like jQuery are essential, but you shouldn\'t learn to depend on them.\r\n\r\nFor proper community support, definitely follow Shawn Drost\'s advice and go to that subreddit. A good way to get help can also be Wizpert - I\'ve done a decent number of assists there and people are generally very satisfied. \r\n\r\nAs for productivity tools you mention in the second part of the question:\r\n\r\nFirefox/Chrome devtools are the alpha and omega of JS development.\r\nGit+Github for version control and community feedback\r\nA good IDE for ease of development and getting rid of setup procedures when starting a new project or setting up a new machine - WebStorm is absolutely marvelous and multi-platform, you just need to save your settings online somewhere and you\'re good to go anywhere.\r\nJSFiddle for on-the-fly experiments and JSHint for syntax control\r\nVagrant and Puppet for virtual machines, so you can have a fresh and identical VM development environment at any time, without polluting your main dev machine with runtimes and updates. See protobox for a good starting point. This also prevents you from being able to mess up your machine. Just destroy and rebuild the VM and you\'re good to go, nothing happened.', '2018-03-04', 'rakko', 'js'),
(5, 'Which is better, PHP or Python? Why?', 'I\'m working with a PHP few years and was very sad because PHP was my every day pain. After I moved from PHP to Python more that 2 years ago I can say what do I think about Python to PHP comparision:\r\n1. Python has a philosophy that helps to write better for understanding code.\r\n2. Language evolution planning using PEPs - you know what you get in a next few years. PHP development process looks chaotic: making OOP like a something in Java, then add some \"static typing\" collections, then include some lambdas and namespaces (almost after 15 years of development). What\'s next?\r\n3. Python has more compact and clean syntax that helps developers,\r\n4. In Python the same things can be done the same way.\r\nThere is no matter what iterable things you using (list, tuple, string  or something else) you always can access by index, get a slice, iterate  over it or get the length the same way. No strlen()/count(), substr()  and a lot of other functions.\r\n5. More predictable and strict.\r\nNo 1 == \"1\" and other strange things like in PHP.\r\n6. Python has more unified and powerful standard library. It has some problems, but python\'s included library much better than PHP\'s.\r\n7. Python better working with exception. And trying to improve working with exceptions in future versions.\r\nThere is no errors like in PHP. Just Exception subclasses.\r\n8. Better namespaces and importing.\r\n9. Better OOP.\r\nAll the thing are objects (but with some limitations for int, float, etc.): types, functions, objects, modules.\r\nAll the objects can be introspected.\r\nABC, collections and other good batteries included.\r\n10. Metaclasses.\r\n11. Better support of functional programming style.\r\n12. Better unicode support (much better in Py3k).\r\n13. Syntax sugar for lists, dictionaries.\r\n14. Interactive interpreter mode, and few different improved interactive mode implementations.', '2018-03-05', 'anita', 'php'),
(6, 'Should I learn PHP today? Is it still worth it?', 'I can say, I have been working and observing the IT training and placement since 8 years. In my experience I could see many fluctuations in IT field with various development technologies and languages. I the following article may give you a brief on ‘Why PHP learning is worth today?’\r\n\r\nThe world of web development is quite a huge one, and there are numerous programming languages associated with the same. For those who do not know, it is an HTML powered server-side language based on scripting. It was the year 1995 when PHP made its way into the market. Even in 2016, the demand for PHP has not decreased a bit. In fact, it is among the most preferred web development languages. This is the reason why a lot of candidates who want to get into the IT industry opt to learn PHP. But the question is- can PHP provide a good platform to a fresher to begin a career in the IT field?\r\n\r\nHow PHP can boost your career?\r\n\r\nThere are numbers of reasons that can entice you to pursue PHP related courses in India. Take a look at some of them:\r\n\r\nIt’s popular - In the last five years, the demand of PHP language for web development based services has increased a lot. Most of the reputed web development companies in India prefer PHP language when it comes to developing websites. The simplicity and robust nature of PHP makes it the most preferred choice for web development process. For this reason, the opportunities associated with this field are very lucrative, and as a fresher, you can certainly expect a good start to your IT career.', '2018-03-05', 'rakko', 'php');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_data`
--
ALTER TABLE `blog_data`
  ADD PRIMARY KEY (`blog_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_data`
--
ALTER TABLE `blog_data`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
