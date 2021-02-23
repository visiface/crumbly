-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2021 at 12:09 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crumbly`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `usersProfileID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID`, `usersProfileID`, `usersID`, `comment`, `date`) VALUES
(1, 5, 4, 'nerd, yo a bich', '2021-01-31 16:08:00'),
(2, 5, 5, 'The fuck?', '2021-01-31 16:22:43'),
(5, 5, 4, 'You heard me', '2021-01-31 18:52:53'),
(6, 5, 4, 'bich', '2021-01-31 18:54:21'),
(7, 4, 4, 'i amc ool', '2021-01-31 18:54:39'),
(10, 5, 4, 'u cant bake', '2021-01-31 19:27:10'),
(11, 4, 5, 'meme\r\n/miːm/\r\nnoun\r\n\r\n1.\r\nan element of a culture or system of behaviour passed from one individual to another by imitation or other non-genetic means.\r\n\r\n2.\r\nan image, video, piece of text, etc., typically humorous in nature, that is copied and spread rapidly by internet users, often with slight variations.', '2021-01-31 20:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersID` int(11) NOT NULL,
  `usersUsername` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersPassword` varchar(128) NOT NULL,
  `avatar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersID`, `usersUsername`, `usersEmail`, `usersPassword`, `avatar`) VALUES
(4, 'visiface', 'visiface@live.com', '$2y$10$rp.Q/nIxMYCj3VtYPyWCCOLcJmVq.BLvQw7inFNZP9CLeVwkf/Yyu', '1e5e2fe429.jpg'),
(5, 'Tumas2', 'thomas@tums.se', '$2y$10$iT.iaX72UzXC8t7Pb.uvte/dZrCbgAjBuMoXMdYv6zHlsvNQIZMFe', '2da5d7d923.png'),
(6, 'iForgotMyPassword', 'poop@email.com', '$2y$10$NhHTQ/0Duh0yJaoP08ZW4.SEt/bc60DFmTFDhAEdsMUcqr3GyPLLK', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
