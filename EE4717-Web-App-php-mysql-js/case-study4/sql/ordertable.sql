-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2017 at 01:33 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f35ee`
--

-- --------------------------------------------------------

--
-- Table structure for table `ordertable`
--

CREATE TABLE `ordertable` (
  `id` int(11) NOT NULL,
  `qty1` int(3) NOT NULL,
  `qty2` int(3) NOT NULL,
  `qty3` int(3) NOT NULL,
  `qty4` int(3) NOT NULL,
  `qty5` int(3) NOT NULL,
  `earn1` double NOT NULL,
  `earn2` double NOT NULL,
  `earn3` double NOT NULL,
  `earn4` double NOT NULL,
  `earn5` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordertable`
--

INSERT INTO `ordertable` (`id`, `qty1`, `qty2`, `qty3`, `qty4`, `qty5`, `earn1`, `earn2`, `earn3`, `earn4`, `earn5`, `date`) VALUES
(17, 3, 5, 11, 10, 20, 6, 15, 33, 47.5, 115, '2017-10-23'),
(18, 7, 0, 1, 5, 1, 14, 0, 3, 23.75, 5.75, '2017-10-20'),
(19, 2, 1, 0, 0, 0, 4, 3, 0, 0, 0, '2017-10-21'),
(20, 0, 0, 4, 0, 0, 0, 0, 12, 0, 0, '2017-10-24'),
(21, 0, 0, 0, 1, 0, 0, 0, 0, 4.75, 0, '2017-10-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ordertable`
--
ALTER TABLE `ordertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ordertable`
--
ALTER TABLE `ordertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
