-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2026 at 11:33 PM
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
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(255) NOT NULL,
  `userId` int(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `dateAdded` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `userId`, `file`, `title`, `dateAdded`) VALUES
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
  `tagValue` varchar(255) NOT NULL,
  `tagDesc` varchar(255) NOT NULL COMMENT 'use later for distinguishing between user tags and normal tags with set descriptions'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'userImages/default.png',
  `telephone` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `privileges` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `image`, `telephone`, `email`, `privileges`) VALUES
(1, 'user', '$2y$10$X2/OWpwR50I1lZZt8ctTPOFiDbWQdrC6J7OkGH6LQrqrkDbKKTkYq', 'userImages/69dfded410a88Screenshot_20260322_220942.png', '', '', 0),
(2, 'name', 'pass', '', '', '', 0),
(3, '123', '$2y$10$IUAgOIYwX2hXMd6vt1b/weggnC7glA5YWH9K5MPs63WTYIq5IBahW', 'userImages/default.png', '123', '123@1', 0),
(4, '1234', '$2y$10$GULScbA6yrfo5lZPzQvYWeuswfupaxNIlROYPVVNMM3LOjawqwOoy', 'userImages/default.png', '1234', '123@4', 0),
(5, 'aber', '$2y$10$FH7F9S.1.ypLlFErK/5TaeNHvT4kMA9RbbSOipcL9qBvIU1d10KrG', 'userImages/default.png', '', '', 0);

--
-- Indexes for dumped tables
--

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
  ADD KEY `foreing_tag` (`tagId`),
  ADD KEY `foreing_img` (`imgId`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `tagId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `foreing_usr` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `tagConnections`
--
ALTER TABLE `tagConnections`
  ADD CONSTRAINT `foreing_img` FOREIGN KEY (`imgId`) REFERENCES `images` (`imgId`),
  ADD CONSTRAINT `foreing_tag` FOREIGN KEY (`tagId`) REFERENCES `tags` (`tagId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
