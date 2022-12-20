-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2022 at 03:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` smallint(6) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `isActive` tinyint(4) DEFAULT 1,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `host`, `port`, `email`, `password`, `token`, `lang`, `isActive`, `rank`, `createdAt`, `updatedAt`) VALUES
(1, '78.142.211.12', 90, 'ylcnirmak@ytd.com.tr', '1453', 'd7c5764e-67ec-48b1-91d6-390f5aa96b09', 'tr', 1, 1, '2022-12-19 11:00:49', '2022-12-20 13:49:24'),
(2, '185.210.92.173', 90, 'mutfak@mutfak.com', '14531453', '62c61deb-9bff-4b6f-91da-29647ed6c584', 'tr', 1, 2, '2022-12-19 11:05:11', '2022-12-20 13:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `protocol` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` smallint(6) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `isActive` tinyint(4) DEFAULT 1,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `protocol`, `host`, `port`, `email`, `password`, `lang`, `isActive`, `rank`, `createdAt`, `updatedAt`) VALUES
(1, 'ssl', 'smtp.yandex.com.tr', 465, 'emrekilic@mutfakyapim.com', 'my12345', 'tr', 1, 1, '2022-11-25 08:17:48', '2022-11-25 08:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `top_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `target` enum('_self','_blank','_parent','_top') DEFAULT '_self',
  `position` enum('HEADER','HEADER_RIGHT','MOBILE','FOOTER','FOOTER2') DEFAULT 'HEADER',
  `lang` char(2) DEFAULT 'tr',
  `rank` int(11) DEFAULT 0,
  `isActive` tinyint(4) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `codes_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `seo_url` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `vat` int(11) DEFAULT 8,
  `stock` int(11) DEFAULT 0,
  `lang` char(2) DEFAULT 'tr',
  `isActive` tinyint(4) DEFAULT 1,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `codes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `top_id` int(11) DEFAULT NULL,
  `codes_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `seo_url` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `banner_url` varchar(255) DEFAULT NULL,
  `lang` char(2) DEFAULT 'tr',
  `rank` int(11) DEFAULT 0,
  `isActive` tinyint(4) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `codes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `top_id`, `codes_id`, `title`, `seo_url`, `img_url`, `banner_url`, `lang`, `rank`, `isActive`, `createdAt`, `updatedAt`, `codes`) VALUES
(13, NULL, 1, ' xvxcvxcv', NULL, NULL, NULL, 'tr', 0, 1, '2022-12-05 14:36:29', '2022-12-05 14:36:29', NULL),
(14, 13, 2, 'czxc', NULL, NULL, NULL, 'tr', 1, 1, '2022-12-05 14:36:29', '2022-12-05 14:38:21', NULL),
(15, NULL, 3, ' xvxcvxcvvcbvre', NULL, NULL, NULL, 'tr', 0, 1, '2022-12-05 14:36:29', '2022-12-05 14:36:29', NULL),
(18, 15, 1, ' xvxcvxcv', NULL, NULL, NULL, 'tr', 1, 1, '2022-12-05 14:36:29', '2022-12-07 09:36:12', NULL),
(19, 13, 2, 'czxc', NULL, NULL, NULL, 'tr', 1, 1, '2022-12-05 14:36:29', '2022-12-05 14:38:21', NULL),
(20, 18, 3, ' xvxcvxcvvcbvre', NULL, NULL, NULL, 'tr', 1, 1, '2022-12-05 14:36:29', '2022-12-07 09:36:14', NULL),
(21, 20, 1, ' xvxcvxcv', NULL, NULL, NULL, 'tr', 1, 1, '2022-12-05 14:36:29', '2022-12-07 09:36:16', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isActive` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive ',
  `role_id` int(11) DEFAULT 2,
  `rank` int(11) DEFAULT 1,
  `lang` char(2) DEFAULT 'tr'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `createdAt`, `updatedAt`, `isActive`, `role_id`, `rank`, `lang`) VALUES
(1, 'Emre', 'KILIÇ', 'emrekilic@mutfakyapim.com', '0a7483867a2442352e2b86d4b4910826', '05494410120', '2022-10-07 11:20:08', '2022-10-12 13:44:59', 1, 1, 1, 'tr'),
(2, 'Emre', 'KILIÇ2', 'emrekilic2@mutfakyapim.com', '0a7483867a2442352e2b86d4b4910826', '05494410121', '2022-10-07 11:20:08', '2022-11-25 14:01:02', 1, 2, 2, 'tr');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `codes_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT 'Türkiye',
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `quarter` varchar(255) DEFAULT NULL,
  `addresss` longtext DEFAULT NULL,
  `tax_no` varchar(12) DEFAULT NULL,
  `tax_administration` varchar(255) DEFAULT NULL,
  `id_no` varchar(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `company_name` varchar(1000) DEFAULT NULL,
  `first_name` varchar(70) DEFAULT NULL,
  `last_name` varchar(70) DEFAULT NULL,
  `address_type` enum('Individual','Corporate') DEFAULT 'Individual',
  `isActive` tinyint(4) DEFAULT 1,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `isActive` tinyint(4) DEFAULT 1,
  `isCover` tinyint(4) DEFAULT 0,
  `rank` int(11) DEFAULT 1,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `title`, `permissions`, `isActive`, `isCover`, `rank`, `createdAt`, `updatedAt`) VALUES
(1, 'Admin', '{\"AuthController\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"CodesController\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"EmailSettingsController\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"ProductCategoriesController\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"ProductsController\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"SettingsController\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"UserRolesController\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"UsersController\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"FrontendAuthController\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"Welcome\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"}}', 1, 1, 1, '2022-11-28 09:26:09', '2022-12-19 10:32:50'),
(2, 'Kullanıcı', NULL, 1, 1, 2, '2022-11-28 09:26:09', '2022-11-29 11:50:10'),
(3, 'Bayi', NULL, 1, 1, 3, '2022-11-28 09:26:29', '2022-11-29 11:50:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
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
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USER_ID` (`user_id`),
  ADD KEY `INDEX_TAX_NO` (`tax_no`),
  ADD KEY `INDEX_ID_NO` (`id_no`),
  ADD KEY `INDEX_CODES_ID` (`codes_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `FK_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
