-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2023 at 10:16 PM
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
-- Database: `fullcalendar2`
--

-- --------------------------------------------------------

--
-- Table structure for table `subtasks`
--

CREATE TABLE `subtasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subtasks`
--

INSERT INTO `subtasks` (`id`, `title`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 'القيام بالمهام والمسؤوليات والأدوار في الدليل الإرشادي للمشرف التربوي الأخير.', 0, 1, '2023-01-08 17:23:41', '2023-01-08 17:23:41'),
(2, 'الاطلاع على أعمال المعلم/ين المسندين ومدير المدرسة بالمنصة ونور ومتابعة تفعيلها وفق المطلوب منهم نظاماً.', 0, 1, '2023-01-08 17:24:05', '2023-01-08 17:24:05'),
(3, 'حصر غياب المعلمين المسندين خلال العام المالي، والكادر المدرسي خلال اليوم الدراسي وعدم مغادرة المدرسة إلا بعد تثبيت غياب الطلاب.*', 0, 1, '2023-01-08 17:24:27', '2023-01-08 17:24:27'),
(4, 'متابعة سلامة سير العملية التعليمية والبيئة المدرسية خلال اليوم الدراسي ومصادقة الزيارة الفنية والمدرسية من الإدارة بعد إدخالها بنور.', 0, 1, '2023-01-08 17:24:41', '2023-01-08 17:24:41'),
(5, 'الاطلاع على ملف تحليل نتائج الاختبارات المعيارية وعدد مشاركات طلابهم ودور المدرسة في توعية المعلمين والطلاب بذلك.', 0, 1, '2023-01-08 17:24:54', '2023-01-08 17:24:54'),
(6, 'التأكيد من قيام لجنة التحصيل الدراسي بمهامها وفق الدليل التنظيمي مع وجود شواهد التنفيذ . وتقديم الدعم اللازم والرفع بالتوصيات.', 0, 1, '2023-01-08 17:25:15', '2023-01-08 17:25:15'),
(7, 'تدوين الزيارة المدرسية بنور ثم طباعتها ومصادقتها من مدير المدرسة وتزويده بنسخة منها.', 0, 1, '2023-01-08 17:25:45', '2023-01-08 17:25:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subtasks`
--
ALTER TABLE `subtasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subtasks`
--
ALTER TABLE `subtasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
