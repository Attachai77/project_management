-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2019 at 03:49 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_management`
--

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_11_10_101300_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 11),
(1, 'App\\User', 15),
(2, 'App\\User', 1),
(2, 'App\\User', 2),
(7, 'App\\User', 12),
(7, 'App\\User', 13),
(7, 'App\\User', 14),
(8, 'App\\User', 3),
(8, 'App\\User', 4),
(8, 'App\\User', 5),
(8, 'App\\User', 6),
(8, 'App\\User', 7),
(8, 'App\\User', 8),
(8, 'App\\User', 9),
(8, 'App\\User', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('attachaisaorangtoi@gmail.com', '$2y$10$qBins1T4R9yGJCO7wGykGuNIGLYsLTQg5X6oGzCB/VsnWaGCHOG3u', '2019-12-10 04:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_group_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`, `permission_group_id`, `deleted`) VALUES
(1, 'create permission', 'Create Permission', 'web', '2019-11-15 22:51:56', '2019-11-23 02:36:28', NULL, 1),
(2, 'permission list', 'Permission List', 'web', '2019-11-15 22:51:56', '2019-11-23 02:36:26', NULL, 1),
(3, 'edit permission', 'Edit Permission', 'web', '2019-11-15 22:51:56', '2019-11-23 02:36:25', NULL, 1),
(4, 'view permission', 'View Permission', 'web', '2019-11-15 22:51:56', '2019-11-23 02:36:24', NULL, 1),
(5, 'delete permission', 'Delete Permission', 'web', '2019-11-15 22:51:56', '2019-11-23 02:36:22', NULL, 1),
(6, 'create-role', 'เพิ่มข้อมูลกลุ่มบทบาท', 'web', '2019-11-15 22:51:56', '2019-11-23 02:37:12', 5, 0),
(7, 'role-list', 'ดูรายการกลุ่มบทบาท', 'web', '2019-11-15 22:51:56', '2019-11-23 02:37:31', 5, 0),
(8, 'edit-role', 'แก้ไขข้อมูลกลุ่มบทบาท', 'web', '2019-11-15 22:51:56', '2019-11-23 02:37:52', 5, 0),
(9, 'view-role', 'ดูข้อมูลกลุ่มบทบาท', 'web', '2019-11-15 22:51:56', '2019-11-23 02:38:06', 5, 0),
(10, 'delete-role', 'ลบข้อมูลกลุ่มบทบาท', 'web', '2019-11-15 22:51:56', '2019-11-23 02:38:24', 5, 0),
(11, 'create-user', 'เพิ่มข้อมูลผู้ใช้งาน', 'web', '2019-11-15 22:51:56', '2019-11-23 02:38:43', 4, 0),
(12, 'user-list', 'ดูรายการผู้ใช้งาน', 'web', '2019-11-15 22:51:56', '2019-11-23 02:38:56', 4, 0),
(13, 'edit-user', 'แก้ไขข้อมูลผู้ใช้งาน', 'web', '2019-11-15 22:51:56', '2019-11-23 02:39:08', 4, 0),
(14, 'view-user', 'ดูข้อมูลผู้ใช้งาน', 'web', '2019-11-15 22:51:56', '2019-11-23 02:39:20', 4, 0),
(15, 'delete-user', 'ลบข้อมูลผู้ช้งาน', 'web', '2019-11-15 22:51:56', '2019-11-23 02:39:34', 4, 0),
(20, 'project-checking-list', 'ดูรายการโครงการรอการตรวจสอบ', 'web', '2019-12-10 02:32:54', '2019-12-10 02:32:54', 9, 0),
(21, 'create-project', 'สร้างโครงการ', 'web', '2019-12-10 02:35:38', '2019-12-10 02:35:38', 10, 0),
(22, 'edit-project', 'แก้ไขข้อมูลโครงการ (เฉพาะโครงการที่เป็นเจ้าของ)', 'web', '2019-12-10 02:36:53', '2019-12-10 02:36:53', 6, 0),
(23, 'delete-project', 'ลบข้อมูลโครงการ (เฉพาะโครงการที่เป็นเจ้าของ)', 'web', '2019-12-10 02:37:10', '2019-12-10 02:37:10', 6, 0),
(24, 'project-list', 'ดูรายการโครงการทั้งหมด', 'web', '2019-12-10 02:43:10', '2019-12-10 02:43:10', 7, 0),
(25, 'your-project-list', 'ดูรายการโครงการของคุณ', 'web', '2019-12-10 02:53:56', '2019-12-10 02:53:56', 6, 0),
(26, 'project-position-list', 'ดูรายการตำแหน่งโครงการ', 'web', '2019-12-10 04:10:45', '2019-12-10 04:10:45', 11, 0),
(27, 'create-project-position', 'เพิ่มข้อมูลตำแหน่งโครงการ', 'web', '2019-12-10 04:11:29', '2019-12-10 04:11:29', 11, 0),
(28, 'edit-project-position', 'แก้ไขข้อมูลตำแหน่งโครงกร', 'web', '2019-12-10 04:11:58', '2019-12-10 04:11:58', 11, 0),
(29, 'delete-project-position', 'ลบข้อมูลตำแหน่งโครงการ', 'web', '2019-12-10 04:12:27', '2019-12-10 04:12:27', 11, 0),
(30, 'show-project-position', 'ดูข้อมูลตำแหน่งโครงการ', 'web', '2019-12-10 04:12:51', '2019-12-10 04:12:51', 11, 0),
(31, 'assign-permission-role', 'กำหนดสิทธิ์ให้กลุ่มผู้ใช้งาน', 'web', '2019-12-10 04:14:40', '2019-12-10 04:14:40', 5, 0),
(32, 'assign-permission-user', 'กำหนดสิทธิ์เพิ่มเติมให้ผู้ใช้งาน', 'web', '2019-12-10 04:15:03', '2019-12-10 04:15:03', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_uid` int(11) DEFAULT NULL,
  `updated_uid` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `group_name`, `created_uid`, `updated_uid`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'rrr', 2, 2, '2019-11-23 07:19:23', '2019-11-23 07:28:02', 1),
(2, 'aaa', 2, 2, '2019-11-23 07:20:29', '2019-11-23 07:22:55', 1),
(3, 'aaaa', 2, 2, '2019-11-23 07:20:36', '2019-11-23 07:22:54', 1),
(4, 'จัดการข้อมูลผู้ใช้งาน', 2, 2, '2019-11-23 07:28:05', '2019-11-23 07:43:20', 0),
(5, 'จัดการข้อมูลกลุ่มผู้ใช้งาน', 2, NULL, '2019-11-23 07:43:32', '2019-11-23 07:43:32', 0),
(6, 'เมนูโครงการของคุณ', 5, 1, '2019-11-23 10:18:50', '2019-12-07 07:42:03', 0),
(7, 'เมนูโครงการทั้งหมด', 1, 1, '2019-12-07 07:41:11', '2019-12-07 07:42:10', 0),
(8, 'เมนูกิจกรรมของคุณ', 1, NULL, '2019-12-07 07:42:21', '2019-12-07 07:42:21', 0),
(9, 'เมนูโครงการรอการตรวจสอบ', 1, NULL, '2019-12-10 09:32:08', '2019-12-10 09:32:08', 0),
(10, 'อื่น ๆ', 1, NULL, '2019-12-10 09:35:21', '2019-12-10 09:35:21', 0),
(11, 'จัดการข้อมูลตำแหน่งโครงการ', 1, NULL, '2019-12-10 11:10:09', '2019-12-10 11:10:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_owner_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_uid` int(11) NOT NULL,
  `updated_uid` int(11) DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  `project_description` text COLLATE utf8_unicode_ci,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=pending, 1=check, 2=plan , 3=inprogress , 4=done , 5=cancle, 6=reject  ',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `adviser_id` int(11) DEFAULT NULL COMMENT 'ที่ปรึกษาโครงการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `project_owner_id`, `start_date`, `end_date`, `created_at`, `updated_at`, `created_uid`, `updated_uid`, `budget`, `project_description`, `location`, `status`, `deleted`, `adviser_id`) VALUES
