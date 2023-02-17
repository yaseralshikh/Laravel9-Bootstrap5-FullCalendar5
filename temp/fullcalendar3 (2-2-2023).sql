-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2023 at 11:31 PM
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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `week_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `user_id`, `week_id`, `semester_id`, `office_id`, `color`, `status`, `created_at`, `updated_at`) VALUES
(2, 'ثانوية الشواجرة - مقررات', '2023-01-30 00:00:00', '2023-01-31 00:00:00', 1, 9, 2, 1, '#298A08', 1, '2023-01-30 00:53:46', '2023-02-02 00:27:28'),
(3, 'ابتدائية ومتوسطة علوم جازان العالمية', '2023-01-31 00:00:00', '2023-02-01 00:00:00', 1, 9, 2, 1, '#298A08', 1, '2023-01-30 00:53:56', '2023-01-30 00:56:48'),
(4, 'ابتدائية مدارس شركة مستقبل الاحفاد الاهلية', '2023-02-01 00:00:00', '2023-02-02 00:00:00', 1, 9, 2, 1, '#298A08', 1, '2023-01-30 00:54:24', '2023-01-30 00:56:48'),
(5, 'متوسطة المعرفة الاهلية', '2023-02-02 00:00:00', '2023-02-03 00:00:00', 1, 9, 2, 1, '#298A08', 1, '2023-01-30 00:56:33', '2023-01-30 00:56:48'),
(6, 'يوم مكتبي', '2023-01-29 00:00:00', '2023-01-30 00:00:00', 2, 9, 2, 1, '#000000', 1, '2023-01-30 05:18:46', '2023-02-02 00:23:56'),
(9, 'يوم مكتبي', '2023-01-29 00:00:00', '2023-01-30 00:00:00', 4, 9, 2, 3, '#000000', 1, '2023-01-31 18:11:20', '2023-01-31 18:11:20'),
(10, 'يوم مكتبي', '2023-01-30 00:00:00', '2023-01-31 00:00:00', 4, 9, 2, 3, '#000000', 1, '2023-01-31 18:11:51', '2023-01-31 18:11:51'),
(11, 'يوم مكتبي', '2023-02-05 00:00:00', '2023-02-06 00:00:00', 1, 10, 2, 1, '#000000', 1, '2023-02-01 01:08:18', '2023-02-02 00:23:56'),
(12, 'ابتدائية الريان', '2023-02-05 00:00:00', '2023-02-06 00:00:00', 4, 10, 2, 3, '#298A08', 1, '2023-02-02 05:07:40', '2023-02-02 05:07:40'),
(13, 'برنامج تدريبي', '2023-02-05 00:00:00', '2023-02-06 00:00:00', 3, 10, 2, 3, '#eb6c0c', 1, '2023-02-02 05:10:16', '2023-02-02 05:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ابتدائي', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(2, 'متوسط', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(3, 'ثانوي', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(4, 'مجمع', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(5, 'أخرى', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_12_09_213942_create_levels_table', 1),
(5, '2022_12_09_213945_create_offices_table', 1),
(6, '2022_12_09_213951_create_tasks_table', 1),
(7, '2022_12_09_215854_create_specializations_table', 1),
(8, '2022_12_09_215855_create_semesters_table', 1),
(9, '2022_12_09_215856_create_weeks_table', 1),
(10, '2022_12_09_215859_create_users_table', 1),
(11, '2022_12_09_215860_create_events_table', 1),
(12, '2022_12_12_184402_laratrust_setup_tables', 1),
(13, '2023_01_07_172825_create_subtasks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director_signature_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assistant_signature_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `name`, `director`, `director_signature_path`, `assistant_signature_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'مكتب التعليم بوسط جازان بنين', 'عبدالرحمن بن عسيري عكور', NULL, NULL, 1, '2023-01-30 00:32:03', '2023-02-01 01:02:40'),
(2, 'مكتب التعليم بوسط جازان بنات', 'وردة علي بركات', NULL, NULL, 1, '2023-01-30 00:32:03', '2023-01-31 05:32:22'),
(3, 'مكتب التعليم بأبي عريش', 'الدكتور حسن بن أبكر خضي', NULL, NULL, 1, '2023-01-30 00:32:03', '2023-01-31 04:36:34'),
(4, 'مكتب التعليم بصامطة', 'عبدالرزاق بن محمد الصميلي', NULL, NULL, 1, '2023-01-30 00:32:03', '2023-01-31 05:32:14'),
(5, 'مكتب التعليم بالمسارحة والحرث', 'الدكتور علي بن محمد عطيف', NULL, NULL, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(6, 'مكتب التعليم بالعارضة', 'الدكتور إبراهيم محزري', NULL, NULL, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(7, 'مكتب التعليم بفرسان', 'عبدالله بن محمد نسيب', NULL, NULL, 1, '2023-01-30 00:32:03', '2023-01-31 05:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
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
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'users-create', 'Create Users', 'Create Users', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(2, 'users-read', 'Read Users', 'Read Users', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(3, 'users-update', 'Update Users', 'Update Users', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(4, 'users-delete', 'Delete Users', 'Delete Users', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(5, 'events-create', 'Create Events', 'Create Events', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(6, 'events-read', 'Read Events', 'Read Events', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(7, 'events-update', 'Update Events', 'Update Events', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(8, 'events-delete', 'Delete Events', 'Delete Events', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(9, 'pecializations-create', 'Create Pecializations', 'Create Pecializations', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(10, 'pecializations-read', 'Read Pecializations', 'Read Pecializations', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(11, 'pecializations-update', 'Update Pecializations', 'Update Pecializations', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(12, 'pecializations-delete', 'Delete Pecializations', 'Delete Pecializations', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(13, 'tasks-create', 'Create Tasks', 'Create Tasks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(14, 'tasks-read', 'Read Tasks', 'Read Tasks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(15, 'tasks-update', 'Update Tasks', 'Update Tasks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(16, 'tasks-delete', 'Delete Tasks', 'Delete Tasks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(17, 'subtasks-create', 'Create Subtasks', 'Create Subtasks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(18, 'subtasks-read', 'Read Subtasks', 'Read Subtasks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(19, 'subtasks-update', 'Update Subtasks', 'Update Subtasks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(20, 'subtasks-delete', 'Delete Subtasks', 'Delete Subtasks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(21, 'levels-create', 'Create Levels', 'Create Levels', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(22, 'levels-read', 'Read Levels', 'Read Levels', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(23, 'levels-update', 'Update Levels', 'Update Levels', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(24, 'levels-delete', 'Delete Levels', 'Delete Levels', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(25, 'offices-create', 'Create Offices', 'Create Offices', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(26, 'offices-read', 'Read Offices', 'Read Offices', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(27, 'offices-update', 'Update Offices', 'Update Offices', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(28, 'offices-delete', 'Delete Offices', 'Delete Offices', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(29, 'semesters-create', 'Create Semesters', 'Create Semesters', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(30, 'semesters-read', 'Read Semesters', 'Read Semesters', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(31, 'semesters-update', 'Update Semesters', 'Update Semesters', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(32, 'semesters-delete', 'Delete Semesters', 'Delete Semesters', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(33, 'weeks-create', 'Create Weeks', 'Create Weeks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(34, 'weeks-read', 'Read Weeks', 'Read Weeks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(35, 'weeks-update', 'Update Weeks', 'Update Weeks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(36, 'weeks-delete', 'Delete Weeks', 'Delete Weeks', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(37, 'profile-read', 'Read Profile', 'Read Profile', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(38, 'profile-update', 'Update Profile', 'Update Profile', '2023-01-30 00:32:03', '2023-01-30 00:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
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
(5, 3),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(8, 2),
(8, 3),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
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
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(37, 2),
(37, 3),
(38, 1),
(38, 2),
(38, 3);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `roles`
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
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Superadmin', 'Superadmin', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(2, 'admin', 'Admin', 'Admin', '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(3, 'user', 'User', 'User', '2023-01-30 00:32:03', '2023-01-30 00:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\User'),
(3, 2, 'App\\Models\\User'),
(2, 3, 'App\\Models\\User'),
(3, 4, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `school_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `title`, `start`, `end`, `school_year`, `active`, `status`, `created_at`, `updated_at`) VALUES
(1, 'الفصل الدراسي الأول', '2022-08-28', '2022-11-24', '1444', 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(2, 'الفصل الدراسي الثاني', '2022-12-04', '2023-03-02', '1444', 1, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(3, 'الفصل الدراسي الثالث', '2023-03-12', '2023-06-22', '1444', 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'إدارة مدرسية', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(2, 'تربية إسلامية', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(3, 'لغة عربية', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(4, 'صفوف أولية', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(5, 'رياضيات', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(6, 'علوم', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(7, 'كيمياء', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(8, 'فيزياء', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(9, 'أحياء', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(10, 'لغة إنجليزية', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(11, 'اجتماعيات', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(12, 'فنية', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(13, 'بدنية', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(14, 'حاسب آلي', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(15, 'النشاط الطلابي', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(16, 'التوجيه والإرشاد', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(17, 'الموهوبين', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(18, 'التجهيزات المدرسية', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(19, 'الصحة المدرسية', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(20, 'الجودة', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(21, 'رئيس الشؤون المدرسية', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(22, 'رئيس الشؤون التعليمية', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(23, 'تقنية المعلومات', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(24, 'الاختبارات', 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03');

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

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `level_id`, `office_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'يوم مكتبي', 5, 1, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(2, 'إجازة', 5, 1, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(3, 'برنامج تدريبي', 5, 1, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(4, 'يوم مكتبي', 5, 2, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(5, 'إجازة', 5, 2, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(6, 'برنامج تدريبي', 5, 2, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(7, 'يوم مكتبي', 5, 3, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(8, 'إجازة', 5, 3, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(9, 'برنامج تدريبي', 5, 3, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(10, 'يوم مكتبي', 5, 4, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(11, 'إجازة', 5, 4, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(12, 'برنامج تدريبي', 5, 4, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(13, 'يوم مكتبي', 5, 5, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(14, 'إجازة', 5, 5, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(15, 'برنامج تدريبي', 5, 5, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(16, 'يوم مكتبي', 5, 6, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(17, 'إجازة', 5, 6, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(18, 'برنامج تدريبي', 5, 6, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(19, 'يوم مكتبي', 5, 7, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(20, 'إجازة', 5, 7, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(21, 'برنامج تدريبي', 5, 7, 1, '2023-01-29 11:28:27', '2023-01-29 11:28:27'),
(22, 'ابتدائية  ذوالنورين', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'ابتدائية الأمير محمد بن ناصر', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'ابتدائية السعودية', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'ابتدائية السويس', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'ابتدائية الشواجرة', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'ابتدائية الشيخ عيسى شماخي لتحفيظ القران الكريم ', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'ابتدائية العشوة', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'ابتدائية الفقهاء', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'ابتدائية الفيصلية', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'ابتدائية المثنى بن حارثة', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'ابتدائية المحمدية', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'ابتدائية المعبوج', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'ابتدائية المعرفه الأهلية', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'ابتدائية الملك عبد العزيز', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'ابتدائية الملك عبدالله بن عبدالعزيز', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'ابتدائية بخشة', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'ابتدائية بدر بالمقارية', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'ابتدائية حي الجبل', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'ابتدائية خالد بن الوليد', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'ابتدائية دار التوحيد', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'ابتدائية دحيقة', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'ابتدائية رياض جازان العالمية - بنين', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'ابتدائية رياض جازان المسار المصري', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'ابتدائية سلمان الفارسي', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'ابتدائية طارق بن زياد', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'ابتدائية عبدالله بن عباس', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'ابتدائية علوم جازان العالمية', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'ابتدائية علي بن أبي طالب', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'ابتدائية عمير والخرادلة', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'ابتدائية محلية', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'ابتدائية مدارس شركة مستقبل الاحفاد الاهلية', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'ابتدائية منارات المجد الاهلية', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'متوسطة منارات المجد الأهلية', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'متوسطة معاذ بن جبل', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'متوسطة مستقبل الاحفاد الاهلية', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'متوسطة محمد بن علي السنوسي', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'متوسطة عمير والخرادلة', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'متوسطة علوم جازان العالمية .', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'متوسطة سلمان الفارسي', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'متوسطة رياض جازان العالمية المصري', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'متوسطة رياض جازان العالمية - بنين', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'متوسطة دحيقة', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'متوسطة دار التوحيد', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'متوسطة حي الروضة', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'متوسطة تحفيظ القران الكريم  بجازان', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'متوسطة الملك فهد بمحلية', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'متوسطة المعهد العلمي بجازان', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'متوسطة المعرفة الاهلية', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'متوسطة الفقهاء', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'متوسطة الصفا', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'متوسطة الشواجرة', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'متوسطة الأندلس', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'متوسطة الأمير محمد بن ناصر', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'متوسطة أبو بكر الصديق', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'متوسطة ابن سيناء', 2, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'ثانوية منارات المجد الاهلية ـ مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'ثانوية منارات المجد الاهلية ـ - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'ثانوية معاذ بن جبل -مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'ثانوية معاذ بن جبل - - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'ثانوية مستقبل الاحفاد الاهلية - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'ثانوية مستقبل الاحفاد الاهلية - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'ثانوية محمد بن علي السنوسي - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'ثانوية محمد بن علي السنوسي - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'ثانوية عمير والخرادلة - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'ثانوية عمير والخرادلة - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'ثانوية رياض جازان العالمية - المسار المصري', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'ثانوية دحيقة - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'ثانوية دحيقة - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'ثانوية الملك فهد بمحلية - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'ثانوية الملك فهد بمحلية - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'ثانوية المعهد العلمي بجازان', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'ثانوية المعرفة الأهلية - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'ثانوية المعرفة الأهلية - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'ثانوية الكربوس - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'ثانوية الكربوس - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'ثانوية الشواجرة - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'ثانوية الشواجرة - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'ثانوية الروضة بجازان - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'ثانوية الروضة بجازان - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'ثانوية الرازي - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'ثانوية الرازي - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'ثانوية الخوارزمي - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'ثانوية الخوارزمي - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'ثانوية الأمير فيصل بن عبدالله - مقررات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'ثانوية الأمير فيصل بن عبدالله - مسارات', 3, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'ابتدائية  ذوالنورين وابتدائية علي بن أبي طالب', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'ابتدائية ومتوسطة الأمير محمد بن ناصر', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'ابتدائية السعودية وابتدائية عبدالله بن عباس', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'ابتدائية السويس ومتوسطة معاذ بن جبل وثانوية الأمير فيصل بن عبدالله', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'ابتدائية ومتوسطة وثانوية الشواجرة', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'ابتدائية الشيخ عيسى شماخي لتحفيظ القران الكريم ومتوسطة تحفيظ القران الكريم بجازان', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'ابتدائية ومتوسطة الفقهاء', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'ابتدائية المثنى بن حارثة ومتوسطة أبوبكر الصديق', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'ابتدائية خالد بن الوليد وابتدائية ومتوسطة دار التوحيد', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'ابتدائية ومتوسطة رياض جازان العالمية - بنين', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'ابتدائية ومتوسطة سلمان الفارسي', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'ابتدائية طارق بن زياد ومتوسطة الصفا', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'ابتدائية ومتوسطة علوم جازان العالمية', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'ابتدائية ومتوسطة وثانوية عمير والخرادلة', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'ابتدائية ومتوسطة منارات المجد الاهلية', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'متوسطة وثانوية محمد بن علي السنوسي', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'متوسطة وثانوية دحيقة', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'متوسطة وثانوية الملك فهد بمحلية', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'متوسطة وثانوية المعهد العلمي بجازان', 4, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'مدارس مكتب فرسان', 4, 1, 1, NULL, '2023-01-29 15:11:32'),
(127, 'ابتدائية الريان', 1, 3, 1, '2023-02-02 05:07:18', '2023-02-02 05:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization_id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `specialization_id`, `office_id`, `type`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ياسر محمد أحمد الشيخ', 'yaseralshikh@gmail.com', 14, 1, 'مشرف تربوي', NULL, '$2y$10$v6AGIkS3XsmfVR5CE8S/0u7nhbFzHTAgjDzMDBlKAuxyFMug09uM6', 1, NULL, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(2, 'نبيل محمد أحمد الشيخ', 'nabeel@gmail.com', 12, 1, 'مشرف تربوي', NULL, '$2y$10$TPcObDNgLxHflj5oFgpnYeMBMH5dAJPVz/DPZmKZ4r06ZBRBIHtpi', 1, NULL, '2023-01-30 05:14:10', '2023-01-30 05:16:30'),
(3, 'عمر السنوسي', 'omar@gmail.com', 2, 3, 'مشرف تربوي', NULL, '$2y$10$0orbQVPqfr0aZj6G36x.Muw./MfiAduJLYTOzd0D5nyN4DgH.0Dku', 1, NULL, '2023-01-30 05:14:55', '2023-01-30 05:14:55'),
(4, 'محمد عياشي', 'mohammed@gmail.com', 7, 3, 'مشرف تربوي', NULL, '$2y$10$uqU6dOFlrjLk7NivqWFqT.u2iCxcdGSQJTi8BjWx5GCWBquGzJAvC', 1, NULL, '2023-01-30 05:16:07', '2023-01-30 05:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `weeks`
--

CREATE TABLE `weeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weeks`
--

INSERT INTO `weeks` (`id`, `title`, `start`, `end`, `semester_id`, `active`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ف2 - الأسبوع الأول', '2022-12-04', '2022-12-08', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(2, 'ف2 - الأسبوع الثاني', '2022-12-11', '2022-12-15', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(3, 'ف2 - الأسبوع الثالث', '2022-12-18', '2022-12-22', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(4, 'ف2 - الأسبوع الرابع', '2022-12-25', '2022-12-29', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(5, 'ف2 - الأسبوع الخامس', '2023-01-01', '2023-01-05', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(6, 'ف2 - الأسبوع السادس', '2023-01-08', '2023-01-12', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(7, 'ف2 - الأسبوع السابع', '2023-01-15', '2023-01-19', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(8, 'ف2 - الأسبوع الثامن', '2023-01-22', '2023-01-26', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(9, 'ف2 - الأسبوع التاسع', '2023-01-29', '2023-02-02', 2, 1, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(10, 'ف2 - الأسبوع العاشر', '2023-02-05', '2023-02-09', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(11, 'ف2 - الأسبوع الحادي عشر', '2023-02-12', '2023-02-16', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(12, 'ف2 - الأسبوع الثاني عشر', '2023-02-19', '2023-02-23', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03'),
(13, 'ف2 - الأسبوع الثالث عشر', '2023-02-26', '2023-03-02', 2, 0, 1, '2023-01-30 00:32:03', '2023-01-30 00:32:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`),
  ADD KEY `events_week_id_foreign` (`week_id`),
  ADD KEY `events_semester_id_foreign` (`semester_id`),
  ADD KEY `events_office_id_foreign` (`office_id`);

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
-- Indexes for table `offices`
--
ALTER TABLE `offices`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtasks_office_id_foreign` (`office_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_level_id_foreign` (`level_id`),
  ADD KEY `tasks_office_id_foreign` (`office_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_specialization_id_foreign` (`specialization_id`),
  ADD KEY `users_office_id_foreign` (`office_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `subtasks`
--
ALTER TABLE `subtasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `weeks`
--
ALTER TABLE `weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`),
  ADD CONSTRAINT `events_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `events_week_id_foreign` FOREIGN KEY (`week_id`) REFERENCES `weeks` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subtasks`
--
ALTER TABLE `subtasks`
  ADD CONSTRAINT `subtasks_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`),
  ADD CONSTRAINT `tasks_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`),
  ADD CONSTRAINT `users_specialization_id_foreign` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`);

--
-- Constraints for table `weeks`
--
ALTER TABLE `weeks`
  ADD CONSTRAINT `weeks_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;