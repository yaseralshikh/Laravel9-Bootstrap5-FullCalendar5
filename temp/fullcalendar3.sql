-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 يناير 2023 الساعة 23:14
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
-- بنية الجدول `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `week_id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `user_id`, `week_id`, `color`, `status`, `created_at`, `updated_at`) VALUES
(1, 'يوم مكتبي', '2023-01-08 00:00:00', '2023-01-09 00:00:00', 1, 6, '#000000', 1, '2023-01-07 15:24:01', '2023-01-07 15:37:23'),
(2, 'متوسطة المعرفة الاهلية', '2023-01-09 00:00:00', '2023-01-10 00:00:00', 1, 6, '#298A08', 1, '2023-01-07 15:25:04', '2023-01-07 15:37:43'),
(3, 'ابتدائية طارق بن زياد ومتوسطة الصفا', '2023-01-10 00:00:00', '2023-01-11 00:00:00', 1, 6, '#298A08', 1, '2023-01-07 15:25:29', '2023-01-07 15:37:43'),
(4, 'ابتدائية ومتوسطة سلمان الفارسي', '2023-01-11 00:00:00', '2023-01-12 00:00:00', 1, 6, '#298A08', 1, '2023-01-07 15:25:57', '2023-01-07 15:37:43'),
(5, 'ابتدائية حي الجبل', '2023-01-12 00:00:00', '2023-01-13 00:00:00', 1, 6, '#298A08', 1, '2023-01-07 15:26:11', '2023-01-07 15:37:43'),
(6, 'ابتدائية  ذوالنورين', '2023-01-08 00:00:00', '2023-01-09 00:00:00', 2, 6, '#298A08', 1, '2023-01-07 18:11:33', '2023-01-07 18:11:33'),
(7, 'ابتدائية الأمير محمد بن ناصر', '2023-01-09 00:00:00', '2023-01-10 00:00:00', 2, 6, '#298A08', 1, '2023-01-07 18:11:45', '2023-01-07 18:11:45');

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `levels`
--

