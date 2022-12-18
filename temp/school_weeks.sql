-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2022 at 08:51 PM
-- Server version: 10.4.24-MariaDB
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
-- Table structure for table `school_weeks`
--

CREATE TABLE `school_weeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_weeks`
--

INSERT INTO `school_weeks` (`id`, `name`, `start`, `end`, `semester_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ف2 - الأسبوع الأول', '2022-12-04', '2022-12-08', 2, 1, NULL, NULL),
(2, 'ف2 - الأسبوع الثاني', '2022-12-11', '2022-12-15', 2, 1, NULL, NULL),
(3, 'ف2 - الأسبوع الثالث', '2022-12-19', '2022-12-22', 2, 1, NULL, NULL),
(4, 'ف2 - الأسبوع الرابع', '2022-12-25', '2022-12-29', 2, 1, NULL, NULL),
(5, 'ف2 - الأسبوع الخامس', '2023-01-01', '2023-01-05', 2, 1, NULL, NULL),
(6, 'ف2 - الأسبوع السادس', '2023-01-08', '2023-01-12', 2, 1, NULL, NULL),
(7, 'ف2 - الأسبوع السابع', '2023-01-17', '2023-01-19', 2, 1, NULL, NULL),
(8, 'ف2 - الأسبوع الثامن', '2023-01-22', '2023-01-26', 2, 1, NULL, NULL),
(9, 'ف2 - الأسبوع التاسع', '2023-01-29', '2023-02-02', 2, 1, NULL, NULL),
(10, 'ف2 - الأسبوع العاشر', '2023-02-05', '2023-02-09', 2, 1, NULL, NULL),
(11, 'ف2 - الأسبوع الحادي عشر', '2023-02-12', '2023-02-16', 2, 1, NULL, NULL),
(12, 'ف2 - الأسبوع الثاني عشر', '2023-02-19', '2023-02-21', 2, 1, NULL, NULL),
(13, 'ف2 - الأسبوع الثالث عشر', '2023-02-26', '2023-03-02', 2, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `school_weeks`
--
ALTER TABLE `school_weeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_weeks_semester_id_foreign` (`semester_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `school_weeks`
--
ALTER TABLE `school_weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `school_weeks`
--
ALTER TABLE `school_weeks`
  ADD CONSTRAINT `school_weeks_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
