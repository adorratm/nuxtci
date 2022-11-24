-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 03:48 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `excellencehali`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `protocol` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` smallint(6) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` int(255) DEFAULT NULL,
  `tomail` varchar(255) DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `isActive` tinyint(4) DEFAULT 1,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `mobile_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `medium` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `analytics` longtext DEFAULT NULL,
  `metrica` longtext DEFAULT NULL,
  `live_support` longtext DEFAULT NULL,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isActive` tinyint(1) DEFAULT 1,
  `lang` char(2) DEFAULT 'tr',
  `address_informations` longtext DEFAULT NULL,
  `appstore` varchar(255) DEFAULT NULL,
  `playstore` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `slogan`, `logo`, `mobile_logo`, `favicon`, `email`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `medium`, `pinterest`, `meta_keywords`, `meta_description`, `analytics`, `metrica`, `live_support`, `rank`, `createdAt`, `updatedAt`, `isActive`, `lang`, `address_informations`, `appstore`, `playstore`) VALUES
(1, 'Excellence Halı', '', '4e8e3222fe61843042e69a25d6535267.webp', '2986aca27c89e7c815b6acdc65ab23ea.webp', 'fee73d93b265a4cb801c6282b65687cf.webp', 'emrekilic@mutfakyapim.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-11-07 13:18:03', '2022-11-08 11:19:00', 1, 'tr', '\"[{\\\"address\\\":\\\"H\\u00fcrriyet, 35473 Menderes\\/\\u0130zmir\\\",\\\"map\\\":\\\"<iframe class=\\\\\\\"lazy\\\\\\\" data-src=\\\\\\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3131.719034905321!2d27.13809241498435!3d38.2860053903549!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14bbe044e28b9981%3A0xe19993c774170db9!2sYal%C3%A7inkaya%20Hali!5e0!3m2!1sen!2str!4v1667826978115!5m2!1sen!2str\\\\\\\" width=\\\\\\\"600\\\\\\\" height=\\\\\\\"450\\\\\\\" style=\\\\\\\"border:0;\\\\\\\" allowfullscreen=\\\\\\\"\\\\\\\" loading=\\\\\\\"lazy\\\\\\\" referrerpolicy=\\\\\\\"no-referrer-when-downgrade\\\\\\\"><\\/iframe>\\\",\\\"phones\\\":[{\\\"phone\\\":\\\"+90 232 431 03 51\\\",\\\"whatsapp\\\":\\\"+90 507 992 72 07\\\",\\\"fax\\\":\\\"+90 232 431 03 98\\\"}]}]\"', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive ',
  `role_id` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `created`, `modified`, `status`, `role_id`) VALUES
(1, 'Emre', 'KILIÇ', 'emrekilic@mutfakyapim.com', '0a7483867a2442352e2b86d4b4910826', '05494410120', '2022-10-07 11:20:08', '2022-10-12 13:44:59', 1, 1),
(2, 'Emre', 'KILIÇ2', 'emrekilic2@mutfakyapim.com', '0a7483867a2442352e2b86d4b4910826', '05494410121', '2022-10-07 11:20:08', '2022-10-12 13:44:59', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
