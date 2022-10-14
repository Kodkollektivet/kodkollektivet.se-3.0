-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 14, 2022 at 07:11 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kdkl_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origin` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `user_id`, `item_id`, `item_type`, `origin`, `created_at`, `updated_at`) VALUES
(53, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur neque ipsam dolore eveniet. Laudantium perferendis deleniti facilis, provident ducimus aperiam ullam, totam debitis, alias nemo reprehenderit consectetur optio dolorem fuga!', 1, 56, 'post', NULL, '2022-10-09 17:29:45', '2022-10-09 17:29:45'),
(54, '???', 1, 53, 'comment', 53, '2022-10-09 17:37:37', '2022-10-09 17:37:37'),
(55, 'hmmmmmmm', 1, 54, 'comment', 53, '2022-10-09 17:43:48', '2022-10-09 17:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_images`
--

CREATE TABLE `deleted_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `log_id` int(11) DEFAULT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delete_logs`
--

CREATE TABLE `delete_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `action_id` int(10) UNSIGNED NOT NULL,
  `item` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `link`, `type`, `date`, `place`, `user_id`, `image`, `intro`, `description`, `created_at`, `updated_at`) VALUES
(19, 'Your event title', NULL, 1, '2022-10-10T20:17', 'Videum', 1, '1665339446_2BB9A21B-9717-4826-87E2-E06C8C14F417.jpeg', 'The intro for your event; keep it short! :)', 'The event itself. Separate paragraphs with an empty line. The event itself. Separate paragraphs with an empty line.\r<br>\r<br>The event itself. Separate paragraphs with an empty line.\r<br>\r<br>The event itself. Separate paragraphs with an empty line.', '2022-10-09 18:17:26', '2022-10-09 18:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `event_tags`
--

CREATE TABLE `event_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_users`
--

CREATE TABLE `event_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_users`
--

INSERT INTO `event_users` (`id`, `user_id`, `event_id`, `created_at`, `updated_at`) VALUES
(6, 1, 19, '2022-10-09 18:29:18', '2022-10-09 18:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` int(10) UNSIGNED NOT NULL,
  `follower` int(10) UNSIGNED NOT NULL,
  `following` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `src`, `alt`, `item_id`, `item_type`, `cover`, `created_at`, `updated_at`) VALUES
