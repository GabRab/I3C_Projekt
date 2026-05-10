-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2026 at 05:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projkov`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `imgId` int(11) NOT NULL,
  `comText` varchar(255) NOT NULL,
  `commDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comId`, `userId`, `imgId`, `comText`, `commDate`) VALUES
(1, 1, 21, 'asdds', '2026-04-26 18:01:41'),
(2, 1, 21, 'asdds', '2026-04-26 18:02:11'),
(4, 1, 21, '123', '2026-04-26 18:11:03'),
(5, 1, 21, '123', '2026-04-26 18:12:17'),
(8, 1, 26, 'ass', '2026-05-03 17:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(255) NOT NULL,
  `userId` int(255) NOT NULL,
  `imgFile` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `dateAdded` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `userId`, `imgFile`, `title`, `dateAdded`) VALUES
(21, 1, 'images/69dd2c9f78550Screenshot_20251116_003103.png', '123', '2026-04-15 20:24:21.952628'),
(22, 1, 'images/69dfe09acafe5Screenshot_20260322_220942.png', 'ader', '2026-04-15 21:01:46.831750'),
(23, 1, 'images/69f766a1e8e33Screenshot_20251116_003103.png', '12222', '2026-05-03 17:15:45.954141'),
(24, 1, 'images/69f766a69f5b2Screenshot_20251116_003103.png', '12222', '2026-05-03 17:15:50.653439'),
(25, 1, 'images/69f7677d514c8Music.webp', '1222', '2026-05-03 17:19:25.333636'),
(26, 1, 'images/69f7699089a18icon.webp', '0', '2026-05-03 17:28:16.564221'),
(27, 1, 'images/69f769f69d724icon.webp', 'asddads', '2026-05-03 17:29:58.645132'),
(28, 1, 'images/69f76a13b85cficon.webp', 'asddads', '2026-05-03 17:30:27.755449'),
(29, 1, 'images/69f76a46b1896icon.webp', 'asddads', '2026-05-03 17:31:18.727499'),
(30, 1, 'images/69f76a675ddbeicon.webp', 'asddads', '2026-05-03 17:31:51.384692'),
(31, 1, 'images/69f76a7770e30icon.webp', 'asddads', '2026-05-03 17:32:07.462670'),
(32, 1, 'images/69f76a8acca67icon.webp', 'asddads', '2026-05-03 17:32:26.838620'),
(33, 1, 'images/69f898d1b4afaheadmore.gif', 'start ending me', '2026-05-03 17:39:58.236039'),
(34, 1, 'images/69f76dc8e34bbicon.webp', 'asddads', '2026-05-03 17:46:16.931474'),
(35, 1, 'images/69f76e6f96d26icon.webp', 'asddads', '2026-05-03 17:49:03.618025'),
(36, 1, 'images/69f76edc9b505icon.webp', 'asddads', '2026-05-03 17:50:52.636478'),
(37, 1, 'images/69f76f0f731a9icon.webp', 'asddads', '2026-05-03 17:51:43.471704'),
(38, 1, 'images/69f76f357d413icon.webp', 'asddads', '2026-05-03 17:52:21.513273'),
(39, 1, 'images/69f76f63dbf4aicon.webp', 'asddads', '2026-05-03 17:53:07.901413'),
(40, 1, 'images/69f7710a0e4e7icon.webp', 'asddads', '2026-05-03 18:00:10.058888'),
(41, 1, 'images/69f771237f4b0icon.webp', 'asddads', '2026-05-03 18:00:35.521725'),
(42, 1, 'images/69f7716216f4dicon.webp', 'asddads', '2026-05-03 18:01:38.094434'),
(43, 1, 'images/69f7730c81da9icon.webp', 'asddads', '2026-05-03 18:08:44.532271'),
(44, 1, 'images/69f773237487cicon.webp', 'asddads', '2026-05-03 18:09:07.477554'),
(45, 1, 'images/69f77e21583b8icon.webp', 'asddads', '2026-05-03 18:56:01.361657'),
(46, 1, 'images/69f77ed92476ficon.webp', 'asddads', '2026-05-03 18:59:05.149613'),
(47, 1, 'images/69f77ee47170dicon.webp', 'asddads', '2026-05-03 18:59:16.464947'),
(48, 1, 'images/69f77eefa5de0icon.webp', 'asddads', '2026-05-03 18:59:27.679679'),
(49, 1, 'images/69f77efb1eba1icon.webp', 'asddads', '2026-05-03 18:59:39.126129'),
(50, 1, 'images/69f77f0d8d934icon.webp', 'asddads', '2026-05-03 18:59:57.580155'),
(51, 1, 'images/69f77f17bc562icon.webp', 'asddads', '2026-05-03 19:00:07.771697'),
(52, 1, 'images/69f77f2c7ffb9icon.webp', 'asddads', '2026-05-03 19:00:28.524602'),
(53, 1, 'images/69f77f485d570icon.webp', 'asddads', '2026-05-03 19:00:56.382651');

-- --------------------------------------------------------

--
-- Table structure for table `tagConnections`
--

CREATE TABLE `tagConnections` (
  `connId` int(11) NOT NULL,
  `imgId` int(11) NOT NULL,
  `tagId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tagConnections`
--

INSERT INTO `tagConnections` (`connId`, `imgId`, `tagId`) VALUES
(12, 41, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tagId` int(11) NOT NULL,
  `tagName` varchar(255) NOT NULL,
  `tagDesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagId`, `tagName`, `tagDesc`) VALUES
