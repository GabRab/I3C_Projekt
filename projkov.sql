-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 30, 2026 at 10:12 PM
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
(8, 1, 26, 'ass', '2026-05-03 17:03:49'),
(14, 1, 33, 'I want to cry', '2026-05-30 15:12:43'),
(15, 1, 33, 'I kinda want to die as well', '2026-05-30 15:12:51'),
(16, 1, 33, 'Oh well', '2026-05-30 15:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(255) NOT NULL,
  `userId` int(255) NOT NULL,
  `imgFile` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `dateAdded` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `views` int(255) NOT NULL DEFAULT 0 COMMENT 'amount of times the picture was displayed on image.php'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `userId`, `imgFile`, `title`, `dateAdded`, `views`) VALUES
(22, 1, 'images/6a09cd870faedbush.png', 'ader', '2026-04-15 21:01:46.831750', 149),
(25, 1, 'images/69f7677d514c8Music.webp', '1222', '2026-05-03 17:19:25.333636', 29),
(26, 1, 'images/69f7699089a18icon.webp', '0', '2026-05-03 17:28:16.564221', 28),
(33, 1, 'images/69f898d1b4afaheadmore.gif', 'start ending me', '2026-05-03 17:39:58.236039', 22),
(56, 1, 'images/6a131f6e1e66fdoc.png', 'asda', '2026-05-24 17:55:26.124786', 64),
(57, 12, 'images/6a1b073b1f675blue.gif', 'I want to die', '2026-05-30 17:50:19.128918', 4),
(58, 12, 'images/6a1b0756114d0blue.gif', 'I want to die', '2026-05-30 17:50:46.071077', 4),
(59, 12, 'images/6a1b090b2dd4aBonsai_boi.png', 'bonzie buddy', '2026-05-30 17:58:03.187934', 0),
(60, 12, 'images/6a1b09353cd1dMushy_boi.png', 'mushmushi', '2026-05-30 17:58:45.249442', 7);

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
(106, 22, 2),
(109, 22, 3),
(110, 26, 6),
(112, 26, 3),
(117, 56, 3),
(118, 56, 2),
(121, 22, 5),
(122, 56, 5),
(123, 57, 3),
(124, 57, 5),
(125, 57, 10),
(126, 59, 2),
(127, 59, 3),
(128, 59, 10),
(129, 60, 2),
(130, 60, 3),
(131, 60, 8),
(132, 60, 10);

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
(3, 'tag', 'tag'),
(5, 'animation', 'animation'),
(6, 'anime', 'anime'),
(8, 'fanart', 'art made in someone\'s image'),
(10, 'retro', 'an art style mimicking that of the past ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userImage` varchar(255) NOT NULL DEFAULT 'userImages/default.png',
  `email` varchar(255) DEFAULT NULL,
  `privileges` int(11) NOT NULL DEFAULT 0 COMMENT '0=user\r\n1=user with email\r\n2=moderator\r\n3=admin\r\n4=owner',
  `userCreation` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `password`, `userImage`, `email`, `privileges`, `userCreation`) VALUES
(1, 'user', '$2y$10$X2/OWpwR50I1lZZt8ctTPOFiDbWQdrC6J7OkGH6LQrqrkDbKKTkYq', 'userImages/6a0df2bd4fbe6doc.png', 'email@email', 4, '2026-04-19'),
(3, '123', '$2y$10$IUAgOIYwX2hXMd6vt1b/weggnC7glA5YWH9K5MPs63WTYIq5IBahW', 'userImages/default.png', '123@1', 0, '2026-04-19'),
(4, '1234', '$2y$10$GULScbA6yrfo5lZPzQvYWeuswfupaxNIlROYPVVNMM3LOjawqwOoy', 'userImages/default.png', '123@4', 0, '2026-04-19'),
(5, 'aber', '$2y$10$FH7F9S.1.ypLlFErK/5TaeNHvT4kMA9RbbSOipcL9qBvIU1d10KrG', 'userImages/default.png', '', 0, '2026-04-19'),
(6, 'test', '$2y$10$1gqsktZO7uU0GxW8PIs07uvBiRivUU.NAaBQEbRiHUYxvj5l.g3uW', 'userImages/default.png', NULL, 0, '2026-05-16'),
(7, 'test2', '$2y$10$gDabTf4AtMPNwRnKvved4.W0oHJiQbMMn/TMIoh5.hKZv7RI6OGou', 'userImages/default.png', NULL, 0, '2026-05-16'),
(11, 'test6', '$2y$10$SQTo4STtR0yCII2v9HyeYOVjfjKBftz5PDl5UIwb9SEXR46VidRYe', 'userImages/default.png', NULL, 0, '2026-05-16'),
(12, 'test7', '$2y$10$7B1vG5qCvGW/yZ/C1EnkNe8fI4svGzmE8MbdfxoviadT5915eS9Vm', 'userImages/default.png', NULL, 0, '2026-05-30');

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
  MODIFY `comId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tagConnections`
--
ALTER TABLE `tagConnections`
  MODIFY `connId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `foreing_usr` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

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