(1, 'งานบายเนีย Computer Science  2019', 1, '2019-11-01', '2019-11-28', '2019-11-24 06:41:34', '2019-12-10 07:17:14', 1, 1, 22222222, NULL, 'sfadfasdf', 0, 0, NULL),
(3, 'โครงการบ่ายศรีสู่ขวัญ ภาควิชาคอมพิวเตอร์ ประจำปี 2562', 4, '2019-11-27', '2019-12-18', '2019-11-24 08:25:32', '2019-11-24 10:07:52', 1, 1, 30000, 'ddddddddddddddddddd CCCCCCCCCCCC', 'อาคารวิทยาศาสตร์', 0, 0, NULL),
(4, 'ค่ายวิชาการคอมพิวเตอร์ Computer Camp 2019 @URU', 1, '2019-11-30', '2019-12-26', '2019-11-24 15:12:04', '2019-12-10 09:27:57', 1, 1, 50000, '- มีการแจกรางวัล', 'อาคาร URU ICT', 3, 0, NULL),
(5, 'โครงการ กีฬาสร้างความสัมพันธ์น้องพี่ ภายในภาควิชาคอมพิวเตอร์', 9, '2019-11-28', '2019-12-26', '2019-11-24 15:27:58', '2019-12-14 09:43:53', 1, 1, 20000, NULL, 'โรงยิม URU', 0, 0, 12),
(6, 'โครงการทดสอบ 1', 9, '2019-12-03', '2019-12-28', '2019-12-11 16:35:39', '2019-12-14 09:15:25', 9, 9, 22222, NULL, NULL, 4, 0, 14),
(7, 'โครงการทดสอบ 2', 9, '2019-12-04', '2019-12-28', '2019-12-11 16:36:27', '2019-12-14 06:01:01', 9, 14, NULL, NULL, NULL, 3, 0, 14),
(8, 'โครงการทดสอบ 3', 9, '2019-12-05', '2019-12-31', '2019-12-14 06:09:17', '2019-12-14 10:34:43', 9, 9, NULL, NULL, NULL, 4, 0, 14),
(9, 'โครงการทดสอบ 5', 9, '2019-12-05', '2019-12-31', '2019-12-14 07:30:17', '2019-12-14 07:30:17', 9, NULL, NULL, NULL, NULL, 0, 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `project_expecteds`
--

CREATE TABLE `project_expecteds` (
  `id` int(11) NOT NULL,
  `expected_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_uid` int(11) NOT NULL,
  `updated_uid` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ผลที่คาดว่าจะได้รับจากโครงการ';

--
-- Dumping data for table `project_expecteds`
--

INSERT INTO `project_expecteds` (`id`, `expected_name`, `project_id`, `created_uid`, `updated_uid`, `created_at`, `updated_at`, `deleted`) VALUES
(14, 'ผลที่คาดว่าจะได้รับ : 3', 3, 1, NULL, '2019-11-24 10:07:52', '2019-11-24 10:07:52', 0),
(15, 'ผลที่คาดว่าจะได้รับ : 1', 3, 1, NULL, '2019-11-24 10:07:52', '2019-11-24 10:07:52', 0),
(16, 'ผลที่คาดว่าจะได้รับ : 2', 3, 1, NULL, '2019-11-24 10:07:52', '2019-11-24 10:07:52', 0),
(20, 'นักศึกษาทุกคนมีความสุขกับกิจกรรม', 1, 1, NULL, '2019-11-24 15:07:45', '2019-11-24 15:07:45', 0),
(21, 'นักศึกษาเข้าร่วมกิจกรรมอย่างพร้อมเพรียงกัน', 1, 1, NULL, '2019-11-24 15:07:45', '2019-11-24 15:07:45', 0),
(22, 'นักศึกษาได้รับความรู้', 4, 1, NULL, '2019-11-24 15:12:04', '2019-11-24 15:12:04', 0),
(25, 'นักศึกษาทุกคนมีความสุขกับกิจกรรม', 5, 1, NULL, '2019-12-14 09:43:53', '2019-12-14 09:43:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_logs`
--

CREATE TABLE `project_logs` (
  `id` int(11) NOT NULL,
  `action` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `created_uid` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_logs`
--

INSERT INTO `project_logs` (`id`, `action`, `project_id`, `comment`, `created_uid`, `created_at`) VALUES
(1, 'reject', 7, 'โครงการไม่ผ่าน', 14, '2019-12-14 06:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_uid` int(11) NOT NULL,
  `updated_uid` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='เก็บข้อมูลสมาชิกและตำแหน่งของโครงการ';

--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`id`, `project_id`, `user_id`, `position_id`, `created_at`, `updated_at`, `created_uid`, `updated_uid`, `deleted`) VALUES
(1, 3, 3, 1, '2019-11-24 12:12:03', '2019-11-24 12:24:46', 1, NULL, 1),
(2, 3, 3, 1, '2019-11-24 12:14:25', '2019-11-24 12:24:46', 1, NULL, 1),
(3, 3, 5, 1, '2019-11-24 12:16:49', '2019-11-24 12:24:50', 1, NULL, 1),
(4, 3, 4, 4, '2019-11-24 12:17:42', '2019-11-24 12:17:42', 1, NULL, 0),
(5, 3, 3, 1, '2019-11-24 12:26:39', '2019-11-24 12:26:44', 1, NULL, 1),
(6, 3, 3, 1, '2019-11-24 12:26:41', '2019-11-24 12:26:41', 1, NULL, 0),
(7, 3, 5, 1, '2019-11-24 12:26:51', '2019-11-24 12:26:51', 1, NULL, 0),
(8, 5, 9, 2, '2019-11-25 13:04:35', '2019-11-25 13:04:35', 1, NULL, 0),
(9, 5, 3, 2, '2019-11-25 13:04:40', '2019-11-25 13:04:40', 1, NULL, 0),
(10, 1, 3, 1, '2019-11-30 09:19:40', '2019-11-30 09:19:40', 1, NULL, 0),
(11, 1, 4, 3, '2019-11-30 09:19:45', '2019-11-30 09:19:45', 1, NULL, 0),
(12, 1, 6, 7, '2019-11-30 09:19:49', '2019-11-30 09:19:49', 1, NULL, 0),
(13, 1, 7, 5, '2019-11-30 09:19:55', '2019-11-30 09:19:55', 1, NULL, 0),
(14, 5, 5, 2, '2019-12-07 07:34:42', '2019-12-07 07:34:42', 1, NULL, 0),
(15, 5, 6, 6, '2019-12-07 07:35:27', '2019-12-07 07:35:27', 1, NULL, 0),
(16, 1, 5, 10, '2019-12-08 06:38:44', '2019-12-08 06:38:44', 1, NULL, 0),
(17, 1, 10, 10, '2019-12-08 06:39:13', '2019-12-08 06:39:13', 1, NULL, 0),
(18, 1, 3, 1, '2019-12-08 06:39:18', '2019-12-08 06:39:18', 1, NULL, 0),
(19, 1, 3, 3, '2019-12-08 06:39:28', '2019-12-08 07:17:07', 1, NULL, 1),
(20, 6, 6, 1, '2019-12-14 07:15:03', '2019-12-14 07:15:03', 9, NULL, 0),
(21, 6, 7, 3, '2019-12-14 07:15:11', '2019-12-14 07:15:11', 9, NULL, 0),
(22, 6, 4, 10, '2019-12-14 07:15:15', '2019-12-14 07:15:15', 9, NULL, 0),
(23, 9, 9, 10, '2019-12-14 07:30:17', '2019-12-14 07:30:17', 9, NULL, 0),
(24, 6, 9, 7, '2019-12-14 07:31:03', '2019-12-14 07:31:03', 9, NULL, 0),
(25, 8, 9, 1, '2019-12-14 10:07:16', '2019-12-14 10:07:16', 9, NULL, 0),
(26, 7, 9, 1, '2019-12-14 10:08:24', '2019-12-14 10:08:24', 9, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_positions`
--

CREATE TABLE `project_positions` (
  `id` int(11) NOT NULL,
  `position_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_uid` int(11) NOT NULL,
  `updated_uid` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ตำแหน่งสมาชิกในโครงการ';

--
-- Dumping data for table `project_positions`
--

INSERT INTO `project_positions` (`id`, `position_name`, `created_at`, `updated_at`, `created_uid`, `updated_uid`, `deleted`) VALUES
(1, 'ประธานโครงการ', '2019-11-24 10:54:40', '2019-11-24 10:54:40', 1, NULL, 0),
(2, 'เลขานุการ', '2019-11-24 10:56:20', '2019-11-24 10:56:20', 1, NULL, 0),
(3, 'รองประธานโครงการ', '2019-11-24 10:58:10', '2019-11-24 10:58:10', 1, NULL, 0),
(4, 'เหรัญญิก', '2019-11-24 10:58:13', '2019-11-24 10:58:13', 1, NULL, 0),
(5, 'กรรมการ', '2019-11-24 10:58:23', '2019-11-24 10:58:23', 1, NULL, 0),
(6, 'ประชาสัมพันธ์', '2019-11-24 10:58:41', '2019-11-24 10:58:41', 1, NULL, 0),
(7, 'ฝ่ายสถานที่', '2019-11-24 11:00:48', '2019-11-24 11:06:32', 1, 1, 0),
(8, 'ปปปปป', '2019-11-24 11:07:14', '2019-11-24 11:07:17', 1, 1, 1),
(9, 'กกกกกกกก', '2019-11-24 11:07:36', '2019-11-24 11:07:38', 1, 1, 1),
(10, 'อื่น ๆ', '2019-12-07 07:35:46', '2019-12-07 07:35:46', 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_purposes`
--

CREATE TABLE `project_purposes` (
  `id` int(11) NOT NULL,
  `purpose_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_uid` int(11) NOT NULL,
  `updated_uid` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='วัตถุประสงค์โครงการ';

--
-- Dumping data for table `project_purposes`
--

INSERT INTO `project_purposes` (`id`, `purpose_name`, `project_id`, `created_uid`, `updated_uid`, `created_at`, `updated_at`, `deleted`) VALUES
(14, 'วัตถุประสงค์ 1', 3, 1, NULL, '2019-11-24 10:07:52', '2019-11-24 10:07:52', 0),
(15, 'วัตถุประสงค์  2', 3, 1, NULL, '2019-11-24 10:07:52', '2019-11-24 10:07:52', 0),
(19, 'เพื่อสร้างความสัมพันธ์น้องพี่', 1, 1, NULL, '2019-11-24 15:07:45', '2019-11-24 15:07:45', 0),
(20, 'เพื่อสืบสานประเพณีของสาขา', 1, 1, NULL, '2019-11-24 15:07:45', '2019-11-24 15:07:45', 0),
(21, 'เพื่อสร้างกำลังใจให้นักศึกษา', 1, 1, NULL, '2019-11-24 15:07:45', '2019-11-24 15:07:45', 0),
(22, 'เพื่อสร้างความรู้ใหม่ๆทางวิชาการให้นักศึกษา', 4, 1, NULL, '2019-11-24 15:12:04', '2019-11-24 15:12:04', 0),
(23, 'เพื่อส่งเสริมการเรียนรู้ด้านคอมพิวเตอร์', 4, 1, NULL, '2019-11-24 15:12:04', '2019-11-24 15:12:04', 0),
(28, 'สร้างความสัมพันธ์น้องพี่ ภายในภาควิชาคอมพิวเตอร์', 5, 1, NULL, '2019-12-14 09:43:53', '2019-12-14 09:43:53', 0),
(29, 'เพื่อใช้สร้างสมรรถภาพทางร่างกาย', 5, 1, NULL, '2019-12-14 09:43:53', '2019-12-14 09:43:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_supports`
--

CREATE TABLE `project_supports` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_uid` int(11) NOT NULL,
  `updated_uid` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ผู้สนับสนุนโครงการ';

--
-- Dumping data for table `project_supports`
--

INSERT INTO `project_supports` (`id`, `name`, `project_id`, `created_uid`, `updated_uid`, `created_at`, `updated_at`, `deleted`) VALUES
(13, 'ผู้สนับสนุน :1', 3, 1, NULL, '2019-11-24 10:07:52', '2019-11-24 10:07:52', 0),
(14, 'ผู้สนับสนุน : 2', 3, 1, NULL, '2019-11-24 10:07:52', '2019-11-24 10:07:52', 0),
(18, 'คณะบดีณคะวิทยาศาสตร์', 1, 1, NULL, '2019-11-24 15:07:45', '2019-11-24 15:07:45', 0),
(19, 'คณะอาจารย์ภาควิชาคอมพิวเตอร์', 1, 1, NULL, '2019-11-24 15:07:45', '2019-11-24 15:07:45', 0),
(20, 'กระทรวงดิจิตอล', 4, 1, NULL, '2019-11-24 15:12:04', '2019-11-24 15:12:04', 0),
(21, 'กระทรวง ICT', 4, 1, NULL, '2019-11-24 15:12:04', '2019-11-24 15:12:04', 0),
(22, 'มหาวิทยาลัยราชภัฏอุตรดิตถ์', 4, 1, NULL, '2019-11-24 15:12:04', '2019-11-24 15:12:04', 0),
(25, 'คณะบดีณคะวิทยาศาสตร์', 5, 1, NULL, '2019-12-14 09:43:53', '2019-12-14 09:43:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_uid` int(11) NOT NULL,
  `updated_uid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `display_name`, `description`, `created_at`, `updated_at`, `deleted`, `created_uid`, `updated_uid`) VALUES
(1, 'master', 'web', 'Web Master', 'Web Master is master role', '2019-11-15 22:51:57', '2019-11-22 23:48:01', 0, 0, 2),
(2, 'admin', 'web', 'ผู้ดูแลระบบ (admin)', 'ทำหน้าที่จัดการข้อมูลต่าง ๆ', '2019-11-15 22:51:57', '2019-11-23 02:32:19', 0, 0, 2),
(3, 'writer', 'web', 'Writer', 'Writing', '2019-11-15 22:51:57', '2019-11-23 02:32:32', 1, 0, 2),
(6, 'student', 'web', 'นักศึกษา11', 'dfasdfsadfxx', '2019-11-22 23:48:24', '2019-11-22 23:56:39', 1, 2, 2),
(7, 'manager', 'web', 'ผู้บริหาร / อาจารย์', 'ผู้บริหารโครงการ', '2019-11-23 02:33:27', '2019-12-08 02:34:54', 0, 2, 4),
(8, 'officer', 'web', 'เจ้าหน้าที่', 'เจ้าหน้าที่ดูแลโครงการ', '2019-11-23 02:34:00', '2019-11-23 02:34:00', 0, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(20, 7),
(21, 8),
(22, 8),
(23, 8),
(24, 7),
(24, 8),
(25, 8),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `task_owner_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=no done, 2=done ',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_uid` int(11) NOT NULL,
  `updated_uid` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `project_id`, `task_owner_id`, `status`, `start_date`, `end_date`, `created_uid`, `updated_uid`, `created_at`, `updated_at`, `deleted`, `description`) VALUES
(1, 'qwerwqer', 5, 1, 1, NULL, NULL, 1, NULL, '2019-11-30 07:44:12', '2019-11-30 07:44:12', 0, 'wqerqwerwqer'),
(2, 'qwerwqer', 5, 1, 1, NULL, NULL, 1, NULL, '2019-11-30 07:44:45', '2019-11-30 07:44:45', 0, 'wqerqwerwqer'),
(3, 'qwerwqer', 5, 1, 1, NULL, NULL, 1, NULL, '2019-11-30 07:45:03', '2019-11-30 07:45:03', 0, 'wqerqwerwqer'),
(4, 'qwerwqer', 5, 1, 1, '2019-11-01 00:00:00', '2019-11-30 00:00:00', 1, NULL, '2019-11-30 07:45:40', '2019-11-30 07:45:40', 0, 'wqerqwerwqer'),
(5, 'ชื่อกิจกรรม', 1, 1, 1, '2019-11-01 00:00:00', '2019-11-27 00:00:00', 1, 1, '2019-11-30 08:51:52', '2019-11-30 09:18:51', 1, NULL),
(6, 'ชื่อกิจกรรม 2', 1, 1, 1, NULL, NULL, 1, 1, '2019-11-30 09:10:29', '2019-11-30 09:18:39', 1, NULL),
(7, 'qwerwqer', 1, 1, 1, '2019-11-01 00:00:00', '2019-11-27 00:00:00', 1, NULL, '2019-11-30 09:18:59', '2019-11-30 09:18:59', 0, NULL),
(8, 'ชื่อกิจกรรม 2', 3, 4, 1, NULL, NULL, 4, NULL, '2019-12-08 09:00:59', '2019-12-08 09:00:59', 0, NULL),
(9, 'กิจกรรมที่ 1 xxxx', 6, 9, 2, '2019-12-08 00:00:00', '2019-12-31 00:00:00', 9, 9, '2019-12-14 06:50:22', '2019-12-14 09:11:47', 0, 'XXXXXXXXXXXXXXXXXXX'),
(10, 'กิจกรรม 2', 6, 9, 2, '2019-12-26 00:00:00', '2019-12-28 00:00:00', 9, 9, '2019-12-14 07:05:55', '2019-12-14 09:11:41', 0, 'รายละเอียดกิจกรรม 111111111111'),
(11, 'ชื่อกิจกรรม 3', 6, 9, 2, '2019-12-07 00:00:00', '2019-12-25 00:00:00', 9, 9, '2019-12-14 07:15:48', '2019-12-14 08:37:41', 0, NULL),
(12, 'ชื่อกิจกรรม 1', 8, 9, 2, '2019-12-13 00:00:00', '2019-12-24 00:00:00', 9, 9, '2019-12-14 10:32:45', '2019-12-14 10:33:57', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_members`
--

CREATE TABLE `task_members` (
  `id` int(11) NOT NULL,
  `mission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หน้าที่',
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_uid` int(11) NOT NULL,
  `updated_uid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_members`
--

INSERT INTO `task_members` (`id`, `mission`, `task_id`, `user_id`, `created_at`, `updated_at`, `created_uid`, `updated_uid`) VALUES
(6, NULL, 7, 6, '2019-11-30 10:45:23', '2019-11-30 10:45:23', 1, NULL),
(7, NULL, 7, 7, '2019-11-30 10:45:30', '2019-11-30 10:45:30', 1, NULL),
(8, NULL, 7, 4, '2019-11-30 10:45:41', '2019-11-30 10:45:41', 1, NULL),
(9, NULL, 7, 3, '2019-11-30 10:45:45', '2019-11-30 10:45:45', 1, NULL),
(10, NULL, 1, 9, '2019-12-07 07:33:46', '2019-12-07 07:33:46', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_uid` int(11) DEFAULT NULL,
  `updated_uid` int(11) DEFAULT NULL,
  `tel_no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `profile_img_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `email_verified_at`, `created_uid`, `updated_uid`, `tel_no`, `remember_token`, `created_at`, `updated_at`, `deleted`, `active`, `profile_img_path`) VALUES
(1, 'master', '$2y$10$2yw5/.fbJ1T4s1IzxW8MsOc7pu7K5DnbkqlI6eD3EJAlSFFycMQZ2', 'Web', 'Master', 'master@mail.com', NULL, NULL, 1, NULL, NULL, '2019-11-15 22:51:57', '2019-12-07 22:39:47', 0, 1, '/img/users/profile_img/51080350_2002713533160307_4938707628663504896_o_a7e456ba-e9f1-4595-91f2-5563604f3dc5.jpg'),
(2, 'admin', '$2y$10$2.dZyrUtqFP192qsqwRP.OuSDH2sbdbTfKdsKDlCywU/350rqnUWe', 'Admin', NULL, 'admin@mail.com', NULL, NULL, 1, NULL, NULL, '2019-11-15 22:51:57', '2019-12-10 02:56:44', 0, 1, '/img/users/profile_img/user1-128x128_019e6de7-e112-4d2e-99c1-29daafc55a6a.jpg'),
(3, 'writer', '$2y$10$1lLlYgVCXUt6BUcHt3CngeirXz/HRa1vYcec3/2pnY0aJR1zB/QaG', 'Writer', NULL, 'writer@mail.com', NULL, NULL, 1, NULL, NULL, '2019-11-15 22:51:57', '2019-11-24 09:21:23', 1, 1, NULL),
(4, 'attachai27', '$2y$10$kUauuqA4KRCJztRGGXuGCOUdtcUaqKYxMOVzWZWjxgkAg5Ydln7tK', 'Attachai', 'Saorangtoi', 'attachai@gmail.com', NULL, 1, 4, NULL, NULL, '2019-11-16 00:19:23', '2019-12-08 04:17:44', 0, 1, '/img/users/profile_img/76607525_2456741161090873_3753989158314442752_o_38d2aa79-51cd-492f-aec2-99c36c9e684f.jpg'),
(5, 'attachai1993', '$2y$10$VIc8nRiiKeVvKMaO6lB4w.aY7zB7ia9BElewS63pLpq3Sp.1f2LLW', 'อรรถชัย', 'เสารางทอย', 'attachaisaorangtoi@gmail.com', NULL, 2, 1, NULL, '0yHIR0uVmkN0Ral7p1vgbPjZtZdwNPgo6qwJM6DdUDwZ2xBcTJ2CsZbBErBT', '2019-11-22 22:26:33', '2019-12-07 22:41:43', 1, 1, NULL),
(6, 'sarawuth', '$2y$10$5w4O2o7fLbLluP8xM/jDxeO3UbFUO.lKUU2aRDAfLxkXCplpOcrd6', 'ศราวุฒ', 'ปิ่นศักดิ์', 'sarawuth@gmail.com', NULL, 1, 4, NULL, NULL, '2019-11-24 09:16:08', '2019-12-08 04:17:46', 0, 1, '/img/users/profile_img/62365191_2286231481468982_7933381753417236480_o_d3e52db3-ebdd-434e-b54c-111a39a2e9c5.jpg'),
(7, 'jirapas', '$2y$10$kQADBISqJXeT2F0nY/MDhOR8d0L0lpqZylZhnx/VNK8goMKWerEfW', 'จิราภาส', 'เพ็งเลีย', 'jirapas@gmail.com', NULL, 1, 1, NULL, NULL, '2019-11-24 09:18:58', '2019-12-10 02:56:30', 0, 1, '/img/users/profile_img/64286734_2455813117795110_7109410518405742592_n_8ccc12e2-c058-4269-aca0-6461486b1345.jpg'),
(8, 'panithan', '$2y$10$5u9zJK74ONKLo4jrkdunIOYqRW1lj5Ud.kyW1aP/oSbd/3GPuymF.', 'ปนิธาน', 'คนดี', 'panithan@gmail.com', NULL, 1, 1, NULL, NULL, '2019-11-24 09:20:03', '2019-12-08 04:17:50', 0, 1, '/img/users/profile_img/73390808_2504997836242701_7058824453722996736_o_490982fc-6acf-4854-9e9d-a50d6e80e95b.jpg'),
(9, 'beam1993', '$2y$10$dJkffGou4HFwPfyiKHMXrOzl8TVM1dcl.ht79PtnXD3mrv1PmtAta', 'สุธีรพจน์', 'นานา', 'beam@gmail.com', NULL, 1, 1, NULL, NULL, '2019-11-24 09:21:13', '2019-12-08 04:17:52', 0, 1, '/img/users/profile_img/17159242_10206397024245037_2061820410712682421_o_5323b0e0-488b-4889-aeac-ea30a5544c02.jpg'),
(10, 'ampp1993', '$2y$10$Pfr6UnY1TszvHrA8bOenuOecbvisuebJ4879RAnSoHo8hK26kNrCe', 'ชฎาพร', 'ศรเทียน', 'ampp@gmail.com', NULL, 1, 4, NULL, NULL, '2019-11-24 09:22:12', '2019-12-08 04:17:54', 0, 1, '/img/users/profile_img/74211284_2629609137099704_309410393191612416_o_9f99d95e-b2d6-4635-a803-975c43b43a03.jpg'),
(11, 'asdfasdf', '$2y$10$UG1B8JHu4na8osh4Sn.4nu6mv89KbTz58bMkJY52ciNmvyCQWltWK', 'sadfasd', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-12-07 03:00:35', '2019-12-08 01:02:54', 1, 1, '/img/users/profile_img/project_c4163516-adf9-4522-89a4-beec61b7378d.png'),
(12, 'nareewan', '$2y$10$GhS8BFx86Pgb5aBZzVLrqen9ltvjGHrY7ts8tZ7/mcr4irLWxjQrG', 'อาจารย์นารีวรรณ', 'พวงภาคีศิริ', 'nareewan@uru.ac.th', NULL, 1, 1, NULL, NULL, '2019-12-07 03:13:05', '2019-12-08 04:17:56', 0, 1, '/img/users/profile_img/avatar3_45ae6381-58b8-40c3-84ff-10faf79e666b.png'),
(13, 'julalug', '$2y$10$48pwCHlZkoLMP3KD2rSOF.6Y8uHJ9RrnSUTM5cz.5VvYDES/hedIC', 'อาจารย์จุฬาลักษณ์', 'มหาวัน', 'julalug@uru.ac.th', NULL, 1, 1, NULL, NULL, '2019-12-07 03:14:24', '2019-12-08 04:17:58', 0, 1, '/img/users/profile_img/avatar2_7ca67248-9f0b-4f0c-966e-c7f5c4496c82.png'),
(14, 'anucha', '$2y$10$Op3fXUxOjqP9gT3bxFI06ug6EUmBaI1MS7SmVURTkGlX9mOgy3Ss2', 'อาจารย์อนุชา', 'เรืองศิริวัฒนกุล', 'anucha@uru.ac.th', NULL, 1, 1, NULL, NULL, '2019-12-07 03:15:16', '2019-12-08 04:17:59', 0, 1, '/img/users/profile_img/avatar5_ff090680-f577-41d9-85db-17bd066e2797.png'),
(15, 'asdfasdfasdf', '$2y$10$zJm5eWw4Kt7hSwHf/4va9u7T4IHUf.WACeDolPsZnAeee2tDtWa76', 'asdfasdf', 'sadfsadfsa', 'attachaisaorangtoi44@gmail.com', NULL, 1, NULL, NULL, NULL, '2019-12-08 00:46:17', '2019-12-08 00:57:39', 1, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_expecteds`
--
ALTER TABLE `project_expecteds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_logs`
--
ALTER TABLE `project_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_positions`
--
ALTER TABLE `project_positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_purposes`
--
ALTER TABLE `project_purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_supports`
--
ALTER TABLE `project_supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_members`
--
ALTER TABLE `task_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_expecteds`
--
ALTER TABLE `project_expecteds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `project_logs`
--
ALTER TABLE `project_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_members`
--
ALTER TABLE `project_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `project_positions`
--
ALTER TABLE `project_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project_purposes`
--
ALTER TABLE `project_purposes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `project_supports`
--
ALTER TABLE `project_supports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `task_members`
--
ALTER TABLE `task_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