(2, 'tagger', 'tagger'),
(3, 'tag', 'tag');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userImage` varchar(255) NOT NULL DEFAULT 'userImages/default.png',
  `email` varchar(255) NOT NULL,
  `privileges` int(11) NOT NULL DEFAULT 0 COMMENT '0=user\r\n1=user with email\r\n2=moderator\r\n3=admin\r\n4=owner',
  `userCreation` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `password`, `userImage`, `email`, `privileges`, `userCreation`) VALUES
(1, 'user', '$2y$10$X2/OWpwR50I1lZZt8ctTPOFiDbWQdrC6J7OkGH6LQrqrkDbKKTkYq', 'userImages/69dfded410a88Screenshot_20260322_220942.png', '', 1, '2026-04-19'),
(2, 'name', 'pass', '', '', 0, '2026-04-19'),
(3, '123', '$2y$10$IUAgOIYwX2hXMd6vt1b/weggnC7glA5YWH9K5MPs63WTYIq5IBahW', 'userImages/default.png', '123@1', 0, '2026-04-19'),
(4, '1234', '$2y$10$GULScbA6yrfo5lZPzQvYWeuswfupaxNIlROYPVVNMM3LOjawqwOoy', 'userImages/default.png', '123@4', 0, '2026-04-19'),
(5, 'aber', '$2y$10$FH7F9S.1.ypLlFErK/5TaeNHvT4kMA9RbbSOipcL9qBvIU1d10KrG', 'userImages/default.png', '', 0, '2026-04-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `imgId` (`imgId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `foreing_usr` (`userId`);

--
-- Indexes for table `tagConnections`
--
ALTER TABLE `tagConnections`
  ADD PRIMARY KEY (`connId`),
  ADD KEY `img_fk` (`imgId`),
  ADD KEY `tag_fk` (`tagId`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagId`),
  ADD UNIQUE KEY `tagName` (`tagName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tagConnections`
--
ALTER TABLE `tagConnections`
  MODIFY `connId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`imgId`) REFERENCES `images` (`imgId`) ON DELETE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `foreing_usr` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `tagConnections`
--
ALTER TABLE `tagConnections`
  ADD CONSTRAINT `img_fk` FOREIGN KEY (`imgId`) REFERENCES `images` (`imgId`) ON DELETE CASCADE,
  ADD CONSTRAINT `tag_fk` FOREIGN KEY (`tagId`) REFERENCES `tags` (`tagId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
