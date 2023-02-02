-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2023 at 11:44 PM
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
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `position` int(11) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subtasks`
--

INSERT INTO `subtasks` (`id`, `title`, `section`, `office_id`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 'القيام بالمهام والمسؤوليات والأدوار في الدليل الإرشادي للمشرف التربوي الأخير.', 'مهمة فرعية', 1, 0, 1, '2023-01-08 17:23:41', '2023-01-08 17:23:41'),
(2, 'الاطلاع على أعمال المعلم/ين المسندين ومدير المدرسة بالمنصة ونور ومتابعة تفعيلها وفق المطلوب منهم نظاماً.', 'مهمة فرعية', 1, 0, 1, '2023-01-08 17:24:05', '2023-01-08 17:24:05'),
(3, 'حصر غياب المعلمين المسندين خلال العام المالي، والكادر المدرسي خلال اليوم الدراسي وعدم مغادرة المدرسة إلا بعد تثبيت غياب الطلاب.*', 'مهمة فرعية', 1, 0, 1, '2023-01-08 17:24:27', '2023-01-08 17:24:27'),
(4, 'متابعة سلامة سير العملية التعليمية والبيئة المدرسية خلال اليوم الدراسي ومصادقة الزيارة الفنية والمدرسية من الإدارة بعد إدخالها بنور.', 'مهمة فرعية', 1, 0, 1, '2023-01-08 17:24:41', '2023-01-08 17:24:41'),
(5, 'الاطلاع على ملف تحليل نتائج الاختبارات المعيارية وعدد مشاركات طلابهم ودور المدرسة في توعية المعلمين والطلاب بذلك.', 'مهمة فرعية', 1, 0, 1, '2023-01-08 17:24:54', '2023-01-08 17:24:54'),
(6, 'التأكيد من قيام لجنة التحصيل الدراسي بمهامها وفق الدليل التنظيمي مع وجود شواهد التنفيذ . وتقديم الدعم اللازم والرفع بالتوصيات.', 'مهمة فرعية', 1, 0, 1, '2023-01-08 17:25:15', '2023-01-08 17:25:15'),
(7, 'تدوين الزيارة المدرسية بنور ثم طباعتها ومصادقتها من مدير المدرسة وتزويده بنسخة منها.', 'مهمة فرعية', 1, 0, 1, '2023-01-08 17:25:45', '2023-01-08 17:25:45'),
(8, 'ص : متابعة الدوام.', 'حاشية', 1, 0, 1, '2023-01-30 00:50:19', '2023-01-30 00:50:19'),
(9, 'ص : الشؤون التعليمية / إدارة الاشراف.', 'حاشية', 1, 0, 1, '2023-01-30 00:50:32', '2023-01-30 00:50:32'),
(10, 'ص : مكتب سعادة مدير التعليم.', 'حاشية', 1, 0, 1, '2023-01-30 00:50:44', '2023-01-30 00:50:44'),
(11, '---------------------', 'حاشية', 1, 0, 1, '2023-01-30 00:50:58', '2023-01-30 00:50:58'),
(12, 'سيتم اعتماد الخطط في نظام نور في تمام الساعة 7:45 من صباح كل يوم أحد من كل أسبوع.', 'حاشية', 1, 0, 1, '2023-01-30 00:51:09', '2023-01-30 00:51:09'),
(13, 'قد تكون هناك تعديلات على خطتك نظراً لتعارض زيارة أكثر من مشرف/يْن لمدرسة ، أو حسب توجيهات إدارة المكتب.', 'حاشية', 1, 0, 1, '2023-01-30 00:51:18', '2023-01-30 00:51:18'),
(14, 'عند رصد غياب معلم مسند أكثر من خمسة أيام دون عذر خلال العام، أو غياب وتأخر نسبة كبيرة أثناء الزيارة يجب إبلاغ إدارة المكتب وتدوينه بتقرير الزيارة المدرسية.', 'حاشية', 1, 0, 1, '2023-01-30 00:51:30', '2023-01-30 00:51:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subtasks`
--
ALTER TABLE `subtasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtasks_office_id_foreign` (`office_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subtasks`
--
ALTER TABLE `subtasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subtasks`
--
ALTER TABLE `subtasks`
  ADD CONSTRAINT `subtasks_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