INSERT INTO `levels` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ابتدائي', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(2, 'متوسط', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(3, 'ثانوي', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(4, 'مجمع', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(5, 'أخرى', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33');

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_12_09_213942_create_levels_table', 1),
(5, '2022_12_09_213950_create_schools_table', 1),
(6, '2022_12_09_215854_create_specializations_table', 1),
(7, '2022_12_09_215855_create_semesters_table', 1),
(8, '2022_12_09_215856_create_weeks_table', 1),
(9, '2022_12_09_215859_create_users_table', 1),
(10, '2022_12_09_215860_create_events_table', 1),
(11, '2022_12_12_184402_laratrust_setup_tables', 1),
(12, '2023_01_07_172825_create_subtasks_table', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'users-create', 'Create Users', 'Create Users', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(2, 'users-read', 'Read Users', 'Read Users', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(3, 'users-update', 'Update Users', 'Update Users', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(4, 'users-delete', 'Delete Users', 'Delete Users', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(5, 'events-create', 'Create Events', 'Create Events', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(6, 'events-read', 'Read Events', 'Read Events', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(7, 'events-update', 'Update Events', 'Update Events', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(8, 'events-delete', 'Delete Events', 'Delete Events', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(9, 'pecializations-create', 'Create Pecializations', 'Create Pecializations', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(10, 'pecializations-read', 'Read Pecializations', 'Read Pecializations', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(11, 'pecializations-update', 'Update Pecializations', 'Update Pecializations', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(12, 'pecializations-delete', 'Delete Pecializations', 'Delete Pecializations', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(13, 'schools-create', 'Create Schools', 'Create Schools', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(14, 'schools-read', 'Read Schools', 'Read Schools', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(15, 'schools-update', 'Update Schools', 'Update Schools', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(16, 'schools-delete', 'Delete Schools', 'Delete Schools', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(17, 'profile-read', 'Read Profile', 'Read Profile', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(18, 'profile-update', 'Update Profile', 'Update Profile', '2023-01-07 15:11:33', '2023-01-07 15:11:33');

-- --------------------------------------------------------

--
-- بنية الجدول `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(17, 3),
(18, 1),
(18, 2),
(18, 3);

-- --------------------------------------------------------

--
-- بنية الجدول `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Superadmin', 'Superadmin', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(2, 'admin', 'Admin', 'Admin', '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(3, 'user', 'User', 'User', '2023-01-07 15:11:33', '2023-01-07 15:11:33');

-- --------------------------------------------------------

--
-- بنية الجدول `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\User'),
(3, 2, 'App\\Models\\User');

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

-- --------------------------------------------------------

--
-- بنية الجدول `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `semesters`
--

INSERT INTO `semesters` (`id`, `title`, `school_year`, `status`, `created_at`, `updated_at`) VALUES
(1, 'الفصل الدراسي الأول', '1444', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(2, 'الفصل الدراسي الثاني', '1444', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(3, 'الفصل الدراسي الثالث', '1444', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33');

-- --------------------------------------------------------

--
-- بنية الجدول `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `specializations`
--

INSERT INTO `specializations` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'إدارة مدرسية', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(2, 'تربية إسلامية', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(3, 'لغة عربية', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(4, 'صفوف أولية', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(5, 'رياضيات', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(6, 'علوم', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(7, 'لغة إنجليزية', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(8, 'اجتماعيات', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(9, 'فنية', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(10, 'بدنية', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(11, 'حاسب آلي', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(12, 'النشاط الطلابي', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(13, 'التوجيه والإرشاد', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(14, 'الموهوبين', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(15, 'التجهيزات المدرسية', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(16, 'الصحة المدرسية', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(17, 'الجودة', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(18, 'رئيس الشؤون المدرسية', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(19, 'رئيس الشؤون التعليمية', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(20, 'تقنية المعلومات', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(21, 'الاختبارات', 1, '2023-01-07 15:11:33', '2023-01-07 15:11:33');

-- --------------------------------------------------------

--
-- بنية الجدول `subtasks`
--

CREATE TABLE `subtasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `subtasks`
--

INSERT INTO `subtasks` (`id`, `title`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 'القيام بالمهام والمسؤوليات والأدوار في الدليل الإرشادي للمشرف التربوي الأخير.', 0, 1, '2023-01-07 16:40:19', '2023-01-07 18:01:19'),
(2, 'الاطلاع على أعمال المعلم/ين المسندين ومدير المدرسة بالمنصة ونور ومتابعة تفعيلها وفق المطلوبب منهم نظاماً.', 0, 1, '2023-01-07 16:43:16', '2023-01-07 18:01:19'),
(5, 'حصر غياب المعلمين المسندين خلال العام المالي، والكادر المدرسي خلال اليوم الدراسي وعدم مغادرة المدرسة إلا بعد تثبيت غياب الطلاب.*', 0, 1, '2023-01-07 17:50:04', '2023-01-07 18:01:19'),
(6, 'متابعة سلامة سير العملية التعليمية والبيئة المدرسية خلال اليوم الدراسي ومصادقة الزيارة الفنية والمدرسية من الإدارة بعد إدخالها بنور.', 0, 1, '2023-01-07 17:54:09', '2023-01-07 18:01:19'),
(7, 'الاطلاع على ملف تحليل نتائج الاختبارات المعيارية وعدد مشاركات طلابهم ودور المدرسة في توعية المعلمين والطلاب بذلك.', 0, 1, '2023-01-07 17:54:16', '2023-01-07 18:01:19'),
(8, 'التأكيد من قيام لجنة التحصيل الدراسي بمهامها وفق الدليل التنظيمي مع وجود شواهد التنفيذ . وتقديم الدعم اللازم والرفع بالتوصيات.', 0, 1, '2023-01-07 17:54:23', '2023-01-07 18:01:19'),
(9, 'تدوين الزيارة المدرسية بنورثم طباعتها ومصادقتها من مدير المدرسة وتزويده بنسخة منها.', 0, 1, '2023-01-07 17:54:34', '2023-01-07 18:01:19');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization_id` bigint(20) UNSIGNED NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `specialization_id`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Yaser Alshikh', 'yaseralshikh@gmail.com', 14, NULL, '$2y$10$CGnCQUGyetyEbgphYydet.r1RH2MbBduLIveyzbEVz0M5Uzsi2clW', 1, NULL, '2023-01-07 15:11:33', '2023-01-07 15:11:33'),
(2, 'نبيل محمد احمد الشيح', 'nabeel@gmail.com', 9, NULL, '$2y$10$.Qpb.mY7v5VjEt5ZzFhFx.gzTco4bBbXzfhQKBRfK2G/uHGL/ae.6', 1, NULL, '2023-01-07 18:11:04', '2023-01-07 18:11:04');

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
(1, 'ف2 - الأسبوع الأول', '2022-12-04', '2022-12-08', 2, 0, '2023-01-07 15:15:45', '2023-01-07 15:23:45'),
(2, 'ف2 - الأسبوع الثاني', '2022-12-11', '2022-12-15', 2, 0, '2023-01-07 15:16:18', '2023-01-07 15:23:45'),
(3, 'ف2 - الأسبوع الثالث', '2022-12-18', '2022-12-22', 2, 0, '2023-01-07 15:16:57', '2023-01-07 15:23:45'),
(4, 'ف2 - الأسبوع الرابع', '2022-12-25', '2022-12-29', 2, 0, '2023-01-07 15:17:18', '2023-01-07 15:23:45'),
(5, 'ف2 - الأسبوع الخامس', '2023-01-01', '2023-01-05', 2, 0, '2023-01-07 15:17:38', '2023-01-07 15:23:45'),
(6, 'ف2 - الأسبوع السادس', '2023-01-08', '2023-01-12', 2, 1, '2023-01-07 15:17:59', '2023-01-07 15:17:59'),
(7, 'ف2 - الأسبوع السابع', '2023-01-15', '2023-01-19', 2, 1, '2023-01-07 15:18:34', '2023-01-07 15:18:34'),
(8, 'ف2 - الأسبوع الثامن', '2023-01-22', '2023-01-26', 2, 1, '2023-01-07 15:19:24', '2023-01-07 15:19:24'),
(9, 'ف2 - الأسبوع التاسع', '2023-01-29', '2023-02-02', 2, 1, '2023-01-07 15:19:54', '2023-01-07 15:19:54'),
(10, 'ف2 - الأسبوع العاشر', '2023-02-05', '2023-02-09', 2, 1, '2023-01-07 15:20:15', '2023-01-07 15:20:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`),
  ADD KEY `events_week_id_foreign` (`week_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schools_level_id_foreign` (`level_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subtasks`
--
ALTER TABLE `subtasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_specialization_id_foreign` (`specialization_id`);

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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subtasks`
--
ALTER TABLE `subtasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `weeks`
--
ALTER TABLE `weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `events_week_id_foreign` FOREIGN KEY (`week_id`) REFERENCES `weeks` (`id`);

--
-- القيود للجدول `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`);

--
-- القيود للجدول `weeks`
--
ALTER TABLE `weeks`
  ADD CONSTRAINT `weeks_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
