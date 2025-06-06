-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2025 at 02:03 AM
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
-- Database: `MovieTracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_published` date NOT NULL,
  `director` varchar(255) NOT NULL,
  `starring` varchar(255) NOT NULL,
  `watched` tinyint(1) NOT NULL DEFAULT 0,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `date_published`, `director`, `starring`, `watched`, `rating`) VALUES
(2, 'Burn After Reading', '2008-09-12', 'Ethan Coen', 'John Malkovich, Frances McDormand, Brad Pitt', 0, NULL),
(3, 'Click', '2006-06-23', 'Frank Coraci', 'Adam Sandler, Christopher Walken', 0, NULL),
(5, 'No Country for Old Men', '2007-11-21', 'Joel Coen, Ethan Coen', 'Tommy Lee Jones, Javier Bardem, Josh Brolin', 1, NULL),
(6, 'The Hunt for Red October', '1990-03-20', 'John McTiernan', 'Sean Connery, Alec Baldwin, Scott Glenn', 0, NULL),
(7, 'Risky Business', '1983-06-13', 'Paul Brickman', 'Tom Cruise, Rebecca De Mornay, Joe Pantoliano', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
