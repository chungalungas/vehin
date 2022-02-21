-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2022 at 11:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehin_db`
--
CREATE DATABASE IF NOT EXISTS `vehin_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vehin_db`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(2048) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `created`, `modified`) VALUES
(1, 'Mike', 'Dalisay', 'mike@codeofaninja.com', '$2y$10$9bcfsOMvx86.8CzOzrrHkurjX1wfPaHkyh.CmmgmcvAkF.epsX4Tu', '2022-02-14 21:36:28', '2022-02-15 03:36:28'),
(2, 'Fernando', 'Olvera', 'ferolverac@gmail.com', '$2y$10$ZHSvjjyWHftFphRiOGLUI.tqfEyeDeDxY9JiYYAqfjm1voNlankOa', '2022-02-14 22:43:45', '2022-02-15 04:43:45'),
(3, 'Juan', 'Perez', 'jperez@myemail.com', '$2y$10$mnmQRpD1VXo/Ab26nm2v5OwejzHQZvWzyNYuyaEjYDAKqNbhujgkG', '2022-02-15 20:53:21', '2022-02-16 02:53:21'),
(4, 'Jose', 'Ramirez', 'jramirez@myemail.com', '$2y$10$5S5bNusM54zfgRrC31MHX.Zims9BBp82ePcNiopI31oRmp7mcnF7y', '2022-02-15 23:37:51', '2022-02-16 05:37:51'),
(5, 'User 1', 'Test', 'tuser1@myemail.com', '$2y$10$tiI0VYnYDdznYGYj6Ls4V.V8kM0XP/gww/UhSQcpuelXVBVbTgQS.', '2022-02-17 22:20:22', '2022-02-18 04:20:22'),
(6, 'User 2', 'Test', 'tuser2@myemail.com', '$2y$10$0l40e1/N3p6h6Xm.WO0dqukMmQoZMsI4.9LX9D8nsbgiVMay0R6Tu', '2022-02-17 22:21:02', '2022-02-18 04:21:02'),
(7, 'User 2', 'Test', 'tuser2@myemail.com', '$2y$10$gFL55xPOUk3FT7ix6Nz/yOlugWZCH/wxPFXNcF.f5Bv.cv34WO.lS', '2022-02-17 22:21:17', '2022-02-18 04:21:17'),
(8, 'User 3', 'Test', 'tuser3@myemail.com', '$2y$10$nS4USrUdOD/O.1r.nlJo5u7Q0xhksZEtnyg7eY1sWHzsM8eH5YO0a', '2022-02-17 22:22:28', '2022-02-18 04:22:28'),
(9, 'User 4', 'Test', 'tuser4@myemail.com', '$2y$10$F.UoaFwnFVSm5EUPJ5OQMOmbogohJt0seNF4sqGFMmhsbHQ03xtVO', '2022-02-17 22:33:02', '2022-02-18 04:33:02'),
(10, 'User 5', 'Test', 'tuser5@myemail.com', '$2y$10$FLsnVCKjFpVWOXgUsPlpV.G.O6eRGpgBDn4Y26yjvW.vLNePWJ.me', '2022-02-17 22:35:04', '2022-02-18 04:35:04'),
(11, 'User 6', 'Test', 'tuser6@myemail.com', '$2y$10$YaqAzsZSO67tS2.NsLwX6eCtRucY6lBCR0IwyBPzNHtUJZBwsHwPG', '2022-02-17 22:36:41', '2022-02-18 04:36:41'),
(12, 'User 7', 'Test', 'tuser7@myemail.com', '$2y$10$Tq5DwdHotUkZ8Uoa72cMjegTLobU/SeDbhEGcwaFY9J/duZfEJ1bK', '2022-02-17 22:42:12', '2022-02-18 04:42:12'),
(13, 'admin', 'admin', 'admin@gmail.com', '$2y$10$Tx/qtNIQehAFp6GLfkhltuXrf8TOMnVjYZpOnSJ4024M7Cga2IzYy', '2022-02-21 15:29:28', '2022-02-21 21:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `type` set('Sedan','Bike') NOT NULL,
  `wheels` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `create_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `vehicles`
--

TRUNCATE TABLE `vehicles`;
--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `type`, `wheels`, `hp`, `create_timestamp`) VALUES
(1, 'Sedan', 4, 88, '2022-02-19 04:55:54'),
(2, 'Sedan', 4, 88, '2022-02-19 04:55:58'),
(3, 'Sedan', 4, 88, '2022-02-19 05:03:21'),
(4, 'Bike', 2, 21, '2022-02-19 05:04:01'),
(5, 'Bike', 2, 21, '2022-02-19 05:05:01'),
(6, 'Sedan', 4, 88, '2022-02-21 17:45:18'),
(7, 'Bike', 4, 18, '2022-02-21 17:45:33'),
(8, 'Bike', 2, 0, '2022-02-21 17:53:39'),
(9, 'Bike', 2, 0, '2022-02-21 17:54:17'),
(10, 'Sedan', 4, 88, '2022-02-21 17:54:23'),
(11, 'Bike', 2, 0, '2022-02-21 17:55:02'),
(12, 'Sedan', 4, 90, '2022-02-21 18:29:18'),
(13, 'Sedan', 4, 200, '2022-02-21 18:32:14'),
(14, 'Bike', 2, 11, '2022-02-21 18:32:58'),
(15, 'Bike', 2, 15, '2022-02-21 18:34:44'),
(16, 'Bike', 2, 0, '2022-02-21 18:35:09'),
(17, 'Bike', 2, 0, '2022-02-21 18:36:14'),
(18, 'Bike', 2, 15, '2022-02-21 18:39:18'),
(19, 'Sedan', 4, 50, '2022-02-21 18:40:08'),
(20, 'Bike', 2, 23, '2022-02-21 18:44:58'),
(21, 'Sedan', 4, 123, '2022-02-21 18:45:42'),
(22, 'Bike', 2, 23, '2022-02-21 21:16:20'),
(23, 'Bike', 2, 31, '2022-02-21 21:29:01'),
(24, 'Sedan', 4, 88, '2022-02-21 22:18:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
