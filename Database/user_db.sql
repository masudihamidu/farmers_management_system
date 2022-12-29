-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2022 at 11:45 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `bid` int(100) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `bank` varchar(10) NOT NULL,
  `bank_acc` bigint(15) NOT NULL,
  `gender` char(1) NOT NULL,
  `nida_no` bigint(25) NOT NULL,
  `nida_doc` varchar(50) NOT NULL,
  `fd_doc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`bid`, `first_name`, `middle_name`, `last_name`, `phone`, `bank`, `bank_acc`, `gender`, `nida_no`, `nida_doc`, `fd_doc`) VALUES
(2, 'Zacharia', 'Johnbosco', 'Mwageni', 255752820389, 'CRDB', 112233445566, 'M', 9223372036854775807, 'nida_test.pdf', 'nida_test.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `image`) VALUES
(1, 'dunstan', 'dunstanmtili@gmail.com', 'a38e14103a024431c61ac121ba87dcfd', 'dodoma_zone_295131395_607267327477708_2673812519951072123_n.jfif'),
(2, 'Zacharia Erica', 'dunstanmtili@gmail.com', 'a49dda5e484871dc4030abbfe4ecfce2', 'fred_vunjabei_271251135_154041783642724_122940511186517576_n.jpg'),
(3, 'test', 'dunstanmtili@gmail.com', 'a49dda5e484871dc4030abbfe4ecfce2', 'cust_profile.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrower`
--
ALTER TABLE `borrower`
  ADD CONSTRAINT `borrower_famer_fk` FOREIGN KEY (`bid`) REFERENCES `user_form` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
