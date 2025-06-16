-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2024 at 10:30 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charity`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debutante_memberships`
--

CREATE TABLE `debutante_memberships` (
  `id` bigint UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `age` int DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` int DEFAULT NULL,
  `is_approve` tinyint(1) DEFAULT '0',
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `debutante_memberships`
--

INSERT INTO `debutante_memberships` (`id`, `fname`, `lname`, `dob`, `age`, `address`, `city`, `state`, `zip`, `telephone`, `email`, `balance`, `is_approve`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'omar', 'bb', '1994-03-01', 29, 'gg', 'hh', 'ii', 'jj', '(588) 888-8888', 'ofarid27@gmail.com', 100, 1, 1, '2024-01-23 10:51:01', '2024-01-23 10:52:34');

-- --------------------------------------------------------

--
-- Table structure for table `debutante_membership_info`
--

CREATE TABLE `debutante_membership_info` (
  `id` bigint UNSIGNED NOT NULL,
  `debutante_membership_id` bigint UNSIGNED NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attend_or_graduate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attending_college_now` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_gpa` double(8,2) NOT NULL,
  `why_debutante` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `have_escort_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `philosophy_of_life` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `how_learn_debutante_program` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_of_striker` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature_name_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `debutante_membership_info`
--

INSERT INTO `debutante_membership_info` (`id`, `debutante_membership_id`, `father_name`, `mother_name`, `attend_or_graduate`, `attending_college_now`, `current_gpa`, `why_debutante`, `have_escort_details`, `philosophy_of_life`, `how_learn_debutante_program`, `program_category`, `name_of_striker`, `signature_name_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'kk', 'll', 'mm', 'mm', 2.69, 'm', 'n', 'iioo', 'df', 'Political', 'dfd', 'dfsf', '2024-01-23 10:51:01', '2024-01-23 10:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `is_read`, `status`, `created_at`, `updated_at`) VALUES
(1, 'President', 0, 1, NULL, NULL),
(2, 'Vice President', 0, 1, NULL, NULL),
(3, 'Recording Secretary', 0, 1, NULL, NULL),
(4, 'Financial Secretary', 0, 1, NULL, NULL),
(5, 'Corresponding Secretary', 0, 1, NULL, NULL),
(6, 'Treasurer', 0, 1, NULL, NULL),
(7, 'Business Manager', 0, 1, NULL, NULL),
(8, 'Member At Large', 0, 1, NULL, NULL),
(9, 'Member', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hero_sliders`
--

CREATE TABLE `hero_sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_back_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn_text` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_sliders`
--

INSERT INTO `hero_sliders` (`id`, `image`, `title`, `details`, `call_back_url`, `btn_text`, `is_read`, `status`, `created_at`, `updated_at`) VALUES
(1, 'h1_hero1.jpg', 'Strickers Club, Incorporated', '<P data-animation=\"fadeInUp\" data-delay=\".4s\">Serving our community since 1933</P>', 'contact', 'Contact Us', 0, 1, NULL, NULL),
(2, 'h1_hero2.jpg', 'Civic Activities', '<p data-animation=\"fadeInUp\" data-delay=\".2s\" style=\"margin-bottom:2%;font-weight:0;padding:2px !important;line-height: 1.0 !important;\">Joining the NAACP in 1934 to support an anti-lynch law</p>\n                <p data-animation=\"fadeInUp\"data-delay=\".2s\" style=\"margin-bottom:2%;font-weight:0;padding:2px !important;line-height: 1.0 !important;\">Donating a bus for mentally challenged children</p>\n                <p data-animation=\"fadeInUp\" data-delay=\".2s\" style=\"margin-bottom:5%;font-weight:0;padding:2px !important;line-height: 1.0 !important;\">Sponsoring the Ebony fashion show</p>', 'debutante.program', 'Debutante Program', 0, 1, NULL, NULL),
(3, 'h1_hero3.jpg', 'Debutante Program', '<P data-animation=\"fadeInUp\" data-delay=\".4s\" style=\"margin-bottom:5%;font-weight:0;padding:2px !important;line-height: 1.0 !important;\">The Debutante / Escort program is the PRIDE of <br>the Strikers Club, Inc.</P>', 'debutante.application', 'Debutante Application', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `age` int DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(2,2) DEFAULT NULL,
  `marital` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religious_affiliation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobbies` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_affiliations` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_desire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_striker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approve` tinyint(1) DEFAULT '0',
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_id`, `fname`, `lname`, `dob`, `age`, `address`, `city`, `state`, `zip`, `telephone`, `email`, `balance`, `marital`, `spouse`, `spouse_dob`, `educational_background`, `occupation`, `religious_affiliation`, `hobbies`, `other_affiliations`, `why_desire`, `name_of_striker`, `signature_date`, `is_approve`, `is_read`, `created_at`, `updated_at`) VALUES
(3, NULL, 'Solte', 'Polte', '1994-03-01', 29, 'Tabgail', 'Gopalpur', 'Modhupur Votto', '1209', '(666) 666-6666', 'mehediarif.du@gmail.com', NULL, 'Married', 'Mousumi Akter', '1994-10-27', 'BBS', 'INU', 'Hiindus', 'Codimg, Traveling, Gardening, Cahppor', 'Abdul batenna', 'Kala babu', 'Md. Arif Mehedi', 'Md. Arif Mehedi  Kala Baba 01-24-1993', 0, 1, '2024-01-27 11:47:05', '2024-01-27 11:51:36'),
(4, NULL, 'aa aa', 'bb bb', '1994-03-01', 29, 'cc cc', 'dd dd', 'ee ee', 'ff ff', 'ii ii', 'gg@gmail.com', NULL, 'Married', 'jj jj', '1994-06-09', 'kk kk', 'll ll', 'mm mm', 'nn nn', 'oo  oo', 'pp pp', 'qq qq', 'ss ss', 0, 0, '2024-01-27 13:15:55', '2024-01-27 14:25:03'),
(5, NULL, 'hh', 'jj', '1994-03-01', 29, 'kk', 'll', 'mm', 'nn', 'oo', 'kk@gmail.com', NULL, 'Married', 'pp', '1999-03-06', 'qq', 'rr', 'ss', 'tt', 'uu', 'vv', 'ww', 'xx', 1, 0, '2024-01-27 13:26:54', '2024-01-27 16:15:36'),
(6, NULL, 'zz', 'xx', '1995-01-03', 29, 'yy', 'vv', 'pp', 'qq', 'ss', 'rrf@gmail.com', NULL, 'Married', 'tt', '1999-06-09', 'uu', 'vv', 'www', 'xxx', 'yyy', 'zzz', 'aaa', 'bbb', 1, 0, '2024-01-27 13:30:20', '2024-01-27 16:05:21'),
(7, NULL, 'yyyy aa', 'xxxx bb', '2000-07-09', 23, 'zzzz cc', 'aaaa dd', 'bbbb ee', 'cccc ff', 'dddd gg', 'ddddaa@mail.com', 0.00, 'Married', 'eeee hh', '2002-12-12', 'ffff ii', 'gggg jj', 'hhhh kk', 'iiii ll', 'jjjj mm', 'kkkk nn', 'llll oo', 'mmmm pp', 1, 1, '2024-01-27 13:33:01', '2024-01-27 16:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_12_30_151434_create_site_controllers_table', 1),
(7, '2024_01_01_092800_create_events_table', 1),
(8, '2024_01_05_161626_create_contacts_table', 1),
(9, '2024_01_06_161455_create_debutante_memberships_table', 1),
(10, '2024_01_06_161833_create_debutante_membership_info_table', 1),
(11, '2024_01_10_161434_create_notifications_table', 1),
(12, '2024_01_10_185645_create_promoted_members_table', 1),
(13, '2024_01_14_223625_create_gallery_table', 1),
(14, '2024_01_14_233559_create_hero_sliders_table', 1),
(15, '2024_01_18_202323_create_designations_table', 1),
(16, '2024_01_27_083401_create_member_table', 2),
(19, '2024_01_27_083401_create_members_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `category` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non-communication',
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `admin_call_back_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_is_read` tinyint(1) NOT NULL DEFAULT '0',
  `member_call_back_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `category`, `title`, `message`, `user_id`, `admin_call_back_url`, `admin_is_read`, `member_call_back_url`, `member_is_read`, `created_at`, `updated_at`) VALUES
(1, 'Debutante-application', 'Debutante Applicant Recieved', 'ofarid27@gmail.com', -1, 'admin.debutante.index', 0, NULL, 0, '2024-01-23 10:51:04', '2024-01-23 10:51:04'),
(2, 'member-application', 'Member updated Recieved', 'gg@gmail.com', -1, 'admin.member.index', 0, NULL, 0, '2024-01-27 14:27:36', '2024-01-27 14:27:36'),
(3, 'member-application', 'Member updated Recieved', 'rrf@gmail.com', -1, 'admin.member.index', 0, NULL, 0, '2024-01-27 14:30:06', '2024-01-27 14:30:06'),
(4, 'member-application', 'Member updated Recieved', 'ddddaa@mail.com', -1, 'admin.member.index', 0, NULL, 0, '2024-01-27 14:31:34', '2024-01-27 14:31:34');

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promoted_members`
--

CREATE TABLE `promoted_members` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Active 1, Inactive 0',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_controllers`
--

CREATE TABLE `site_controllers` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_balance` double DEFAULT NULL,
  `due_balance` double DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Active 1, Inactive 0',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `email_verified_at`, `password`, `role`, `remember_token`, `designation`, `total_balance`, `due_balance`, `type`, `status`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@mail.com', NULL, NULL, '$2y$12$8885f5Y2imlzuIuYUJ7SP.pf.3Bc7yMUdlwS3l51YyqMKL5nfLX4y', 1, NULL, 'Admin', NULL, NULL, '100', 1, 1, NULL, NULL),
(2, 'Omar Farid', 'ofarid27@gmail.com', NULL, NULL, '$2y$12$eO8SoH54kMVZt86mGQgWsuGEU2aGLQPRvWnnfHXme7bW3OcKCcUt.', 1, NULL, 'Developer', NULL, NULL, '100', 1, 1, NULL, NULL),
(3, 'Marif Akter', 'marif@gmail.com', NULL, NULL, '$2y$12$V/iw30dUGGfQTpJFbrx6Kew9YmuP5RFpf.S7.yr9RkwsCRELoyW1i', 0, NULL, 'Member', NULL, NULL, '100', 1, 1, NULL, NULL),
(4, 'Anthony Harper', 'anthonyharper@mail.com', 'Anthony-Harper.jpg', NULL, '$2y$12$doOjEvxAP0Eg04XSJQjleePJhUggXQTgY5lXVU0a4krw4x69otnmy', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(5, 'Antonio Darrington', 'antoniodarrington@mail.com', 'Antonio-Darrington.jpg', NULL, '$2y$12$L6w.FHVBbeeEKlBOIPhPcuAZ2624DV5duIUY.5HRmFA0ZBweAZ3YC', 1, NULL, 'Member At Large', NULL, NULL, '100', 1, 0, NULL, NULL),
(6, 'Carl Sykes', 'carlsykes@mail.com', NULL, NULL, '$2y$12$6tC22g38SMneXIOl5fH9zOFay4divmQz5zdx1U54wkpNxGeU1aw1a', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(7, 'Cartez Horton', 'cartezhorton@mail.com', 'Cartez-Horton.jpg', NULL, '$2y$12$QZjzPA6rIB3uk4COuP955ug5Eh7rhNYMNfRTBiHhdAnMMms3LPz4i', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(8, 'Charles James', 'charlesjames@mail.com', NULL, NULL, '$2y$12$/W20vV0bYEeBDQEmBDFI0.rHkUjuTo6eHiIMsdnTHEuan92TTARKO', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(9, 'Claude Bumpers', 'claudebumpers@mail.com', NULL, NULL, '$2y$12$iFls/odPLUoHYTewNalVge638CWTWYY5vTNmBQYQxsiGTF2i2uyc6', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(10, 'Darren Smith', 'darrensmith@mail.com', 'Darren-Smith.jpg', NULL, '$2y$12$BTr8KMMJuEqUuDFgBPHiOOMhNUqmJBix2dBK2PK6Nu4xM3tJd.vj2', 1, NULL, 'Treasurer', NULL, NULL, '100', 1, 1, NULL, '2024-01-23 10:41:05'),
(11, 'DeJuan Kidd', 'dejuankidd@mail.com', 'DeJuan-Kidd_0.jpg', NULL, '$2y$12$wtW3nlOJ5p/9u.rMopwXGep42KCWdtOz6TmhFPPwVP9VME7.r9cMO', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(12, 'DeMarcus Smith', 'demarcussmith@mail.com', 'DeMarcus-Smith_0.jpg', NULL, '$2y$12$P0wuf2L5Rr5dEN7OViLwxO9icvcskK/uJXLUXkFXDzyp8W4ROBxee', 1, NULL, 'Member At Large', NULL, NULL, '100', 1, 0, NULL, NULL),
(13, 'Edward Franklin', 'edwardfranklin@mail.com', 'Edward-Franklin.jpg', NULL, '$2y$12$k40pYmdMK5N.kaWFo29lE.qLcuibaXzxKzAyAcNSwHootyjES8OyK', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(14, 'Edward Sanderson', 'edwardsanderson@mail.com', 'Ed-Sanderson.jpg', NULL, '$2y$12$A0exnKn1lC/55IgNjmz8NOlfEe.kxBRLCQkxNWTvq.SmHGDNjazTW', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(15, 'Edward Thomas', 'edwardthomas@mail.com', 'Edward-Thomas.jpg', NULL, '$2y$12$KVpejOpQSY/R75AC.4Js7.i5zIrXToGgduJ9sLCGXEIEsbCS3Dtrm', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(16, 'Gabriel Peck', 'gabrielpeck@mail.com', 'Gabriel-Peck.JPG', NULL, '$2y$12$QaFRhr5igyqE/PPaPAf6cujIaEMseEVvixZiiivG/XF/.Kmqj89XS', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(17, 'Garrard Green', 'garrardgreen@mail.com', 'Garrard-Green.JPG', NULL, '$2y$12$7DW5kkdsSP1N4MM1T88YAOqkl8KzcTHA3MO8sHoGDXooe20BGkpCm', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(18, 'Hubert Campbell', 'hubertcampbell@mail.com', 'Hubert-Campbell.JPG', NULL, '$2y$12$ADsF1DN93t5MDCY.uLtmUOM/GjEbgxbYxVxNdpyLG6oQscoMBGgye', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(19, 'James Hunter', 'jameshunter@mail.com', NULL, NULL, '$2y$12$7RjKasSxE5g7oiYO91m/Ju0e9mIlhme0j/iOaEu2ahf.tpLJXc1ka', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(20, 'James Smith', 'jamessmith@mail.com', 'James-Smith.jpg', NULL, '$2y$12$3JIvE7TkT/AZIMDROdgBZeHKOUqI.ce4WMVpL6g.Uj8/LZU5lTa.C', 1, NULL, 'Financial Secretary', NULL, NULL, '100', 1, 0, NULL, NULL),
(21, 'James Watson', 'jameswatson@mail.com', 'James-Watson.jpg', NULL, '$2y$12$RYTduaDRfTdnlrj8iGN7luQRW1YBdjVfAlJTpRBLd0f5RH7mSZzAO', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(22, 'Jason Hackworth', 'jasonhackworth@gmail.com', NULL, NULL, '$2y$12$QpXTREmhsRLWVg1KXRJJPOV2//EMxLxXOjjjyRu9VLwezbIAgtuYy', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(23, 'Joseph Dennis Jr.', 'josephdennisjr@gmail.com', 'Joseph-Dennis-Jr_0.JPG', NULL, '$2y$12$W4ioV1vTnvGOI3b2pfRd2uwCItJzd.jMx2q.swOo3C1MpAMtq/Dd2', 1, NULL, 'Vice President', NULL, NULL, '100', 1, 0, NULL, NULL),
(24, 'Kenny Holder', 'kennyholder@mail.com', NULL, NULL, '$2y$12$vxAsJPFsu2Yu6JQ85hswlui.hVHZ6iAdj.Rc/3hfL6Ua0kNIaAcBC', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(25, 'Leonard Stewart', 'leonardstewart@mail.com', 'Leonard-stewart.JPG', NULL, '$2y$12$D7QwYJyzRl6PgmmgSmiVAevvJlcCs4gQDZUcIxv4eVohkc1z8L5BK', 1, NULL, 'President', NULL, NULL, '100', 1, 0, NULL, NULL),
(26, 'Lionel Smith', 'lionelsmith@mail.com', 'Lionel-Smith.JPG', NULL, '$2y$12$OW81tqhkzJZ5IuSyZF/jFeVa8TA0vzH3mvHUZIBPU55Gre76tIYM6', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(27, 'Lorenzo McKee', 'lorenzomckee@mail.com', 'Lorenzo-McKee.JPG', NULL, '$2y$12$Ra/Ow4Pz8cVyNlHsIBKNb.y0/Z.kufDX9Rmp5O/xBoEi2X6GYDYb.', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(28, 'Maurice Davis', 'mauricedavis@mail.com', NULL, NULL, '$2y$12$wc69uJ2gVBx1lqb5tsDLbedg3VeZgKLbwA/7nofN1v/GkWi5N5ZOW', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(29, 'Maurice Holt', 'mauriceholt@mail.com', 'Maurice-Holt.JPG', NULL, '$2y$12$sAxCJ7N6r1HR1/blL.zP4./868gk32.8/ZUY4fbgybEb0s2qqZy42', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(30, 'Reginald Crenshaw', 'reginaldcrenshaw@mail.com', 'Reginald-Crenshaw.JPG', NULL, '$2y$12$s3GlyuZJlRxTo5TwrcmwjetWpCD3xQGuBFd5FhoEyef9fqBaHV.py', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(31, 'Robert Bettis', 'robertbettis@mail.com', 'Robert-Bettis.jpg', NULL, '$2y$12$L6YtNZ0eW25/SXZg/mW9fugaTr9E6tp5ViH8iTghxvwOPGcRoI6fy', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(32, 'Robert Moore', 'robertmoore@mail.com', 'Robert-Moore.jpg', NULL, '$2y$12$hn/1MJWXcN1Vx6aRL3JLa.eRT1JgLRnFAOtGwOrYE2L9PgbJ10QMi', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(33, 'Rogery Perine', 'rogeryperine@mail.com', 'Rogery-Perine.jpg', NULL, '$2y$12$cpMEZ3N7dRwG5JdBc24Wt.g.8OXdB7ZpWtjDRWF9SJp68FRTWiN2G', 1, NULL, 'Business Manager', NULL, NULL, '100', 1, 0, NULL, NULL),
(34, 'Stephen Maynard', 'stephenmaynard@mail.com', 'Stephen-Maynard.jpg', NULL, '$2y$12$pRdpv5y.b01Ooe1b04aKn.wQigbxQEQpxljixS003Vw6K1D6O3te6', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(35, 'Terrell Washington', 'terrellwashington@mail.com', NULL, NULL, '$2y$12$3.WLikHspHzytAvdDhK2H.J9wQ336UYHSiGOBdQBDDhXffuAZ0JS.', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(36, 'Terry Foxx', 'terryfoxx@mail.com', NULL, NULL, '$2y$12$X0tblzgGPAjgFCcmUC7u/e.Qo5g.yCB1mWbbnoEOwBGGZGHysMaI.', 0, NULL, 'Member', NULL, NULL, '100', 1, 0, NULL, NULL),
(37, 'Tommie Perine', 'tommieperine@mail.com', 'James-Watson.jpg', NULL, '$2y$12$QQxXqozlmM.GFthxyIzQTOv30FU2on9w6MdSV/B/rfQwSbsKjtAB2', 0, NULL, 'Member', NULL, NULL, '100', 1, 1, NULL, '2024-01-22 15:24:21'),
(38, 'Tyrone Wiley', 'tyronewiley@mail.com', 'Tyrone-Wiley_0.JPG', NULL, '$2y$12$twwmdyzylnj7qyRR.sGxgeyMuEYO8WSTl9UW07gOZo9/pMaStDsNW', 1, NULL, 'Recording Secretary', NULL, NULL, '100', 1, 0, NULL, NULL),
(39, 'Xavier Poellnitz', 'xavierpoellnitz@mail.com', 'Xavier-Poellnitz.jpg', NULL, '$2y$12$fZZ469NAc8Bb1uXdWLTExeB0Bjw3pJ2xw5uBtnUit8hbC1PrjH3sq', 1, NULL, 'Corresponding Secretary', NULL, NULL, '100', 1, 1, NULL, '2024-01-22 15:15:24'),
(45, 'zz xx', 'rrf@gmail.com', NULL, NULL, '$2y$12$K5vIC3AdeW/97iPocT2jR.N7pUCCfqXYoPo/Cn1M9i5a0MDSyeTgy', 0, NULL, 'Member', 1000, NULL, 'Annually', 0, 0, '2024-01-27 16:05:21', '2024-01-27 16:05:21'),
(46, 'hh jj', 'kk@gmail.com', NULL, NULL, '$2y$12$AITVQa.mwkdwCNL/y4jEoeGnMhG2D.YVjZka/Jt0yaAvS7XoxF7UO', 0, NULL, 'Member', 100, 50, 'Annually', 0, 0, '2024-01-27 16:15:36', '2024-01-27 16:15:36'),
(47, 'yyyy aa xxxx bb', 'ddddaa@mail.com', NULL, NULL, '$2y$12$XkQfp3y1b9z2ODONFG10aOyYlL85NWivWLLXmeOdP2S0/7INoZMqW', 0, NULL, 'Member', NULL, NULL, 'Monthly', 0, 0, '2024-01-27 16:18:48', '2024-01-27 16:18:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debutante_memberships`
--
ALTER TABLE `debutante_memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debutante_membership_info`
--
ALTER TABLE `debutante_membership_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debutante_membership_info_debutante_membership_id_foreign` (`debutante_membership_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_sliders`
--
ALTER TABLE `hero_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `members_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `promoted_members`
--
ALTER TABLE `promoted_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promoted_members_user_id_foreign` (`user_id`);

--
-- Indexes for table `site_controllers`
--
ALTER TABLE `site_controllers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debutante_memberships`
--
ALTER TABLE `debutante_memberships`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `debutante_membership_info`
--
ALTER TABLE `debutante_membership_info`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hero_sliders`
--
ALTER TABLE `hero_sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promoted_members`
--
ALTER TABLE `promoted_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_controllers`
--
ALTER TABLE `site_controllers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `debutante_membership_info`
--
ALTER TABLE `debutante_membership_info`
  ADD CONSTRAINT `debutante_membership_info_debutante_membership_id_foreign` FOREIGN KEY (`debutante_membership_id`) REFERENCES `debutante_memberships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promoted_members`
--
ALTER TABLE `promoted_members`
  ADD CONSTRAINT `promoted_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