(62, '1665335398_E622ADE4-78C4-4894-95BC-8B00AFA78AFE_1_201_a.jpeg', NULL, 56, 'post', NULL, '2022-10-09 17:09:59', '2022-10-09 17:09:59'),
(63, '1665335399_7DE61952-3198-421B-BF0D-5BBEEF99630A_1_201_a.jpeg', NULL, 56, 'post', NULL, '2022-10-09 17:09:59', '2022-10-09 17:09:59'),
(64, '1665335399_85209E89-C7E6-468A-907B-E99DC32890C9.jpeg', NULL, 56, 'post', NULL, '2022-10-09 17:09:59', '2022-10-09 17:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE `invites` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `sent_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`id`, `user_id`, `sent_to`, `accepted`, `created_at`, `updated_at`) VALUES
(8, 1, 'evilfirtree@gmail.com', 1, '2022-10-09 19:21:57', '2022-10-09 19:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `member_tasks`
--

CREATE TABLE `member_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `action_id` int(10) UNSIGNED NOT NULL,
  `viewed` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remove_posts` tinyint(1) NOT NULL DEFAULT '0',
  `remove_events` tinyint(1) NOT NULL DEFAULT '0',
  `remove_projects` tinyint(1) NOT NULL DEFAULT '0',
  `remove_docs` tinyint(1) NOT NULL DEFAULT '0',
  `create_posts` tinyint(1) NOT NULL DEFAULT '0',
  `create_events` tinyint(1) NOT NULL DEFAULT '0',
  `create_projects` tinyint(1) NOT NULL DEFAULT '0',
  `create_docs` tinyint(1) NOT NULL DEFAULT '0',
  `edit_posts` tinyint(1) NOT NULL DEFAULT '0',
  `edit_events` tinyint(1) NOT NULL DEFAULT '0',
  `edit_projects` tinyint(1) NOT NULL DEFAULT '0',
  `edit_docs` tinyint(1) NOT NULL DEFAULT '0',
  `edit_users` tinyint(1) NOT NULL DEFAULT '0',
  `edit_social` tinyint(1) NOT NULL DEFAULT '0',
  `close_accounts` tinyint(1) NOT NULL DEFAULT '0',
  `remove_userdata` tinyint(1) NOT NULL DEFAULT '0',
  `set_roles` tinyint(1) NOT NULL DEFAULT '0',
  `set_positions` tinyint(1) NOT NULL DEFAULT '0',
  `ban` tinyint(1) NOT NULL DEFAULT '0',
  `application_decide` tinyint(1) NOT NULL DEFAULT '0',
  `open` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `remove_posts`, `remove_events`, `remove_projects`, `remove_docs`, `create_posts`, `create_events`, `create_projects`, `create_docs`, `edit_posts`, `edit_events`, `edit_projects`, `edit_docs`, `edit_users`, `edit_social`, `close_accounts`, `remove_userdata`, `set_roles`, `set_positions`, `ban`, `application_decide`, `open`) VALUES
(1, 'President', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
(2, 'Vice President', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
(3, 'Treasurer', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'Assistant Treasurer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'Marketing / Socials Manager', 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0),
(6, 'Game Manager', 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'WEB Manager', 1, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 0, 0, 1, 0, 0),
(8, 'Infrastructure Manager', 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'Secretary', 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 'Social Events Manager', 0, 1, 0, 0, 1, 1, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 'Discord Manager', 0, 0, 0, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(12, 'Robotics Manager', 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 'Project Manager', 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 'Moderator', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `position_applications`
--

CREATE TABLE `position_applications` (
  `id` int(10) UNSIGNED NOT NULL,
  `position_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci,
  `approved` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `community` int(1) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `user_id`, `community`, `image`, `intro`, `description`, `created_at`, `updated_at`) VALUES
(56, 'Test layout 1', 1, NULL, '1665335398_2BB9A21B-9717-4826-87E2-E06C8C14F417.jpeg', 'asdlakjsdlkjalksd alskjdlkajslkdj!!', 'The post itself. Separate paragraphs with an empty line. The post itself. Separate paragraphs with an empty line.\r<br>\r<br>The post itself. Separate paragraphs with an empty line.\r<br>\r<br>!-- start php --! echo \'H3110, w0r1d!\'; !-- end --!', '2022-10-09 17:09:58', '2022-10-09 17:09:58'),
(57, 'Your post title', 1, 1, '1665337750_C048AACD-A0CF-46E3-914E-30DF0A5E7C4A.jpeg', 'The intro for your post; keep it short! :)', 'The post itself. Separate paragraphs with an empty line. The post itself. Separate paragraphs with an empty line.\r<br>\r<br>The post itself. Separate paragraphs with an empty line.\r<br>\r<br>The post itself. Separate paragraphs with an empty line. The post itself. Separate paragraphs with an empty line.', '2022-10-09 17:49:10', '2022-10-09 17:49:10'),
(58, 'Your post title', 1, 1, NULL, 'The intro for your post; keep it short! :)', 'The post itself. Separate paragraphs with an empty line. The post itself. Separate paragraphs with an empty line.\r<br>\r<br>The post itself. Separate paragraphs with an empty line.\r<br>\r<br>The post itself. Separate paragraphs with an empty line.', '2022-10-09 17:50:14', '2022-10-09 17:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(56, 56, 5, '2022-10-09 17:09:59', '2022-10-09 17:09:59'),
(57, 57, 4, '2022-10-09 17:49:10', '2022-10-09 17:49:10'),
(58, 57, 5, '2022-10-09 17:49:10', '2022-10-09 17:49:10'),
(59, 58, 2, '2022-10-09 17:50:14', '2022-10-09 17:50:14'),
(60, 58, 3, '2022-10-09 17:50:14', '2022-10-09 17:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_stages`
--

CREATE TABLE `project_stages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_tags`
--

CREATE TABLE `project_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_users`
--

CREATE TABLE `project_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `item_id`, `item_type`, `type`, `content`, `resolved`, `created_at`, `updated_at`) VALUES
(21, 1, 30, 'user', 'Abuse / harassment', 'aslhjdkjahsd', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` tinyint(1) NOT NULL DEFAULT '0',
  `post` tinyint(1) NOT NULL DEFAULT '0',
  `apply_positions` tinyint(1) NOT NULL DEFAULT '0',
  `h_comment` tinyint(1) NOT NULL DEFAULT '0',
  `h_post` tinyint(1) NOT NULL DEFAULT '0',
  `h_comment_lim` int(11) DEFAULT NULL,
  `h_post_lim` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `comment`, `post`, `apply_positions`, `h_comment`, `h_post`, `h_comment_lim`, `h_post_lim`) VALUES
(1, 'Board', 1, 1, 1, 1, 1, NULL, NULL),
(2, 'Member', 1, 1, 1, 1, 1, NULL, 1),
(3, 'Veteran', 1, 1, 1, 1, 1, NULL, NULL),
(4, 'Guest', 0, 0, 0, 1, 1, 10, 1),
(5, 'Purgatory', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('h5idT6U66UeQhewiZnx7Dc4UJA4UVVCpfgeuh7SV', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDZzbkxzZHhRNHF4Z3N5ZkVUYzUxQkJTanFSQWpoZnRZOGdnb042MyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1665498539),
('wulJ4i4bXnlFrAOHndrLuw2RHyjS3fOB6U6QKSmT', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZk1yQm9OMmNtZDVUMmdYb1h5ZFNwaEI4SnFweDJyMlRUeVJ1dWJiRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tZW1iZXIvdGhlQWxleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1665686865);

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `name`, `url`, `description`, `username`, `password`, `feature`, `created_at`, `updated_at`) VALUES
(1, 'Facebook', 'https://www.facebook.com/kodkollektivet/', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus, fugiat inventore consequuntur ea nemo quaerat dolore eaque nesciunt, aisjhdioas', 'jdalksdj', 'eyJpdiI6IkZES2NSeG84ei9BT3YrazN3eWxyNGc9PSIsInZhbHVlIjoiWWlITDJVdUtvRlFwYWluZlhVN2l4UT09IiwibWFjIjoiNDg2MmUyNGVkNDUwMDJlMGJjNDAzMTQ4MjRiNGRmZTZhZmVhOWM4NTJkOGY2M2RlOTk0ZmE5YzRmNmY3YWIwNiIsInRhZyI6IiJ9', 1, NULL, '2022-09-19 17:34:13'),
(2, 'Instagram', 'https://www.instagram.com/kodkollektivet/', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus, fugiat inventore consequuntur ea nemo quaerat dolore eaque nesciunt,', NULL, 'eyJpdiI6ImpabjQzSEJrMVZESFQ1eHV1cHQyNEE9PSIsInZhbHVlIjoiNDYyR1BVL0Myc0ViT2pQc09PbWdmQT09IiwibWFjIjoiZmZiNDcxNjVhMjk2NWYwZDhiNzM3ZmE5MjRjY2NjNGEwOTgwYjNmMDc1NmFkOGJmYzIwOTg2OTE3ZDBkMjhkYSIsInRhZyI6IiJ9', 1, NULL, '2022-09-19 17:31:42'),
(3, 'GitHub', 'https://github.com/Kodkollektivet', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus, fugiat inventore consequuntur ea nemo quaerat dolore eaque nesciunt,', 'aslkdnlaksd', 'eyJpdiI6IkczRjRkSTNwR2lHK0lYVXIwUGh2RkE9PSIsInZhbHVlIjoia3cxVjM3VVJvK1BUQXV6cE1lU2tuZz09IiwibWFjIjoiMGY0YjMxODU2YTY5MGViNDUwMzhkOWYwNzhkMTAwZmIzZTlkNzAzY2M0ZThkYzlmNWViYTY2NTM3YTcyMDkwOCIsInRhZyI6IiJ9', NULL, NULL, '2022-10-09 18:48:10'),
(4, 'Discord', 'https://discord.gg/gh9DmaRE', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus, fugiat inventore consequuntur ea nemo quaerat dolore eaque nesciunt,', NULL, 'eyJpdiI6Im9lNVlSU3BoeWVDMWVBRHBsY2RWQkE9PSIsInZhbHVlIjoiaDFVWGh5b0FnejFraWlMb2hWTWorUT09IiwibWFjIjoiMWUxMmYxMDFiMTc4NDYyMzAxMGM3MmNmZTgwZDA0Mzc2MTU5ZTA5MDg3OGM4N2U4ODhlZmIxYzM3ZjMzZTBjNiIsInRhZyI6IiJ9', 1, NULL, '2022-10-09 18:47:09'),
(5, 'YouTube', 'https://www.youtube.com/channel/UC-RTLmclEA4gdc7aVOqHkLw', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus, fugiat inventore consequuntur ea nemo quaerat dolore eaque nesciunt,', NULL, 'eyJpdiI6IjFLSnFMN1lOZ0tNd0VGMVdmWFhvSFE9PSIsInZhbHVlIjoicXA1UXdtd2E4VmRhQm9EZVlobkN0dz09IiwibWFjIjoiZjc0NTk5MTNhNTNjODg2NTk0MGU1YTZjN2RiZGQ1YzE1MmJhNzRhNzczY2I4NjJjY2I5MDhjYzQ2MTdhYWNkOCIsInRhZyI6IiJ9', NULL, NULL, '2022-10-09 18:47:14'),
(6, 'LinkedIn', 'https://in.linkedin.com/company/kodkollektivet-lnu', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloribus, fugiat inventore consequuntur ea nemo quaerat dolore eaque nesciunt,', NULL, 'eyJpdiI6IklOUUtYVDlEa0JXcUlNbktzVG80enc9PSIsInZhbHVlIjoiNlNZMmgxclZNenQ3dTlvQXVicmlXZz09IiwibWFjIjoiNmUwN2I4MzI1YmVjNWExY2QyZjhhNDY1YmUyYmFjMjI1ZjJlMzVkMzIwMGIxNWNhZTA2MTk3NDI5ZTUyZDg0OCIsInRhZyI6IiJ9', NULL, NULL, '2022-10-09 18:47:18');

-- --------------------------------------------------------

--
-- Table structure for table `stage_images`
--

CREATE TABLE `stage_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `src` int(11) NOT NULL,
  `alt` int(11) NOT NULL,
  `stage_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stage_tasks`
--

CREATE TABLE `stage_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `done` tinyint(1) DEFAULT NULL,
  `stage_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Robotics', NULL, NULL),
(2, 'Software', NULL, NULL),
(3, 'Hardware', NULL, NULL),
(4, 'Education', NULL, NULL),
(5, 'other', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `technologies`
--

CREATE TABLE `technologies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technologies`
--

INSERT INTO `technologies` (`id`, `name`, `icon`, `type`) VALUES
(1, 'Agda', NULL, 'Programming / markup languages'),
(2, 'ASM', NULL, 'Programming / markup languages'),
(3, 'Bash', 'bash-plain', 'Programming / markup languages'),
(4, 'C', 'c-plain', 'Programming / markup languages'),
(5, 'CFML', NULL, 'Programming / markup languages'),
(6, 'Clojure', 'clojure-line', 'Programming / markup languages'),
(7, 'CoffeeScript', 'coffeescript-original', 'Programming / markup languages'),
(8, 'Lisp', NULL, 'Programming / markup languages'),
(9, 'C++', 'cplusplus-plain', 'Programming / markup languages'),
(10, 'Crystal', 'crystal-original', 'Programming / markup languages'),
(11, 'C#', 'csharp-plain', 'Programming / markup languages'),
(12, 'Dart', 'dart-plain', 'Programming / markup languages'),
(13, 'Elixir', 'elixir-plain', 'Programming / markup languages'),
(14, 'Elm', 'elm-plain', 'Programming / markup languages'),
(15, 'Erlang', 'erlang-plain', 'Programming / markup languages'),
(16, 'F#', 'fsharp-plain', 'Programming / markup languages'),
(17, 'Go', 'go-original-wordmark', 'Programming / markup languages'),
(18, 'Groovy', 'groovy-plain', 'Programming / markup languages'),
(19, 'Haskell', 'haskell-plain', 'Programming / markup languages'),
(20, 'Haxe', 'haxe-plain', 'Programming / markup languages'),
(21, 'HTML', 'html5-plain', 'Programming / markup languages'),
(22, 'Java', 'java-plain', 'Programming / markup languages'),
(23, 'JavaScript', 'javascript-plain', 'Programming / markup languages'),
(24, 'Julia', 'julia-plain', 'Programming / markup languages'),
(25, 'Kotlin', 'kotlin-plain', 'Programming / markup languages'),
(26, 'Lua', 'lua-plain', 'Programming / markup languages'),
(27, 'NASM', NULL, 'Programming / markup languages'),
(28, 'Objective-C', 'objectivec-plain', 'Programming / markup languages'),
(29, 'Perl', 'perl-plain', 'Programming / markup languages'),
(30, 'PHP', 'php-plain', 'Programming / markup languages'),
(31, 'Python', 'python-plain', 'Programming / markup languages'),
(32, 'Ruby', 'ruby-plain', 'Programming / markup languages'),
(33, 'Rust', 'rust-plain', 'Programming / markup languages'),
(34, 'Scala', 'scala-plain', 'Programming / markup languages'),
(35, 'Solidity', 'solidity-plain', 'Programming / markup languages'),
(36, 'Swift', 'swift-plain', 'Programming / markup languages'),
(37, 'TypeScript', 'typescript-plain', 'Programming / markup languages'),
(38, 'JSON', NULL, 'Programming / markup languages'),
(39, 'XML', NULL, 'Programming / markup languages'),
(40, 'Laravel', 'laravel-plain', 'Frameworks / CMS'),
(41, 'CodeIgniter', 'codeigniter-plain', 'Frameworks / CMS'),
(42, 'Symfony', 'symfony-original', 'Frameworks / CMS'),
(43, 'CakePHP', 'cakephp-plain', 'Frameworks / CMS'),
(44, 'Zend', 'zend-plain', 'Frameworks / CMS'),
(45, 'WordPress', 'wordpress-plain', 'Frameworks / CMS'),
(46, 'React', 'react-original', 'Frameworks / CMS'),
(47, 'Vue', 'vuejs-plain', 'Frameworks / CMS'),
(48, 'Angular', 'angularjs-plain', 'Frameworks / CMS'),
(49, 'Ember', 'ember-original-wordmark', 'Frameworks / CMS'),
(50, 'Node.js', 'nodejs-plain', 'Frameworks / CMS'),
(51, 'Svelte', 'svelte-plain', 'Frameworks / CMS'),
(52, 'Preact', NULL, 'Frameworks / CMS'),
(53, 'BackBoneJS', 'backbonejs-plain', 'Frameworks / CMS'),
(54, 'Polymer', NULL, 'Frameworks / CMS'),
(55, 'Next', 'nextjs-original', 'Frameworks / CMS'),
(56, 'Aurelia', NULL, 'Frameworks / CMS'),
(57, 'Express', 'express-original', 'Frameworks / CMS'),
(58, 'Meteor.JS', 'meteor-plain', 'Frameworks / CMS'),
(59, 'Gatsby', 'gatsby-plain', 'Frameworks / CMS'),
(60, 'Mithril', NULL, 'Frameworks / CMS'),
(61, 'Nuxt', 'nuxtjs-plain', 'Frameworks / CMS'),
(62, 'Jest', 'jest-plain', 'Frameworks / CMS'),
(63, '.NET', 'dot-net-plain', 'Frameworks / CMS'),
(64, 'Umbraco', NULL, 'Frameworks / CMS'),
(65, 'CherryPy', NULL, 'Frameworks / CMS'),
(66, 'Django', 'django-plain', 'Frameworks / CMS'),
(67, 'Falcon', NULL, 'Frameworks / CMS'),
(68, 'Flask', 'flask-original', 'Frameworks / CMS'),
(69, 'Pyramid', NULL, 'Frameworks / CMS'),
(70, 'Tornado', NULL, 'Frameworks / CMS'),
(71, 'TurboGears', NULL, 'Frameworks / CMS'),
(72, 'Web2Py', NULL, 'Frameworks / CMS'),
(73, 'Unix', 'unix-original', 'OSs, VMs, Version control'),
(74, 'Windows', 'windows8-original', 'OSs, VMs, Version control'),
(75, 'Docker', 'docker-plain', 'OSs, VMs, Version control'),
(76, 'Kubernetes', 'kubernetes-plain', 'OSs, VMs, Version control'),
(77, 'Git', 'git-plain', 'OSs, VMs, Version control'),
(78, 'Oracle', 'oracle-original', 'Databases'),
(79, 'MySQL', 'mysql-plain', 'Databases'),
(80, 'SQL Server', NULL, 'Databases'),
(81, 'PostgreSQL', 'postgresql-plain', 'Databases'),
(82, 'MongoDB', 'mongodb-plain', 'Databases'),
(83, 'Redis', 'redis-plain', 'Databases'),
(84, 'Elasticsearch', NULL, 'Databases'),
(85, 'SQLite', 'sqlite-plain', 'Databases'),
(86, 'Unity', 'unity-original', 'Game engines'),
(87, 'Unreal Engine', 'unrealengine-original', 'Game engines'),
(88, 'Godot', 'godot-plain', 'Game engines'),
(89, 'Phaser', NULL, 'Game engines'),
(90, 'GameMaker Studio 2', NULL, 'Game engines'),
(91, 'Maya', 'maya-plain', '3D graphics, CAD'),
(92, 'ZBrush', NULL, '3D graphics, CAD'),
(93, 'Blender', 'blender-original', '3D graphics, CAD'),
(94, 'Houdini', NULL, '3D graphics, CAD'),
(95, 'Cinema 4D', NULL, '3D graphics, CAD'),
(96, 'Autodesk 3ds Max', NULL, '3D graphics, CAD'),
(97, 'Modo', NULL, '3D graphics, CAD'),
(98, 'Lightwave 3D', NULL, '3D graphics, CAD'),
(99, 'Fusion 360', NULL, '3D graphics, CAD'),
(100, 'Rhino', NULL, '3D graphics, CAD'),
(101, 'AutoCAD', NULL, '3D graphics, CAD'),
(102, 'Photoshop', 'photoshop-plain', '2D graphics, prototyping'),
(103, 'Affinity Photo', NULL, '2D graphics, prototyping'),
(104, 'Procreate', NULL, '2D graphics, prototyping'),
(105, 'SketchBook', NULL, '2D graphics, prototyping'),
(106, 'GIMP', 'gimp-plain', '2D graphics, prototyping'),
(107, 'Figma', 'figma-plain', '2D graphics, prototyping'),
(108, 'Adobe XD', 'xd-plain', '2D graphics, prototyping'),
(109, 'Marvel', NULL, '2D graphics, prototyping');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT '4',
  `position_id` int(10) UNSIGNED DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `remove_data` tinyint(1) NOT NULL DEFAULT '0',
  `activity_hide` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `verification`, `role_id`, `position_id`, `avatar`, `password`, `session_id`, `closed`, `remove_data`, `activity_hide`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Aleksandra Bušure', 'theAlex', 'ab225tz@student.lnu.se', NULL, '', 1, 7, '1665179737_precursor.png', '$2y$10$1SqTppsYL2WWnA3hnrZ.2.49uGpSkwxYdhur9yhpiWL36LN1SO.eC', NULL, 0, 0, 0, 'EpTlxR7SwlSMz3y10b7v848XbS4U8Md0l2tp8NRgGh736snn2TVGG20lQ56f', '2022-06-26 08:20:18', '2022-10-11 14:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_actions`
--

CREATE TABLE `user_actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_actions`
--

INSERT INTO `user_actions` (`id`, `user_id`, `item_id`, `item_type`, `action`, `created_at`, `updated_at`) VALUES
(467, 1, 56, 'post', 'created', '2022-10-09 17:09:59', '2022-10-09 17:09:59'),
(468, 1, 56, 'post', 'updated', '2022-10-09 17:15:17', '2022-10-09 17:15:17'),
(469, 1, 56, 'post', 'commented on', '2022-10-09 17:29:45', '2022-10-09 17:29:45'),
(470, 1, 56, 'post', 'replied to a comment on', '2022-10-09 17:37:37', '2022-10-09 17:37:37'),
(471, 1, 56, 'post', 'replied to a comment on', '2022-10-09 17:43:48', '2022-10-09 17:43:48'),
(472, 1, 57, 'post', 'created', '2022-10-09 17:49:10', '2022-10-09 17:49:10'),
(473, 1, 58, 'post', 'created', '2022-10-09 17:50:14', '2022-10-09 17:50:14'),
(474, 1, 19, 'event', 'created', '2022-10-09 18:17:26', '2022-10-09 18:17:26'),
(475, 1, 19, 'event', 'signed up for', '2022-10-09 18:29:09', '2022-10-09 18:29:09'),
(476, 1, 19, 'event', 'is no longer planning to attend', '2022-10-09 18:29:11', '2022-10-09 18:29:11'),
(477, 1, 19, 'event', 'signed up for', '2022-10-09 18:29:12', '2022-10-09 18:29:12'),
(478, 1, 19, 'event', 'is no longer planning to attend', '2022-10-09 18:29:13', '2022-10-09 18:29:13'),
(479, 1, 19, 'event', 'signed up for', '2022-10-09 18:29:18', '2022-10-09 18:29:18'),
(482, 1, 30, 'user', 'followed', '2022-10-09 19:42:39', '2022-10-09 19:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discord` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `programme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LOE` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_started` date DEFAULT NULL,
  `date_ended` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `status`, `about`, `cover`, `phone`, `discord`, `github`, `facebook`, `linkedin`, `website`, `campus`, `programme`, `LOE`, `year`, `date_started`, `date_ended`, `created_at`, `updated_at`) VALUES
(1, 1, 'Inspired by Aimo Koivunen', 'A full-stack developer from Latvia, working part-time for a Växjö-based startup. I don\'t have to type anything else since I did take the time to fill out all the non-mandatory fields.\r\rP.S.: this website is my handiwork 🐙', '1665178047_pexels-cottonbro-9668535.jpg', NULL, 'balticKraken#0346', 'confidently_Dumb', NULL, NULL, NULL, 'Växjö', 'Software Technology', 'Bachelor', '2', '2022-03-29', NULL, '2022-06-26 08:20:18', '2022-10-11 10:27:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_technologies`
--

CREATE TABLE `user_technologies` (
  `id` int(10) UNSIGNED NOT NULL,
  `technology_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_technologies`
--

INSERT INTO `user_technologies` (`id`, `technology_id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 3, 1, '2022-09-17 15:37:53', '2022-09-17 15:37:53'),
(7, 21, 1, '2022-09-17 15:37:58', '2022-09-17 15:37:58'),
(8, 22, 1, '2022-09-17 15:37:59', '2022-09-17 15:37:59'),
(9, 23, 1, '2022-09-17 15:38:08', '2022-09-17 15:38:08'),
(10, 30, 1, '2022-09-17 15:38:11', '2022-09-17 15:38:11'),
(11, 38, 1, '2022-09-17 15:38:12', '2022-09-17 15:38:12'),
(12, 39, 1, '2022-09-17 15:38:13', '2022-09-17 15:38:13'),
(13, 37, 1, '2022-09-17 15:38:14', '2022-09-17 15:38:14'),
(14, 31, 1, '2022-09-17 15:38:18', '2022-09-17 15:38:18'),
(15, 40, 1, '2022-09-17 15:38:32', '2022-09-17 15:38:32'),
(16, 45, 1, '2022-09-17 15:38:33', '2022-09-17 15:38:33'),
(17, 42, 1, '2022-09-17 15:38:34', '2022-09-17 15:38:34'),
(18, 47, 1, '2022-09-17 15:38:36', '2022-09-17 15:38:36'),
(19, 50, 1, '2022-09-17 15:38:40', '2022-09-17 15:38:40'),
(20, 73, 1, '2022-09-17 15:38:58', '2022-09-17 15:38:58'),
(21, 77, 1, '2022-09-17 15:38:59', '2022-09-17 15:38:59'),
(22, 75, 1, '2022-09-17 15:39:01', '2022-09-17 15:39:01'),
(23, 79, 1, '2022-09-17 15:39:06', '2022-09-17 15:39:06'),
(24, 80, 1, '2022-09-17 15:39:06', '2022-09-17 15:39:06'),
(25, 83, 1, '2022-09-17 15:39:09', '2022-09-17 15:39:09'),
(26, 84, 1, '2022-09-17 15:39:10', '2022-09-17 15:39:10'),
(27, 93, 1, '2022-09-17 15:39:18', '2022-09-17 15:39:18'),
(28, 106, 1, '2022-09-17 15:39:26', '2022-09-17 15:39:26'),
(29, 105, 1, '2022-09-17 15:39:31', '2022-09-17 15:39:31'),
(35, 4, 1, '2022-10-07 03:41:54', '2022-10-07 03:41:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `deleted_images`
--
ALTER TABLE `deleted_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted_images_user_id_foreign` (`user_id`),
  ADD KEY `deleted_images_author_id_foreign` (`author_id`);

--
-- Indexes for table `delete_logs`
--
ALTER TABLE `delete_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delete_logs_user_id_foreign` (`user_id`),
  ADD KEY `delete_logs_action_id_foreign` (`action_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`);

--
-- Indexes for table `event_tags`
--
ALTER TABLE `event_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_tags_event_id_foreign` (`event_id`),
  ADD KEY `event_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `event_users`
--
ALTER TABLE `event_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_users_user_id_foreign` (`user_id`),
  ADD KEY `event_users_event_id_foreign` (`event_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follows_follower_foreign` (`follower`),
  ADD KEY `follows_following_foreign` (`following`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invites_user_id_foreign` (`user_id`);

--
-- Indexes for table `member_tasks`
--
ALTER TABLE `member_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_tasks_task_id_foreign` (`task_id`),
  ADD KEY `member_tasks_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_action_id_foreign` (`action_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_applications`
--
ALTER TABLE `position_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `position_applications_position_id_foreign` (`position_id`),
  ADD KEY `position_applications_user_id_foreign` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tags_post_id_foreign` (`post_id`),
  ADD KEY `post_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_user_id_foreign` (`user_id`);

--
-- Indexes for table `project_stages`
--
ALTER TABLE `project_stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_stages_project_id_foreign` (`project_id`);

--
-- Indexes for table `project_tags`
--
ALTER TABLE `project_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_tags_project_id_foreign` (`project_id`),
  ADD KEY `project_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `project_users`
--
ALTER TABLE `project_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_users_project_id_foreign` (`project_id`),
  ADD KEY `project_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stage_images`
--
ALTER TABLE `stage_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stage_images_stage_id_foreign` (`stage_id`);

--
-- Indexes for table `stage_tasks`
--
ALTER TABLE `stage_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stage_tasks_stage_id_foreign` (`stage_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technologies`
--
ALTER TABLE `technologies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `user_actions`
--
ALTER TABLE `user_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_actions_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_technologies`
--
ALTER TABLE `user_technologies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_technologies_technology_id_foreign` (`technology_id`),
  ADD KEY `user_technologies_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `deleted_images`
--
ALTER TABLE `deleted_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `delete_logs`
--
ALTER TABLE `delete_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `event_tags`
--
ALTER TABLE `event_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_users`
--
ALTER TABLE `event_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `invites`
--
ALTER TABLE `invites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `member_tasks`
--
ALTER TABLE `member_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `position_applications`
--
ALTER TABLE `position_applications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_stages`
--
ALTER TABLE `project_stages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_tags`
--
ALTER TABLE `project_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project_users`
--
ALTER TABLE `project_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stage_images`
--
ALTER TABLE `stage_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stage_tasks`
--
ALTER TABLE `stage_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `technologies`
--
ALTER TABLE `technologies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_actions`
--
ALTER TABLE `user_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_technologies`
--
ALTER TABLE `user_technologies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deleted_images`
--
ALTER TABLE `deleted_images`
  ADD CONSTRAINT `deleted_images_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deleted_images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `delete_logs`
--
ALTER TABLE `delete_logs`
  ADD CONSTRAINT `delete_logs_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `user_actions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delete_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_tags`
--
ALTER TABLE `event_tags`
  ADD CONSTRAINT `event_tags_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_users`
--
ALTER TABLE `event_users`
  ADD CONSTRAINT `event_users_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_follower_foreign` FOREIGN KEY (`follower`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_following_foreign` FOREIGN KEY (`following`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invites`
--
ALTER TABLE `invites`
  ADD CONSTRAINT `invites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `member_tasks`
--
ALTER TABLE `member_tasks`
  ADD CONSTRAINT `member_tasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `stage_tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `member_tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_action_id_foreign` FOREIGN KEY (`action_id`) REFERENCES `user_actions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `position_applications`
--
ALTER TABLE `position_applications`
  ADD CONSTRAINT `position_applications_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `position_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD CONSTRAINT `post_tags_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_stages`
--
ALTER TABLE `project_stages`
  ADD CONSTRAINT `project_stages_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_tags`
--
ALTER TABLE `project_tags`
  ADD CONSTRAINT `project_tags_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_users`
--
ALTER TABLE `project_users`
  ADD CONSTRAINT `project_users_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stage_images`
--
ALTER TABLE `stage_images`
  ADD CONSTRAINT `stage_images_stage_id_foreign` FOREIGN KEY (`stage_id`) REFERENCES `project_stages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stage_tasks`
--
ALTER TABLE `stage_tasks`
  ADD CONSTRAINT `stage_tasks_stage_id_foreign` FOREIGN KEY (`stage_id`) REFERENCES `project_stages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_actions`
--
ALTER TABLE `user_actions`
  ADD CONSTRAINT `user_actions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_technologies`
--
ALTER TABLE `user_technologies`
  ADD CONSTRAINT `user_technologies_technology_id_foreign` FOREIGN KEY (`technology_id`) REFERENCES `technologies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_technologies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
