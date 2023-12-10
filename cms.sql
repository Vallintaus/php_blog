-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2023 at 11:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Meat'),
(2, 'Chicken'),
(5, 'Fish'),
(18, 'Vegetarian');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(52, 42, 'test', 'test@test.com', '345345345345345', 'approved', '2023-11-28'),
(53, 42, 'test', 'test@test.com', 'ethertyh we5y4 h', 'approved', '2023-11-28'),
(54, 41, 'test', 'test@test.com', 'dthrt hrth rth', 'approved', '2023-11-28'),
(55, 41, 'test', 'test@test.com', 'rthrth44h44h4h4h', 'approved', '2023-11-28'),
(56, 41, 'test', 'test@test.com', '00000000', 'approved', '2023-11-28'),
(59, 59, 'test', 'test@test.com', 'asd', 'approved', '2023-12-08'),
(60, 59, 'test', 'test@test.com', 'asdasd', 'approved', '2023-12-10'),
(61, 59, 'test', 'test@test.com', 'dfgdfg', 'approved', '2023-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(12, 43, 54),
(27, 43, 52),
(37, 43, 53),
(38, 43, 44),
(44, 43, 55),
(46, 43, 59);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(6) NOT NULL DEFAULT 0,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_view_count` int(11) NOT NULL DEFAULT 0,
  `post_likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_view_count`, `post_likes`) VALUES
(39, 1, 'TEST', 'test', '2023-11-28', '12578484c5f16c8.png', 'asdad asd asd asd asd asd asd asd ad asd ad asd', 'asdad', 0, 'published', 2, 1),
(41, 1, 'Kikkeliskokkelis', 'test', '2023-11-28', 'Kävelykatu.jpg', 'ADGAE HSETHSRTGH DRThdrthdr th rth RDTHD FRHDRTH drth drth', 'KATU', 0, 'published', 0, 0),
(42, 1, 'TEST', 'test', '2023-11-28', '12578484c5f16c8.png', 'asdad asd asd asd asd asd asd asd ad asd ad asd', 'asdad', 0, 'published', 0, 0),
(43, 18, 'test22222', 'test', '2023-12-04', 'github.png', 'anfaoifhadoif', 'PHP', 0, 'published', 0, 0),
(44, 1, 'kalle', 'test', '2023-11-30', 'beach.png', 'sdoigjsoigsigsdg', 'PHP', 0, 'published', 2, 1),
(52, 1, 'kalle', 'test', '2023-12-04', 'beach.png', 'sdoigjsoigsigsdg', '', 0, 'published', 7, 1),
(53, 1, 'test22222', 'test', '2023-11-30', 'github.png', 'anfaoifhadoif', 'PHP', 0, 'published', 20, 1),
(54, 5, 'TEST', 'test', '2023-12-04', '12578484c5f16c8.png', 'asdad asd asd asd asd asd asd asd ad asd ad asd', 'asdad', 0, 'published', 3, 1),
(55, 1, 'Kikkeliskokkelis', 'test', '2023-12-04', 'Kävelykatu.jpg', 'ADGAE HSETHSRTGH DRThdrthdr th rth RDTHD FRHDRTH drth drth', 'KATU', 0, 'published', 37, 1),
(59, 5, 'TEST', 'test', '2023-12-04', '12578484c5f16c8.png', 'asdad asd asd asd asd asd asd asd ad asd ad asd', 'asdad', 0, 'published', 77, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(43, 'test', '$2y$10$hRx/MAq4cCPlq6rQ4b0xOey18U5Nu7vVlciNBhlbjnxY5NLsnH3L6', 'test', 'test', 'test@test.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(97, 'testi', '$2y$10$sTXgMrjQWehec647quFVFeg3hhDaL99hRw1T12dsKvebOKcWQ/Lje', '', '', 'testi@gamil.com', '', 'user', '$2y$10$iusesomecrazystrings22'),
(98, 'test2', '$2y$10$comxWExbqlIby82UeFPAle99lS/x2ZE/99hhiF.07/ryPa2qbAoKC', '', '', 'test2@gmail.com', '', 'user', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `online_id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`online_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `online_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56539;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
