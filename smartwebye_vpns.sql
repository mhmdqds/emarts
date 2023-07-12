-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2023 at 10:35 AM
-- Server version: 10.3.36-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartwebye_vpns`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@email.com', NULL, '$2y$10$J/b8wFS5M5UcFrZqwWyCHOPTV2XqEkkwZeK3EuFrcSrDpz/kSyycS', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vpnserver`
--

CREATE TABLE `vpnserver` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config_udp` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `config_tcp` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vpnserver`
--

INSERT INTO `vpnserver` (`id`, `name`, `flag`, `country`, `config_udp`, `config_tcp`, `slug`, `username`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'canda', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'canda', '219.100.37.178 443', NULL, 'vq6f58GAF2DUG4KukZZFTtKAKv3O5iSgkzlaKVHNQT1enC0JMm8VUUPfDJ8WOVi5', 'freevpn4you', '2577498', 0, '2022-12-25 02:07:11', '2022-12-25 02:07:11'),
(2, 'france', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'france', '51.68.191.75', NULL, '6PK5uky6xIjFiBi7okgN5qsmXk8T8vruhn41VERhUJwTuGVdbFunVu5GqUkeA7fv', 'freevpn4you', '6455442', 0, '2022-12-25 02:07:57', '2022-12-25 02:07:57'),
(3, 'ukrain', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'canda', '205.185.119.100', NULL, 'HYWy5q9ycRbLglUVuhdvv7ADyKmP9RksvAUUkyg0cpzgH8rNj4hIc16hhqi1r4k2', 'freevpn4you', '1907526', 0, '2022-12-25 02:08:44', '2022-12-25 02:08:44'),
(4, 'USA', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'USA', '51.68.191.75', NULL, 'aLpEXNRFnzACLA3J68mRIHtk4CgTOyCqjbGHELKMzowzPbcEZeo5IxbHrR6oeqES', 'vpn', 'qazwsxedc', 0, '2022-12-25 02:14:14', '2022-12-25 02:14:14'),
(5, 'canada', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'canada', '51.68.191.75', NULL, 'wvtMqcm96gZ6IbEUs6wzCZB2qfgVDN4j24J2ijrtMgvZz30OJH0Y2F9AmkIJhqpb', 'vpn', 'qazwsxedc', 0, '2022-12-25 02:14:50', '2022-12-25 02:14:50'),
(6, 'Australia', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'Australia', '51.68.191.75', NULL, 'llkms5azzf6AcZgPinYmsQMV8cDqrPVZI1xTjXnYcOQWNfuOqnvpq9LK5s7BVhHW', 'vpn', 'qazwsxedc', 0, '2022-12-25 02:15:44', '2022-12-25 02:15:44'),
(7, 'Singapore', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'Singapore', '51.68.191.75', NULL, 'vW89BiP3ruoQGHf5wVgF2JEYJzLd9ajiXSFum2zcIBThnjPYDKxnDchkW3b4VbIF', 'vpn', 'qazwsxedc', 0, '2022-12-25 02:17:05', '2022-12-25 02:17:05'),
(8, 'switzerland', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'switzerland', '51.68.191.75', NULL, '3KONS2pOzBKqyF0aqYPr6GldO9BxhAfImtHrF3N4oX7jARTUydDTIH5OIpMrPZSU', 'vpn', 'qazwsxedc', 0, '2022-12-25 02:17:36', '2022-12-25 02:17:36'),
(9, 'Netherlands', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'Netherlands', '51.68.191.75', NULL, '27ZUQ87gEWm6ycX2FtRyCs49RITCWu7L2redZFpszWj3K4ZTWdIGPGk6BkRFyt73', 'vpn', 'qazwsxedc', 0, '2022-12-25 02:18:07', '2022-12-25 02:18:07'),
(10, 'Germany', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'Germany', '51.68.191.75', NULL, '4WjNGFS66LGkOKcXW4ObUfYNn1Lbhfvm4c0U55QO6e0le7DlZKjK0E6tGCX9E1FI', 'vpn', 'qazwsxedc', 0, '2022-12-25 02:18:37', '2022-12-25 02:18:37'),
(11, 'Italy', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'Italy', '51.68.191.75', NULL, 'wH3evmM6lOcQgopK9NCbutWRo1MrR9Rr3ec5PxUG8Qf3cGUPPkXbI403FQ69WoeI', 'vpn', 'qazwsxedc', 0, '2022-12-25 02:19:10', '2022-12-25 02:19:10'),
(12, 'Japan', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'Japan', '219.100.37.209', NULL, '16iBjNT4S119baoWl84c8TotMd898oaUrTwyVH1viz8W9cECnd5Dp3Mkpr2hF3xH', NULL, NULL, 0, '2022-12-25 02:34:36', '2022-12-25 02:34:36'),
(13, 'United States', 'https://www.countryflags.com/wp-content/uploads/united-states-of-america-flag-png-large.png', 'United States', '173.233.73.3', NULL, 'cgoU3g0o8gLp9crATl3ImGvMrcdCmdkvzIfL5s1keTCYqROHuGwUvh4aq5LYUNTg', NULL, NULL, 0, '2022-12-25 02:36:05', '2022-12-25 02:36:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vpnserver`
--
ALTER TABLE `vpnserver`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vpnserver_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vpnserver`
--
ALTER TABLE `vpnserver`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
