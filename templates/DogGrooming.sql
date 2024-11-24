-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 18, 2024 at 10:33 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DogGrooming`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookGroom`
--

CREATE TABLE `bookGroom` (
  `id` int(11) NOT NULL,
  `fName` varchar(255) DEFAULT NULL,
  `lName` varchar(255) DEFAULT NULL,
  `dogName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `groomDate` date DEFAULT NULL,
  `dropOff` time DEFAULT NULL,
  `clipStyle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookGroom`
--

INSERT INTO `bookGroom` (`id`, `fName`, `lName`, `dogName`, `email`, `mobile`, `groomDate`, `dropOff`, `clipStyle`) VALUES
(1, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL),
(2, 'petra', 'kovacs', 'bobo', 'petranella.kovac@gmail.com', '0421699789', '2024-10-24', '10:00:00', 'dayout');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` tinytext,
  `imageurl` text,
  `comment` text,
  `websiteurl` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `imageurl`, `comment`, `websiteurl`) VALUES
(3, 'Barry in the park', 'https://images.pexels.com/photos/1254140/pexels-photo-1254140.jpeg?auto=compress&cs=tinysrgb&w=800', 'Barry after a clip in the park', 'https://www.nationalgeographic.com/animals/mammals/facts/domestic-dog');

-- --------------------------------------------------------

--
-- Table structure for table `tblEmailList`
--

CREATE TABLE `tblEmailList` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `uidUsers` tinytext,
  `emailUsers` tinytext,
  `pwdUsers` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `uidUsers`, `emailUsers`, `pwdUsers`) VALUES
(1, 'Daniel', 'Daniel@Daniel.com', '$2y$10$t0ir2VGFLloikzk5XKh4w.yL7wT/Ckg1sDS2/vriVkbdPnKJbyUVO'),
(2, 'Petranella', 'pkovacs@student.holmesglen.edu.au', '$2y$10$rqXVgdCuKnUDVTUjyIq3/eTVdfhfMZyGrho6bM8sffXbQWISap9hS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookGroom`
--
ALTER TABLE `bookGroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookGroom`
--
ALTER TABLE `bookGroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
