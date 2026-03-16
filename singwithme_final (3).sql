-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 16, 2026 at 07:50 AM
-- Server version: 10.6.23-MariaDB
-- PHP Version: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `singwithme_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_sections`
--

CREATE TABLE `about_sections` (
  `id` bigint(20) NOT NULL,
  `about_heading` varchar(300) NOT NULL,
  `about_description_1` text NOT NULL,
  `about_description_2` text NOT NULL,
  `about_button_link` varchar(500) NOT NULL,
  `about_image_1` text DEFAULT NULL,
  `about_image_2` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_sections`
--

INSERT INTO `about_sections` (`id`, `about_heading`, `about_description_1`, `about_description_2`, `about_button_link`, `about_image_1`, `about_image_2`, `created_at`, `updated_at`) VALUES
(1, 'Who We Are – SingWithMe Records Ltd', 'At SingWithMe Records Ltd, we believe every artist deserves a platform to showcase their talent and reach a global audience. Our mission is to support independent artists by offering an easy, effective way to upload music, videos, and artwork, and distribute them to major streaming platforms such as YouTube, Spotify, iTunes, and TikTok.', 'We provide artists with royalty collection services, distribution, and promotion ensuring they havethe resources they need to succeed. SingWithMe Records Ltd takes a 20% commission on royalties, and 80% goes directly to the artists. Our platform is designed to be artist-centric, transparent, and empowering, making sure artists can focus on what they do best: creating amazing music.\r\nWhether you\'re an emerging talent or a seasoned professional, SingWithMe Records Ltd is your trusted partner in music', 'Fugiat esse nisi per', 'uploads/about/VcelqsZmNU8bAPt4uTAO2VYDaJRnslppTKhAa50h.jpg', 'uploads/about/1RRJJbE8AkF0PShcqUfXtpIxJ3iStBDnJ5pJ5UW1.jpg', '2025-08-27 10:12:06', '2025-11-24 05:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(300) NOT NULL,
  `file` text NOT NULL,
  `link` text NOT NULL,
  `visibility` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `file`, `link`, `visibility`, `created_at`, `updated_at`) VALUES
(6, 'Test', 'ads/1768812536_test image.jpeg', 'https://www.google.com/', 1, '2026-01-19 03:48:56', '2026-01-19 03:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `ad_impressions`
--

CREATE TABLE `ad_impressions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `music_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `impression_type` enum('banner','video','audio','popup') NOT NULL DEFAULT 'banner',
  `ip_address` varchar(45) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `device_type` varchar(50) DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `clicked` tinyint(1) NOT NULL DEFAULT 0,
  `clicked_at` timestamp NULL DEFAULT NULL,
  `revenue` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ad_revenue_shares`
--

CREATE TABLE `ad_revenue_shares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `period_date` date NOT NULL,
  `total_ad_impressions` bigint(20) NOT NULL DEFAULT 0,
  `total_ad_clicks` bigint(20) NOT NULL DEFAULT 0,
  `total_ad_revenue` decimal(10,2) NOT NULL DEFAULT 0.00,
  `artist_share_percentage` decimal(5,2) NOT NULL DEFAULT 50.00,
  `artist_share_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `platform_share_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','calculated','paid') NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_agreements`
--

CREATE TABLE `artist_agreements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `document_version` varchar(50) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `accepted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_analytics`
--

CREATE TABLE `artist_analytics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stream_count` bigint(20) NOT NULL DEFAULT 0,
  `download_count` bigint(20) NOT NULL DEFAULT 0,
  `revenue` decimal(10,2) NOT NULL DEFAULT 0.00,
  `period_type` enum('daily','weekly','monthly','yearly','all_time') NOT NULL DEFAULT 'all_time',
  `period_date` date DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `age_group` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_earnings`
--

CREATE TABLE `artist_earnings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stream_id` bigint(20) UNSIGNED DEFAULT NULL,
  `earnings_type` enum('stream','download','purchase','tip','other') NOT NULL DEFAULT 'stream',
  `gross_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `platform_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `net_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `royalty_percentage` decimal(5,2) NOT NULL DEFAULT 80.00,
  `status` enum('pending','processed','paid','failed') NOT NULL DEFAULT 'pending',
  `period_date` date NOT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artist_earnings`
--

INSERT INTO `artist_earnings` (`id`, `artist_id`, `music_id`, `stream_id`, `earnings_type`, `gross_amount`, `platform_fee`, `net_amount`, `currency`, `royalty_percentage`, `status`, `period_date`, `processed_at`, `created_at`, `updated_at`) VALUES
(1, 33, 16, NULL, 'stream', 5000.00, 1000.00, 4000.00, 'USD', 80.00, 'processed', '2026-01-01', '2026-01-16 03:01:20', '2026-01-16 03:01:20', '2026-01-16 03:01:20'),
(2, 33, 16, NULL, 'stream', 1500.00, 300.00, 1200.00, 'USD', 80.00, 'processed', '2026-01-01', '2026-01-16 03:22:33', '2026-01-16 03:22:33', '2026-01-16 03:22:33'),
(3, 28, 16, NULL, 'stream', 1500.00, 300.00, 1200.00, 'USD', 80.00, 'processed', '2026-01-01', '2026-01-16 03:22:33', '2026-01-16 03:22:33', '2026-01-16 03:22:33'),
(4, 28, 16, NULL, 'stream', 250.00, 50.00, 200.00, 'USD', 80.00, 'processed', '2026-01-01', '2026-01-19 00:23:00', '2026-01-19 00:23:00', '2026-01-19 00:23:00'),
(5, 33, 16, NULL, 'stream', 250.00, 50.00, 200.00, 'USD', 80.00, 'processed', '2026-01-01', '2026-01-19 00:23:00', '2026-01-19 00:23:00', '2026-01-19 00:23:00'),
(6, 33, 17, NULL, 'stream', 500.00, 100.00, 400.00, 'USD', 80.00, 'processed', '2026-01-01', '2026-01-19 00:23:00', '2026-01-19 00:23:00', '2026-01-19 00:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `artist_followers`
--

CREATE TABLE `artist_followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Artist user ID',
  `follower_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Follower (fan) user ID',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artist_followers`
--

INSERT INTO `artist_followers` (`id`, `artist_id`, `follower_id`, `created_at`, `updated_at`) VALUES
(1, 30, 32, '2026-01-14 07:18:28', '2026-01-14 07:18:28'),
(2, 33, 32, '2026-01-14 09:52:21', '2026-01-14 09:52:21'),
(5, 33, 34, '2026-01-16 03:08:23', '2026-01-16 03:08:23'),
(6, 36, 34, '2026-01-19 03:56:07', '2026-01-19 03:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `artist_musics`
--

CREATE TABLE `artist_musics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `music_file` text NOT NULL,
  `video_file` text DEFAULT NULL,
  `thumbnail_image` text NOT NULL,
  `listeners` bigint(20) NOT NULL,
  `duration` int(11) DEFAULT NULL COMMENT 'Duration in seconds',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `isrc_code` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist_musics`
--

INSERT INTO `artist_musics` (`id`, `driver_id`, `name`, `music_file`, `video_file`, `thumbnail_image`, `listeners`, `duration`, `is_featured`, `isrc_code`, `created_at`, `updated_at`) VALUES
(1, 7, 'This is a test', 'artist_music/music_1758704260_ENjGUm1I3R.mp3', 'artist_videos/video_1758704260_NpOwQlpOZF.mp4', 'artist_thumbnails/thumb_1758704260_Zw6X5aIxFA.png', 15, NULL, 0, NULL, '2025-09-24 03:57:40', '2026-01-27 17:45:53'),
(2, 7, 'Test', 'artist_music/music_1758706892_g3dOU3ZtsW.mp3', 'artist_videos/video_1758706892_KXmULzbi4s.mp4', 'artist_thumbnails/thumb_1758706892_OjfMPGJeaI.png', 7, NULL, 0, NULL, '2025-09-24 04:41:32', '2026-01-27 17:45:29'),
(3, 7, 'Midnight City', 'artist_music/music_1758707495_wVFEn6MUG2.mp3', NULL, 'artist_thumbnails/thumb_1758707495_eoOfKUhKFn.png', 8, NULL, 0, NULL, '2025-09-24 04:51:35', '2025-09-24 04:51:35'),
(4, 9, 'Midnight City', 'songs/sample1.mp3', NULL, 'artist_thumbnails/sample1.jpg', 1250, NULL, 0, NULL, '2025-10-01 06:03:10', '2025-10-01 06:03:10'),
(5, 9, 'Perfect', 'songs/sample2.mp3', NULL, 'artist_thumbnails/sample2.jpg', 2100, NULL, 0, NULL, '2025-10-01 06:03:10', '2025-10-01 06:03:10'),
(6, 9, 'Shape of You', 'songs/sample1.mp3', NULL, 'artist_thumbnails/sample1.jpg', 3500, NULL, 0, NULL, '2025-10-01 06:03:10', '2025-10-01 06:03:10'),
(7, 9, 'Blinding Lights', 'songs/sample2.mp3', NULL, 'artist_thumbnails/sample2.jpg', 2800, NULL, 0, NULL, '2025-10-01 06:03:10', '2025-10-01 06:03:10'),
(8, 9, 'Levitating', 'songs/sample1.mp3', NULL, 'artist_thumbnails/sample1.jpg', 1900, NULL, 0, NULL, '2025-10-01 06:03:10', '2025-10-01 06:03:10'),
(9, 17, 'dfdf', 'artist_music/music_1764685010_zeHNtGIL58.mp3', NULL, 'artist_thumbnails/thumb_1764685010_fQLIKUIsnJ.jpg', 0, NULL, 0, NULL, '2025-12-02 09:16:50', '2025-12-02 09:16:50'),
(10, 17, 'Test', 'artist_music/music_1764685044_YhXu7EkUkw.mp3', NULL, 'artist_thumbnails/thumb_1764685044_grhcLuQljx.jpg', 0, NULL, 0, NULL, '2025-12-02 09:17:24', '2025-12-02 09:17:24'),
(11, 19, 'levi', 'artist_music/music_1765190335_Aw4qT0Qbti.mp3', 'artist_videos/video_1765190335_p1fzgD81rU.mp4', 'artist_thumbnails/thumb_1765190335_47IJc49hTw.png', 0, NULL, 0, NULL, '2025-12-08 05:38:55', '2025-12-08 05:38:55'),
(12, 33, 'Blinding Lights', 'artist_music/music_1768393213_z5CRDf8xwi.aac', NULL, 'artist_thumbnails/thumb_1768393214_FNCGV2YVa6.jpeg', 5, NULL, 1, NULL, '2026-01-14 07:20:14', '2026-01-27 17:22:27'),
(13, 33, 'Levitating', 'artist_music/music_1768402377_GqFoPb5Bdb.aac', NULL, 'artist_thumbnails/thumb_1768402378_kLHPMQirlr.jpeg', 4, NULL, 1, NULL, '2026-01-14 09:52:58', '2026-01-28 11:15:41'),
(14, 33, 'Test 2', 'artist_music/music_1768498846_vol6tuKj1P.mp3', NULL, 'artist_thumbnails/thumb_1768498847_197e9CLeUW.jpeg', 12, NULL, 0, NULL, '2026-01-15 12:40:47', '2026-01-19 00:14:25'),
(15, 33, 'final', 'artist_music/music_1768499001_7jXsiwKzQi.mp3', NULL, 'artist_thumbnails/thumb_1768499001_wovLg2Swsi.jpg', 27, NULL, 1, NULL, '2026-01-15 12:43:21', '2026-01-28 11:15:40'),
(16, 33, 'long song', 'artist_music/music_1768550329_UsYqxXZeVN.mp3', NULL, 'artist_thumbnails/thumb_1768550329_Abh2x4PkhY.jpeg', 21, NULL, 0, NULL, '2026-01-16 02:58:49', '2026-01-27 17:18:37'),
(17, 33, 'test', 'artist_music/music_1768572133_15oizXnI1N.mp3', NULL, 'artist_thumbnails/thumb_1768572133_pdp4S0PS6g.jpg', 11, NULL, 0, NULL, '2026-01-16 09:02:13', '2026-01-19 03:55:36'),
(18, 7, 'dff', 'artist_music/music_1768759331_S6FFqoV1Ya.mp3', NULL, 'artist_thumbnails/thumb_1768759331_8n7pkTLkgx.jpeg', 0, NULL, 0, NULL, '2026-01-18 13:02:11', '2026-01-18 13:02:11'),
(19, 7, 'dfdfd', 'artist_music/music_1768759361_xVZNXd6nvZ.mp3', NULL, 'artist_thumbnails/thumb_1768759361_zbsO7pqWX3.jpeg', 0, NULL, 0, NULL, '2026-01-18 13:02:41', '2026-01-18 13:02:41'),
(20, 7, 'dfdf', 'artist_music/music_1768759385_MHuzq2VCvY.mp3', NULL, 'artist_thumbnails/thumb_1768759385_jswlZabX7d.jpg', 0, NULL, 0, NULL, '2026-01-18 13:03:05', '2026-01-18 13:03:05'),
(21, 36, 'Test', 'artist_music/music_1768798025_Mb55d89fAf.mp3', NULL, 'artist_thumbnails/thumb_1768798025_5LO2tMibhx.jpeg', 12, NULL, 0, NULL, '2026-01-18 23:47:05', '2026-01-26 17:59:08'),
(22, 33, 'Shape of You', 'artist_music/music_1768798377_xTVfVc818I.mp3', NULL, 'artist_thumbnails/thumb_1768798377_tmc2uL1gi7.jpg', 0, NULL, 1, 'HFJHF-34-34524', '2026-01-18 23:52:57', '2026-01-19 00:14:18'),
(23, 42, 'Michael', 'artist_music/music_1773398968_cNkKATojwN.mp3', NULL, 'artist_thumbnails/thumb_1773398968_lDA6Zaur56.jpeg', 5, NULL, 0, 'EXE-232-F22', '2026-03-13 05:49:28', '2026-03-13 06:03:52'),
(24, 43, 'Micah Craft', 'artist_music/music_1773401186_qp0uZdUDpw.mp3', NULL, 'artist_thumbnails/thumb_1773401186_q0qrRISaSk.jpeg', 1, NULL, 0, 'EXE-F78F-G12', '2026-03-13 06:26:26', '2026-03-13 06:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `artist_payment_details`
--

CREATE TABLE `artist_payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` enum('bank_transfer','paypal','wise','other') NOT NULL DEFAULT 'bank_transfer',
  `account_name` varchar(255) DEFAULT NULL COMMENT 'Account holder name',
  `account_number` varchar(255) DEFAULT NULL COMMENT 'Bank account number or PayPal email',
  `routing_number` varchar(50) DEFAULT NULL COMMENT 'Bank routing/SWIFT code',
  `bank_name` varchar(255) DEFAULT NULL COMMENT 'Bank name',
  `paypal_email` varchar(255) DEFAULT NULL COMMENT 'PayPal email address',
  `wise_email` varchar(255) DEFAULT NULL COMMENT 'Wise email address',
  `account_details_json` text DEFAULT NULL COMMENT 'Additional details as JSON',
  `is_primary` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Primary payment method',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Admin verified',
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Admin who verified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artist_payment_details`
--

INSERT INTO `artist_payment_details` (`id`, `artist_id`, `payment_method`, `account_name`, `account_number`, `routing_number`, `bank_name`, `paypal_email`, `wise_email`, `account_details_json`, `is_primary`, `is_verified`, `verified_at`, `verified_by`, `created_at`, `updated_at`) VALUES
(1, 33, 'bank_transfer', 'hjhj', '877878', '76878', 'jhhj', NULL, NULL, NULL, 1, 0, NULL, NULL, '2026-01-15 12:03:34', '2026-01-15 12:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `artist_performance`
--

CREATE TABLE `artist_performance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `period_type` enum('daily','weekly','monthly','yearly') NOT NULL,
  `period_date` date NOT NULL,
  `total_streams` bigint(20) NOT NULL DEFAULT 0,
  `total_downloads` bigint(20) NOT NULL DEFAULT 0,
  `total_revenue` decimal(10,2) NOT NULL DEFAULT 0.00,
  `platform_revenue` decimal(10,2) NOT NULL DEFAULT 0.00,
  `artist_revenue` decimal(10,2) NOT NULL DEFAULT 0.00,
  `growth_rate` decimal(5,2) DEFAULT NULL,
  `top_country` varchar(100) DEFAULT NULL,
  `top_genre` varchar(255) DEFAULT NULL,
  `new_listeners` int(11) NOT NULL DEFAULT 0,
  `returning_listeners` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_profiles`
--

CREATE TABLE `artist_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `genre` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_qa_sessions`
--

CREATE TABLE `artist_qa_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `access_type` enum('premium_only','super_listeners_only','all_subscribers','public') NOT NULL DEFAULT 'premium_only',
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `status` enum('scheduled','live','completed','cancelled') NOT NULL DEFAULT 'scheduled',
  `max_participants` int(11) DEFAULT NULL,
  `current_participants` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_subscriptions`
--

CREATE TABLE `artist_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Artist user ID',
  `artist_subscription_plan_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Reference to artist_subscription_plans.id',
  `subscription_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `subscription_duration` int(11) NOT NULL DEFAULT 30 COMMENT 'Duration in days',
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artist_subscriptions`
--

INSERT INTO `artist_subscriptions` (`id`, `user_id`, `artist_subscription_plan_id`, `subscription_date`, `subscription_duration`, `payment_method`, `payment_id`, `created_at`, `updated_at`) VALUES
(1, 29, 2, '2026-01-13 11:05:21', 30, 'stripe', 'pi_3SpA5lDBrmpWurbR1YtnXWNL', '2026-01-13 11:05:21', '2026-01-13 11:05:21'),
(2, 29, 2, '2026-01-13 11:05:21', 30, 'stripe', 'pi_3SpA5jDBrmpWurbR1k69BOY8', '2026-01-13 11:05:21', '2026-01-13 11:05:21'),
(3, 29, 2, '2026-01-13 11:05:21', 30, 'stripe', 'pi_3SpA5lDBrmpWurbR0uhTY57A', '2026-01-13 11:05:21', '2026-01-13 11:05:21'),
(4, 29, 2, '2026-01-13 11:05:21', 30, 'stripe', 'pi_3SpA5lDBrmpWurbR0SUHtpjO', '2026-01-13 11:05:21', '2026-01-13 11:05:21'),
(5, 29, 2, '2026-01-13 11:05:21', 30, 'stripe', 'pi_3SpA5kDBrmpWurbR06pQniXY', '2026-01-13 11:05:21', '2026-01-13 11:05:21'),
(6, 30, 2, '2026-01-13 11:50:48', 30, 'stripe', 'pi_3SpAntDBrmpWurbR0XPPYzjB', '2026-01-13 11:50:48', '2026-01-13 11:50:48'),
(7, 30, 2, '2026-01-13 11:50:51', 30, 'stripe', 'pi_3SpAnwDBrmpWurbR0TxzwXYl', '2026-01-13 11:50:51', '2026-01-13 11:50:51'),
(8, 30, 2, '2026-01-13 11:50:51', 30, 'stripe', 'pi_3SpAnwDBrmpWurbR1A0aKeNy', '2026-01-13 11:50:51', '2026-01-13 11:50:51'),
(9, 30, 2, '2026-01-13 11:50:51', 30, 'stripe', 'pi_3SpAnwDBrmpWurbR1mda7x3G', '2026-01-13 11:50:51', '2026-01-13 11:50:51'),
(10, 30, 2, '2026-01-13 11:50:52', 30, 'stripe', 'pi_3SpAnxDBrmpWurbR18rotX0h', '2026-01-13 11:50:52', '2026-01-13 11:50:52'),
(11, 30, 2, '2026-01-13 11:50:53', 30, 'stripe', 'pi_3SpAnyDBrmpWurbR1YZSnva9', '2026-01-13 11:50:53', '2026-01-13 11:50:53'),
(12, 30, 2, '2026-01-13 11:50:53', 30, 'stripe', 'pi_3SpAnyDBrmpWurbR0nMk9x2r', '2026-01-13 11:50:53', '2026-01-13 11:50:53'),
(13, 33, 2, '2026-01-16 07:31:46', 30, 'stripe', 'pi_3SqCBqDBrmpWurbR1fK9qnUL', '2026-01-16 07:31:46', '2026-01-16 07:31:46'),
(14, 36, 3, '2026-01-18 23:46:10', 30, 'stripe', 'pi_3SrALtDBrmpWurbR0NPHoBOp', '2026-01-18 23:46:10', '2026-01-18 23:46:10'),
(15, 36, 3, '2026-01-18 23:46:25', 30, 'stripe', 'pi_3SrAM8DBrmpWurbR0v5Ze2Fa', '2026-01-18 23:46:25', '2026-01-18 23:46:25'),
(16, 24, 2, '2026-03-11 07:44:05', 30, 'stripe', 'pi_3T9m7MDBrmpWurbR1tmseURG', '2026-03-11 07:44:05', '2026-03-11 07:44:05'),
(17, 42, 2, '2026-03-13 05:48:18', 30, 'stripe', 'pi_3TATGPDBrmpWurbR0kGvEdlk', '2026-03-13 05:48:18', '2026-03-13 05:48:18'),
(18, 43, 2, '2026-03-13 06:25:26', 30, 'stripe', 'pi_3TATqLDBrmpWurbR1aIEqIex', '2026-03-13 06:25:26', '2026-03-13 06:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `artist_subscription_plans`
--

CREATE TABLE `artist_subscription_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_slug` varchar(255) NOT NULL,
  `monthly_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(3) NOT NULL DEFAULT 'GBP',
  `ideal_for` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `songs_per_month` int(11) DEFAULT NULL COMMENT 'NULL = unlimited, 0 = free tier',
  `is_unlimited_uploads` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured_rotation` tinyint(1) NOT NULL DEFAULT 0,
  `featured_rotation_weeks` int(11) DEFAULT NULL COMMENT 'Weeks per month for featured rotation',
  `is_priority_search` tinyint(1) NOT NULL DEFAULT 0,
  `is_custom_banner` tinyint(1) NOT NULL DEFAULT 0,
  `is_isrc_codes` tinyint(1) NOT NULL DEFAULT 0,
  `is_early_access_insights` tinyint(1) NOT NULL DEFAULT 0,
  `is_certified_badge` tinyint(1) NOT NULL DEFAULT 0,
  `is_showcase_placement` tinyint(1) NOT NULL DEFAULT 0,
  `is_royalty_tracking` tinyint(1) NOT NULL DEFAULT 0,
  `is_playlist_highlighted` tinyint(1) NOT NULL DEFAULT 0,
  `is_advanced_analytics` tinyint(1) NOT NULL DEFAULT 0,
  `is_showcase_invitations` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artist_subscription_plans`
--

INSERT INTO `artist_subscription_plans` (`id`, `plan_name`, `plan_slug`, `monthly_fee`, `currency`, `ideal_for`, `description`, `songs_per_month`, `is_unlimited_uploads`, `is_featured_rotation`, `featured_rotation_weeks`, `is_priority_search`, `is_custom_banner`, `is_isrc_codes`, `is_early_access_insights`, `is_certified_badge`, `is_showcase_placement`, `is_royalty_tracking`, `is_playlist_highlighted`, `is_advanced_analytics`, `is_showcase_invitations`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Starter Artist', 'starter-artist', 0.00, 'GBP', 'Beginner musicians & new creators', 'Perfect for artists just starting their journey on SingWithMe', 3, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, '2026-01-11 16:12:31', '2026-01-11 16:12:31'),
(2, 'Pro Artist', 'pro-artist', 9.99, 'GBP', 'Semi-professional creators seeking more exposure', 'Ideal for artists looking to grow their audience and get featured', NULL, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 2, '2026-01-11 16:12:31', '2026-01-11 16:12:31'),
(3, 'Certified Creator', 'certified-creator', 19.99, 'GBP', 'Established artists focusing on branding & monetization', 'Premium package for professional artists with advanced features', NULL, 1, 1, 4, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3, '2026-01-11 16:12:31', '2026-01-11 16:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `artist_tiers`
--

CREATE TABLE `artist_tiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `min_streams` bigint(20) NOT NULL DEFAULT 0,
  `min_revenue` decimal(10,2) NOT NULL DEFAULT 0.00,
  `royalty_percentage` decimal(5,2) NOT NULL DEFAULT 80.00,
  `platform_fee_percentage` decimal(5,2) NOT NULL DEFAULT 20.00,
  `benefits` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_tier_assignments`
--

CREATE TABLE `artist_tier_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `tier_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_tips`
--

CREATE TABLE `artist_tips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'User who sent the tip',
  `artist_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Artist receiving the tip',
  `amount` decimal(10,2) NOT NULL COMMENT 'Tip amount',
  `platform_fee` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Platform fee (5%)',
  `total_amount` decimal(10,2) NOT NULL COMMENT 'Total amount paid by user',
  `payment_method` varchar(50) NOT NULL COMMENT 'stripe, paypal, google-pay, apple-pay, square',
  `payment_method_id` varchar(255) DEFAULT NULL COMMENT 'Payment gateway transaction ID',
  `status` enum('pending','paid','sent_to_artist','failed','cancelled') NOT NULL DEFAULT 'pending' COMMENT 'pending: user paid, admin needs to send | paid: admin received | sent_to_artist: admin sent to artist',
  `admin_notes` text DEFAULT NULL COMMENT 'Admin notes when sending to artist',
  `user_message` text DEFAULT NULL COMMENT 'Optional message from user to artist',
  `paid_at` timestamp NULL DEFAULT NULL COMMENT 'When user payment was completed',
  `sent_to_artist_at` timestamp NULL DEFAULT NULL COMMENT 'When admin sent tip to artist',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artist_tips`
--

INSERT INTO `artist_tips` (`id`, `user_id`, `artist_id`, `amount`, `platform_fee`, `total_amount`, `payment_method`, `payment_method_id`, `status`, `admin_notes`, `user_message`, `paid_at`, `sent_to_artist_at`, `created_at`, `updated_at`) VALUES
(1, 34, 33, 5.00, 0.25, 5.25, 'stripe', 'pi_3Sq6ngDBrmpWurbR1jD71zXm', 'sent_to_artist', NULL, NULL, '2026-01-16 01:46:29', '2026-01-16 02:19:08', '2026-01-16 01:46:29', '2026-01-16 02:19:08'),
(2, 34, 36, 50.00, 2.50, 52.50, 'stripe', 'pi_3SrEGVDBrmpWurbR0Ytvzykf', 'sent_to_artist', NULL, 'Love your songs', '2026-01-19 03:56:52', '2026-01-19 03:56:52', '2026-01-19 03:56:52', '2026-01-19 03:56:52'),
(3, 44, 33, 7.00, 0.35, 7.35, 'stripe', 'pi_3TBY5bDBrmpWurbR1El4A2UQ', 'sent_to_artist', NULL, NULL, '2026-03-16 05:09:35', '2026-03-16 05:09:35', '2026-03-16 05:09:35', '2026-03-16 05:09:35'),
(4, 44, 33, 5.00, 0.25, 5.25, 'stripe', 'pi_3TBY9QDBrmpWurbR1hUQDQ8c', 'sent_to_artist', NULL, NULL, '2026-03-16 05:13:33', '2026-03-16 05:13:33', '2026-03-16 05:13:33', '2026-03-16 05:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `artist_wallets`
--

CREATE TABLE `artist_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `available_balance` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Available balance for payout',
  `pending_balance` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Pending earnings not yet processed',
  `total_earned` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Total lifetime earnings',
  `total_paid_out` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Total amount paid out',
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artist_wallets`
--

INSERT INTO `artist_wallets` (`id`, `artist_id`, `available_balance`, `pending_balance`, `total_earned`, `total_paid_out`, `currency`, `last_updated`, `created_at`, `updated_at`) VALUES
(1, 29, 10.00, 0.00, 0.00, 0.00, 'USD', '2026-01-15 17:05:58', '2026-01-13 10:48:48', '2026-01-15 17:05:58'),
(2, 30, 60.00, 0.00, 0.00, 0.00, 'USD', '2026-01-15 17:14:02', '2026-01-13 11:39:40', '2026-01-15 17:14:02'),
(3, 31, 60.00, 0.00, 0.00, 0.00, 'USD', '2026-01-15 17:13:58', '2026-01-14 06:24:55', '2026-01-15 17:13:58'),
(4, 33, 5612.00, 0.00, 5817.00, 265.00, 'USD', '2026-03-16 10:13:33', '2026-01-14 07:19:34', '2026-03-16 05:13:33'),
(5, 28, 1400.00, 0.00, 1400.00, 0.00, 'USD', '2026-01-19 05:23:00', '2026-01-16 03:22:33', '2026-01-19 00:23:00'),
(6, 7, 0.00, 0.00, 0.00, 0.00, 'USD', '2026-01-18 18:01:02', '2026-01-18 13:01:02', '2026-01-18 13:01:02'),
(7, 36, 50.00, 0.00, 50.00, 0.00, 'USD', '2026-01-19 08:56:52', '2026-01-18 23:45:16', '2026-01-19 03:56:52'),
(8, 21, 0.00, 0.00, 0.00, 0.00, 'USD', '2026-01-19 16:00:18', '2026-01-19 11:00:18', '2026-01-19 11:00:18'),
(9, 38, 0.00, 0.00, 0.00, 0.00, 'USD', '2026-01-28 10:02:03', '2026-01-28 05:02:03', '2026-01-28 05:02:03'),
(10, 39, 0.00, 0.00, 0.00, 0.00, 'USD', '2026-01-28 10:06:23', '2026-01-28 05:06:23', '2026-01-28 05:06:23'),
(11, 24, 0.00, 0.00, 0.00, 0.00, 'USD', '2026-03-11 12:08:32', '2026-03-11 07:08:32', '2026-03-11 07:08:32'),
(12, 42, 0.00, 0.00, 0.00, 0.00, 'USD', '2026-03-13 10:36:32', '2026-03-13 05:36:32', '2026-03-13 05:36:32'),
(13, 43, 0.00, 0.00, 0.00, 0.00, 'USD', '2026-03-13 11:23:47', '2026-03-13 06:23:47', '2026-03-13 06:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `artwork_photos`
--

CREATE TABLE `artwork_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artwork_photos`
--

INSERT INTO `artwork_photos` (`id`, `driver_id`, `image`, `created_at`, `updated_at`) VALUES
(18, 21, 'artwork_photos/artwork_1766499559_oAmdSjaw9Z.jpeg', '2025-12-23 09:19:19', '2025-12-23 09:19:19'),
(19, 33, 'artwork_photos/artwork_1768543061_MnwaiGO3BE.jpeg', '2026-01-16 00:57:42', '2026-01-16 00:57:42'),
(20, 36, 'artwork_photos/artwork_1768798035_DlBvaDsB8b.jpeg', '2026-01-18 23:47:15', '2026-01-18 23:47:15'),
(21, 36, 'artwork_photos/artwork_1768798045_yrU4f3JbWl.jpg', '2026-01-18 23:47:25', '2026-01-18 23:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `audience_demographics`
--

CREATE TABLE `audience_demographics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `age_group` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `stream_count` bigint(20) NOT NULL DEFAULT 0,
  `download_count` bigint(20) NOT NULL DEFAULT 0,
  `revenue` decimal(10,2) NOT NULL DEFAULT 0.00,
  `period_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `autodeposit_sections`
--

CREATE TABLE `autodeposit_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deposit_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `image` text NOT NULL,
  `tags` text DEFAULT NULL,
  `min_read` varchar(255) DEFAULT NULL,
  `visibility` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `content`, `image`, `tags`, `min_read`, `visibility`, `created_at`, `updated_at`) VALUES
(2, 'How to Upload & Distribute Your Music Like a Pro', 'how-to-upload-distribute-your-music-like-a-pro', '<p>Distributing your music professionally means more than just uploading a file. It&rsquo;s about making sure your music reaches every major platform, is properly tagged, and is discoverable by your growing audience.</p>\r\n\r\n<h2>Why Distribution Matters</h2>\r\n\r\n<p>Without proper distribution, even your best track can sit unheard. Platforms like Spotify, Apple Music, YouTube, and Amazon offer global reach &mdash; but you need the right strategy to take advantage of them.</p>\r\n\r\n<h2>Step-by-Step Upload Guide</h2>\r\n\r\n<ul>\r\n	<li><strong>Step 1:</strong>&nbsp;Finalize your audio and artwork (WAV or MP3 formats, 3000x3000px cover art recommended).</li>\r\n	<li><strong>Step 2:</strong>&nbsp;Create an account with a distributor or use the&nbsp;<em>SingWithMe Artist Portal</em>.</li>\r\n	<li><strong>Step 3:</strong>&nbsp;Add metadata: track title, genre, artist name, contributors, and ISRC codes (if available).</li>\r\n	<li><strong>Step 4:</strong>&nbsp;Choose platforms and regions &mdash; opt for worldwide distribution unless otherwise planned.</li>\r\n	<li><strong>Step 5:</strong>&nbsp;Set a release date and submit. Most platforms take 3&ndash;7 days to process.</li>\r\n</ul>\r\n\r\n<h2>Tips for a Successful Launch</h2>\r\n\r\n<ul>\r\n	<li>Schedule your release at least 2 weeks in advance.</li>\r\n	<li>Promote your music with pre-saves and teaser content on social media.</li>\r\n	<li>Use tools like Spotify for Artists to pitch to editorial playlists.</li>\r\n</ul>\r\n\r\n<p>Uploading your music doesn&#39;t have to be stressful. With the right tools and preparation, you can distribute your tracks professionally &mdash; and start gaining the recognition you deserve.</p>', 'uploads/1763980451_slim-emcee.jpg', NULL, NULL, 1, '2025-08-29 08:03:32', '2025-11-24 05:34:11'),
(3, 'Understanding Royalties in the Streaming Era', 'understanding-royalties-in-the-streaming-era', '<p>Distributing your music professionally means more than just uploading a file. It&rsquo;s about making sure your music reaches every major platform, is properly tagged, and is discoverable by your growing audience.</p>\r\n\r\n<h2>Why Distribution Matters</h2>\r\n\r\n<p>Without proper distribution, even your best track can sit unheard. Platforms like Spotify, Apple Music, YouTube, and Amazon offer global reach &mdash; but you need the right strategy to take advantage of them.</p>\r\n\r\n<h2>Step-by-Step Upload Guide</h2>\r\n\r\n<ul>\r\n	<li><strong>Step 1:</strong>&nbsp;Finalize your audio and artwork (WAV or MP3 formats, 3000x3000px cover art recommended).</li>\r\n	<li><strong>Step 2:</strong>&nbsp;Create an account with a distributor or use the&nbsp;<em>SingWithMe Artist Portal</em>.</li>\r\n	<li><strong>Step 3:</strong>&nbsp;Add metadata: track title, genre, artist name, contributors, and ISRC codes (if available).</li>\r\n	<li><strong>Step 4:</strong>&nbsp;Choose platforms and regions &mdash; opt for worldwide distribution unless otherwise planned.</li>\r\n	<li><strong>Step 5:</strong>&nbsp;Set a release date and submit. Most platforms take 3&ndash;7 days to process.</li>\r\n</ul>\r\n\r\n<h2>Tips for a Successful Launch</h2>\r\n\r\n<ul>\r\n	<li>Schedule your release at least 2 weeks in advance.</li>\r\n	<li>Promote your music with pre-saves and teaser content on social media.</li>\r\n	<li>Use tools like Spotify for Artists to pitch to editorial playlists.</li>\r\n</ul>\r\n\r\n<p>Uploading your music doesn&#39;t have to be stressful. With the right tools and preparation, you can distribute your tracks professionally &mdash; and start gaining the recognition you deserve.</p>', 'uploads/1763980463_ricardo-nunes.jpg', NULL, NULL, 1, '2025-08-29 08:04:51', '2025-11-24 05:34:23'),
(4, 'Managing Your Artist Brand & Identity', 'managing-your-artist-brand-identity', '<p>Distributing your music professionally means more than just uploading a file. It&rsquo;s about making sure your music reaches every major platform, is properly tagged, and is discoverable by your growing audience.</p>\r\n\r\n<h2>Why Distribution Matters</h2>\r\n\r\n<p>Without proper distribution, even your best track can sit unheard. Platforms like Spotify, Apple Music, YouTube, and Amazon offer global reach &mdash; but you need the right strategy to take advantage of them.</p>\r\n\r\n<h2>Step-by-Step Upload Guide</h2>\r\n\r\n<ul>\r\n	<li><strong>Step 1:</strong>&nbsp;Finalize your audio and artwork (WAV or MP3 formats, 3000x3000px cover art recommended).</li>\r\n	<li><strong>Step 2:</strong>&nbsp;Create an account with a distributor or use the&nbsp;<em>SingWithMe Artist Portal</em>.</li>\r\n	<li><strong>Step 3:</strong>&nbsp;Add metadata: track title, genre, artist name, contributors, and ISRC codes (if available).</li>\r\n	<li><strong>Step 4:</strong>&nbsp;Choose platforms and regions &mdash; opt for worldwide distribution unless otherwise planned.</li>\r\n	<li><strong>Step 5:</strong>&nbsp;Set a release date and submit. Most platforms take 3&ndash;7 days to process.</li>\r\n</ul>\r\n\r\n<h2>Tips for a Successful Launch</h2>\r\n\r\n<ul>\r\n	<li>Schedule your release at least 2 weeks in advance.</li>\r\n	<li>Promote your music with pre-saves and teaser content on social media.</li>\r\n	<li>Use tools like Spotify for Artists to pitch to editorial playlists.</li>\r\n</ul>\r\n\r\n<p>Uploading your music doesn&#39;t have to be stressful. With the right tools and preparation, you can distribute your tracks professionally &mdash; and start gaining the recognition you deserve.</p>', 'uploads/1763980480_vidar-nordli-mathisen.jpg', NULL, NULL, 1, '2025-08-29 08:05:18', '2025-11-24 05:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `brand_collaborations`
--

CREATE TABLE `brand_collaborations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_partnership_id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `collaboration_type` enum('exclusive_content','featured_artist','event_appearance','social_media','other') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content_url` text DEFAULT NULL,
  `compensation_amount` decimal(10,2) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('pending','active','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand_partnerships`
--

CREATE TABLE `brand_partnerships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_logo` text DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `partnership_type` enum('sponsored_playlist','feature_sponsorship','event_sponsorship','exclusive_content','other') NOT NULL,
  `description` text DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('pending','active','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` enum('user','bot','admin') NOT NULL DEFAULT 'user',
  `status` enum('pending','answered','escalated') NOT NULL DEFAULT 'pending',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `requires_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `session_id`, `name`, `email`, `message`, `type`, `status`, `is_read`, `requires_admin`, `created_at`, `updated_at`) VALUES
(1, 'session_1768747557420_zpij998oz', 'User', 'user@example.com', 'hi', 'user', 'answered', 0, 0, '2026-01-18 09:46:05', '2026-01-18 09:46:05'),
(2, 'session_1768747557420_zpij998oz', 'ChatBot', 'bot@chatbot.com', 'Thank you for your question: \"hi\". I\'m here to help! Please try asking about our business hours, shipping policies, contact information, or any other common topics. If you need specific assistance, feel free to rephrase your question.', 'bot', 'answered', 0, 0, '2026-01-18 09:46:05', '2026-01-18 09:46:05'),
(3, 'session_1768748136456_2y4lwzlm6', 'User', 'user@example.com', 'payment', 'user', 'answered', 0, 0, '2026-01-18 09:55:41', '2026-01-18 09:55:41'),
(4, 'session_1768748136456_2y4lwzlm6', 'ChatBot', 'bot@chatbot.com', '<p>this is a test answer</p>', 'bot', 'answered', 0, 0, '2026-01-18 09:55:41', '2026-01-18 09:55:41'),
(5, 'session_1768750108846_whykq11y4', 'hello', 'hello@gmail.com', 'hi', 'user', 'answered', 0, 0, '2026-01-18 10:29:59', '2026-01-18 10:29:59'),
(6, 'session_1768750108846_whykq11y4', 'ChatBot', 'bot@chatbot.com', 'Thank you for your question: \"hi\". I\'m here to help! Please try asking about our business hours, shipping policies, contact information, or any other common topics. If you need specific assistance, feel free to rephrase your question.', 'bot', 'answered', 0, 0, '2026-01-18 10:29:59', '2026-01-18 10:29:59'),
(7, 'session_1768750226438_q2jm40ig5', 'hello', 'hello@gmail.com', 'payment', 'user', 'answered', 0, 0, '2026-01-18 10:36:07', '2026-01-18 10:36:07'),
(8, 'session_1768750226438_q2jm40ig5', 'ChatBot', 'bot@chatbot.com', '<p>this is a test answer</p>', 'bot', 'answered', 0, 0, '2026-01-18 10:36:07', '2026-01-18 10:36:07'),
(9, 'session_1768750226438_q2jm40ig5', 'hello', 'hello@gmail.com', 'hi', 'user', 'answered', 0, 0, '2026-01-18 10:36:10', '2026-01-18 10:36:10'),
(10, 'session_1768750226438_q2jm40ig5', 'ChatBot', 'bot@chatbot.com', 'Thank you for your question: \"hi\". I\'m here to help! Please try asking about our business hours, shipping policies, contact information, or any other common topics. If you need specific assistance, feel free to rephrase your question.', 'bot', 'answered', 0, 0, '2026-01-18 10:36:10', '2026-01-18 10:36:10'),
(11, 'session_1768750226438_q2jm40ig5', 'hello', 'hello@gmail.com', 'io', 'user', 'answered', 0, 0, '2026-01-18 10:36:11', '2026-01-18 10:36:11'),
(12, 'session_1768750226438_q2jm40ig5', 'ChatBot', 'bot@chatbot.com', 'Thank you for your question: \"io\". I\'m here to help! Please try asking about our business hours, shipping policies, contact information, or any other common topics. If you need specific assistance, feel free to rephrase your question.', 'bot', 'answered', 0, 0, '2026-01-18 10:36:11', '2026-01-18 10:36:11'),
(13, 'session_1768750226438_q2jm40ig5', 'hello', 'hello@gmail.com', 'payment', 'user', 'answered', 0, 0, '2026-01-18 10:36:23', '2026-01-18 10:36:23'),
(14, 'session_1768750226438_q2jm40ig5', 'ChatBot', 'bot@chatbot.com', '<p>this is a test answer</p>', 'bot', 'answered', 0, 0, '2026-01-18 10:36:23', '2026-01-18 10:36:23'),
(15, 'session_1768812720464_kyqvnuy9q', 'test', 'test@gmail.com', 'hi', 'user', 'answered', 0, 0, '2026-01-19 03:52:31', '2026-01-19 03:52:31'),
(16, 'session_1768812720464_kyqvnuy9q', 'ChatBot', 'bot@chatbot.com', 'Thank you for your question: \"hi\". I\'m here to help! Please try asking about our business hours, shipping policies, contact information, or any other common topics. If you need specific assistance, feel free to rephrase your question.', 'bot', 'answered', 0, 0, '2026-01-19 03:52:31', '2026-01-19 03:52:31'),
(17, 'session_1768812720464_kyqvnuy9q', 'test', 'test@gmail.com', 'payment', 'user', 'answered', 0, 0, '2026-01-19 03:52:35', '2026-01-19 03:52:35'),
(18, 'session_1768812720464_kyqvnuy9q', 'ChatBot', 'bot@chatbot.com', '<p>this is a test answer</p>', 'bot', 'answered', 0, 0, '2026-01-19 03:52:35', '2026-01-19 03:52:35'),
(19, 'session_1769595029126_zeggv38hk', 'testtt', 'tetsth@dd.com', 'hi', 'user', 'answered', 0, 0, '2026-01-28 05:10:44', '2026-01-28 05:10:44'),
(20, 'session_1769595029126_zeggv38hk', 'ChatBot', 'bot@chatbot.com', 'Thank you for your question: \"hi\". I\'m here to help! Please try asking about our business hours, shipping policies, contact information, or any other common topics. If you need specific assistance, feel free to rephrase your question.', 'bot', 'answered', 0, 0, '2026-01-28 05:10:44', '2026-01-28 05:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `cms_royaltycollections`
--

CREATE TABLE `cms_royaltycollections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `value2` varchar(255) DEFAULT NULL,
  `title3` varchar(255) DEFAULT NULL,
  `value3` varchar(255) DEFAULT NULL,
  `title4` varchar(255) DEFAULT NULL,
  `value4` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms_royaltycollections`
--

INSERT INTO `cms_royaltycollections` (`id`, `title`, `value`, `title2`, `value2`, `title3`, `value3`, `title4`, `value4`, `created_at`, `updated_at`) VALUES
(1, 'Royalties Collected', '$2.5M+', 'Countries Covered', '150+', 'Active Artists', '10K+', 'Collection Rate', '99.2%', '2025-09-02 04:28:59', '2025-09-02 04:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `collaboration_requests`
--

CREATE TABLE `collaboration_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `requester_id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `proposed_budget` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','accepted','rejected','completed','cancelled') NOT NULL DEFAULT 'pending',
  `responded_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collaboration_revenue_distributions`
--

CREATE TABLE `collaboration_revenue_distributions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collaboration_id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `ownership_percentage` decimal(5,2) NOT NULL,
  `total_revenue` decimal(10,2) NOT NULL DEFAULT 0.00,
  `platform_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `artist_share_before_split` decimal(10,2) NOT NULL DEFAULT 0.00,
  `artist_share_after_split` decimal(10,2) NOT NULL DEFAULT 0.00,
  `period_date` date NOT NULL,
  `stream_count` bigint(20) NOT NULL DEFAULT 0,
  `status` enum('pending','calculated','paid') NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dark_logo` varchar(255) DEFAULT NULL,
  `light_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_sections`
--

CREATE TABLE `contact_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_submissions`
--

CREATE TABLE `contact_submissions` (
  `id` bigint(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_submissions`
--

INSERT INTO `contact_submissions` (`id`, `firstname`, `lastname`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Daniel', 'Emerson', 'fimewebyn@mailinator.com', 'partnership', 'Saepe vel adipisci n', '2025-08-29 10:04:49', '2025-08-29 10:04:49'),
(3, 'Ramona', 'Coffey', 'pexagy@mailinator.com', 'feedback', 'Placeat quos ut off', '2025-08-29 10:08:54', '2025-08-29 10:08:54'),
(5, 'fgfg', 'gffg', 'milupil@mailinator.com', 'support', 'fg', '2025-08-29 10:23:52', '2025-08-29 10:23:52'),
(6, 'fddf', 'dfdf', 'milupil@mailinator.com', 'general', 'fdf', '2025-08-29 10:26:15', '2025-08-29 10:26:15'),
(7, 'dfdf', 'dfdf', 'rowot@mailinator.com', 'support', 'dfdf', '2025-08-29 10:39:38', '2025-08-29 10:39:38'),
(8, 'Olga', 'Collier', 'lanegiteb@mailinator.com', 'sales', 'Pariatur Tempor aut', '2025-09-01 10:57:24', '2025-09-01 10:57:24'),
(9, 'ghuguhu', 'iduiuid', 'iduigjijg@dff.com', 'support', 'hghghgh', '2025-11-24 05:41:28', '2025-11-24 05:41:28'),
(10, 'sdjkj', 'kjkjjk', 'jjdfs@dd.com', 'general', 'dfjkdjkf', '2026-01-18 10:08:20', '2026-01-18 10:08:20'),
(11, 'test', 'user', 'testuser@gmail.com', 'general', 'this is a test contact form submission', '2026-01-19 03:58:14', '2026-01-19 03:58:14'),
(12, 'Ab', 'Y', 'info@bestaiseocompany.com', 'general', 'Hey team singwithmerecords.co.uk,\r\n\r\nHope your doing well!\r\n\r\nI just following your website and realized that despite having a good design; but it was not ranking high on any of the Search Engines (Google, Yahoo & Bing) for most of the keywords related to your business.\r\n\r\nWe can place your website on Google\'s 1st page.\r\n\r\n*  Top ranking on Google search!\r\n*  Improve website clicks and views!\r\n*  Increase Your Leads, clients & Revenue!\r\n\r\nInterested? Please provide your name, contact information, and email.\r\n\r\nBests Regards,\r\nAby\r\nBest AI SEO Company\r\nAccounts Manager\r\nwww.bestaiseocompany.com\r\nPhone No: +1 (949) 508-0277', '2026-02-03 08:27:11', '2026-02-03 08:27:11'),
(13, 'Drew', 'James', 'wuwynu@mailinator.com', 'partnership', 'Debitis fugit volup', '2026-03-16 04:53:38', '2026-03-16 04:53:38'),
(14, 'Drew', 'James', 'wuwynu@mailinator.com', 'partnership', 'Debitis fugit volup', '2026-03-16 04:53:38', '2026-03-16 04:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `phone_code` varchar(255) NOT NULL,
  `phone_number_limit` varchar(255) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `phone_code`, `phone_number_limit`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', '+93', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(2, 'Åland Islands', 'AX', '+358', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(3, 'Albania', 'AL', '+355', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(4, 'Algeria', 'DZ', '+213', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(5, 'American Samoa', 'AS', '+1684', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(6, 'Andorra', 'AD', '+376', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(7, 'Angola', 'AO', '+244', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(8, 'Anguilla', 'AI', '+1264', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(9, 'Antarctica', 'AQ', '+672', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(10, 'Antigua and Barbuda', 'AG', '+1268', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(11, 'Argentina', 'AR', '+54', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(12, 'Armenia', 'AM', '+374', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(13, 'Aruba', 'AW', '+297', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(14, 'Australia', 'AU', '+61', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(15, 'Austria', 'AT', '+43', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(16, 'Azerbaijan', 'AZ', '+994', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(17, 'Bahamas', 'BS', '+1242', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(18, 'Bahrain', 'BH', '+973', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(19, 'Bangladesh', 'BD', '+880', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(20, 'Barbados', 'BB', '+1246', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(21, 'Belarus', 'BY', '+375', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(22, 'Belgium', 'BE', '+32', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(23, 'Belize', 'BZ', '+501', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(24, 'Benin', 'BJ', '+229', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(25, 'Bermuda', 'BM', '+1441', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(26, 'Bhutan', 'BT', '+975', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(27, 'Bolivia, Plurinational State of', 'BO', '+591', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(28, 'Bonaire, Sint Eustatius and Saba', 'BQ', '+599', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(29, 'Bosnia and Herzegovina', 'BA', '+387', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(30, 'Botswana', 'BW', '+267', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(31, 'Bouvet Island', 'BV', '+55', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(32, 'Brazil', 'BR', '+55', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(33, 'British Indian Ocean Territory', 'IO', '+246', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(34, 'Brunei Darussalam', 'BN', '+673', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(35, 'Bulgaria', 'BG', '+359', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(36, 'Burkina Faso', 'BF', '+226', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(37, 'Burundi', 'BI', '+257', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(38, 'Cambodia', 'KH', '+855', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(39, 'Cameroon', 'CM', '+237', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(40, 'Canada', 'CA', '+1', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(41, 'Cape Verde', 'CV', '+238', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(42, 'Cayman Islands', 'KY', '+1345', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(43, 'Central African Republic', 'CF', '+236', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(44, 'Chad', 'TD', '+235', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(45, 'Chile', 'CL', '+56', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(46, 'China', 'CN', '+86', '11', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(47, 'Christmas Island', 'CX', '+61', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(48, 'Cocos (Keeling) Islands', 'CC', '+61', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(49, 'Colombia', 'CO', '+57', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(50, 'Comoros', 'KM', '+269', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(51, 'Congo', 'CG', '+242', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(52, 'Congo, the Democratic Republic of the', 'CD', '+243', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(53, 'Cook Islands', 'CK', '+682', '5', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(54, 'Costa Rica', 'CR', '+506', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(55, 'Côte d\'Ivoire', 'CI', '+225', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(56, 'Croatia', 'HR', '+385', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(57, 'Cuba', 'CU', '+53', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(58, 'Curaçao', 'CW', '+599', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(59, 'Cyprus', 'CY', '+357', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(60, 'Czech Republic', 'CZ', '+420', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(61, 'Denmark', 'DK', '+45', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(62, 'Djibouti', 'DJ', '+253', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(63, 'Dominica', 'DM', '+1767', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(64, 'Dominican Republic', 'DO', '+1809', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(65, 'Ecuador', 'EC', '+593', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(66, 'Egypt', 'EG', '+20', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(67, 'El Salvador', 'SV', '+503', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(68, 'Equatorial Guinea', 'GQ', '+240', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(69, 'Eritrea', 'ER', '+291', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(70, 'Estonia', 'EE', '+372', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(71, 'Eswatini', 'SZ', '+268', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(72, 'Ethiopia', 'ET', '+251', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(73, 'Falkland Islands (Malvinas)', 'FK', '+500', '5', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(74, 'Faroe Islands', 'FO', '+298', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(75, 'Fiji', 'FJ', '+679', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(76, 'Finland', 'FI', '+358', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(77, 'France', 'FR', '+33', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(78, 'French Guiana', 'GF', '+594', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(79, 'French Polynesia', 'PF', '+689', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(80, 'French Southern Territories', 'TF', '+262', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(81, 'Gabon', 'GA', '+241', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(82, 'Gambia', 'GM', '+220', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(83, 'Georgia', 'GE', '+995', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(84, 'Germany', 'DE', '+49', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(85, 'Ghana', 'GH', '+233', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(86, 'Gibraltar', 'GI', '+350', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(87, 'Greece', 'GR', '+30', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(88, 'Greenland', 'GL', '+299', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(89, 'Grenada', 'GD', '+1473', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(90, 'Guadeloupe', 'GP', '+590', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(91, 'Guam', 'GU', '+1671', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(92, 'Guatemala', 'GT', '+502', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(93, 'Guernsey', 'GG', '+44', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(94, 'Guinea', 'GN', '+224', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(95, 'Guinea-Bissau', 'GW', '+245', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(96, 'Guyana', 'GY', '+592', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(97, 'Haiti', 'HT', '+509', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(98, 'Heard Island and McDonald Islands', 'HM', '+672', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(99, 'Holy See (Vatican City State)', 'VA', '+39', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(100, 'Honduras', 'HN', '+504', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(101, 'Hong Kong', 'HK', '+852', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(102, 'Hungary', 'HU', '+36', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(103, 'Iceland', 'IS', '+354', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(104, 'India', 'IN', '+91', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(105, 'Indonesia', 'ID', '+62', '11', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(106, 'Iran', 'IR', '+98', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(107, 'Iraq', 'IQ', '+964', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(108, 'Ireland', 'IE', '+353', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(109, 'Isle of Man', 'IM', '+44', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(110, 'Israel', 'IL', '+972', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(111, 'Italy', 'IT', '+39', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(112, 'Jamaica', 'JM', '+1876', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(113, 'Japan', 'JP', '+81', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(114, 'Jersey', 'JE', '+44', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(115, 'Jordan', 'JO', '+962', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(116, 'Kazakhstan', 'KZ', '+7', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(117, 'Kenya', 'KE', '+254', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(118, 'Kiribati', 'KI', '+686', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(119, 'North Korea', 'KP', '+850', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(120, 'South Korea', 'KR', '+82', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(121, 'Kuwait', 'KW', '+965', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(122, 'Kyrgyzstan', 'KG', '+996', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(123, 'Lao People\'s Democratic Republic', 'LA', '+856', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(124, 'Latvia', 'LV', '+371', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(125, 'Lebanon', 'LB', '+961', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(126, 'Lesotho', 'LS', '+266', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(127, 'Liberia', 'LR', '+231', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(128, 'Libya', 'LY', '+218', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(129, 'Liechtenstein', 'LI', '+423', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(130, 'Lithuania', 'LT', '+370', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(131, 'Luxembourg', 'LU', '+352', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(132, 'Macao', 'MO', '+853', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(133, 'Macedonia, the Former Yugoslav Republic of', 'MK', '+389', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(134, 'Madagascar', 'MG', '+261', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(135, 'Malawi', 'MW', '+265', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(136, 'Malaysia', 'MY', '+60', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(137, 'Maldives', 'MV', '+960', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(138, 'Mali', 'ML', '+223', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(139, 'Malta', 'MT', '+356', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(140, 'Marshall Islands', 'MH', '+692', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(141, 'Martinique', 'MQ', '+596', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(142, 'Mauritania', 'MR', '+222', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(143, 'Mauritius', 'MU', '+230', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(144, 'Mayotte', 'YT', '+262', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(145, 'Mexico', 'MX', '+52', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(146, 'Micronesia', 'FM', '+691', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(147, 'Moldova, Republic of', 'MD', '+373', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(148, 'Monaco', 'MC', '+377', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(149, 'Mongolia', 'MN', '+976', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(150, 'Montenegro', 'ME', '+382', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(151, 'Montserrat', 'MS', '+1664', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(152, 'Morocco', 'MA', '+212', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(153, 'Mozambique', 'MZ', '+258', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(154, 'Myanmar', 'MM', '+95', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(155, 'Namibia', 'NA', '+264', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(156, 'Nauru', 'NR', '+674', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(157, 'Nepal', 'NP', '+977', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(158, 'Netherlands', 'NL', '+31', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(159, 'New Caledonia', 'NC', '+687', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(160, 'New Zealand', 'NZ', '+64', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(161, 'Nicaragua', 'NI', '+505', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(162, 'Niger', 'NE', '+227', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(163, 'Nigeria', 'NG', '+234', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(164, 'Niue', 'NU', '+683', '4', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(165, 'Norfolk Island', 'NF', '+672', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(166, 'Northern Mariana Islands', 'MP', '+1670', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(167, 'Norway', 'NO', '+47', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(168, 'Oman', 'OM', '+968', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(169, 'Pakistan', 'PK', '+92', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(170, 'Palau', 'PW', '+680', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(171, 'Palestine, State of', 'PS', '+970', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(172, 'Panama', 'PA', '+507', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(173, 'Papua New Guinea', 'PG', '+675', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(174, 'Paraguay', 'PY', '+595', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(175, 'Peru', 'PE', '+51', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(176, 'Philippines', 'PH', '+63', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(177, 'Pitcairn', 'PN', '+64', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(178, 'Poland', 'PL', '+48', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(179, 'Portugal', 'PT', '+351', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(180, 'Puerto Rico', 'PR', '+1939', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(181, 'Qatar', 'QA', '+974', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(182, 'Réunion', 'RE', '+262', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(183, 'Romania', 'RO', '+40', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(184, 'Russian Federation', 'RU', '+7', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(185, 'Rwanda', 'RW', '+250', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(186, 'Saint Barthélemy', 'BL', '+590', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(187, 'Saint Helena', 'SH', '+290', '4', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(188, 'Saint Kitts and Nevis', 'KN', '+1869', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(189, 'Saint Lucia', 'LC', '+1758', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(190, 'Saint Martin (French part)', 'MF', '+590', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(191, 'Saint Pierre and Miquelon', 'PM', '+508', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(192, 'Saint Vincent and the Grenadines', 'VC', '+1784', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(193, 'Samoa', 'WS', '+685', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(194, 'San Marino', 'SM', '+378', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(195, 'Sao Tome and Principe', 'ST', '+239', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(196, 'Saudi Arabia', 'SA', '+966', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(197, 'Senegal', 'SN', '+221', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(198, 'Serbia', 'RS', '+381', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(199, 'Seychelles', 'SC', '+248', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(200, 'Sierra Leone', 'SL', '+232', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(201, 'Singapore', 'SG', '+65', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(202, 'Sint Maarten (Dutch part)', 'SX', '+1721', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(203, 'Slovakia', 'SK', '+421', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(204, 'Slovenia', 'SI', '+386', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(205, 'Solomon Islands', 'SB', '+677', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(206, 'Somalia', 'SO', '+252', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(207, 'South Africa', 'ZA', '+27', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(208, 'South Georgia and the South Sandwich Islands', 'GS', '+500', '5', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(209, 'South Sudan', 'SS', '+211', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(210, 'Spain', 'ES', '+34', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(211, 'Sri Lanka', 'LK', '+94', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(212, 'Sudan', 'SD', '+249', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(213, 'Suriname', 'SR', '+597', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(214, 'Svalbard and Jan Mayen', 'SJ', '+47', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(215, 'Sweden', 'SE', '+46', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(216, 'Switzerland', 'CH', '+41', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(217, 'Syrian Arab Republic', 'SY', '+963', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(218, 'Taiwan, Province of China', 'TW', '+886', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(219, 'Tajikistan', 'TJ', '+992', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(220, 'Tanzania, United Republic of', 'TZ', '+255', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(221, 'Thailand', 'TH', '+66', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(222, 'Timor-Leste', 'TL', '+670', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(223, 'Togo', 'TG', '+228', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(224, 'Tokelau', 'TK', '+690', '4', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(225, 'Tonga', 'TO', '+676', '5', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(226, 'Trinidad and Tobago', 'TT', '+1868', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(227, 'Tunisia', 'TN', '+216', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(228, 'Turkey', 'TR', '+90', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(229, 'Turkmenistan', 'TM', '+993', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(230, 'Tuvalu', 'TV', '+688', '5', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(231, 'Uganda', 'UG', '+256', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(232, 'Ukraine', 'UA', '+380', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(233, 'United Arab Emirates', 'AE', '+971', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(234, 'United Kingdom', 'GB', '+44', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(235, 'United States', 'US', '+1', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(236, 'Uruguay', 'UY', '+598', '8', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(237, 'Uzbekistan', 'UZ', '+998', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(238, 'Vanuatu', 'VU', '+678', '7', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(239, 'Venezuela', 'VE', '+58', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(240, 'Viet Nam', 'VN', '+84', '10', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(241, 'Wallis and Futuna', 'WF', '+681', '6', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(242, 'Western Sahara', 'EH', '+212', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(243, 'Yemen', 'YE', '+967', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(244, 'Zambia', 'ZM', '+260', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(245, 'Zimbabwe', 'ZW', '+263', '9', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `credit_redemptions`
--

CREATE TABLE `credit_redemptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `redemption_type` enum('boost','ad_slot','subscription_discount','marketplace_item','other') NOT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `credits_spent` decimal(10,2) NOT NULL,
  `value_received` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','completed','failed','refunded') NOT NULL DEFAULT 'pending',
  `redeemed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_transactions`
--

CREATE TABLE `credit_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_type` enum('earned','spent','purchased','refunded','expired','bonus') NOT NULL,
  `source_type` enum('daily_engagement','referral','playlist_growth','purchase','subscription_boost','ad_slot','marketplace','other') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `balance_after` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Chief Executive Officer (CEO)', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(2, 'Chief Operating Officer (COO)', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(3, 'Chief Financial Officer (CFO)', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(4, 'Chief Technology Officer (CTO)', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(5, 'Chief Marketing Officer (CMO)', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(6, 'Managing Director', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(7, 'General Manager', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(8, 'Operations Manager', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(9, 'Project Manager', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(10, 'Product Manager', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(11, 'Human Resources Manager', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(12, 'Finance Manager', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(13, 'Software Engineer', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(14, 'Senior Software Engineer', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(15, 'Frontend Developer', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(16, 'Backend Developer', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(17, 'Full Stack Developer', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(18, 'UI/UX Designer', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(19, 'Quality Assurance Engineer', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(20, 'Data Analyst', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(21, 'Data Scientist', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(22, 'Network Administrator', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(23, 'Marketing Manager', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(24, 'Sales Manager', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(25, 'Customer Support Representative', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(26, 'Accountant', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(27, 'Business Analyst', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(28, 'Legal Advisor', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(29, 'Consultant', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(30, 'Research Analyst', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(31, 'Content Writer', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(32, 'Digital Marketing Specialist', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(33, 'Social Media Manager', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(34, 'Administrative Assistant', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(35, 'Receptionist', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(36, 'Security Officer', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(37, 'Office Assistant', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `document_versions`
--

CREATE TABLE `document_versions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `changes_summary` text DEFAULT NULL,
  `effective_date` date NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `download_stats`
--

CREATE TABLE `download_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `device_type` varchar(50) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `downloaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `download_stats`
--

INSERT INTO `download_stats` (`id`, `music_id`, `artist_id`, `user_id`, `ip_address`, `country`, `city`, `device_type`, `platform`, `downloaded_at`, `created_at`, `updated_at`) VALUES
(1, 15, 33, 34, '127.0.0.1', NULL, NULL, NULL, NULL, '2026-01-16 07:10:59', '2026-01-16 07:10:59', '2026-01-16 07:10:59'),
(2, 17, 33, 34, '2407:aa80:14:9453:b84a:4ef3:4354:6a4b', NULL, NULL, NULL, NULL, '2026-01-19 03:55:42', '2026-01-19 03:55:42', '2026-01-19 03:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `exclusive_previews`
--

CREATE TABLE `exclusive_previews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `preview_type` enum('audio','video','behind_scenes','story','other') NOT NULL DEFAULT 'audio',
  `media_url` text DEFAULT NULL,
  `thumbnail_url` text DEFAULT NULL,
  `access_type` enum('premium_only','super_listeners_only','all_subscribers','public') NOT NULL DEFAULT 'premium_only',
  `release_date` timestamp NULL DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visibility` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `description`, `visibility`, `created_at`, `updated_at`) VALUES
(1, 'What types of products do you assemble?', '<p>We specialize in assembling wooden swing sets, basketball goals, exercise equipment, and other outdoor and home fitness products.</p>', 1, '2025-08-29 05:21:40', '2025-10-22 08:41:50'),
(2, 'How do I book an assembly service?', '<p>Simply choose your product type on our website, select a convenient date and time, and pay securely via Venmo. Our technicians will arrive on time and ready to work!</p>', 1, '2025-10-22 08:42:07', '2025-10-22 08:42:07'),
(3, 'Can technicians come to my location on weekends?', '<p>Yes! We offer flexible scheduling options, including weekends, to fit your busy lifestyle.</p>', 1, '2025-10-22 08:42:23', '2025-10-22 08:42:23'),
(4, 'Do your technicians bring their own tools?', '<p>Absolutely! All our technicians are fully equipped with professional-grade tools to handle installations safely and efficiently.</p>', 1, '2025-10-22 08:42:40', '2025-10-22 08:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `faq_questions`
--

CREATE TABLE `faq_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `keywords` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_questions`
--

INSERT INTO `faq_questions` (`id`, `question`, `answer`, `keywords`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'This is a test question', '<p>this is a test answer</p>', 'payment', 1, '2026-01-18 09:55:24', '2026-01-18 09:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Male', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(2, 'Female', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(3, 'Non-Binary', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(4, 'Transgender Male', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(5, 'Transgender Female', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(6, 'Genderfluid', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(7, 'Agender', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(8, 'Bigender', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(9, 'Two-Spirit', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(10, 'Androgynous', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(11, 'Demiboy', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(12, 'Demigirl', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(13, 'Genderqueer', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(14, 'Intersex', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(15, 'Pangender', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(16, 'Neutrois', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(17, 'Questioning', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(18, 'Other', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(19, 'Prefer Not to Say', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `gift_subscriptions`
--

CREATE TABLE `gift_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gifter_id` bigint(20) UNSIGNED NOT NULL,
  `recipient_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_plan_id` bigint(20) UNSIGNED NOT NULL,
  `gift_message` text DEFAULT NULL,
  `duration_months` int(11) NOT NULL DEFAULT 1,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','paid','activated','expired','cancelled') NOT NULL DEFAULT 'pending',
  `activation_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `gifted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `activated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hero_sections`
--

CREATE TABLE `hero_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `subheading` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_country` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_hero_sections`
--

CREATE TABLE `home_hero_sections` (
  `id` bigint(20) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `button_link` text NOT NULL,
  `bg_image` text NOT NULL,
  `song_image` text NOT NULL,
  `song_name` text NOT NULL,
  `song_album` varchar(255) NOT NULL,
  `song` text NOT NULL,
  `pc_image_1` text NOT NULL,
  `pc_image_2` text NOT NULL,
  `pc_image_3` text NOT NULL,
  `pc_image_4` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_hero_sections`
--

INSERT INTO `home_hero_sections` (`id`, `heading`, `description`, `button_link`, `bg_image`, `song_image`, `song_name`, `song_album`, `song`, `pc_image_1`, `pc_image_2`, `pc_image_3`, `pc_image_4`, `created_at`, `updated_at`) VALUES
(1, 'SingWithMe', 'SingWithMe Records Ltd is a community-driven platform for independent artists to share their music, grow their fanbase, and reach global audiences. Upload songs, videos, and artwork with ease, and distribute them to Spotify, YouTube, iTunes, TikTok, and more. Simple, transparent, and built for artists—join us today and elevate your music career!', 'Soluta totam ut accu', 'uploads/1756313393_cover.jpg', 'uploads/1756313267_msc.jpg', 'SoundHelix Song 1', 'Demo Album', 'uploads/audio/1765188607_song-english-edm-296526 (1).mp3', 'uploads/1756313180_song2.jpg', 'uploads/1756313180_2.jpg', 'uploads/1756313180_3.jpg', 'uploads/1756313180_4.jpg', '2025-08-27 11:44:31', '2025-12-08 05:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `iseeyou_sections`
--

CREATE TABLE `iseeyou_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `video_link` text DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `iso_code` varchar(255) NOT NULL,
  `native_name` varchar(255) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `iso_code`, `native_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'English', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(2, 'Spanish', 'es', 'Español', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(3, 'French', 'fr', 'Français', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(4, 'Chinese', 'zh', '中文', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(5, 'Arabic', 'ar', 'العربية', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(6, 'Hindi', 'hi', 'हिन्दी', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(7, 'Russian', 'ru', 'Русский', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(8, 'Portuguese', 'pt', 'Português', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(9, 'Bengali', 'bn', 'বাংলা', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(10, 'Urdu', 'ur', 'اردو', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(11, 'Japanese', 'ja', '日本語', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(12, 'German', 'de', 'Deutsch', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(13, 'Korean', 'ko', '한국어', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(14, 'Turkish', 'tr', 'Türkçe', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(15, 'Italian', 'it', 'Italiano', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(16, 'Persian', 'fa', 'فارسی', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(17, 'Dutch', 'nl', 'Nederlands', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(18, 'Swedish', 'sv', 'Svenska', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(19, 'Greek', 'el', 'Ελληνικά', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(20, 'Hebrew', 'he', 'עברית', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(21, 'Thai', 'th', 'ไทย', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(22, 'Vietnamese', 'vi', 'Tiếng Việt', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(23, 'Polish', 'pl', 'Polski', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(24, 'Romanian', 'ro', 'Română', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(25, 'Hungarian', 'hu', 'Magyar', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(26, 'Czech', 'cs', 'Čeština', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(27, 'Finnish', 'fi', 'Suomi', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(28, 'Malay', 'ms', 'Bahasa Melayu', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(29, 'Indonesian', 'id', 'Bahasa Indonesia', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(30, 'Norwegian', 'no', 'Norsk', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(31, 'Danish', 'da', 'Dansk', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(32, 'Slovak', 'sk', 'Slovenčina', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(33, 'Serbian', 'sr', 'Српски', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(34, 'Bulgarian', 'bg', 'Български', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(35, 'Lithuanian', 'lt', 'Lietuvių', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(36, 'Latvian', 'lv', 'Latviešu', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(37, 'Estonian', 'et', 'Eesti', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(38, 'Croatian', 'hr', 'Hrvatski', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(39, 'Slovenian', 'sl', 'Slovenščina', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(40, 'Swahili', 'sw', 'Kiswahili', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(41, 'Afrikaans', 'af', 'Afrikaans', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(42, 'Albanian', 'sq', 'Shqip', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(43, 'Armenian', 'hy', 'Հայերեն', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(44, 'Georgian', 'ka', 'ქართული', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(45, 'Pashto', 'ps', 'پښتو', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(46, 'Kurdish', 'ku', 'Kurdî', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(47, 'Sindhi', 'sd', 'سنڌي', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(48, 'Tamil', 'ta', 'தமிழ்', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(49, 'Telugu', 'te', 'తెలుగు', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(50, 'Marathi', 'mr', 'मराठी', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(51, 'Gujarati', 'gu', 'ગુજરાતી', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `legal_documents`
--

CREATE TABLE `legal_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_type` enum('privacy_policy','terms_of_service','user_agreement','artist_agreement','copyright_policy','data_usage_policy','refund_policy','community_guidelines') NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `version` varchar(50) NOT NULL DEFAULT '1.0',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_required` tinyint(1) NOT NULL DEFAULT 1,
  `effective_date` date NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_videos`
--

CREATE TABLE `live_videos` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `video` text NOT NULL,
  `views` varchar(255) NOT NULL,
  `visibility` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `live_videos`
--

INSERT INTO `live_videos` (`id`, `title`, `video`, `views`, `visibility`, `created_at`, `updated_at`) VALUES
(3, 'Best Artist', 'uploads/1763980551_video.mp4', '16M', 1, '2025-08-29 09:21:17', '2025-11-24 05:35:51'),
(4, 'Music Performance Live', 'uploads/1763980632_video2.mp4', '12M', 1, '2025-08-29 09:21:55', '2025-11-24 05:37:12'),
(5, 'Cooking Show Live Stream', 'uploads/1763980672_video3.mp4', '8M', 1, '2025-08-29 09:22:20', '2025-11-24 05:37:52'),
(6, 'Tech Review Live', 'uploads/1756477360_video4.mp4', '15M', 1, '2025-08-29 09:22:40', '2025-08-29 09:22:40'),
(7, 'Gaming Live Stream', 'uploads/1763980805_video6.mp4', '22M', 1, '2025-08-29 09:23:09', '2025-11-24 05:40:05'),
(8, 'Educational Content Live', 'uploads/1763980757_video7.mp4', '9M', 1, '2025-08-29 09:23:28', '2025-11-24 05:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `marital_statuses`
--

CREATE TABLE `marital_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marital_statuses`
--

INSERT INTO `marital_statuses` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Single', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(2, 'Married', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(3, 'Divorced', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(4, 'Widowed', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(5, 'Separated', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(6, 'Engaged', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(7, 'In a Relationship', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(8, 'It\'s Complicated', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(9, 'Domestic Partnership', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(10, 'Civil Union', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18'),
(11, 'Prefer Not to Say', 'active', '2025-08-27 09:52:18', '2025-08-27 09:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_items`
--

CREATE TABLE `marketplace_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `item_type` enum('beat','collaboration','personalized_music','instrumental','acapella','other') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `price_currency` varchar(3) NOT NULL DEFAULT 'USD',
  `accept_credits` tinyint(1) NOT NULL DEFAULT 1,
  `credits_price` decimal(10,2) DEFAULT NULL,
  `media_file` text DEFAULT NULL,
  `thumbnail_image` text DEFAULT NULL,
  `demo_file` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `license_type` enum('exclusive','non_exclusive','lease','unlimited') NOT NULL DEFAULT 'non_exclusive',
  `status` enum('draft','active','sold_out','archived') NOT NULL DEFAULT 'draft',
  `view_count` int(11) NOT NULL DEFAULT 0,
  `purchase_count` int(11) NOT NULL DEFAULT 0,
  `rating` decimal(3,2) DEFAULT NULL,
  `review_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_purchases`
--

CREATE TABLE `marketplace_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','credits','both') NOT NULL,
  `cash_amount` decimal(10,2) DEFAULT NULL,
  `credits_amount` decimal(10,2) DEFAULT NULL,
  `platform_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `artist_earnings` decimal(10,2) NOT NULL DEFAULT 0.00,
  `license_type` varchar(50) NOT NULL,
  `download_url` text DEFAULT NULL,
  `download_expires_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','completed','failed','refunded') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `purchased_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketplace_reviews`
--

CREATE TABLE `marketplace_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `review_text` text DEFAULT NULL,
  `is_verified_purchase` tinyint(1) NOT NULL DEFAULT 1,
  `helpful_count` int(11) NOT NULL DEFAULT 0,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_05_21_203520_create_permission_tables', 1),
(6, '2025_05_22_202511_create_countries_table', 1),
(7, '2025_05_22_202520_create_languages_table', 1),
(8, '2025_05_22_202529_create_genders_table', 1),
(9, '2025_05_22_202546_create_marital_statuses_table', 1),
(10, '2025_05_22_202636_create_designations_table', 1),
(11, '2025_05_22_202637_create_timezones_table', 1),
(12, '2025_05_22_202638_create_company_settings_table', 1),
(13, '2025_05_22_202645_create_profiles_table', 1),
(14, '2025_05_22_203629_create_system_settings_table', 1),
(15, '2025_05_22_210323_create_notifications_table', 1),
(16, '2025_07_21_141525_create_faqs_table', 1),
(17, '2025_07_21_141539_create_contacts_table', 1),
(18, '2025_07_21_162639_create_company_details_table', 1),
(19, '2025_07_21_163957_create_hero_sections_table', 1),
(20, '2025_07_21_164537_create_iseeyou_sections_table', 1),
(21, '2025_07_21_164748_create_partnership_sections_table', 1),
(22, '2025_07_21_164917_create_autodeposit_sections_table', 1),
(23, '2025_07_21_175416_create_contact_sections_table', 1),
(24, '2025_07_22_133745_create_prefooter_sections_table', 1),
(25, '2025_07_22_140939_create_newsletters_table', 1),
(26, '2025_07_22_155254_create_visit_stats_table', 1),
(27, '2025_08_30_095029_add_visibility_to_social_share_musics_table', 1),
(28, '2025_09_01_161143_create_new_newsletters_table', 2),
(29, '2025_09_01_174032_create_service_musicvideos_table', 3),
(30, '2025_09_01_174037_create_service_royaltycollection_table', 3),
(31, '2025_09_27_135836_create_user_playlists_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 26),
(2, 'App\\Models\\User', 32),
(2, 'App\\Models\\User', 34),
(2, 'App\\Models\\User', 35),
(2, 'App\\Models\\User', 37),
(2, 'App\\Models\\User', 40),
(2, 'App\\Models\\User', 41),
(2, 'App\\Models\\User', 44),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 23),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 28),
(3, 'App\\Models\\User', 29),
(3, 'App\\Models\\User', 30),
(3, 'App\\Models\\User', 31),
(3, 'App\\Models\\User', 33),
(3, 'App\\Models\\User', 36),
(3, 'App\\Models\\User', 38),
(3, 'App\\Models\\User', 39),
(3, 'App\\Models\\User', 42),
(3, 'App\\Models\\User', 43);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_plays`
--

CREATE TABLE `monthly_plays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `plays` bigint(20) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monthly_plays`
--

INSERT INTO `monthly_plays` (`id`, `user_id`, `music_id`, `plays`, `month`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 13, '10', '2025', '2025-10-02 11:34:10', '2025-10-03 03:54:24'),
(2, 1, 1, 9, '11', '2025', '2025-11-24 05:47:17', '2025-11-24 06:16:45'),
(3, 1, 2, 5, '11', '2025', '2025-11-24 05:50:03', '2025-11-24 06:00:07'),
(4, 1, 1, 37, '12', '2025', '2025-12-02 08:34:29', '2025-12-23 06:44:42'),
(5, 1, 2, 16, '12', '2025', '2025-12-02 08:36:17', '2025-12-23 06:44:46'),
(6, 1, 10, 3, '12', '2025', '2025-12-06 10:16:08', '2025-12-11 04:57:01'),
(7, 1, 9, 6, '12', '2025', '2025-12-06 10:16:10', '2025-12-11 04:57:01'),
(8, 1, 8, 5, '12', '2025', '2025-12-06 10:16:10', '2025-12-11 04:56:57'),
(9, 1, 4, 12, '12', '2025', '2025-12-06 10:16:13', '2025-12-23 06:44:48'),
(10, 1, 3, 7, '12', '2025', '2025-12-06 10:19:03', '2025-12-17 05:40:58'),
(11, 1, 6, 4, '12', '2025', '2025-12-06 10:25:14', '2025-12-11 04:56:59'),
(12, 1, 5, 3, '12', '2025', '2025-12-06 10:53:03', '2025-12-23 06:44:50'),
(13, 1, 7, 2, '12', '2025', '2025-12-06 10:53:06', '2025-12-11 04:56:59'),
(14, 1, 11, 1, '12', '2025', '2025-12-11 04:57:00', '2025-12-11 04:57:00'),
(15, 1, 1, 8, '1', '2026', '2026-01-03 12:48:43', '2026-01-27 17:45:53'),
(16, 1, 2, 5, '1', '2026', '2026-01-03 12:48:44', '2026-01-27 17:45:29'),
(17, 1, 7, 2, '1', '2026', '2026-01-03 12:48:48', '2026-01-06 07:42:25'),
(18, 1, 9, 1, '1', '2026', '2026-01-03 12:48:48', '2026-01-03 12:48:48'),
(19, 1, 11, 1, '1', '2026', '2026-01-03 12:48:49', '2026-01-03 12:48:49'),
(20, 1, 15, 27, '1', '2026', '2026-01-16 01:19:53', '2026-01-28 11:15:40'),
(21, 1, 14, 12, '1', '2026', '2026-01-16 01:20:25', '2026-01-16 10:11:31'),
(22, 1, 16, 21, '1', '2026', '2026-01-16 02:59:36', '2026-01-27 17:18:37'),
(23, 1, 13, 4, '1', '2026', '2026-01-16 07:12:40', '2026-01-28 11:15:41'),
(24, 1, 17, 11, '1', '2026', '2026-01-16 09:03:17', '2026-01-19 03:55:36'),
(25, 1, 21, 12, '1', '2026', '2026-01-19 03:43:57', '2026-01-26 17:59:08'),
(26, 1, 12, 5, '1', '2026', '2026-01-19 03:55:16', '2026-01-27 17:22:27'),
(27, 1, 23, 5, '3', '2026', '2026-03-13 05:50:57', '2026-03-13 06:03:52'),
(28, 1, 24, 1, '3', '2026', '2026-03-13 06:27:04', '2026-03-13 06:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `newsbars`
--

CREATE TABLE `newsbars` (
  `id` bigint(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsbars`
--

INSERT INTO `newsbars` (`id`, `title`, `created_at`, `updated_at`) VALUES
(2, 'Empowering independent artists worldwide — keep 80% of your royalties!', '2025-09-01 10:41:27', '2025-09-01 10:41:27'),
(4, 'Collect royalties, promote your work & grow your fanbase — all in one place.', '2025-09-01 10:42:05', '2025-09-01 10:42:05'),
(5, 'Emerging or pro, SingWithMe Records is your trusted music partner.', '2025-09-01 10:42:11', '2025-09-01 10:42:11'),
(6, 'Transparent, artist-first platform — focus on your music, we’ll handle the rest.', '2025-09-01 10:42:17', '2025-09-01 10:42:17'),
(7, 'Upload songs, videos & artwork — reach a global audience today!', '2025-09-01 10:42:23', '2025-09-01 10:42:23'),
(8, 'Distribute your music to Spotify, YouTube, iTunes & TikTok — hassle-free.', '2025-09-01 10:42:30', '2025-09-01 10:42:30'),
(9, 'Empowering independent artists worldwide — keep 80% of your royalties!', '2025-09-01 10:42:37', '2025-09-01 10:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `visibility` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `new_newsletters`
--

CREATE TABLE `new_newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_newsletters`
--

INSERT INTO `new_newsletters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'ffd@dsrf.com', '2025-09-01 11:13:52', '2025-09-01 11:13:52'),
(2, 'hjgjufftuftyft@ghghghjghj.com', '2025-09-01 11:15:33', '2025-09-01 11:15:33'),
(3, 'trdtrtr@werrf.com', '2025-09-01 11:18:37', '2025-09-01 11:18:37'),
(4, 'fcgfgh@def.com', '2025-11-24 05:46:41', '2025-11-24 05:46:41'),
(5, 'sysors@gmail.com', '2025-12-26 17:23:33', '2025-12-26 17:23:33'),
(6, 'sds@dd.com', '2026-01-18 10:08:05', '2026-01-18 10:08:05'),
(7, 'newsletter@gmail.com', '2026-01-19 03:58:26', '2026-01-19 03:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `type` enum('info','success','warning','error','payment','subscription','earnings','payout','system') DEFAULT 'info',
  `notification_type` enum('email','push','in_app','sms') DEFAULT 'in_app',
  `title` varchar(255) DEFAULT NULL,
  `action_url` varchar(500) DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `read_at` timestamp NULL DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `type`, `notification_type`, `title`, `action_url`, `metadata`, `read_at`, `sent_at`, `delivered_at`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 30, 'Lars Watson subscribed to your artist profile.', 'subscription', 'in_app', 'New Subscriber', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-14 07:18:28', '2026-01-14 07:18:28'),
(2, 33, 'Lars Watson subscribed to your artist profile.', 'subscription', 'in_app', 'New Subscriber', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-14 09:52:21', '2026-01-14 09:52:21'),
(3, 32, 'Test Artist uploaded a new song: Test Music 2', 'system', 'in_app', 'New Song Uploaded', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-14 09:52:58', '2026-01-14 09:52:58'),
(4, 33, 'Your payout request of $51.00 has been submitted and is pending admin approval. You will be notified once it\'s processed.', 'payment', 'in_app', 'Payout Request Submitted', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-15 12:20:37', '2026-01-15 12:20:37'),
(5, 33, 'Your payout request of $51.00 has been approved and is being processed.', 'payment', 'in_app', 'Payout Approved', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-15 12:28:16', '2026-01-15 12:28:16'),
(6, 33, 'Your payout of $51.00 has been completed and sent to your bank_transfer account.', 'payment', 'in_app', 'Payout Completed', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-15 12:28:26', '2026-01-15 12:28:26'),
(7, 32, 'Test Artist uploaded a new song: Test 2', 'system', 'in_app', 'New Song Uploaded', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-15 12:40:47', '2026-01-15 12:40:47'),
(8, 32, 'Test Artist uploaded a new song: final', 'system', 'in_app', 'New Song Uploaded', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-15 12:43:21', '2026-01-15 12:43:21'),
(9, 32, 'Test Artist uploaded new artwork.', 'system', 'in_app', 'New Artwork Uploaded', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-16 00:57:42', '2026-01-16 00:57:42'),
(10, 33, 'Test User subscribed to your artist profile.', 'subscription', 'in_app', 'New Subscriber', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-16 01:21:33', '2026-01-16 01:21:33'),
(11, 1, 'New tip received: £5 from Test User to Test Artist. Please process and send to artist.', 'payment', 'in_app', 'New Tip Received', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-16 01:46:29', '2026-01-16 01:46:29'),
(12, 33, 'You received a tip of £5.00 from Test User!', 'payment', 'in_app', 'Tip Received', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-16 02:19:08', '2026-01-16 02:19:08'),
(13, 33, 'Test User subscribed to your artist profile.', 'subscription', 'in_app', 'New Subscriber', NULL, NULL, NULL, '2026-01-16 02:56:45', NULL, 0, '2026-01-16 02:56:45', '2026-01-16 02:56:45'),
(14, 32, 'Test Artist uploaded a new song: long song', 'system', 'in_app', 'New Song Uploaded', NULL, NULL, NULL, '2026-01-16 02:58:49', NULL, 0, '2026-01-16 02:58:49', '2026-01-16 02:58:49'),
(16, 33, 'Royalty calculation completed for January 2026. You earned $4,000.00 from 1 streams. Amount added to your wallet.', 'payment', 'in_app', 'Royalty Calculated', NULL, NULL, '2026-01-16 03:08:38', '2026-01-16 03:01:20', NULL, 1, '2026-01-16 03:01:20', '2026-01-16 03:08:38'),
(17, 33, 'Test User subscribed to your artist profile.', 'subscription', 'in_app', 'New Subscriber', NULL, NULL, NULL, '2026-01-16 03:08:23', NULL, 0, '2026-01-16 03:08:23', '2026-01-16 03:08:23'),
(18, 33, 'Royalty calculation completed for January 2026. You earned $1,200.00 from 1 streams. Amount added to your wallet.', 'payment', 'in_app', 'Royalty Calculated', NULL, NULL, NULL, '2026-01-16 03:22:33', NULL, 0, '2026-01-16 03:22:33', '2026-01-16 03:22:33'),
(19, 28, 'Royalty calculation completed for January 2026. You earned $1,200.00 from 1 streams. Amount added to your wallet.', 'payment', 'in_app', 'Royalty Calculated', NULL, NULL, NULL, '2026-01-16 03:22:34', NULL, 0, '2026-01-16 03:22:34', '2026-01-16 03:22:34'),
(20, 32, 'Test Artist uploaded a new song: test', 'system', 'in_app', 'New Song Uploaded', NULL, NULL, NULL, '2026-01-16 09:02:13', NULL, 0, '2026-01-16 09:02:13', '2026-01-16 09:02:13'),
(22, 33, 'Your payout request of $214.00 has been submitted and is pending admin approval. You will be notified once it\'s processed.', 'payment', 'in_app', 'Payout Request Submitted', NULL, NULL, NULL, '2026-01-18 23:51:46', NULL, 0, '2026-01-18 23:51:46', '2026-01-18 23:51:46'),
(23, 32, 'Test Artist uploaded a new song: Test with ISRC', 'system', 'in_app', 'New Song Uploaded', NULL, NULL, NULL, '2026-01-18 23:52:57', NULL, 0, '2026-01-18 23:52:57', '2026-01-18 23:52:57'),
(25, 28, 'Royalty calculation completed for January 2026. You earned $200.00 from 1 streams. Amount added to your wallet.', 'payment', 'in_app', 'Royalty Calculated', NULL, NULL, NULL, '2026-01-19 00:23:00', NULL, 0, '2026-01-19 00:23:00', '2026-01-19 00:23:00'),
(26, 33, 'Royalty calculation completed for January 2026. You earned $600.00 from 2 streams. Amount added to your wallet.', 'payment', 'in_app', 'Royalty Calculated', NULL, NULL, NULL, '2026-01-19 00:23:01', NULL, 0, '2026-01-19 00:23:01', '2026-01-19 00:23:01'),
(27, 33, 'Your payout request of $214.00 has been approved and is being processed.', 'payment', 'in_app', 'Payout Approved', NULL, NULL, NULL, '2026-01-19 00:23:49', NULL, 0, '2026-01-19 00:23:49', '2026-01-19 00:23:49'),
(28, 33, 'Your payout of $214.00 has been completed and sent to your bank_transfer account.', 'payment', 'in_app', 'Payout Completed', NULL, NULL, NULL, '2026-01-19 00:23:58', NULL, 0, '2026-01-19 00:23:58', '2026-01-19 00:23:58'),
(29, 36, 'Test User subscribed to your artist profile.', 'subscription', 'in_app', 'New Subscriber', NULL, NULL, NULL, '2026-01-19 03:56:07', NULL, 0, '2026-01-19 03:56:07', '2026-01-19 03:56:07'),
(30, 36, 'You received a tip of £50 from Test User! Message: Love your songs', 'payment', 'in_app', 'Tip Received', 'https://singwithmerecords.co.uk/artist/artisit-portal', '{\"tip_id\":2,\"user_id\":34,\"amount\":50,\"user_message\":\"Love your songs\"}', NULL, '2026-01-19 03:56:52', NULL, 0, '2026-01-19 03:56:52', '2026-01-19 03:56:52'),
(32, 36, 'razin subscribed to your artist profile.', 'subscription', 'in_app', 'New Subscriber', NULL, NULL, NULL, '2026-01-19 11:26:33', NULL, 0, '2026-01-19 11:26:33', '2026-01-19 11:26:33'),
(33, 33, 'You received a tip of £7 from Jacky!', 'payment', 'in_app', 'Tip Received', 'https://singwithmerecords.co.uk/artist/artisit-portal', '{\"tip_id\":3,\"user_id\":44,\"amount\":7,\"user_message\":null}', '2026-03-16 05:12:10', '2026-03-16 05:09:35', NULL, 1, '2026-03-16 05:09:35', '2026-03-16 05:12:10'),
(34, 44, 'Your tip of £7 to Edward Munoz has been sent successfully! The artist has been notified.', 'payment', 'in_app', 'Tip Sent Successfully', 'https://singwithmerecords.co.uk/tip-artist?artist=33', '{\"tip_id\":3,\"artist_id\":33,\"amount\":7}', NULL, '2026-03-16 05:09:37', NULL, 0, '2026-03-16 05:09:37', '2026-03-16 05:09:37'),
(35, 33, 'You received a tip of £5 from Jacky!', 'payment', 'in_app', 'Tip Received', 'https://singwithmerecords.co.uk/artist/artisit-portal', '{\"tip_id\":4,\"user_id\":44,\"amount\":5,\"user_message\":null}', NULL, '2026-03-16 05:13:33', NULL, 0, '2026-03-16 05:13:33', '2026-03-16 05:13:33'),
(36, 44, 'Your tip of £5 to Edward Munoz has been sent successfully! The artist has been notified.', 'payment', 'in_app', 'Tip Sent Successfully', 'https://singwithmerecords.co.uk/tip-artist?artist=33', '{\"tip_id\":4,\"artist_id\":33,\"amount\":5}', NULL, '2026-03-16 05:13:34', NULL, 0, '2026-03-16 05:13:34', '2026-03-16 05:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `template_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event_type` varchar(100) NOT NULL,
  `notification_type` enum('email','push','sms') NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `status` enum('pending','sent','delivered','failed','bounced') NOT NULL DEFAULT 'pending',
  `sent_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `failure_reason` text DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_preferences`
--

CREATE TABLE `notification_preferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `email_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `push_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `sms_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('email','push','sms','all') NOT NULL DEFAULT 'all',
  `event_type` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `variables` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ownership_splits`
--

CREATE TABLE `ownership_splits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `collaboration_id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `ownership_percentage` decimal(5,2) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `contribution_type` enum('vocals','instrumental','production','lyrics','composition','mixing','mastering','other') DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `approved_by_artist` tinyint(1) NOT NULL DEFAULT 0,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ownership_splits`
--

INSERT INTO `ownership_splits` (`id`, `collaboration_id`, `artist_id`, `ownership_percentage`, `role`, `contribution_type`, `is_primary`, `approved_by_artist`, `approved_at`, `created_at`, `updated_at`) VALUES
(1, 1, 33, 50.00, NULL, NULL, 1, 1, '2026-01-16 03:09:28', '2026-01-16 03:09:28', '2026-01-16 03:09:28'),
(2, 1, 28, 50.00, 'testttt', NULL, 0, 0, NULL, '2026-01-16 03:09:28', '2026-01-16 03:09:28'),
(3, 2, 36, 70.00, NULL, NULL, 1, 1, '2026-01-18 23:48:57', '2026-01-18 23:48:57', '2026-01-18 23:48:57'),
(4, 2, 24, 30.00, 'Featured', NULL, 0, 0, NULL, '2026-01-18 23:48:57', '2026-01-18 23:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) NOT NULL,
  `title` varchar(300) NOT NULL,
  `logo` text NOT NULL,
  `visibility` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `title`, `logo`, `visibility`, `created_at`, `updated_at`) VALUES
(3, '1', 'uploads/1763980977_relax-music.svg', 1, '2025-08-29 11:02:15', '2025-11-24 06:10:14'),
(4, 'Electronic Music', 'uploads/1763980987_rock-roll.svg', 1, '2025-08-29 11:02:37', '2025-11-24 05:43:07'),
(5, 'Rock & Roll', 'uploads/1763981112_classical-music.svg', 1, '2025-08-29 11:02:57', '2025-11-24 05:45:12'),
(6, 'Latin Music', 'uploads/1763981073_latin-music.svg', 1, '2025-08-29 11:03:31', '2025-11-24 05:44:33'),
(7, 'Jazz Music', 'uploads/1763981063_jazz-music.svg', 1, '2025-08-29 11:03:55', '2025-11-24 05:44:23'),
(8, 'Relax Music', 'uploads/1763981030_classical-music.svg', 1, '2025-08-29 11:04:14', '2025-11-24 05:43:50'),
(9, 'ds', 'uploads/1763981053_electronic-music.svg', 1, '2025-10-22 09:50:13', '2025-11-24 05:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `partnership_sections`
--

CREATE TABLE `partnership_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payout_history`
--

CREATE TABLE `payout_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payout_request_id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `payout_method` enum('bank_transfer','paypal','wise','other') NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `status` enum('processing','completed','failed','refunded') NOT NULL DEFAULT 'processing',
  `processed_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `failure_reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payout_history`
--

INSERT INTO `payout_history` (`id`, `payout_request_id`, `artist_id`, `amount`, `currency`, `payout_method`, `transaction_id`, `status`, `processed_at`, `completed_at`, `failure_reason`, `created_at`, `updated_at`) VALUES
(1, 1, 33, 51.00, 'USD', 'bank_transfer', NULL, 'completed', '2026-01-15 12:28:16', '2026-01-15 12:28:26', NULL, '2026-01-15 12:28:16', '2026-01-15 12:28:26'),
(2, 2, 33, 214.00, 'USD', 'bank_transfer', NULL, 'completed', '2026-01-19 00:23:49', '2026-01-19 00:23:58', NULL, '2026-01-19 00:23:49', '2026-01-19 00:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `payout_requests`
--

CREATE TABLE `payout_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `requested_amount` decimal(10,2) NOT NULL,
  `available_balance` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `payout_method` enum('bank_transfer','paypal','wise','other') NOT NULL DEFAULT 'bank_transfer',
  `account_details` text DEFAULT NULL,
  `status` enum('pending','approved','rejected','processing','completed','failed') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `attachment_file` varchar(255) DEFAULT NULL COMMENT 'Admin attachment file path',
  `artist_notes` text DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `processed_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `rejected_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payout_requests`
--

INSERT INTO `payout_requests` (`id`, `artist_id`, `requested_amount`, `available_balance`, `currency`, `payout_method`, `account_details`, `status`, `admin_notes`, `attachment_file`, `artist_notes`, `requested_at`, `processed_at`, `approved_by`, `rejected_by`, `created_at`, `updated_at`) VALUES
(1, 33, 51.00, 60.00, 'USD', 'bank_transfer', '{\"account_name\":\"hjhj\",\"account_number\":\"877878\",\"bank_name\":\"jhhj\",\"routing_number\":\"76878\",\"payment_method\":\"bank_transfer\"}', 'completed', 'dfd', NULL, NULL, '2026-01-15 17:20:37', '2026-01-15 12:28:26', 1, NULL, '2026-01-15 12:20:37', '2026-01-15 12:28:26'),
(2, 33, 214.00, 5214.00, 'USD', 'bank_transfer', '{\"account_name\":\"hjhj\",\"account_number\":\"877878\",\"bank_name\":\"jhhj\",\"routing_number\":\"76878\",\"payment_method\":\"bank_transfer\"}', 'completed', 'Payment Sent', NULL, NULL, '2026-01-19 04:51:46', '2026-01-19 00:23:58', 1, NULL, '2026-01-18 23:51:46', '2026-01-19 00:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `pending_agreement_notifications`
--

CREATE TABLE `pending_agreement_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `notification_sent_at` timestamp NULL DEFAULT NULL,
  `reminder_count` int(11) NOT NULL DEFAULT 0,
  `last_reminder_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','accepted','expired') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 11, 'auth_token', 'e0c65786c78ac16bd52de7fc6f1feebf79a5ce772186cf4f1d56e9f980ac082d', '[\"*\"]', NULL, NULL, '2025-10-02 03:56:11', '2025-10-02 03:56:11'),
(2, 'App\\Models\\User', 8, 'auth_token', 'd62f03f859cc9c88ab67b2c1399495517caee2479f95f876b4db56b049fb2480', '[\"*\"]', NULL, NULL, '2025-10-02 03:56:54', '2025-10-02 03:56:54'),
(3, 'App\\Models\\User', 8, 'auth_token', '28a3dfa70878e17add80b05598836640fecacb347ad2834e8b4ed1ad16a68c16', '[\"*\"]', NULL, NULL, '2025-10-02 08:19:07', '2025-10-02 08:19:07'),
(4, 'App\\Models\\User', 8, 'auth_token', 'e8911f4f3643945beb7f3126a3f61246d7104334c188d9404dfd1301c053873f', '[\"*\"]', NULL, NULL, '2025-10-02 10:56:43', '2025-10-02 10:56:43'),
(5, 'App\\Models\\User', 8, 'auth_token', '4860c69aa57c87e338ca6604729bce6a4c344744bb6b7b54553d20468fd1ff11', '[\"*\"]', NULL, NULL, '2025-10-03 03:17:18', '2025-10-03 03:17:18'),
(6, 'App\\Models\\User', 34, 'auth_token', '47bc031bee7c69d1564bf5494a71f73c3eb486d86ce3fc8e40b43146a6616ebf', '[\"*\"]', NULL, NULL, '2026-01-15 06:06:19', '2026-01-15 06:06:19'),
(7, 'App\\Models\\User', 34, 'auth_token', '46f69cfa786f000a48e0c420b36a21552386adf8bff3382ec474e126ecb82b0f', '[\"*\"]', NULL, NULL, '2026-01-15 06:42:21', '2026-01-15 06:42:21'),
(8, 'App\\Models\\User', 34, 'auth_token', 'cec44433195a5ef06798af598013c1c27067ff16f3a28b75d4a2f544cb51960a', '[\"*\"]', NULL, NULL, '2026-01-15 12:34:42', '2026-01-15 12:34:42'),
(9, 'App\\Models\\User', 34, 'auth_token', 'b9442ae25f0eeec1fb135c2fa211a639732b1ce8b90b215b0ac34ac7231fc297', '[\"*\"]', NULL, NULL, '2026-01-16 01:13:25', '2026-01-16 01:13:25'),
(10, 'App\\Models\\User', 34, 'auth_token', 'a3c078cdaaacab3ee43ce63aefe747205c802cdd6f7a0376b869f947b93b0feb', '[\"*\"]', NULL, NULL, '2026-01-16 06:41:17', '2026-01-16 06:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `platform_revenue_tracking`
--

CREATE TABLE `platform_revenue_tracking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `period_month` int(11) NOT NULL COMMENT '1-12 for month',
  `period_year` int(11) NOT NULL COMMENT 'Year (e.g., 2025)',
  `total_platform_revenue` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Total revenue from subscriptions/ads',
  `total_platform_streams` bigint(20) NOT NULL DEFAULT 0 COMMENT 'Total streams across all content',
  `total_platform_downloads` bigint(20) NOT NULL DEFAULT 0 COMMENT 'Total downloads across all content',
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `revenue_source` enum('subscriptions','ads','purchases','other') NOT NULL DEFAULT 'subscriptions',
  `status` enum('pending','confirmed','finalized') NOT NULL DEFAULT 'pending',
  `finalized_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `platform_revenue_tracking`
--

INSERT INTO `platform_revenue_tracking` (`id`, `period_month`, `period_year`, `total_platform_revenue`, `total_platform_streams`, `total_platform_downloads`, `currency`, `revenue_source`, `status`, `finalized_at`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 2026, 1000.00, 2, 1, 'USD', 'subscriptions', 'finalized', '2026-01-19 00:23:00', NULL, '2026-01-14 06:08:59', '2026-01-19 00:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `prefooter_sections`
--

CREATE TABLE `prefooter_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `subheading` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preview_access_logs`
--

CREATE TABLE `preview_access_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `preview_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `accessed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `company_phone` varchar(255) DEFAULT NULL,
  `company_type` varchar(255) DEFAULT NULL,
  `company_size` varchar(255) DEFAULT NULL,
  `dance_style` varchar(255) DEFAULT NULL,
  `dance_video` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `phone`, `company_name`, `contact_person`, `company_phone`, `company_type`, `company_size`, `dance_style`, `dance_video`, `picture`, `banner_image`, `about`, `created_at`, `updated_at`) VALUES
(1, 33, 'Tester', 'Musician', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'artist_profiles/VxNVbutZYyhBVKZSPjJAaFiJ2EJvenqvB8CcPt0w.jpg', 'artist_banners/MkpcEd2xKjFkrv9AuRmL3ExAIiqNCjpUZI34AE6r.jpg', 'This is a test bio for testing purpose', '2026-01-16 01:05:43', '2026-01-16 01:06:11'),
(2, 36, 'Test', 'Artist', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'artist_profiles/WzRD08zmJ4CeKKXYwOWNn1QlP3RPFpx4uMYTdGdF.jpg', 'artist_banners/eOBENrqEGSlWLjOYOukAXmhgHOKThdO9wEUrc1bp.jpg', 'This is a test bio for artist', '2026-01-18 23:48:17', '2026-01-18 23:48:17'),
(3, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'artist_profiles/35f0vTKCT3n0ewcm4KbIOPxkeglyZfHf1aAIJ1Cv.jpg', 'artist_banners/Wy9KTKLMrD4N4fn79ZxIoVJ3nfTYhxdy0LxtsSc3.jpg', NULL, '2026-01-27 17:41:29', '2026-01-27 17:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `qa_questions`
--

CREATE TABLE `qa_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qa_session_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text DEFAULT NULL,
  `answered_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `upvotes` int(11) NOT NULL DEFAULT 0,
  `status` enum('pending','answered','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referrer_id` bigint(20) UNSIGNED NOT NULL,
  `referred_id` bigint(20) UNSIGNED NOT NULL,
  `referral_code` varchar(50) NOT NULL,
  `credits_earned` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','completed','rewarded') NOT NULL DEFAULT 'pending',
  `completed_at` timestamp NULL DEFAULT NULL,
  `rewarded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-08-27 09:52:17', '2025-08-27 09:52:17'),
(2, 'individual', 'web', '2025-08-27 09:52:17', '2025-08-27 09:52:17'),
(3, 'artist', 'web', '2025-08-27 09:52:17', '2025-08-27 09:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `royalty_calculations`
--

CREATE TABLE `royalty_calculations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `calculation_period` date NOT NULL,
  `total_streams` bigint(20) NOT NULL DEFAULT 0,
  `total_downloads` bigint(20) NOT NULL DEFAULT 0,
  `total_gross_revenue` decimal(10,2) NOT NULL DEFAULT 0.00,
  `platform_fee_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `artist_royalty_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `royalty_percentage` decimal(5,2) NOT NULL DEFAULT 80.00,
  `platform_fee_percentage` decimal(5,2) NOT NULL DEFAULT 20.00,
  `status` enum('pending','calculated','paid','disputed') NOT NULL DEFAULT 'pending',
  `calculated_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `royalty_calculations`
--

INSERT INTO `royalty_calculations` (`id`, `artist_id`, `calculation_period`, `total_streams`, `total_downloads`, `total_gross_revenue`, `platform_fee_amount`, `artist_royalty_amount`, `royalty_percentage`, `platform_fee_percentage`, `status`, `calculated_at`, `notes`, `created_at`, `updated_at`) VALUES
(1, 33, '2026-01-01', 2, 1, 750.00, 150.00, 600.00, 80.00, 20.00, 'calculated', '2026-01-19 00:23:00', NULL, '2026-01-16 03:01:20', '2026-01-19 00:23:00'),
(2, 28, '2026-01-01', 1, 0, 250.00, 50.00, 200.00, 80.00, 20.00, 'calculated', '2026-01-19 00:23:00', NULL, '2026-01-16 03:22:33', '2026-01-19 00:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `service_artistsubscription`
--

CREATE TABLE `service_artistsubscription` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_artistsubscription`
--

INSERT INTO `service_artistsubscription` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Royalty Collection', '<p>Track your music royalties in real-time and receive fast, transparent payouts directly to your account.</p>', '2025-09-02 03:23:56', '2025-09-02 03:23:56'),
(3, 'Music Distribution', '<p>Distribute your songs to Spotify, Apple Music, YouTube, and 50+ other platforms worldwide.</p>', '2025-09-02 03:24:03', '2025-09-02 03:24:03'),
(4, 'Promotional Tools', '<p>Boost your visibility with access to playlist pitching, promo banners, and social integrations.</p>', '2025-09-02 03:24:09', '2025-09-02 03:24:09'),
(5, 'Live Stream Support', '<p>Monetize live performances and reach fans globally through integrated live video tools.</p>', '2025-09-02 03:24:34', '2025-09-02 03:24:34'),
(6, 'Analytics Dashboard', '<p>Get detailed insights on streams, audience demographics, and trends to grow your music career.</p>', '2025-09-02 03:24:41', '2025-09-02 03:24:41'),
(7, 'Priority Support', '<p>Enjoy fast response times and personalized assistance from our dedicated artist support team.</p>', '2025-09-02 03:24:48', '2025-09-02 03:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `service_artworkphoto`
--

CREATE TABLE `service_artworkphoto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_artworkphoto`
--

INSERT INTO `service_artworkphoto` (`id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(2, '<lord-icon src=\"https://cdn.lordicon.com/xyvcjupc.json\" trigger=\"loop\" delay=\"1500\" state=\"in-reveal\" colors=\"primary:#320a5c,secondary:#110a5c,tertiary:#a866ee\">                                 </lord-icon>', 'Accepted Formats', '<p>JPG, PNG, GIF formats supported with maximum 5MB file size for optimal performance</p>', '2025-09-02 03:30:09', '2025-09-02 03:30:09'),
(3, '<lord-icon src=\"https://cdn.lordicon.com/zsixeihu.json\" trigger=\"in\" delay=\"1500\" state=\"in-reveal\" colors=\"primary:#320a5c,secondary:#a866ee,tertiary:#a866ee,quaternary:#e5d1fa\">                                 </lord-icon>', 'Content Types', '<p>Upload album covers, profile photos, banners, promotional graphics, and brand assets</p>', '2025-09-02 03:30:18', '2025-09-02 03:30:18'),
(4, '<lord-icon src=\"https://cdn.lordicon.com/vwgzpetl.json\" trigger=\"in\" delay=\"1500\" state=\"in-reveal\" colors=\"primary:#320a5c,secondary:#c69cf4,tertiary:#a866ee\">                                 </lord-icon>', 'Resolution Guidelines', '<p>High-resolution images recommended with minimum 1000x1000px for best quality results</p>', '2025-09-02 03:31:06', '2025-09-02 03:31:06'),
(5, '<lord-icon src=\"https://cdn.lordicon.com/viglwblu.json\" trigger=\"in\" delay=\"1500\" state=\"in-reveal\" colors=\"primary:#8930e8,secondary:#c69cf4,tertiary:#320a5c\">                                 </lord-icon>', 'Usage Rights', '<p>Ensure you own or have proper rights to use all uploaded images and artwork</p>', '2025-09-02 03:31:15', '2025-09-02 03:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `service_musicvideos`
--

CREATE TABLE `service_musicvideos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` text NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `include` text NOT NULL,
  `button_link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_musicvideos`
--

INSERT INTO `service_musicvideos` (`id`, `icon`, `title`, `description`, `include`, `button_link`, `created_at`, `updated_at`) VALUES
(2, '<svg viewBox=\"0 0 24 24\" fill=\"currentColor\">     <path d=\"M12 3V13.55C11.41 13.21 10.73 13 10 13C7.79 13 6 14.79 6 17S7.79 21 10 21 14 19.21 14 17V7H18V3H12Z\"></path>   </svg>', 'Music Upload', '<p>Upload your original tracks, beats, and compositions. Support for MP3, WAV, FLAC, and more high-quality formats.</p>', '[\"High-quality audio processing\",\"Automatic metadata extraction\",\"Multiple format support\",\"Instant preview and editing\",\"Copyright protection\"]', 'https://singwithme.thevisionbrands.com', '2025-09-02 03:01:16', '2025-09-02 03:01:16'),
(3, '<svg viewBox=\"0 0 24 24\" fill=\"currentColor\">                                 <path d=\"M17,10.5V7A1,1 0 0,0 16,6H4A1,1 0 0,0 3,7V17A1,1 0 0,0 4,18H16A1,1 0 0,0 17,17V13.5L21,17.5V6.5L17,10.5Z\"></path>                             </svg>', 'Video Upload', '<p>Share your music videos, live performances, and behind-the-scenes content. Professional video processing included.</p>', '[\"4K video support\",\"Automatic compression\",\"Thumbnail generation\",\"Subtitle support\",\"Social media optimization\"]', 'https://singwithme.thevisionbrands.com/', '2025-09-02 03:02:50', '2025-09-02 03:02:50'),
(4, '<svg viewBox=\"0 0 24 24\" fill=\"currentColor\">                                 <path d=\"M12,2A3,3 0 0,1 15,5V11A3,3 0 0,1 12,14A3,3 0 0,1 9,11V5A3,3 0 0,1 12,2M19,11C19,14.53 16.39,17.44 13,17.93V21H11V17.93C7.61,17.44 5,14.53 5,11H7A5,5 0 0,0 12,16A5,5 0 0,0 17,11H19Z\"></path>                             </svg>', 'Live Streaming', '<p>Stream live performances, jam sessions, and interact with your audience in real-time with professional streaming tools.</p>', '[\"HD live streaming\",\"Real-time chat integration\",\"Multi-camera support\",\"Stream recording\",\"Audience analytics\"]', 'https://singwithme.thevisionbrands.com/', '2025-09-02 03:08:55', '2025-09-02 03:08:55'),
(5, '<svg viewBox=\"0 0 24 24\" fill=\"currentColor\">                                 <path d=\"M16,4C18.21,4 20,5.79 20,8C20,10.21 18.21,12 16,12C15.67,12 15.34,11.95 15.04,11.85L14.6,12.68C15.11,13.12 15.5,13.73 15.67,14.42L16.96,15.71C17.3,15.37 17.74,15.12 18.24,15.03C19.04,14.9 19.83,15.11 20.45,15.56C21.07,16 21.5,16.63 21.64,17.35C21.92,18.78 20.83,20.14 19.4,20.42C18.64,20.56 17.87,20.35 17.28,19.86C16.69,19.37 16.32,18.66 16.22,17.9L15.29,16.97C14.6,17.33 13.81,17.5 13,17.5C12.19,17.5 11.4,17.33 10.71,16.97L9.78,17.9C9.68,18.66 9.31,19.37 8.72,19.86C8.13,20.35 7.36,20.56 6.6,20.42C5.17,20.14 4.08,18.78 4.36,17.35C4.5,16.63 4.93,16 5.55,15.56C6.17,15.11 6.96,14.9 7.76,15.03C8.26,15.12 8.7,15.37 9.04,15.71L10.33,14.42C10.5,13.73 10.89,13.12 11.4,12.68L10.96,11.85C10.66,11.95 10.33,12 10,12C7.79,12 6,10.21 6,8C6,5.79 7.79,4 10,4C11.25,4 12.37,4.58 13,5.5C13.63,4.58 14.75,4 16,4M10,6A2,2 0 0,0 8,8A2,2 0 0,0 10,10A2,2 0 0,0 12,8A2,2 0 0,0 10,6M16,6A2,2 0 0,0 14,8A2,2 0 0,0 16,10A2,2 0 0,0 18,8A2,2 0 0,0 16,6Z\"></path>                             </svg>', 'Collaboration Hub', '<p>Connect with other artists for collaborations, remixes, and joint projects. Build your musical network globally.</p>', '[\"Artist matching system\",\"Project collaboration tools\",\"Version control for tracks\",\"Real-time feedback\",\"Revenue sharing options\"]', 'https://singwithme.thevisionbrands.com/', '2025-09-02 03:10:21', '2025-09-02 03:10:21'),
(6, '<svg viewBox=\"0 0 24 24\" fill=\"currentColor\">                                 <path d=\"M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12A6,6 0 0,0 12,6M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8Z\"></path>                             </svg>', 'Global Distribution', '<p>Distribute your music to Spotify, Apple Music, YouTube Music, and 150+ platforms worldwide with one click.</p>', '[\"Instant global distribution\",\"Royalty collection & tracking\",\"Release scheduling\",\"Performance analytics\",\"Playlist pitching service\"]', 'https://singwithme.thevisionbrands.com/', '2025-09-02 03:11:35', '2025-09-02 03:11:35'),
(7, '<svg viewBox=\"0 0 24 24\" fill=\"currentColor\">                                 <path d=\"M22,21H2V3H4V19H6V17H10V19H12V16H16V19H18V17H22V21M16,8H18V15H16V8M12,2H14V15H12V2M8,9H10V15H8V9M4,11H6V15H4V11Z\"></path>                             </svg>', 'Advanced Analytics', '<p>Get detailed insights into your music performance, audience demographics, and revenue streams across all platforms.</p>', '[\"Real-time streaming data\",\"Audience demographics\",\"Revenue tracking\",\"Geographic insights\",\"Trend analysis & predictions\"]', 'https://singwithme.thevisionbrands.com/', '2025-09-02 03:12:51', '2025-09-02 03:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `service_royaltycollection`
--

CREATE TABLE `service_royaltycollection` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` text NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `include` text NOT NULL,
  `button_link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_royaltycollection`
--

INSERT INTO `service_royaltycollection` (`id`, `icon`, `title`, `description`, `include`, `button_link`, `created_at`, `updated_at`) VALUES
(2, '<svg width=\"30\" height=\"30\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\">                                 <path d=\"M12 2L2 7v10c0 5.55 3.84 9.74 9 11 5.16-1.26 9-5.45 9-11V7l-10-5z\"></path>                                 <path d=\"M9 12l2 2 4-4\"></path>                             </svg>', 'Performance Royalties', '<p>Collect royalties from radio, TV, streaming platforms, and live performances worldwide.</p>', '[\"Global PRO registration\",\"Radio & TV monitoring\",\"Streaming platform tracking\",\"Live performance collection\",\"International royalty recovery\"]', 'https://singwithme.thevisionbrands.com/', '2025-09-02 03:19:49', '2025-09-02 03:19:49'),
(3, '<svg width=\"30\" height=\"30\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\">                                 <circle cx=\"12\" cy=\"12\" r=\"10\"></circle>                                 <path d=\"M8 14s1.5 2 4 2 4-2 4-2\"></path>                                 <line x1=\"9\" y1=\"9\" x2=\"9.01\" y2=\"9\"></line>                                 <line x1=\"15\" y1=\"9\" x2=\"15.01\" y2=\"9\"></line>                             </svg>', 'Mechanical Royalties', '<p>Ensure you receive all mechanical royalties from digital downloads and physical sales.</p>', '[\"Digital download tracking\",\"Physical sales monitoring\",\"Sync licensing royalties\",\"Interactive streaming rates\",\"Automated collection setup\"]', 'https://singwithme.thevisionbrands.com/', '2025-09-02 03:20:51', '2025-09-02 03:20:51'),
(4, '<svg width=\"30\" height=\"30\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\">                                 <path d=\"M3 3v18h18\"></path>                                 <path d=\"M18.7 8l-5.1 5.2-2.8-2.7L7 14.3\"></path>                             </svg>', 'Analytics & Reporting', '<p>Comprehensive analytics and detailed reporting on all your royalty streams and earnings.</p>', '[\"Real-time earnings dashboard\",\"Detailed royalty breakdowns\",\"Performance analytics\",\"Revenue forecasting\",\"Custom reporting tools\"]', 'https://singwithme.thevisionbrands.com/', '2025-09-02 03:21:55', '2025-09-02 03:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `service_supportnetworking`
--

CREATE TABLE `service_supportnetworking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_supportnetworking`
--

INSERT INTO `service_supportnetworking` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Live Chat Support', '<p>Need help fast? Our support team is available via live chat 24/7 to assist with your account, uploads, royalties, and more.</p>', '2025-09-02 03:34:09', '2025-09-02 03:34:09'),
(3, 'Email Assistance', '<p>Reach out to our support team at any time. We respond quickly to inquiries regarding payments, releases, and technical help.</p>', '2025-09-02 03:34:20', '2025-09-02 03:34:20'),
(4, 'Knowledge Base', '<p>Browse articles, FAQs, and step-by-step guides to help you navigate every aspect of the SingWithMe platform with ease.</p>', '2025-09-02 03:34:36', '2025-09-02 03:34:36'),
(5, 'Artist Community Portal', '<p>Join other creators in our exclusive artist space &mdash; share ideas, ask questions, and connect with industry peers.</p>', '2025-09-02 03:34:45', '2025-09-02 03:34:45'),
(6, 'Collaboration Tools', '<p>Find and collaborate with vocalists, producers, or video editors directly on the platform. Grow your sound together.</p>', '2025-09-02 03:34:53', '2025-09-02 03:34:53'),
(7, 'Artist Forums', '<p>Participate in topic-based discussions about branding, mixing, promotion, and more. Learn from other artists&#39; journeys.</p>', '2025-09-02 03:34:58', '2025-09-02 03:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `share_your_music_sections`
--

CREATE TABLE `share_your_music_sections` (
  `id` bigint(20) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` text DEFAULT NULL,
  `heading2` varchar(300) NOT NULL,
  `description2` text DEFAULT NULL,
  `button_link` text NOT NULL,
  `step1_title` varchar(300) DEFAULT NULL,
  `step1_description` text DEFAULT NULL,
  `step2_title` varchar(300) DEFAULT NULL,
  `step2_description` text DEFAULT NULL,
  `step3_title` varchar(300) DEFAULT NULL,
  `step3_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `share_your_music_sections`
--

INSERT INTO `share_your_music_sections` (`id`, `title`, `description`, `heading2`, `description2`, `button_link`, `step1_title`, `step1_description`, `step2_title`, `step2_description`, `step3_title`, `step3_description`, `created_at`, `updated_at`) VALUES
(1, 'Sharing My Sound Everywhere', 'My music is now live across TikTok, YouTube, Spotify, Instagram, and Vevo—so no matter where you are, the vibe is just a tap away. Let’s connect through sound.', 'Why Release Music Online with SingWithMe?', 'We\'ve been supporting independent artists and labels for the past 20 years. Our industry toolkit includes unlimited distribution, publishing, sync pitching, playlisting and more.', 'Vero sed illo aliqua', 'Upload your music.', 'Use our Release Builder to create singles, EPs or albums. Just upload your tracks, artwork & all the important info about your release, then choose which platforms your fans can listen on.', 'We release it everywhere.', 'Once your track meets the platform guidelines, SingWithMe will deliver it to all your selected music stores. You\'ll also get a SingWithMe SmartLink, making it easy for your fans to Pre-Save your release before it goes live.', 'You get paid.', 'When your release date arrives and your music\'s out there, you\'ll make money every time it\'s streamed or downloaded. You\'ll keep 100% of the royalties you earn and can quickly withdraw every penny directly to your bank account or PayPal.', '2025-08-30 08:24:37', '2025-08-30 08:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `social_share_musics`
--

CREATE TABLE `social_share_musics` (
  `id` bigint(20) NOT NULL,
  `title` varchar(300) NOT NULL,
  `link` text NOT NULL,
  `image` text NOT NULL,
  `visibility` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social_share_musics`
--

INSERT INTO `social_share_musics` (`id`, `title`, `link`, `image`, `visibility`, `created_at`, `updated_at`) VALUES
(1, 'Labore dolorem labor', 'https://singwithme.thevisionbrands.com/artisit-portal.html', 'uploads/1756548021_1.jpeg', 1, '2025-08-30 04:31:37', '2025-08-30 08:22:44'),
(2, 'Sound On for Instagram', 'https://singwithme.thevisionbrands.com/artisit-portal.html', 'uploads/1756548050_insta_img.jpeg', 1, '2025-08-30 05:00:50', '2025-08-30 05:00:50'),
(3, 'Now Streaming on Amazon', 'https://singwithme.thevisionbrands.com/artisit-portal.html', 'uploads/1756548069_amazon_img.jpeg', 1, '2025-08-30 05:01:09', '2025-08-30 05:01:09'),
(4, 'Vibes Only on Spotify', 'https://singwithme.thevisionbrands.com/artisit-portal.html', 'uploads/1756548091_spotify_img.jpeg', 1, '2025-08-30 05:01:31', '2025-08-30 05:01:31'),
(5, 'Music Drops on TikTok', 'https://singwithme.thevisionbrands.com/artisit-portal.html', 'uploads/1756548130_tiktok_img.jpeg', 1, '2025-08-30 05:02:10', '2025-08-30 05:02:10'),
(6, 'Tune In on Youtube', 'https://singwithme.thevisionbrands.com/artisit-portal.html', 'uploads/1756548155_youtube.jpg', 1, '2025-08-30 05:02:35', '2025-08-30 05:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `sponsored_playlists`
--

CREATE TABLE `sponsored_playlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_partnership_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `playlist_image` text DEFAULT NULL,
  `curator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `like_count` int(11) NOT NULL DEFAULT 0,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsored_playlist_items`
--

CREATE TABLE `sponsored_playlist_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `playlist_id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stream_stats`
--

CREATE TABLE `stream_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stream_duration` int(11) NOT NULL DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `device_type` varchar(50) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `is_complete` tinyint(1) NOT NULL DEFAULT 0,
  `streamed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stream_stats`
--

INSERT INTO `stream_stats` (`id`, `music_id`, `artist_id`, `user_id`, `stream_duration`, `ip_address`, `country`, `city`, `device_type`, `platform`, `is_complete`, `streamed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 1, 0, '127.0.0.1', NULL, NULL, NULL, NULL, 0, '2026-01-15 06:14:55', '2026-01-15 06:14:55', '2026-01-15 06:14:55'),
(2, 14, 33, 1, 0, '127.0.0.1', NULL, NULL, NULL, NULL, 0, '2026-01-16 02:56:25', '2026-01-16 02:56:25', '2026-01-16 02:56:25'),
(3, 16, 33, 1, 54, '127.0.0.1', NULL, NULL, NULL, NULL, 1, '2026-01-16 03:00:30', '2026-01-16 03:00:30', '2026-01-16 03:00:30'),
(4, 15, 33, 1, 12, '127.0.0.1', NULL, NULL, NULL, NULL, 0, '2026-01-16 03:00:50', '2026-01-16 03:00:50', '2026-01-16 03:00:50'),
(5, 15, 33, 1, 12, '127.0.0.1', NULL, NULL, NULL, NULL, 0, '2026-01-16 07:10:26', '2026-01-16 07:10:26', '2026-01-16 07:10:26'),
(6, 15, 33, 1, 12, '127.0.0.1', NULL, NULL, NULL, NULL, 0, '2026-01-16 07:11:00', '2026-01-16 07:11:00', '2026-01-16 07:11:00'),
(7, 15, 33, 1, 12, '127.0.0.1', NULL, NULL, NULL, NULL, 0, '2026-01-16 07:17:56', '2026-01-16 07:17:56', '2026-01-16 07:17:56'),
(8, 17, 33, 1, 54, '117.102.60.243', NULL, NULL, NULL, NULL, 1, '2026-01-16 09:18:30', '2026-01-16 09:18:30', '2026-01-16 09:18:30'),
(9, 15, 33, 1, 12, '117.102.60.243', NULL, NULL, NULL, NULL, 0, '2026-01-16 09:26:07', '2026-01-16 09:26:07', '2026-01-16 09:26:07'),
(10, 15, 33, 1, 12, '117.102.60.243', NULL, NULL, NULL, NULL, 0, '2026-01-16 09:38:24', '2026-01-16 09:38:24', '2026-01-16 09:38:24'),
(11, 14, 33, 1, 12, '117.102.60.243', NULL, NULL, NULL, NULL, 0, '2026-01-16 09:41:46', '2026-01-16 09:41:46', '2026-01-16 09:41:46'),
(12, 15, 33, 1, 12, '117.102.60.243', NULL, NULL, NULL, NULL, 0, '2026-01-16 09:43:56', '2026-01-16 09:43:56', '2026-01-16 09:43:56'),
(13, 15, 33, 1, 12, '117.102.60.243', NULL, NULL, NULL, NULL, 0, '2026-01-16 09:44:50', '2026-01-16 09:44:50', '2026-01-16 09:44:50'),
(14, 14, 33, 1, 12, '117.102.60.243', NULL, NULL, NULL, NULL, 0, '2026-01-16 09:50:23', '2026-01-16 09:50:23', '2026-01-16 09:50:23'),
(15, 14, 33, 1, 12, '117.102.60.243', NULL, NULL, NULL, NULL, 0, '2026-01-16 10:00:23', '2026-01-16 10:00:23', '2026-01-16 10:00:23'),
(16, 14, 33, 1, 12, '117.102.60.243', NULL, NULL, NULL, NULL, 0, '2026-01-16 10:11:31', '2026-01-16 10:11:31', '2026-01-16 10:11:31'),
(17, 21, 36, 1, 12, '216.106.188.185', NULL, NULL, NULL, NULL, 0, '2026-01-19 11:26:21', '2026-01-19 11:26:21', '2026-01-19 11:26:21'),
(18, 1, 7, 1, 11, '103.156.137.166', NULL, NULL, NULL, NULL, 0, '2026-01-26 18:50:03', '2026-01-26 18:50:03', '2026-01-26 18:50:03'),
(19, 16, 33, 1, 54, '103.156.137.163', NULL, NULL, NULL, NULL, 1, '2026-01-27 17:12:07', '2026-01-27 17:12:07', '2026-01-27 17:12:07'),
(20, 16, 33, 1, 54, '103.156.137.163', NULL, NULL, NULL, NULL, 1, '2026-01-27 17:13:46', '2026-01-27 17:13:46', '2026-01-27 17:13:46'),
(21, 16, 33, 1, 54, '103.156.137.163', NULL, NULL, NULL, NULL, 1, '2026-01-27 17:15:25', '2026-01-27 17:15:25', '2026-01-27 17:15:25'),
(22, 16, 33, 1, 54, '103.156.137.163', NULL, NULL, NULL, NULL, 1, '2026-01-27 17:17:04', '2026-01-27 17:17:04', '2026-01-27 17:17:04'),
(23, 16, 33, 1, 54, '103.156.137.163', NULL, NULL, NULL, NULL, 1, '2026-01-27 17:18:37', '2026-01-27 17:18:37', '2026-01-27 17:18:37'),
(24, 23, 42, 1, 12, '2406:d00:cccf:8281:1894:c54b:e113:b9de', NULL, NULL, NULL, NULL, 0, '2026-03-13 06:03:52', '2026-03-13 06:03:52', '2026-03-13 06:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `max_upload_size` varchar(255) DEFAULT NULL,
  `currency_symbol` varchar(255) DEFAULT NULL,
  `currency_symbol_position` enum('prefix','postfix') NOT NULL DEFAULT 'prefix',
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `timezone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `offset` varchar(255) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `track_collaborations`
--

CREATE TABLE `track_collaborations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `primary_artist_id` bigint(20) UNSIGNED NOT NULL,
  `collaboration_type` enum('feature','collaboration','remix','producer') NOT NULL DEFAULT 'collaboration',
  `status` enum('pending','active','rejected','completed') NOT NULL DEFAULT 'pending',
  `total_ownership_percentage` decimal(5,2) NOT NULL DEFAULT 100.00,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `track_collaborations`
--

INSERT INTO `track_collaborations` (`id`, `music_id`, `primary_artist_id`, `collaboration_type`, `status`, `total_ownership_percentage`, `is_verified`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 16, 33, 'feature', 'pending', 100.00, 0, NULL, '2026-01-16 03:09:28', '2026-01-16 03:09:28'),
(2, 21, 36, 'feature', 'pending', 100.00, 0, NULL, '2026-01-18 23:48:57', '2026-01-18 23:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_type` enum('earnings','payout','refund','adjustment','subscription_payment','subscription_renewal') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `description` text DEFAULT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','completed','failed','cancelled') NOT NULL DEFAULT 'pending',
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` enum('active','inactive') NOT NULL DEFAULT 'active',
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `is_artist` int(11) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `usersubscription_id` bigint(20) UNSIGNED DEFAULT NULL,
  `usersubscription_date` timestamp NULL DEFAULT NULL,
  `usersubscription_duration` bigint(20) DEFAULT NULL,
  `referral_code` varchar(50) DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `payment_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `is_active`, `provider`, `provider_id`, `is_artist`, `is_featured`, `usersubscription_id`, `usersubscription_date`, `usersubscription_duration`, `referral_code`, `payment_method`, `payment_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', NULL, '$2y$10$c8POulTn6abF.sdRjG8tX.N9y/TVSFwlRI4dhms/YYpXRye2owEbO', 'zToFXpsCTVEQS5UHYXnSl94mbiLfSJ5o9Ft52m5RegKhabSXhuwCsZecSf5i', 'active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-27 09:52:17', '2025-10-01 10:24:47', NULL),
(2, 'John Doe', 'individual@example.com', 'john_individual', NULL, '$2y$10$uwEnpe1LmjMB1aqchZ6YrOueYy2heB0rGURHehAWXb4/YtT.2zo9C', NULL, 'active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-27 09:52:18', '2025-08-27 09:52:18', NULL),
(3, 'ACME Corp', 'company@example.com', 'acme_company', NULL, '$2y$10$EK6KMHf1EmcIrTYb7oDwiut/V0mYu8YKKlZ8sKRPwLUr11biStNBu', NULL, 'active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-27 09:52:18', '2025-08-27 09:52:18', NULL),
(5, 'Buckminster Warren', 'vygohosin@mailinator.com', 'buckminsterwarren1831', NULL, '$2y$10$mnGYziD2LCRTLKbERWyNL.Mcg6s2UnQgB2.JJ0n5Zz8wFjp3em1sy', NULL, 'active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-08 09:33:07', '2025-09-08 09:33:07', NULL),
(7, 'Edward Munoz', 'finalgamers67@gmail.com', 'edwardmunoz7162', NULL, '$2y$10$f52iHMUIkjvHyqs/wQXB9..qKnQE95wtBS2Db.ImAhZUXszQug7PO', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-23 11:16:36', '2026-01-18 13:00:46', NULL),
(8, 'sghdgg', 'user1234@gmail.com', 'sghdgg7497', NULL, '$2y$10$mopooYOFFFCVwagIxYe7N.ohN/7CN1xzNN5CSAoAk/v9Ye3BcEzfW', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-01 05:57:18', '2025-10-01 05:57:18', NULL),
(9, 'Test User', 'test@example.com', 'testuser', '2025-10-01 06:03:10', '$2y$10$OAUFvWOMe3QLhxo93kjH6uSbN6KtHU3uHYDaqPYEfFzoxGOX5Ryk.', NULL, 'active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-01 06:03:10', '2025-10-01 06:03:10', NULL),
(11, 'dfsfdf', 'user12345@gmail.com', 'dfsfdf5973', NULL, '$2y$10$XjmN08QEG8hf1sr6KLXqmuCJ8QF0uEV4FocmyYf3xdYQjEvMgMqfu', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-02 03:50:36', '2025-10-02 03:50:36', NULL),
(12, 'bhjnhjh', 'adfgmin@gmail.com', 'bhjnhjh5319', NULL, '$2y$10$LblfF5jUvmVFJxZ5onQA9e6l5PBYrewYlhDJif06FoY5rd47cna.S', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-19 04:44:51', '2025-11-19 04:44:51', NULL),
(13, 'TestArtist', 'testartist@gmail.com', 'testartist8428', NULL, '$2y$10$NBiXCymN2M3w5DGhOjEnluKqDaB8puMLMsfTWRJ1d6/muSzAhcw7S', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-24 04:21:19', '2025-11-24 04:21:19', NULL),
(14, 'Rachel Marks', 'kogyh@mailinator.com', 'rachelmarks8477', NULL, '$2y$10$.mZj7dM7uNmxy6h54f/qbeAAJITmXM8dlbeoTGD3oHxa.qfiW3P8O', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 08:31:05', '2025-12-02 08:31:05', NULL),
(15, 'Keith Dixon', 'paveqitam@mailinator.com', 'keithdixon7543', NULL, '$2y$10$5.Inpnjs8u5u36TOl6lPe.xU2dxdk1bu1pWU6nPreCmRicdAovNF2', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 08:37:53', '2025-12-02 08:37:53', NULL),
(16, 'Mona Bass', 'bawejotu@mailinator.com', 'monabass7846', NULL, '$2y$10$jXaww9giIl0BSyH8c4qC8.cQig79YKDSfo0yGjrFV24PBiTpPBT1W', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 09:06:08', '2025-12-02 09:06:08', NULL),
(17, 'Test User', 'testingartist@gmail.com', 'testuser1767', NULL, '$2y$10$o.c3ZXSVHJW.fs8bNCnvSOXEsyUCduRc62BNhkWtrdEiASeAK5eqa', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-02 09:07:29', '2025-12-02 09:07:29', NULL),
(18, 'Remedios Vance', 'vokygoqa@mailinator.com', 'remediosvance9539', NULL, '$2y$10$CDOa0hokSlrAC6g7IFX10e8Z3UBkreIxXI/OZsjcl.WBp6LHCLyUS', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-06 07:59:24', '2025-12-06 07:59:24', NULL),
(19, 'Malachi Ray', 'zimejylo@mailinator.com', 'malachiray3224', NULL, '$2y$10$gWn6Tjd3doGoE00DTI1QtuivyUNRU.LF2ECFI4aoH9hY3hVgm4vg.', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-08 05:03:19', '2025-12-08 05:03:19', NULL),
(20, 'user1', 'alex.marketing.gab@gmail.com', 'user11424', NULL, '$2y$10$8kGz2bFQ4Mmz3U6MMaT0cOMGD8s.HSfSUPvIAJNS493HyrP5LTYM.', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-17 09:06:18', '2025-12-17 09:06:18', NULL),
(21, 'razin', 'raziy.dev@gmail.com', 'razin5333', NULL, '$2y$10$tN5q9yW9IR/q6eZOgvDZtORHSNovWoPcORuBtX7Vu9BWnn1KkeIyq', 'w850yfgFmIZO8Hms8yPQ2Ytz4hYGeKVcemPkub3U3Ozja6BlEFsxZqnpeN6l', 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-20 08:45:56', '2025-12-20 08:45:56', NULL),
(22, 'Eden Harmon', 'jobuxovu@mailinator.com', 'edenharmon5302', NULL, '$2y$10$pVU2nvtODEJQZiihpEAh3.YuFLEidqE6o2jdZjgYL5Ik1GbyC7ICu', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-23 06:36:45', '2025-12-23 06:36:45', NULL),
(23, 'Olivia Deniz', 'oliviadenizthevisionbrands@gmail.com', 'oliviadeniz4110', NULL, '$2y$10$1c6qxZBRnZTdqFjWmdsI0./d6HVRV/QGOpsHJpsu2c30BU8vxy6xW', NULL, 'active', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-07 11:41:51', '2026-01-14 09:44:33', NULL),
(24, 'Fredericka Ayala', 'kafijyvupu@mailinator.com', 'frederickaayala1809', NULL, '$2y$10$r5TrVi9vCQ6lGjBw5ywy8uCT9.IlRh62MLdHdqZ531KNUE4G6BoXO', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-08 05:41:36', '2026-01-08 05:41:36', NULL),
(25, 'Candace Holman', 'dozyma@mailinator.com', 'candaceholman3735', NULL, '$2y$10$fcECZpKV1N/hOFRSehJIxuImTDmx1KFeBZXtDdcYAuiXy4Jw.DxV6', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-08 08:21:33', '2026-01-08 08:21:33', NULL),
(26, 'test user', 'testuser@gmadddil.com', 'testuser9915', NULL, '$2y$10$jEkHDPjw.KbvWosOgGtyLum9H3TzQEWePFUacIIvyawHSh8776Ryq', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-08 10:09:42', '2026-01-08 10:09:42', NULL),
(27, 'Illana Hebert', 'fodutesuzo@mailinator.com', 'illanahebert5860', NULL, '$2y$10$jQcvEJLOlIT0CSl9XE5rcuAbgEQVnvUMvtoVX31cpy41Y2VydhOtK', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-11 11:12:58', '2026-01-11 11:12:58', NULL),
(28, 'Indigo Lynch', 'roxox@mailinator.com', 'indigolynch2393', NULL, '$2y$10$phMdm6VdvDZWBNkG0M2Ty.Ow6WMR.ezmJSIGOko9/BsO57EG5/I9m', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-12 07:34:20', '2026-01-12 07:34:20', NULL),
(29, 'Kylynn Rasmussen', 'ryzizy@mailinator.com', 'kylynnrasmussen1996', NULL, '$2y$10$pbAzExZWdCicfeMSv7dAMe0k0AszcC5quLY4s5hnnQaCf81eUy2uW', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 10:47:21', '2026-01-13 10:47:21', NULL),
(30, 'test', 'test124@gmai.com', 'test2864', NULL, '$2y$10$3RyPkZFcXRHSkMR3bvh5HuiuWSxdH7/JoWVgD95g9Ubiu9wfocgkK', NULL, 'active', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-13 11:39:39', '2026-01-14 09:44:30', NULL),
(31, 'Sybil Morin', 'boka@mailinator.com', 'sybilmorin1079', NULL, '$2y$10$nnbs2QjXwNMZ7NmoYRuQF.3m3JMIwGV/ow8fiqB3xoZFtuPB7OBLW', NULL, 'active', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-14 06:24:52', '2026-01-14 09:44:37', NULL),
(32, 'Lars Watson', 'deboned@mailinator.com', 'larswatson4334', NULL, '$2y$10$1wXth5H4MyRyrZ4mMnhII.epY5kCseTReDvmsG2e4moTyWb6suuSW', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-14 07:12:05', '2026-01-14 07:12:05', NULL),
(33, 'Edward Munoz', 'testartist123@gmail.com', 'testartist6667', NULL, '$2y$10$DvhnlZpTuhTkO.e.PMLK.Od.BF/VsDrwN5MHGWGcwtO69W07OKNem', NULL, 'active', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-14 07:19:32', '2026-01-14 09:44:27', NULL),
(34, 'Test User', 'testuser@gmail.com', 'testuser6594', NULL, '$2y$10$qmecyuZumZsIXHYc7GcQbuv7YN7Rgsvz/VIuTjkxIQss37t6T2Jum', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-15 05:35:48', '2026-01-15 05:35:48', NULL),
(35, 'tst', 'testuser222@gmail.com', 'tst4519', NULL, '$2y$10$5G4EYAhusahyyNYcfWbY5.Ou5vo/zmfwB.KWxfNEXBSfJbAPnDyBu', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-16 09:24:17', '2026-01-16 09:24:17', NULL),
(36, 'Artist 123', 'artist123@outlook.com', 'artist1237099', NULL, '$2y$10$CKxqJkSYNnK/mljBR9uYZeulEAYi.V9SaWShiz8YGuZws16vtnWY6', NULL, 'active', NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-18 23:45:16', '2026-01-19 00:14:37', NULL),
(37, 'Nero Keller', 'defehyl@mailinator.com', 'nerokeller5969', NULL, '$2y$10$qQil7.TIGzm9bcB5KShBTeMVzxoYz8RqnZHHtr0p/eYj3rTdfDGZi', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-28 05:00:43', '2026-01-28 05:00:43', NULL),
(38, 'test', 'tetsttttttt22@gmail.com', 'test5080', NULL, '$2y$10$.CDQmn4sq0gw5mVBQsDgPudE9c0JCs9ifLRbuAbbYFDoJd7dNZkjS', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-28 05:02:02', '2026-01-28 05:02:02', NULL),
(39, 'testtt@gmail.com', 'testetddjtt@gmail.com', 'testtt@gmail.com8655', NULL, '$2y$10$tVxpLmueYhH3PZgDCpPgvuzri0Tj2TiCQLWJD1uLROXEMCmy0zT/W', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-28 05:06:22', '2026-01-28 05:06:22', NULL),
(40, 'Edward Munoz', 'edward123@gmail.com', 'edwardmunoz2558', NULL, '$2y$10$DW7QjpLDJlg8EJtiDtFC/.CBSAr4WtxNAG7F814vCotj8F9rjutX.', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-29 04:32:02', '2026-01-29 04:32:02', NULL),
(41, 'Sopoline Craig', 'vyqymek@mailinator.com', 'sopolinecraig9090', NULL, '$2y$10$vE39dGt1bHuN73W1fjDj/OcdlBzOtgydL0IJzKArtl56Glp7Wn9DK', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-13 05:09:41', '2026-03-13 05:09:41', NULL),
(42, 'Salvador Sellers', 'bevaz@mailinator.com', 'salvadorsellers6454', NULL, '$2y$10$hfKU5XhwYhanKH5zFVHluuC1zuztDj.zdVMnQWLy1f27bwTudV67.', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-13 05:36:31', '2026-03-13 05:36:31', NULL),
(43, 'Jonathon Majors', 'john121@gmail.com', 'jonathonmajors9721', NULL, '$2y$10$r1KTTWRjw2.iNgxj7p16f.Im6o37bmk9c9uVVzALC4PHbVjFF9rbO', NULL, 'active', NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-13 06:23:46', '2026-03-13 06:23:46', NULL),
(44, 'Jacky', 'jacky@gmail.com', 'jacky3219', NULL, '$2y$10$OWHbylXL/E6fuZuJ6UFJqearCnxfQqhAYY0oBYlOgedsH4vQ6GB52', NULL, 'active', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-16 05:04:09', '2026-03-16 05:04:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_agreements`
--

CREATE TABLE `user_agreements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `document_version` varchar(50) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `accepted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_collections`
--

CREATE TABLE `user_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_collections`
--

INSERT INTO `user_collections` (`id`, `user_id`, `music_id`, `created_at`, `updated_at`) VALUES
(4, 8, 1, '2025-10-03 03:45:13', '2025-10-03 03:45:13'),
(5, 13, 1, '2025-11-24 06:15:49', '2025-11-24 06:15:49'),
(6, 13, 2, '2025-11-24 06:15:50', '2025-11-24 06:15:50'),
(7, 14, 1, '2025-12-02 08:36:07', '2025-12-02 08:36:07'),
(10, 15, 2, '2025-12-02 08:41:10', '2025-12-02 08:41:10'),
(13, 18, 4, '2025-12-06 10:11:21', '2025-12-06 10:11:21'),
(16, 18, 3, '2025-12-06 10:20:43', '2025-12-06 10:20:43'),
(20, 21, 2, '2026-01-06 07:41:59', '2026-01-06 07:41:59'),
(21, 34, 1, '2026-01-15 06:14:27', '2026-01-15 06:14:27'),
(22, 34, 15, '2026-01-16 07:10:15', '2026-01-16 07:10:15'),
(23, 34, 17, '2026-01-19 03:54:18', '2026-01-19 03:54:18'),
(26, 40, 3, '2026-01-29 04:33:39', '2026-01-29 04:33:39'),
(27, 40, 5, '2026-01-29 04:33:42', '2026-01-29 04:33:42'),
(28, 40, 6, '2026-01-29 04:33:43', '2026-01-29 04:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_credits`
--

CREATE TABLE `user_credits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `lifetime_earned` decimal(10,2) NOT NULL DEFAULT 0.00,
  `lifetime_spent` decimal(10,2) NOT NULL DEFAULT 0.00,
  `last_activity_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_offline_downloads`
--

CREATE TABLE `user_offline_downloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `downloaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `file_size` bigint(20) DEFAULT NULL COMMENT 'File size in bytes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_offline_downloads`
--

INSERT INTO `user_offline_downloads` (`id`, `user_id`, `music_id`, `downloaded_at`, `file_size`, `created_at`, `updated_at`) VALUES
(1, 34, 15, '2026-01-16 12:10:59', 205470, '2026-01-16 07:10:59', '2026-01-16 07:10:59'),
(2, 34, 17, '2026-01-19 08:55:42', 1729515, '2026-01-19 03:55:42', '2026-01-19 03:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `user_playlists`
--

CREATE TABLE `user_playlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `music_id` bigint(20) UNSIGNED NOT NULL,
  `playlist_name` varchar(300) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_playlists`
--

INSERT INTO `user_playlists` (`id`, `user_id`, `music_id`, `playlist_name`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 'test', '2025-10-01 05:58:37', '2025-10-01 05:58:37'),
(4, 8, 1, 'Test Finals', '2025-10-01 07:58:27', '2025-10-01 07:58:27'),
(5, 13, 1, 'Test', '2025-11-24 05:47:23', '2025-11-24 05:47:23'),
(7, 13, 2, 'Test', '2025-11-24 05:59:41', '2025-11-24 05:59:41'),
(8, 14, 1, 'test', '2025-12-02 08:33:30', '2025-12-02 08:33:30'),
(9, 14, 2, 'test', '2025-12-02 08:33:30', '2025-12-02 08:33:30'),
(10, 15, 1, 'Test', '2025-12-02 08:38:33', '2025-12-02 08:38:33'),
(12, 15, 1, 'Test 2', '2025-12-02 08:39:07', '2025-12-02 08:39:07'),
(13, 15, 2, 'Test', '2025-12-02 08:41:05', '2025-12-02 08:41:05'),
(14, 18, 1, 'jj', '2025-12-06 08:00:27', '2025-12-06 08:00:27'),
(15, 18, 8, 'jj', '2025-12-06 11:21:43', '2025-12-06 11:21:43'),
(16, 20, 8, 'text', '2025-12-17 09:14:38', '2025-12-17 09:14:38'),
(17, 34, 1, 'test', '2026-01-19 03:38:19', '2026-01-19 03:38:19'),
(18, 34, 10, 'test', '2026-01-19 03:38:43', '2026-01-19 03:38:43'),
(19, 34, 1, 'test12', '2026-01-19 03:39:30', '2026-01-19 03:39:30'),
(20, 34, 2, 'test12', '2026-01-19 03:39:30', '2026-01-19 03:39:30'),
(21, 34, 14, 'test12', '2026-01-19 03:39:30', '2026-01-19 03:39:30'),
(22, 34, 1, 'Test New Playlist', '2026-01-19 03:54:58', '2026-01-19 03:54:58'),
(23, 34, 12, 'Test New Playlist', '2026-01-19 03:54:58', '2026-01-19 03:54:58'),
(24, 21, 12, 'dd', '2026-01-27 17:09:49', '2026-01-27 17:09:49'),
(25, 21, 16, 'dd', '2026-01-27 17:09:49', '2026-01-27 17:09:49'),
(26, 40, 1, 'Jackson', '2026-01-29 04:32:32', '2026-01-29 04:32:32'),
(27, 40, 2, 'Edward Fav', '2026-01-29 04:32:58', '2026-01-29 04:32:58'),
(28, 40, 21, 'Edward Fav', '2026-01-29 04:32:58', '2026-01-29 04:32:58'),
(29, 40, 17, 'Edward Fav', '2026-01-29 04:32:58', '2026-01-29 04:32:58'),
(30, 40, 1, 'Car Tone', '2026-01-29 04:33:27', '2026-01-29 04:33:27'),
(31, 40, 17, 'Car Tone', '2026-01-29 04:33:27', '2026-01-29 04:33:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `usersubscription_id` text DEFAULT NULL,
  `usersubscription_date` text DEFAULT NULL,
  `usersubscription_duration` text DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `payment_id` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `user_id`, `usersubscription_id`, `usersubscription_date`, `usersubscription_duration`, `payment_method`, `payment_id`, `created_at`, `updated_at`) VALUES
(13, 1, '2', '2025-10-03 08:21:58', '30', 'stripe', 'pi_3SE4FPDBrmpWurbR1nzFYKV7', '2025-10-03 03:21:58', '2025-10-03 03:21:58'),
(14, 1, '2', '2025-12-02 13:42:33', '30', 'stripe', 'pi_3SZtqeDBrmpWurbR1HZqhvhA', '2025-12-02 08:42:33', '2025-12-02 08:42:33'),
(15, 1, '2', '2026-01-08 10:42:42', '30', 'stripe', 'pi_3SnGftDBrmpWurbR1cV9k1vx', '2026-01-08 05:42:42', '2026-01-08 05:42:42'),
(16, 1, '2', '2026-01-08 15:11:23', '30', 'stripe', 'pi_3SnKrvDBrmpWurbR0IOWhjNZ', '2026-01-08 10:11:23', '2026-01-08 10:11:23'),
(17, 34, '2', '2026-01-15 11:26:20', '30', 'stripe', 'pi_3SpogkDBrmpWurbR1I3lNlCL', '2026-01-15 06:26:20', '2026-01-15 06:26:20'),
(18, 34, '2', '2026-01-15 11:26:38', '30', 'stripe', 'pi_3SpohGDBrmpWurbR1DMGvZxb', '2026-01-15 06:26:38', '2026-01-15 06:26:38'),
(19, 34, '2', '2026-01-15 11:26:41', '30', 'stripe', 'pi_3SpohJDBrmpWurbR0WaeiZWt', '2026-01-15 06:26:41', '2026-01-15 06:26:41'),
(20, 34, '2', '2026-01-15 11:26:44', '30', 'stripe', 'pi_3SpohMDBrmpWurbR0jp6Vadp', '2026-01-15 06:26:44', '2026-01-15 06:26:44'),
(21, 34, '3', '2026-01-16 06:14:08', '30', 'stripe', 'pi_3Sq6IFDBrmpWurbR1zmAjkoA', '2026-01-16 01:14:08', '2026-01-16 01:14:08'),
(22, 44, '3', '2026-03-16 10:08:19', '30', 'stripe', 'pi_3TBY4MDBrmpWurbR1UTeID0G', '2026-03-16 05:08:19', '2026-03-16 05:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscription_plans`
--

CREATE TABLE `user_subscription_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(300) DEFAULT NULL,
  `price` varchar(300) DEFAULT NULL,
  `duration` varchar(300) DEFAULT NULL,
  `duration_months` int(11) DEFAULT NULL,
  `is_unlimitedstreaming` int(11) DEFAULT NULL,
  `is_ads` int(11) DEFAULT NULL COMMENT '1 = no ads, 0 = with ads',
  `is_offline` int(11) DEFAULT NULL COMMENT '1 = offline downloads enabled',
  `offline_download_limit` int(11) DEFAULT NULL COMMENT 'NULL = unlimited, number = limit',
  `is_highquality` int(11) DEFAULT NULL COMMENT 'HD audio',
  `is_unlimitedplaylist` int(11) DEFAULT NULL COMMENT '1 = unlimited, 0 = limited',
  `playlist_limit` int(11) DEFAULT NULL COMMENT 'NULL = unlimited, number = limit (e.g., 3)',
  `is_exclusivecontent` int(11) DEFAULT NULL COMMENT 'Early access to releases',
  `is_prioritysupport` int(11) DEFAULT NULL,
  `is_family` int(11) DEFAULT NULL,
  `family_limit` int(11) DEFAULT NULL,
  `is_parentalcontrol` int(11) DEFAULT NULL,
  `is_tip_artists` int(11) DEFAULT NULL COMMENT 'Ability to tip artists directly',
  `is_personalized_recommendations` int(11) DEFAULT NULL COMMENT 'Personalized weekly recommendations',
  `is_supporter_badge` int(11) DEFAULT NULL COMMENT 'Supporter badge on profile',
  `is_trending_access` int(11) DEFAULT NULL COMMENT 'Access to trending & featured creators',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_subscription_plans`
--

INSERT INTO `user_subscription_plans` (`id`, `title`, `price`, `duration`, `duration_months`, `is_unlimitedstreaming`, `is_ads`, `is_offline`, `offline_download_limit`, `is_highquality`, `is_unlimitedplaylist`, `playlist_limit`, `is_exclusivecontent`, `is_prioritysupport`, `is_family`, `family_limit`, `is_parentalcontrol`, `is_tip_artists`, `is_personalized_recommendations`, `is_supporter_badge`, `is_trending_access`, `created_at`, `updated_at`) VALUES
(1, 'Free Listener', '0', 'Monthly', 1, 1, 0, 0, NULL, 0, 0, 3, 0, 0, 0, NULL, 0, 0, 0, 0, 1, '2025-09-08 10:29:56', '2025-09-08 10:30:34'),
(2, 'Premium Listener', '4.99', 'Monthly', 1, 1, 1, 1, 100, 1, 1, NULL, 0, 0, 0, NULL, 0, 0, 0, 0, 1, '2025-09-08 10:30:26', '2025-12-08 06:56:49'),
(3, 'Super Listener', '9.99', 'Monthly', 1, 1, 1, 1, NULL, 1, 1, NULL, 1, 0, 0, NULL, 0, 1, 1, 1, 1, '2025-09-08 10:31:06', '2025-09-08 10:31:06');

-- --------------------------------------------------------

--
-- Table structure for table `visit_stats`
--

CREATE TABLE `visit_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `home_visits` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visit_stats`
--

INSERT INTO `visit_stats` (`id`, `home_visits`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-08-27 09:49:24', '2025-08-29 07:34:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_sections`
--
ALTER TABLE `about_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_impressions`
--
ALTER TABLE `ad_impressions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ad_id` (`ad_id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_music_id` (`music_id`),
  ADD KEY `idx_viewed_at` (`viewed_at`),
  ADD KEY `fk_ad_impressions_user` (`user_id`);

--
-- Indexes for table `ad_revenue_shares`
--
ALTER TABLE `ad_revenue_shares`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_artist_ad_period` (`artist_id`,`ad_id`,`period_date`),
  ADD KEY `idx_period_date` (`period_date`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `fk_ad_revenue_shares_ad` (`ad_id`);

--
-- Indexes for table `artist_agreements`
--
ALTER TABLE `artist_agreements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_artist_document` (`artist_id`,`document_id`),
  ADD KEY `idx_document_id` (`document_id`),
  ADD KEY `idx_accepted_at` (`accepted_at`);

--
-- Indexes for table `artist_analytics`
--
ALTER TABLE `artist_analytics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_music_id` (`music_id`),
  ADD KEY `idx_period` (`period_type`,`period_date`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `artist_earnings`
--
ALTER TABLE `artist_earnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_music_id` (`music_id`),
  ADD KEY `idx_stream_id` (`stream_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_period_date` (`period_date`);

--
-- Indexes for table `artist_followers`
--
ALTER TABLE `artist_followers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_artist_follower` (`artist_id`,`follower_id`),
  ADD KEY `idx_follower_id` (`follower_id`);

--
-- Indexes for table `artist_musics`
--
ALTER TABLE `artist_musics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id_fk` (`driver_id`);

--
-- Indexes for table `artist_payment_details`
--
ALTER TABLE `artist_payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_payment_method` (`payment_method`),
  ADD KEY `idx_is_primary` (`is_primary`),
  ADD KEY `fk_artist_payment_details_verified_by` (`verified_by`);

--
-- Indexes for table `artist_performance`
--
ALTER TABLE `artist_performance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_artist_period` (`artist_id`,`period_type`,`period_date`),
  ADD KEY `idx_period_date` (`period_date`);

--
-- Indexes for table `artist_profiles`
--
ALTER TABLE `artist_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `artist_qa_sessions`
--
ALTER TABLE `artist_qa_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_scheduled_at` (`scheduled_at`);

--
-- Indexes for table `artist_subscriptions`
--
ALTER TABLE `artist_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_artist_subscription_plan_id` (`artist_subscription_plan_id`),
  ADD KEY `idx_subscription_date` (`subscription_date`);

--
-- Indexes for table `artist_subscription_plans`
--
ALTER TABLE `artist_subscription_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_plan_slug` (`plan_slug`),
  ADD KEY `idx_is_active` (`is_active`),
  ADD KEY `idx_sort_order` (`sort_order`);

--
-- Indexes for table `artist_tiers`
--
ALTER TABLE `artist_tiers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_is_active` (`is_active`);

--
-- Indexes for table `artist_tier_assignments`
--
ALTER TABLE `artist_tier_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_artist_tier` (`artist_id`),
  ADD KEY `idx_tier_id` (`tier_id`);

--
-- Indexes for table `artist_tips`
--
ALTER TABLE `artist_tips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_paid_at` (`paid_at`);

--
-- Indexes for table `artist_wallets`
--
ALTER TABLE `artist_wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_artist_wallet` (`artist_id`),
  ADD KEY `idx_artist_id` (`artist_id`);

--
-- Indexes for table `artwork_photos`
--
ALTER TABLE `artwork_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audience_demographics`
--
ALTER TABLE `audience_demographics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_music_id` (`music_id`),
  ADD KEY `idx_country` (`country`),
  ADD KEY `idx_period_date` (`period_date`);

--
-- Indexes for table `autodeposit_sections`
--
ALTER TABLE `autodeposit_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_collaborations`
--
ALTER TABLE `brand_collaborations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_brand_partnership_id` (`brand_partnership_id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `brand_partnerships`
--
ALTER TABLE `brand_partnerships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_partnership_type` (`partnership_type`),
  ADD KEY `fk_brand_partnerships_created_by` (`created_by`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_royaltycollections`
--
ALTER TABLE `cms_royaltycollections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaboration_requests`
--
ALTER TABLE `collaboration_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_item_id` (`item_id`),
  ADD KEY `idx_requester_id` (`requester_id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `collaboration_revenue_distributions`
--
ALTER TABLE `collaboration_revenue_distributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_collaboration_id` (`collaboration_id`),
  ADD KEY `idx_music_id` (`music_id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_period_date` (`period_date`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_settings_country_id_foreign` (`country_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_sections`
--
ALTER TABLE `contact_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_redemptions`
--
ALTER TABLE `credit_redemptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_redemption_type` (`redemption_type`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `credit_transactions`
--
ALTER TABLE `credit_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_transaction_type` (`transaction_type`),
  ADD KEY `idx_source_type` (`source_type`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_versions`
--
ALTER TABLE `document_versions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_document_id` (`document_id`),
  ADD KEY `idx_version` (`version`),
  ADD KEY `fk_document_versions_created_by` (`created_by`);

--
-- Indexes for table `download_stats`
--
ALTER TABLE `download_stats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_music_id` (`music_id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_downloaded_at` (`downloaded_at`);

--
-- Indexes for table `exclusive_previews`
--
ALTER TABLE `exclusive_previews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_music_id` (`music_id`),
  ADD KEY `idx_access_type` (`access_type`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_questions`
--
ALTER TABLE `faq_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_subscriptions`
--
ALTER TABLE `gift_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_gifter_id` (`gifter_id`),
  ADD KEY `idx_recipient_id` (`recipient_id`),
  ADD KEY `idx_subscription_plan_id` (`subscription_plan_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `hero_sections`
--
ALTER TABLE `hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_hero_sections`
--
ALTER TABLE `home_hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iseeyou_sections`
--
ALTER TABLE `iseeyou_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legal_documents`
--
ALTER TABLE `legal_documents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_slug_version` (`slug`,`version`),
  ADD KEY `idx_document_type` (`document_type`),
  ADD KEY `idx_is_active` (`is_active`),
  ADD KEY `idx_effective_date` (`effective_date`);

--
-- Indexes for table `live_videos`
--
ALTER TABLE `live_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marital_statuses`
--
ALTER TABLE `marital_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketplace_items`
--
ALTER TABLE `marketplace_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_item_type` (`item_type`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_category` (`category`);

--
-- Indexes for table `marketplace_purchases`
--
ALTER TABLE `marketplace_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_item_id` (`item_id`),
  ADD KEY `idx_buyer_id` (`buyer_id`),
  ADD KEY `idx_seller_id` (`seller_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_transaction_id` (`transaction_id`);

--
-- Indexes for table `marketplace_reviews`
--
ALTER TABLE `marketplace_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_purchase_review` (`purchase_id`),
  ADD KEY `idx_item_id` (`item_id`),
  ADD KEY `idx_buyer_id` (`buyer_id`),
  ADD KEY `idx_rating` (`rating`);

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
-- Indexes for table `monthly_plays`
--
ALTER TABLE `monthly_plays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_monthlyplays_user` (`user_id`),
  ADD KEY `fk_monthlyplays_music` (`music_id`);

--
-- Indexes for table `newsbars`
--
ALTER TABLE `newsbars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_newsletters`
--
ALTER TABLE `new_newsletters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `new_newsletters_email_unique` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_template_id` (`template_id`),
  ADD KEY `idx_event_type` (`event_type`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `notification_preferences`
--
ALTER TABLE `notification_preferences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_event` (`user_id`,`event_type`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_event_type` (`event_type`),
  ADD KEY `idx_is_active` (`is_active`),
  ADD KEY `fk_notification_templates_created_by` (`created_by`);

--
-- Indexes for table `ownership_splits`
--
ALTER TABLE `ownership_splits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_collaboration_artist` (`collaboration_id`,`artist_id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_ownership_percentage` (`ownership_percentage`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partnership_sections`
--
ALTER TABLE `partnership_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payout_history`
--
ALTER TABLE `payout_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_payout_request_id` (`payout_request_id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_transaction_id` (`transaction_id`);

--
-- Indexes for table `payout_requests`
--
ALTER TABLE `payout_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_requested_at` (`requested_at`),
  ADD KEY `idx_approved_by` (`approved_by`),
  ADD KEY `fk_payout_requests_rejected_by` (`rejected_by`);

--
-- Indexes for table `pending_agreement_notifications`
--
ALTER TABLE `pending_agreement_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_document_id` (`document_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `platform_revenue_tracking`
--
ALTER TABLE `platform_revenue_tracking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_period` (`period_month`,`period_year`),
  ADD KEY `idx_period` (`period_month`,`period_year`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `prefooter_sections`
--
ALTER TABLE `prefooter_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preview_access_logs`
--
ALTER TABLE `preview_access_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_preview_id` (`preview_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_accessed_at` (`accessed_at`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `qa_questions`
--
ALTER TABLE `qa_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_qa_session_id` (`qa_session_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_referral` (`referrer_id`,`referred_id`),
  ADD KEY `idx_referral_code` (`referral_code`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `fk_referrals_referred` (`referred_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `royalty_calculations`
--
ALTER TABLE `royalty_calculations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_artist_period` (`artist_id`,`calculation_period`),
  ADD KEY `idx_calculation_period` (`calculation_period`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `service_artistsubscription`
--
ALTER TABLE `service_artistsubscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_artworkphoto`
--
ALTER TABLE `service_artworkphoto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_musicvideos`
--
ALTER TABLE `service_musicvideos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_royaltycollection`
--
ALTER TABLE `service_royaltycollection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_supportnetworking`
--
ALTER TABLE `service_supportnetworking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share_your_music_sections`
--
ALTER TABLE `share_your_music_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_share_musics`
--
ALTER TABLE `social_share_musics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsored_playlists`
--
ALTER TABLE `sponsored_playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_brand_partnership_id` (`brand_partnership_id`),
  ADD KEY `idx_curator_id` (`curator_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `sponsored_playlist_items`
--
ALTER TABLE `sponsored_playlist_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_playlist_music` (`playlist_id`,`music_id`),
  ADD KEY `idx_music_id` (`music_id`);

--
-- Indexes for table `stream_stats`
--
ALTER TABLE `stream_stats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_music_id` (`music_id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_streamed_at` (`streamed_at`),
  ADD KEY `idx_country` (`country`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_settings_language_id_foreign` (`language_id`),
  ADD KEY `system_settings_timezone_id_foreign` (`timezone_id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `timezones_name_unique` (`name`);

--
-- Indexes for table `track_collaborations`
--
ALTER TABLE `track_collaborations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_music_collaboration` (`music_id`),
  ADD KEY `idx_primary_artist_id` (`primary_artist_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_artist_id` (`artist_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_transaction_type` (`transaction_type`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_transaction_date` (`transaction_date`),
  ADD KEY `idx_reference_id` (`reference_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `referral_code` (`referral_code`),
  ADD KEY `user_subscription_fk` (`usersubscription_id`),
  ADD KEY `idx_referral_code` (`referral_code`);

--
-- Indexes for table `user_agreements`
--
ALTER TABLE `user_agreements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_document` (`user_id`,`document_id`),
  ADD KEY `idx_document_id` (`document_id`),
  ADD KEY `idx_accepted_at` (`accepted_at`);

--
-- Indexes for table `user_collections`
--
ALTER TABLE `user_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_credits`
--
ALTER TABLE `user_credits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_credits` (`user_id`);

--
-- Indexes for table `user_offline_downloads`
--
ALTER TABLE `user_offline_downloads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_music` (`user_id`,`music_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_music_id` (`music_id`),
  ADD KEY `idx_downloaded_at` (`downloaded_at`);

--
-- Indexes for table `user_playlists`
--
ALTER TABLE `user_playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_playlists_user_id_playlist_name_index` (`user_id`,`playlist_name`),
  ADD KEY `user_playlists_music_id_index` (`music_id`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_subscription_plans`
--
ALTER TABLE `user_subscription_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visit_stats`
--
ALTER TABLE `visit_stats`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_sections`
--
ALTER TABLE `about_sections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ad_impressions`
--
ALTER TABLE `ad_impressions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ad_revenue_shares`
--
ALTER TABLE `ad_revenue_shares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_agreements`
--
ALTER TABLE `artist_agreements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_analytics`
--
ALTER TABLE `artist_analytics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_earnings`
--
ALTER TABLE `artist_earnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `artist_followers`
--
ALTER TABLE `artist_followers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `artist_musics`
--
ALTER TABLE `artist_musics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `artist_payment_details`
--
ALTER TABLE `artist_payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artist_performance`
--
ALTER TABLE `artist_performance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_profiles`
--
ALTER TABLE `artist_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_qa_sessions`
--
ALTER TABLE `artist_qa_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_subscriptions`
--
ALTER TABLE `artist_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `artist_subscription_plans`
--
ALTER TABLE `artist_subscription_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `artist_tiers`
--
ALTER TABLE `artist_tiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_tier_assignments`
--
ALTER TABLE `artist_tier_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artist_tips`
--
ALTER TABLE `artist_tips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `artist_wallets`
--
ALTER TABLE `artist_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `artwork_photos`
--
ALTER TABLE `artwork_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `audience_demographics`
--
ALTER TABLE `audience_demographics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `autodeposit_sections`
--
ALTER TABLE `autodeposit_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brand_collaborations`
--
ALTER TABLE `brand_collaborations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_partnerships`
--
ALTER TABLE `brand_partnerships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cms_royaltycollections`
--
ALTER TABLE `cms_royaltycollections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `collaboration_requests`
--
ALTER TABLE `collaboration_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collaboration_revenue_distributions`
--
ALTER TABLE `collaboration_revenue_distributions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_sections`
--
ALTER TABLE `contact_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `credit_redemptions`
--
ALTER TABLE `credit_redemptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_transactions`
--
ALTER TABLE `credit_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `document_versions`
--
ALTER TABLE `document_versions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `download_stats`
--
ALTER TABLE `download_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exclusive_previews`
--
ALTER TABLE `exclusive_previews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faq_questions`
--
ALTER TABLE `faq_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `gift_subscriptions`
--
ALTER TABLE `gift_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hero_sections`
--
ALTER TABLE `hero_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_hero_sections`
--
ALTER TABLE `home_hero_sections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iseeyou_sections`
--
ALTER TABLE `iseeyou_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `legal_documents`
--
ALTER TABLE `legal_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_videos`
--
ALTER TABLE `live_videos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `marital_statuses`
--
ALTER TABLE `marital_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `marketplace_items`
--
ALTER TABLE `marketplace_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketplace_purchases`
--
ALTER TABLE `marketplace_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marketplace_reviews`
--
ALTER TABLE `marketplace_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `monthly_plays`
--
ALTER TABLE `monthly_plays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `newsbars`
--
ALTER TABLE `newsbars`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `new_newsletters`
--
ALTER TABLE `new_newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_preferences`
--
ALTER TABLE `notification_preferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ownership_splits`
--
ALTER TABLE `ownership_splits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `partnership_sections`
--
ALTER TABLE `partnership_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payout_history`
--
ALTER TABLE `payout_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payout_requests`
--
ALTER TABLE `payout_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pending_agreement_notifications`
--
ALTER TABLE `pending_agreement_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `platform_revenue_tracking`
--
ALTER TABLE `platform_revenue_tracking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prefooter_sections`
--
ALTER TABLE `prefooter_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preview_access_logs`
--
ALTER TABLE `preview_access_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `qa_questions`
--
ALTER TABLE `qa_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `royalty_calculations`
--
ALTER TABLE `royalty_calculations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_artistsubscription`
--
ALTER TABLE `service_artistsubscription`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_artworkphoto`
--
ALTER TABLE `service_artworkphoto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service_musicvideos`
--
ALTER TABLE `service_musicvideos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_royaltycollection`
--
ALTER TABLE `service_royaltycollection`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_supportnetworking`
--
ALTER TABLE `service_supportnetworking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `share_your_music_sections`
--
ALTER TABLE `share_your_music_sections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_share_musics`
--
ALTER TABLE `social_share_musics`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sponsored_playlists`
--
ALTER TABLE `sponsored_playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sponsored_playlist_items`
--
ALTER TABLE `sponsored_playlist_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stream_stats`
--
ALTER TABLE `stream_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `track_collaborations`
--
ALTER TABLE `track_collaborations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_agreements`
--
ALTER TABLE `user_agreements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_collections`
--
ALTER TABLE `user_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_credits`
--
ALTER TABLE `user_credits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_offline_downloads`
--
ALTER TABLE `user_offline_downloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_playlists`
--
ALTER TABLE `user_playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_subscription_plans`
--
ALTER TABLE `user_subscription_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visit_stats`
--
ALTER TABLE `visit_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad_impressions`
--
ALTER TABLE `ad_impressions`
  ADD CONSTRAINT `fk_ad_impressions_ad` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ad_impressions_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_ad_impressions_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_ad_impressions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ad_revenue_shares`
--
ALTER TABLE `ad_revenue_shares`
  ADD CONSTRAINT `fk_ad_revenue_shares_ad` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_ad_revenue_shares_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artist_agreements`
--
ALTER TABLE `artist_agreements`
  ADD CONSTRAINT `fk_artist_agreements_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_artist_agreements_document` FOREIGN KEY (`document_id`) REFERENCES `legal_documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artist_analytics`
--
ALTER TABLE `artist_analytics`
  ADD CONSTRAINT `fk_artist_analytics_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_artist_analytics_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `artist_earnings`
--
ALTER TABLE `artist_earnings`
  ADD CONSTRAINT `fk_artist_earnings_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_artist_earnings_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_artist_earnings_stream` FOREIGN KEY (`stream_id`) REFERENCES `stream_stats` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `artist_followers`
--
ALTER TABLE `artist_followers`
  ADD CONSTRAINT `fk_artist_followers_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_artist_followers_follower` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artist_musics`
--
ALTER TABLE `artist_musics`
  ADD CONSTRAINT `driver_id_fk` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artist_payment_details`
--
ALTER TABLE `artist_payment_details`
  ADD CONSTRAINT `fk_artist_payment_details_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_artist_payment_details_verified_by` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `artist_performance`
--
ALTER TABLE `artist_performance`
  ADD CONSTRAINT `fk_artist_performance_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artist_profiles`
--
ALTER TABLE `artist_profiles`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `artist_qa_sessions`
--
ALTER TABLE `artist_qa_sessions`
  ADD CONSTRAINT `fk_qa_sessions_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artist_subscriptions`
--
ALTER TABLE `artist_subscriptions`
  ADD CONSTRAINT `fk_artist_subscriptions_plan` FOREIGN KEY (`artist_subscription_plan_id`) REFERENCES `artist_subscription_plans` (`id`),
  ADD CONSTRAINT `fk_artist_subscriptions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artist_tier_assignments`
--
ALTER TABLE `artist_tier_assignments`
  ADD CONSTRAINT `fk_artist_tier_assignments_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_artist_tier_assignments_tier` FOREIGN KEY (`tier_id`) REFERENCES `artist_tiers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artist_tips`
--
ALTER TABLE `artist_tips`
  ADD CONSTRAINT `fk_artist_tips_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_artist_tips_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artist_wallets`
--
ALTER TABLE `artist_wallets`
  ADD CONSTRAINT `fk_artist_wallets_user` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audience_demographics`
--
ALTER TABLE `audience_demographics`
  ADD CONSTRAINT `fk_audience_demographics_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_audience_demographics_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `brand_collaborations`
--
ALTER TABLE `brand_collaborations`
  ADD CONSTRAINT `fk_brand_collaborations_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_brand_collaborations_partnership` FOREIGN KEY (`brand_partnership_id`) REFERENCES `brand_partnerships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `brand_partnerships`
--
ALTER TABLE `brand_partnerships`
  ADD CONSTRAINT `fk_brand_partnerships_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `collaboration_requests`
--
ALTER TABLE `collaboration_requests`
  ADD CONSTRAINT `fk_collaboration_requests_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_collaboration_requests_item` FOREIGN KEY (`item_id`) REFERENCES `marketplace_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_collaboration_requests_requester` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collaboration_revenue_distributions`
--
ALTER TABLE `collaboration_revenue_distributions`
  ADD CONSTRAINT `fk_collaboration_revenue_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_collaboration_revenue_collaboration` FOREIGN KEY (`collaboration_id`) REFERENCES `track_collaborations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_collaboration_revenue_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD CONSTRAINT `company_settings_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `credit_redemptions`
--
ALTER TABLE `credit_redemptions`
  ADD CONSTRAINT `fk_credit_redemptions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `credit_transactions`
--
ALTER TABLE `credit_transactions`
  ADD CONSTRAINT `fk_credit_transactions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_versions`
--
ALTER TABLE `document_versions`
  ADD CONSTRAINT `fk_document_versions_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_document_versions_document` FOREIGN KEY (`document_id`) REFERENCES `legal_documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `download_stats`
--
ALTER TABLE `download_stats`
  ADD CONSTRAINT `fk_download_stats_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_download_stats_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_download_stats_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `exclusive_previews`
--
ALTER TABLE `exclusive_previews`
  ADD CONSTRAINT `fk_exclusive_previews_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_exclusive_previews_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `gift_subscriptions`
--
ALTER TABLE `gift_subscriptions`
  ADD CONSTRAINT `fk_gift_subscriptions_gifter` FOREIGN KEY (`gifter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_gift_subscriptions_plan` FOREIGN KEY (`subscription_plan_id`) REFERENCES `user_subscription_plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_gift_subscriptions_recipient` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marketplace_items`
--
ALTER TABLE `marketplace_items`
  ADD CONSTRAINT `fk_marketplace_items_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marketplace_purchases`
--
ALTER TABLE `marketplace_purchases`
  ADD CONSTRAINT `fk_marketplace_purchases_buyer` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_marketplace_purchases_item` FOREIGN KEY (`item_id`) REFERENCES `marketplace_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_marketplace_purchases_seller` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marketplace_reviews`
--
ALTER TABLE `marketplace_reviews`
  ADD CONSTRAINT `fk_marketplace_reviews_buyer` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_marketplace_reviews_item` FOREIGN KEY (`item_id`) REFERENCES `marketplace_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_marketplace_reviews_purchase` FOREIGN KEY (`purchase_id`) REFERENCES `marketplace_purchases` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `monthly_plays`
--
ALTER TABLE `monthly_plays`
  ADD CONSTRAINT `fk_monthlyplays_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_monthlyplays_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD CONSTRAINT `fk_notification_logs_template` FOREIGN KEY (`template_id`) REFERENCES `notification_templates` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_notification_logs_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_preferences`
--
ALTER TABLE `notification_preferences`
  ADD CONSTRAINT `fk_notification_preferences_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD CONSTRAINT `fk_notification_templates_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ownership_splits`
--
ALTER TABLE `ownership_splits`
  ADD CONSTRAINT `fk_ownership_splits_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ownership_splits_collaboration` FOREIGN KEY (`collaboration_id`) REFERENCES `track_collaborations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payout_history`
--
ALTER TABLE `payout_history`
  ADD CONSTRAINT `fk_payout_history_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payout_history_request` FOREIGN KEY (`payout_request_id`) REFERENCES `payout_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payout_requests`
--
ALTER TABLE `payout_requests`
  ADD CONSTRAINT `fk_payout_requests_approved_by` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_payout_requests_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payout_requests_rejected_by` FOREIGN KEY (`rejected_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pending_agreement_notifications`
--
ALTER TABLE `pending_agreement_notifications`
  ADD CONSTRAINT `fk_pending_agreements_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pending_agreements_document` FOREIGN KEY (`document_id`) REFERENCES `legal_documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pending_agreements_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `preview_access_logs`
--
ALTER TABLE `preview_access_logs`
  ADD CONSTRAINT `fk_preview_access_logs_preview` FOREIGN KEY (`preview_id`) REFERENCES `exclusive_previews` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_preview_access_logs_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qa_questions`
--
ALTER TABLE `qa_questions`
  ADD CONSTRAINT `fk_qa_questions_session` FOREIGN KEY (`qa_session_id`) REFERENCES `artist_qa_sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_qa_questions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `fk_referrals_referred` FOREIGN KEY (`referred_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_referrals_referrer` FOREIGN KEY (`referrer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `royalty_calculations`
--
ALTER TABLE `royalty_calculations`
  ADD CONSTRAINT `fk_royalty_calculations_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sponsored_playlists`
--
ALTER TABLE `sponsored_playlists`
  ADD CONSTRAINT `fk_sponsored_playlists_curator` FOREIGN KEY (`curator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_sponsored_playlists_partnership` FOREIGN KEY (`brand_partnership_id`) REFERENCES `brand_partnerships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sponsored_playlist_items`
--
ALTER TABLE `sponsored_playlist_items`
  ADD CONSTRAINT `fk_sponsored_playlist_items_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sponsored_playlist_items_playlist` FOREIGN KEY (`playlist_id`) REFERENCES `sponsored_playlists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stream_stats`
--
ALTER TABLE `stream_stats`
  ADD CONSTRAINT `fk_stream_stats_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_stream_stats_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_stream_stats_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD CONSTRAINT `system_settings_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `system_settings_timezone_id_foreign` FOREIGN KEY (`timezone_id`) REFERENCES `timezones` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `track_collaborations`
--
ALTER TABLE `track_collaborations`
  ADD CONSTRAINT `fk_track_collaborations_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_track_collaborations_primary_artist` FOREIGN KEY (`primary_artist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD CONSTRAINT `fk_transaction_history_artist` FOREIGN KEY (`artist_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_transaction_history_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_subscription_fk` FOREIGN KEY (`usersubscription_id`) REFERENCES `user_subscription_plans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_agreements`
--
ALTER TABLE `user_agreements`
  ADD CONSTRAINT `fk_user_agreements_document` FOREIGN KEY (`document_id`) REFERENCES `legal_documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_agreements_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_credits`
--
ALTER TABLE `user_credits`
  ADD CONSTRAINT `fk_user_credits_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_offline_downloads`
--
ALTER TABLE `user_offline_downloads`
  ADD CONSTRAINT `fk_user_offline_downloads_music` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_offline_downloads_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_playlists`
--
ALTER TABLE `user_playlists`
  ADD CONSTRAINT `user_playlists_music_id_foreign` FOREIGN KEY (`music_id`) REFERENCES `artist_musics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_playlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
