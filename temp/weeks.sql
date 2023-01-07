-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 يناير 2023 الساعة 19:20
-- إصدار الخادم: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fullcalendar3`
--

-- --------------------------------------------------------

--
-- بنية الجدول `weeks`
--

CREATE TABLE `weeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `weeks`
--

INSERT INTO `weeks` (`id`, `title`, `start`, `end`, `semester_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ف2 - الأسبوع الأول', '2022-12-04', '2022-12-08', 2, 1, '2023-01-07 15:15:45', '2023-01-07 15:15:45'),
(2, 'ف2 - الأسبوع الثاني', '2022-12-11', '2022-12-15', 2, 1, '2023-01-07 15:16:18', '2023-01-07 15:16:18'),
(3, 'ف2 - الأسبوع الثالث', '2022-12-18', '2022-12-22', 2, 1, '2023-01-07 15:16:57', '2023-01-07 15:16:57'),
(4, 'ف2 - الأسبوع الرابع', '2022-12-25', '2022-12-29', 2, 1, '2023-01-07 15:17:18', '2023-01-07 15:17:18'),
(5, 'ف2 - الأسبوع الخامس', '2023-01-01', '2023-01-05', 2, 1, '2023-01-07 15:17:38', '2023-01-07 15:17:38'),
(6, 'ف2 - الأسبوع السادس', '2023-01-08', '2023-01-12', 2, 1, '2023-01-07 15:17:59', '2023-01-07 15:17:59'),
(7, 'ف2 - الأسبوع السابع', '2023-01-15', '2023-01-19', 2, 1, '2023-01-07 15:18:34', '2023-01-07 15:18:34'),
(8, 'ف2 - الأسبوع الثامن', '2023-01-22', '2023-01-26', 2, 1, '2023-01-07 15:19:24', '2023-01-07 15:19:24'),
(9, 'ف2 - الأسبوع التاسع', '2023-01-29', '2023-02-02', 2, 1, '2023-01-07 15:19:54', '2023-01-07 15:19:54'),
(10, 'ف2 - الأسبوع العاشر', '2023-02-05', '2023-02-09', 2, 1, '2023-01-07 15:20:15', '2023-01-07 15:20:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `weeks`
--
ALTER TABLE `weeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weeks_semester_id_foreign` (`semester_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `weeks`
--
ALTER TABLE `weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `weeks`
--
ALTER TABLE `weeks`
  ADD CONSTRAINT `weeks_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
