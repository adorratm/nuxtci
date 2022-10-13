-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2022 at 04:39 PM
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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `map` varchar(1000) DEFAULT NULL,
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
  `lang` char(2) DEFAULT 'tr'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `slogan`, `address`, `map`, `logo`, `mobile_logo`, `favicon`, `email`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `medium`, `pinterest`, `meta_keywords`, `meta_description`, `analytics`, `metrica`, `live_support`, `rank`, `createdAt`, `updatedAt`, `isActive`, `lang`) VALUES
(1, 'Gülkaymak Zade Market &amp; Şarküteri', 'Gülkaymak Zade Market &amp; Şarküteri', '																																								Bozyaka, 3055. Sk. No: 27/A, 35110 Karabağlar/İzmir																														', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12509.350795866814!2d27.1189267!3d38.3874402!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3e727858f92fcd69!2sG%C3%BClkaymak%20Zade%20Market%20ve%20%C5%9Eark%C3%BCteri!5e0!3m2!1sen!2str!4v1658740746591!5m2!1sen!2str\" width=\"100%\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '97647af947123c24225dd1ff2a62f200.webp', '4d8f7a1f1bd149219097e721c59808de.webp', '5decacea18d27787a1f7f5f8be246fe6.webp', 'info@gulkaymakzade.com.tr', 'https://www.facebook.com/gulkaymakzadesarkuteri/', NULL, 'https://www.instagram.com/gulkaymakzade/', NULL, NULL, NULL, NULL, 'düğün paketi, koltuk takımı, yatak odası, yemek odası, genç odası, mobilya aksesuar', 'Armento Mobilya, mobilya sektöründeki 20 yıldan fazla tecrübesi ve birikimiyle hizmet hayatına başlamıştır. Ürün çeşitliliği, kalitesi ve tasarımlarıyla İzmir’ de yeni bir soluk olan firmamız; İzmir Mobilya Firmaları arasında yerini almıştır.', '', '', '', 1, '2020-07-22 20:57:22', '2022-07-28 15:04:00', 1, 'tr');

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
