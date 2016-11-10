-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Nov 10, 2016 at 08:35 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shouter`
--

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE `following` (
  `user_id` int(11) NOT NULL,
  `following_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`user_id`, `following_id`) VALUES
(2, 3),
(3, 4),
(3, 1),
(1, 2),
(1, 3),
(5, 4),
(5, 3),
(5, 2),
(9, 8),
(1, 5),
(1, 8),
(27, 26),
(27, 15),
(27, 14),
(26, 13),
(26, 8),
(16, 15),
(16, 3),
(16, 28),
(16, 6),
(8, 26),
(8, 27),
(8, 16),
(8, 5),
(8, 2),
(28, 26),
(28, 15),
(28, 8),
(28, 5),
(28, 2),
(1, 26),
(1, 27),
(27, 28),
(27, 13);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `author_id` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `message`, `author_id`, `post_date`) VALUES
(6, 'My Lorem Ipsum Text number 2', 1, '2014-06-02 14:34:10'),
(18, 'My LOrem ipsum number ~ shout', 1, '2014-06-02 23:30:30'),
(19, 'lol', 1, '2014-06-02 23:37:58'),
(20, 'wtf is this', 1, '2014-06-02 23:38:05'),
(21, 'Hehe, this is my first post!', 5, '2014-06-02 23:57:33'),
(23, 'Sun is shining', 5, '2014-06-03 00:00:09'),
(25, 'Lord of the rings, Godfather, KickAss... ', 3, '2014-06-03 00:03:30'),
(26, 'Testing reload', 3, '2014-06-03 00:04:17'),
(28, 'My first post', 8, '2014-06-03 00:23:42'),
(34, 'Mysql Sql Sqlite', 6, '2014-06-03 16:45:17'),
(35, 'John Doe Lorem Ipsum ', 2, '2014-06-03 16:45:59'),
(37, 'affaaffaafa', 1, '2014-06-03 17:25:27'),
(38, 'lol', 1, '2014-06-03 20:21:45'),
(39, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ', 27, '2014-06-03 21:15:10'),
(40, 'Lorem Ipsum is simply dummy text of the printing and typesetting ', 27, '2014-06-03 21:15:17'),
(41, 'This tutorial shows you how to use the MySQL COUNT function to count the number rows in a table.\r\n', 26, '2014-06-03 21:25:46'),
(42, 'This tutorial shows you how to use the MySQL COUNT function to count the number rows in a table.', 26, '2014-06-03 21:26:00'),
(43, 'This tutorial shows you how to use the MySQL COUNT function to count the number rows in a table.', 26, '2014-06-03 21:26:02'),
(44, 'Why this is done is explained in the SQL injection section', 16, '2014-06-03 21:26:29'),
(45, 'Again, as before, we nest another conditional logic statement inside our original two', 16, '2014-06-03 21:26:39'),
(46, 'Configure the query governor cost limit Server Configuration ...', 16, '2014-06-03 21:27:02'),
(47, 'Configure the query governor cost limit Server Configuration ...', 8, '2014-06-03 21:27:24'),
(48, 'Configure the query governor cost limit Server Configuration ...fafafafafafa', 8, '2014-06-03 21:27:26'),
(50, 'Configure the query governor cost limit Server Configuration ...faa', 28, '2014-06-03 21:28:06'),
(51, 'fafafafConfigure the query governor cost limit Server Configuration ...', 28, '2014-06-03 21:28:08'),
(53, 'afafafafafa', 1, '2014-06-05 15:45:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `admin` int(11) DEFAULT NULL,
  `posts_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `admin`, `posts_count`) VALUES
(1, 'shomy', 'bla@gmail.com', '123', 1, 7),
(2, 'JohnDoe', 'blaa@gmail.com', '123', 0, 1),
(3, 'Frank', 'frank@gmail.com', '123', 0, 4),
(5, 'Jeffrey', 'jeffrey@gmail.com', '123', 0, 3),
(6, 'Masinka', 'masinka@gmai.com', '123', 0, 1),
(8, 'ninja', 'ninja@gmail.com', '123', 0, 4),
(15, 'User1', 'user1@gmail.com', '123', 1, 0),
(16, 'user2', 'user@gmail.com', '123', NULL, 3),
(26, 'JeneeAlto', 'JeneeAlto@gmail.com', '123', 0, 3),
(27, 'Paul', 'paul@gmail.com', '123', 0, 2),
(28, 'Selma', 'selma@gmail.com', '123', 1, 2);
