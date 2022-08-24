-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2022 at 03:36 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `com_content` varchar(800) NOT NULL,
  `com_date` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `com_content`, `com_date`, `post_id`, `unique_id`) VALUES
(38, 'asdasdsdas', 'Jul 29 2022 16:59:54', 91, 839035),
(45, 'asdaasdadaasdda', 'Jul 31 2022 15:24:05', 91, 862282),
(46, 'edited', 'Aug 6 2022 10:52:28', 94, 862282);

-- --------------------------------------------------------

--
-- Table structure for table `likers`
--

CREATE TABLE `likers` (
  `like_id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifs`
--

CREATE TABLE `notifs` (
  `notif_id` int(11) NOT NULL,
  `notif_content` varchar(800) NOT NULL,
  `notif_from` int(11) NOT NULL,
  `notif_to` int(11) NOT NULL,
  `notif_date` varchar(255) NOT NULL,
  `notif_type` varchar(255) NOT NULL,
  `opened` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifs`
--

INSERT INTO `notifs` (`notif_id`, `notif_content`, `notif_from`, `notif_to`, `notif_date`, `notif_type`, `opened`) VALUES
(123, 'Zayn Malik commented on your post', 862282, 839035, 'Jul 31 2022 14:47:06', 'comment', '0'),
(124, 'Zayn Malik commented on your post', 862282, 839035, 'Jul 31 2022 15:24:05', 'comment', '0');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_content` varchar(800) NOT NULL,
  `date_posted` varchar(255) NOT NULL,
  `unique_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_content`, `date_posted`, `unique_id`) VALUES
(91, 'First Post', 'Hello guys!', 'Jul 29 2022 16:26:15', 839035),
(93, 'First Post', 'Hello guys!', 'Jul 31 2022 11:33:54', 862282),
(94, 'Second Post', 'Hello Guys!', 'Jul 31 2022 14:51:06', 862282);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `req_id` int(11) NOT NULL,
  `req_from` int(11) NOT NULL,
  `req_to` int(11) NOT NULL,
  `accepted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `pword` varchar(255) NOT NULL,
  `profile_pic` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `address`, `contact`, `email`, `uname`, `pword`, `profile_pic`) VALUES
(18, 839035, 'Liam', 'Payne', 'UK', '09877765422', 'liam@gmail.com', 'liam', 'payne123', '1659148042liam.jpg'),
(19, 862282, 'Zayn', 'Malik', 'UK', '09877765433', 'zayn@gmail.com', 'zayn', 'malik123', '1659250979zayn.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `unique_id` (`unique_id`);

--
-- Indexes for table `likers`
--
ALTER TABLE `likers`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `unique_id` (`unique_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `notifs`
--
ALTER TABLE `notifs`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`unique_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `likers`
--
ALTER TABLE `likers`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `notifs`
--
ALTER TABLE `notifs`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
