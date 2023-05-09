-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 06, 2023 at 02:02 PM
-- Server version: 5.7.23-23
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wateregm_leowa`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 3, 'Josephine N', 'jngethe2000@yahoo.com', '254722698270', '2023-02-17 08:22:21', '2023-02-17 08:22:34'),
(2, 10, 'James', 'jamesmoki@gmail.com', '254701313538', '2023-02-25 12:49:50', '2023-02-25 12:49:50'),
(4, 10, 'Ivy Mwangi', NULL, '254720768136', '2023-02-27 14:57:57', '2023-02-27 14:57:57'),
(17, 2, 'Gerald Musyoka', 'geraldmusyoka7@gmail.com', '0720768136', '2023-04-19 21:33:34', NULL),
(18, 2, 'James Moki', 'jamesmoki19@gmail.com', '0701313538', '2023-05-04 03:24:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `disbursements`
--

CREATE TABLE `disbursements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customers` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disbursements`
--

INSERT INTO `disbursements` (`id`, `user_id`, `customers`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, '{\"2\":\"2\",\"3\":\"3\"}', '20', '2023-02-25 17:31:49', '2023-02-25 17:31:49'),
(2, 2, '{\"2\":\"2\",\"3\":\"3\"}', '20', '2023-02-27 11:35:05', '2023-02-27 11:35:05'),
(3, 3, '{\"1\":\"1\",\"4\":\"4\"}', '20', '2023-02-27 14:59:36', '2023-02-27 14:59:36'),
(4, 10, '{\"2\":\"2\",\"4\":\"4\"}', '15', '2023-05-06 02:37:29', '2023-05-06 02:37:29'),
(5, 10, '{\"2\":\"2\",\"4\":\"4\"}', '10', '2023-05-06 02:49:26', '2023-05-06 02:49:26'),
(6, 10, '{\"2\":\"2\",\"4\":\"4\"}', '15', '2023-05-06 02:56:51', '2023-05-06 02:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `tariffs`
--

CREATE TABLE `tariffs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tariff` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tariffs`
--

INSERT INTO `tariffs` (`id`, `min`, `max`, `tariff`, `created_at`, `updated_at`) VALUES
(1, '0', '50', '1', '2023-02-14 19:02:55', '2023-02-25 12:55:19'),
(2, '51', '5000', '50', '2023-02-17 08:44:23', '2023-02-25 12:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `topups`
--

CREATE TABLE `topups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'topup',
  `transaction_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `third_party_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout_request_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topups`
--

INSERT INTO `topups` (`id`, `phone_number`, `amount`, `transaction_id`, `user_id`, `status`, `transaction_type`, `transaction_date`, `account_reference`, `description`, `third_party_reference`, `checkout_request_id`, `created_at`, `updated_at`) VALUES
(77, '254720768136', '1', 'RE40PL5GHG', 10, '0', 'Top up', '20230504165040', NULL, 'The service request is processed successfully.', 'NULL', 'ws_CO_04052023165030835720768136', '2023-05-04 08:20:31', '2023-05-04 08:20:31'),
(78, '254720768136', '1', 'RE45PPZL4F', 10, '0', 'Top up', '20230504173159', NULL, 'The service request is processed successfully.', 'NULL', 'ws_CO_04052023173145184720768136', '2023-05-04 09:01:45', '2023-05-04 09:01:45'),
(79, '254720768136', '1', 'RE47PTDQOZ', 10, '0', 'Top up', '20230504175841', NULL, 'The service request is processed successfully.', 'NULL', 'ws_CO_04052023175831167720768136', '2023-05-04 09:28:31', '2023-05-04 09:28:31'),
(80, '254720768136', '1', 'RE44QT9AOQ', 10, '0', 'Top up', '20230504232828', NULL, 'The service request is processed successfully.', 'NULL', 'ws_CO_04052023232818630720768136', '2023-05-04 14:58:18', '2023-05-04 14:58:18'),
(81, '254720768136', '20', 'RE48QTDOSI', 10, '0', 'Top up', '20230504233313', NULL, 'The service request is processed successfully.', 'NULL', 'ws_CO_04052023233303808720768136', '2023-05-04 15:03:04', '2023-05-04 15:03:04'),
(82, '254720768136', '10', 'RE56SDGNPG', 10, '0', 'Top up', '20230505155945', NULL, 'The service request is processed successfully.', 'NULL', 'ws_CO_05052023155936793720768136', '2023-05-05 07:29:37', '2023-05-05 07:29:37'),
(83, '254720768136', '20', 'RE61UG10E5', 10, '0', 'Top up', '20230506102759', NULL, 'The service request is processed successfully.', 'NULL', 'ws_CO_06052023102748849720768136', '2023-05-06 01:57:49', '2023-05-06 01:57:49');

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
  `role_id` int(11) NOT NULL DEFAULT '2',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_balance` int(11) DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `phone`, `wallet_balance`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', '2023-02-14 11:46:08', '$2y$10$g3T3OYNo2WR5RkSmCFkDJ.h9/UE0gxa48bYAG.CvCCz4RieF8iu6u', 1, NULL, 0, 'XfvRnjCLxvDBmtJeOB9UzbKtp8TAmdFCSTmaOgfWYFbbszrBVtM2WJ4xc7mt', '2023-02-14 11:46:08', '2023-02-14 11:46:08'),
(2, 'James Moki', 'jamesmoki19@gmail.com', NULL, '$2y$10$ogMsOKG5YnmflFrGxgPB4eTBJDUqHqxKp0gFXLDnhoE8rLNW2rfqi', 2, NULL, 15, NULL, '2023-02-14 11:50:41', '2023-04-02 08:11:54'),
(3, 'josephine', 'josephinen.ngethe@gmail.com', NULL, '$2y$10$7Wr1C9T6F1x2CiH8HafW8.yD2jeLtM6odYJcfSoo6.oECFzbBJ.Ki', 2, NULL, 483, NULL, '2023-02-17 08:17:34', '2023-02-27 14:59:37'),
(10, 'Gerald Musyoka', 'geraldmusyoka7@gmail.com', NULL, '$2y$10$4SMKytXja/hwyTLY7I/S2Ows7sdHovpYN.IsXS3B8Yb5rtjexTjB2', 2, NULL, 29, NULL, '2023-04-18 15:22:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `tariff` int(11) DEFAULT NULL,
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'withdraw',
  `transaction_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conversation_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraws`
--

INSERT INTO `withdraws` (`id`, `phone_number`, `amount`, `result_code`, `transaction_id`, `user_id`, `status`, `tariff`, `transaction_type`, `transaction_date`, `conversation_id`, `description`, `created_at`, `updated_at`) VALUES
(11, '254720768136', '10', '0', 'RBP1GY9WD7', 2, 'success', 1, 'withdraw', '2023-02-25 17:31:49', 'AG_20230225_20407d9c63db94032a1b', 'The service request is processed successfully.', '2023-02-25 17:31:49', '2023-02-25 17:31:51'),
(12, '254701313538', '10', '0', 'RBR0L5BGOI', 2, 'success', 1, 'withdraw', '2023-02-27 11:35:02', 'AG_20230227_20501db7d6af609e8d18', 'The service request is processed successfully.', '2023-02-27 11:35:02', '2023-02-27 11:35:04'),
(13, '254720768136', '10', '0', 'RBR1L5BA31', 2, 'success', 1, 'withdraw', '2023-02-27 11:35:05', 'AG_20230227_204056a816fabbd11455', 'The service request is processed successfully.', '2023-02-27 11:35:05', '2023-02-27 11:35:06'),
(18, '254720768136', '10', NULL, NULL, 10, 'pending', 1, 'withdraw', '2023-05-05 02:42:02', 'AG_20230505_202068635fa6cfffdf1a', 'Accept the service request successfully.', '2023-05-04 21:12:02', '2023-05-04 21:12:02'),
(19, '254720768136', '10', NULL, NULL, 10, 'pending', 1, 'withdraw', '2023-05-05 03:03:55', 'AG_20230505_204033d59eb0d5ee2f2f', 'Accept the service request successfully.', '2023-05-04 21:33:55', '2023-05-04 21:33:55'),
(20, '254720768136', '10', NULL, NULL, 10, 'pending', 1, 'withdraw', '2023-05-05 03:07:08', 'AG_20230505_2010610de3ecfdb024b6', 'Accept the service request successfully.', '2023-05-04 21:37:08', '2023-05-04 21:37:08'),
(21, '254720768136', '10', NULL, 'RE50QX985E', 10, '2001', 1, 'Withdraw', '2023-05-05 03:09:41', 'AG_20230505_20406cd6ddb415360724', 'The initiator information is invalid.', '2023-05-04 21:39:41', '0000-00-00 00:00:00'),
(22, '254720768136', '10', NULL, 'RE54QXCORM', 10, '8006', 1, 'Withdraw', '2023-05-05 03:14:20', 'AG_20230505_204011a0471db54f5243', 'The security credential is locked.', '2023-05-04 21:44:20', '0000-00-00 00:00:00'),
(23, '254720768136', '10', NULL, NULL, 10, 'pending', 1, 'withdraw', '2023-05-05 03:16:06', 'AG_20230505_20702c4a5a4e32b13a64', 'Accept the service request successfully.', '2023-05-04 21:46:06', '2023-05-04 21:46:06'),
(24, '254720768136', '10', NULL, 'RE56QXFH0K', 10, '8006', 1, 'Withdraw', '2023-05-05 03:18:05', 'AG_20230505_20302afa62d5607ce547', 'The security credential is locked.', '2023-05-04 21:48:05', '2023-05-04 21:48:05'),
(25, '254720768136', '10', NULL, 'RE54RXLBX4', 10, '8006', 1, 'Withdraw', '2023-05-05 10:29:39', 'AG_20230505_2060221432bdb2b2a485', 'The security credential is locked.', '2023-05-05 04:59:39', '2023-05-05 04:59:39'),
(26, '254720768136', '10', NULL, 'RE51RZ92QH', 10, '8006', 1, 'Withdraw', '2023-05-05 10:44:48', 'AG_20230505_201027a746d74525f343', 'The security credential is locked.', '2023-05-05 05:14:48', '2023-05-05 05:14:48'),
(27, '254720768136', '10', NULL, 'RE53S3ISER', 10, '0', 1, 'Withdraw', '2023-05-05 11:25:25', 'AG_20230505_206039aca32f0420e8d9', 'The service request is processed successfully.', '2023-05-05 05:55:25', '0000-00-00 00:00:00'),
(28, '254720768136', '10', NULL, 'RE56SD1342', 10, '0', 1, 'Withdraw', '2023-05-05 12:55:42', 'AG_20230505_2020275be50360c9f52b', 'The service request is processed successfully.', '2023-05-05 07:25:42', '2023-05-05 07:25:43'),
(29, '254720768136', '10', NULL, 'RE56SF8W4E', 10, '0', 1, 'Withdraw', '2023-05-05 13:16:09', 'AG_20230505_20407da3649947b7e8a7', 'The service request is processed successfully.', '2023-05-05 07:46:09', '2023-05-05 07:46:10'),
(30, '254701313538', '10', NULL, 'RE66UJVQUU', 10, '0', 1, 'Withdraw', NULL, 'AG_20230506_2020727a677d5341a034', 'The service request is processed successfully.', '2023-05-06 02:37:27', '2023-05-06 02:37:28'),
(31, '254720768136', '5', NULL, 'RE66UJW0SW', 10, '2', 1, 'Withdraw', NULL, 'AG_20230506_204042340c9916b3fcd7', 'Declined due to limit rule: less than the minimum transaction amount.', '2023-05-06 02:37:29', '2023-05-06 02:37:29'),
(32, '254701313538', '5', NULL, 'RE62UL27XE', 10, '2', 1, 'Withdraw', '2023-05-06 08:19:23', 'AG_20230506_203031b8bbb72bb71a82', 'Declined due to limit rule: less than the minimum transaction amount.', '2023-05-06 02:49:23', '2023-05-06 02:49:23'),
(33, '254720768136', '5', NULL, 'RE60UL21DS', 10, '2', 1, 'Withdraw', '2023-05-06 08:19:26', 'AG_20230506_2010778031065cf79d53', 'Declined due to limit rule: less than the minimum transaction amount.', '2023-05-06 02:49:26', '2023-05-06 02:49:26'),
(34, '254701313538', '10', NULL, 'RE65ULS2OF', 10, '0', 1, 'Withdraw', '2023-05-06 08:26:49', 'AG_20230506_204058363e21a236844b', 'The service request is processed successfully.', '2023-05-06 02:56:49', '2023-05-06 02:56:50'),
(35, '254720768136', '5', NULL, 'RE63ULS9PP', 10, '2', 1, 'Withdraw', '2023-05-06 08:26:51', 'AG_20230506_20501f0721755ebc5450', 'Declined due to limit rule: less than the minimum transaction amount.', '2023-05-06 02:56:51', '2023-05-06 02:56:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `disbursements`
--
ALTER TABLE `disbursements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topups`
--
ALTER TABLE `topups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topups_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraws_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `disbursements`
--
ALTER TABLE `disbursements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `topups`
--
ALTER TABLE `topups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `topups`
--
ALTER TABLE `topups`
  ADD CONSTRAINT `topups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD CONSTRAINT `withdraws_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
