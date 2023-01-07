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
-- بنية الجدول `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `schools`
--

INSERT INTO `schools` (`id`, `name`, `level_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ابتدائية  ذوالنورين', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'ابتدائية الأمير محمد بن ناصر', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'ابتدائية السعودية', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'ابتدائية السويس', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ابتدائية الشواجرة', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'ابتدائية الشيخ عيسى شماخي لتحفيظ القران الكريم ', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'ابتدائية العشوة', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'ابتدائية الفقهاء', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'ابتدائية الفيصلية', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'ابتدائية المثنى بن حارثة', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'ابتدائية المحمدية', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'ابتدائية المعبوج', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'ابتدائية المعرفه الأهلية', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'ابتدائية الملك عبد العزيز', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'ابتدائية الملك عبدالله بن عبدالعزيز', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'ابتدائية بخشة', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'ابتدائية بدر بالمقارية', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'ابتدائية حي الجبل', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'ابتدائية خالد بن الوليد', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'ابتدائية دار التوحيد', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'ابتدائية دحيقة', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'ابتدائية رياض جازان العالمية - بنين', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'ابتدائية رياض جازان المسار المصري', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'ابتدائية سلمان الفارسي', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'ابتدائية طارق بن زياد', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'ابتدائية عبدالله بن عباس', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'ابتدائية علوم جازان العالمية', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'ابتدائية علي بن أبي طالب', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'ابتدائية عمير والخرادلة', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'ابتدائية محلية', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'ابتدائية مدارس شركة مستقبل الاحفاد الاهلية', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'ابتدائية منارات المجد الاهلية', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'متوسطة منارات المجد الأهلية', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'متوسطة معاذ بن جبل', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'متوسطة مستقبل الاحفاد الاهلية', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'متوسطة محمد بن علي السنوسي', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'متوسطة عمير والخرادلة', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'متوسطة علوم جازان العالمية .', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'متوسطة سلمان الفارسي', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'متوسطة رياض جازان العالمية المصري', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'متوسطة رياض جازان العالمية - بنين', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'متوسطة دحيقة', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'متوسطة دار التوحيد', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'متوسطة حي الروضة', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'متوسطة تحفيظ القران الكريم  بجازان', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'متوسطة الملك فهد بمحلية', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'متوسطة المعهد العلمي بجازان', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'متوسطة المعرفة الاهلية', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'متوسطة الفقهاء', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'متوسطة الصفا', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'متوسطة الشواجرة', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'متوسطة الأندلس', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'متوسطة الأمير محمد بن ناصر', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'متوسطة أبو بكر الصديق', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'متوسطة ابن سيناء', 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'ثانوية منارات المجد الاهلية ـ مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'ثانوية منارات المجد الاهلية ـ - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'ثانوية معاذ بن جبل -مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'ثانوية معاذ بن جبل - - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'ثانوية مستقبل الاحفاد الاهلية - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'ثانوية مستقبل الاحفاد الاهلية - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'ثانوية محمد بن علي السنوسي - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'ثانوية محمد بن علي السنوسي - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'ثانوية عمير والخرادلة - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'ثانوية عمير والخرادلة - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'ثانوية رياض جازان العالمية - المسار المصري', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'ثانوية دحيقة - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'ثانوية دحيقة - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'ثانوية الملك فهد بمحلية - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'ثانوية الملك فهد بمحلية - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'ثانوية المعهد العلمي بجازان', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'ثانوية المعرفة الأهلية - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'ثانوية المعرفة الأهلية - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'ثانوية الكربوس - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'ثانوية الكربوس - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'ثانوية الشواجرة - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'ثانوية الشواجرة - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'ثانوية الروضة بجازان - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'ثانوية الروضة بجازان - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'ثانوية الرازي - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'ثانوية الرازي - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'ثانوية الخوارزمي - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'ثانوية الخوارزمي - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'ثانوية الأمير فيصل بن عبدالله - مقررات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'ثانوية الأمير فيصل بن عبدالله - مسارات', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'ابتدائية  ذوالنورين وابتدائية علي بن أبي طالب', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'ابتدائية ومتوسطة الأمير محمد بن ناصر', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'ابتدائية السعودية وابتدائية عبدالله بن عباس', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'ابتدائية السويس ومتوسطة معاذ بن جبل وثانوية الأمير فيصل بن عبدالله', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'ابتدائية ومتوسطة وثانوية الشواجرة', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'ابتدائية الشيخ عيسى شماخي لتحفيظ القران الكريم ومتوسطة تحفيظ القران الكريم بجازان', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'ابتدائية ومتوسطة الفقهاء', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'ابتدائية المثنى بن حارثة ومتوسطة أبوبكر الصديق', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'ابتدائية خالد بن الوليد وابتدائية ومتوسطة دار التوحيد', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'ابتدائية ومتوسطة رياض جازان العالمية - بنين', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'ابتدائية ومتوسطة سلمان الفارسي', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'ابتدائية طارق بن زياد ومتوسطة الصفا', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'ابتدائية ومتوسطة علوم جازان العالمية', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'ابتدائية ومتوسطة وثانوية عمير والخرادلة', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'ابتدائية ومتوسطة منارات المجد الاهلية', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'متوسطة وثانوية محمد بن علي السنوسي', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'متوسطة وثانوية دحيقة', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'متوسطة وثانوية الملك فهد بمحلية', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'متوسطة وثانوية المعهد العلمي بجازان', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'يوم مكتبي', 5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'برنامج تدريبي', 5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'إجازة مطولة', 5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'مدارس مكتب فرسان', 5, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schools_level_id_foreign` (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
