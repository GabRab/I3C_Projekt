-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2026 at 08:28 PM
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
(5, 1, 21, '123', '2026-04-26 18:12:17');

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
(22, 1, 'images/69dfe09acafe5Screenshot_20260322_220942.png', 'ader', '2026-04-15 21:01:46.831750');

-- --------------------------------------------------------

--
-- Table structure for table `tagConnections`
--

CREATE TABLE `tagConnections` (
  `connId` int(11) NOT NULL,
  `imgId` int(11) NOT NULL,
  `tagId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `telephone` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `privileges` int(11) NOT NULL DEFAULT 0 COMMENT '-1=admin\r\n0=user\r\n1=user with email',
  `userCreation` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `password`, `userImage`, `telephone`, `email`, `privileges`, `userCreation`) VALUES
(1, 'user', '$2y$10$X2/OWpwR50I1lZZt8ctTPOFiDbWQdrC6J7OkGH6LQrqrkDbKKTkYq', 'userImages/69dfded410a88Screenshot_20260322_220942.png', '', '', 1, '2026-04-19'),
(2, 'name', 'pass', '', '', '', 0, '2026-04-19'),
(3, '123', '$2y$10$IUAgOIYwX2hXMd6vt1b/weggnC7glA5YWH9K5MPs63WTYIq5IBahW', 'userImages/default.png', '123', '123@1', 0, '2026-04-19'),
(4, '1234', '$2y$10$GULScbA6yrfo5lZPzQvYWeuswfupaxNIlROYPVVNMM3LOjawqwOoy', 'userImages/default.png', '1234', '123@4', 0, '2026-04-19'),
(5, 'aber', '$2y$10$FH7F9S.1.ypLlFErK/5TaeNHvT4kMA9RbbSOipcL9qBvIU1d10KrG', 'userImages/default.png', '', '', 0, '2026-04-19');

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
  ADD PRIMARY KEY (`tagId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tagConnections`
--
ALTER TABLE `tagConnections`
  MODIFY `connId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`imgId`) REFERENCES `images` (`imgId`);

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
