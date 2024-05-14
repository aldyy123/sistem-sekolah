-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2023 pada 10.29
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_smart_school`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activities`
--

CREATE TABLE `activities` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_results`
--

CREATE TABLE `activity_results` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  `answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`answers`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `contents`
--

CREATE TABLE `contents` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `estimation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `content_result`
--

CREATE TABLE `content_result` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `grade` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`id`, `description`, `subject_id`, `created_by`, `created_at`, `updated_at`, `grade`) VALUES
('1b4fb5b2-75e3-300f-8036-3b6597eff50e', 'Umum', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'b19fbbc5-df47-3e6c-9479-b9843fb0e774', '2023-03-03 02:25:58', '2023-03-03 02:25:58', 11),
('1cd82b75-e3c0-3320-8267-ab3c48f71b24', 'Bisnis', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'b19fbbc5-df47-3e6c-9479-b9843fb0e774', '2023-03-03 02:25:57', '2023-03-03 02:25:57', 12),
('2f0498ec-0ad4-3967-8b14-2ff2df470e49', 'Bisnis', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'b19fbbc5-df47-3e6c-9479-b9843fb0e774', '2023-03-03 02:25:58', '2023-03-03 02:25:58', 11),
('a457e2a8-2f2f-30f9-8ee5-e8cb48ab09bb', 'IT', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'b19fbbc5-df47-3e6c-9479-b9843fb0e774', '2023-03-03 02:25:57', '2023-03-03 02:25:57', 12),
('b2e58a07-330b-37e9-92af-453a66fbe8c0', 'Umum', '233f8430-283f-38ec-853c-11b8304ae95d', 'b19fbbc5-df47-3e6c-9479-b9843fb0e774', '2023-03-03 02:25:57', '2023-03-03 02:25:57', 11),
('d379bfbd-99f7-3d07-a333-6c7ca655872f', 'IT', '233f8430-283f-38ec-853c-11b8304ae95d', 'b19fbbc5-df47-3e6c-9479-b9843fb0e774', '2023-03-03 02:25:56', '2023-03-03 02:25:56', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `experiences`
--

CREATE TABLE `experiences` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_point` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `school_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `experiences`
--

INSERT INTO `experiences` (`id`, `user_id`, `experience_point`, `level`, `created_at`, `updated_at`, `school_id`, `grade`) VALUES
('e4880a0b-a528-4b92-924d-bb647e54dff5', 'f743e94b-3a5c-39ac-8b1d-c2942ac267e7', 0, 0, NULL, NULL, '68e4098c-3923-3641-82fa-203ad9ee862d', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2021_11_25_041339_create_schools_table', 1),
(3, '2021_11_25_041419_create_users_table', 1),
(4, '2021_11_25_041430_create_subjects_table', 1),
(5, '2021_11_25_041443_create_subject_teachers_table', 1),
(6, '2021_11_28_115639_create_courses_table', 1),
(7, '2021_11_28_120315_create_topics_table', 1),
(8, '2021_11_28_120559_create_contents_table', 1),
(9, '2021_11_28_120733_create_activities_table', 1),
(10, '2021_11_28_120852_create_questions_table', 1),
(11, '2021_11_29_122433_alter_users_table', 1),
(12, '2021_11_29_122444_alter_courses_table', 1),
(13, '2021_12_03_034446_create_content_result_table', 1),
(14, '2021_12_03_034924_create_activity_results_table', 1),
(15, '2021_12_04_032623_alter_activities_table', 1),
(16, '2021_12_05_022829_create_experiences_table', 1),
(17, '2021_12_05_022928_alter_contents_table', 1),
(18, '2021_12_05_023022_add_xp_to_activities', 1),
(19, '2021_12_05_030327_alter_content_table_make_content_nullable', 1),
(20, '2021_12_08_015846_create_notif_table', 1),
(21, '2021_12_09_122628_add_school_id_to_experiences', 1),
(22, '2021_12_11_042754_add_is_send_to_notif', 1),
(23, '2021_12_11_133705_alter_table_questions', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notif`
--

CREATE TABLE `notif` (
  `student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_send` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choices` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`choices`)),
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `explanation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `schools`
--

CREATE TABLE `schools` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `schools`
--

INSERT INTO `schools` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
('04609376-1b54-35de-a022-24d36c941f1c', 'Barton-Hartmann', '822 Gwen Underpass\nAudreannefort, TX 55622', '2023-03-03 02:25:49', '2023-03-03 02:25:49'),
('14e0c0a2-f9e1-341c-a7e4-ed9566014f82', 'Weissnat, Hyatt and Turner', '14975 Pearlie Knoll\nLake Khalid, WV 13767', '2023-03-03 02:25:56', '2023-03-03 02:25:56'),
('15013eec-09f4-3ce5-bcb6-d2edb367dca1', 'Bogisich, Zulauf and Jast', '224 Huel Mews\nLake Hilma, ND 27348', '2023-03-03 02:25:51', '2023-03-03 02:25:51'),
('260f95f6-e1d5-3bd9-8e0d-8cab06d2bcab', 'Robel Inc', '84475 Marianna Islands Suite 174\nTayabury, WA 07512', '2023-03-03 02:25:48', '2023-03-03 02:25:48'),
('4b2fa7b3-bbb4-3a09-b577-563ad83204fc', 'Hilpert-McGlynn', '914 Heidenreich Roads\nMikeltown, OH 72840-5512', '2023-03-03 02:25:50', '2023-03-03 02:25:50'),
('60cf332d-e701-3405-901e-34280bb43462', 'Harris, Williamson and Johnston', '499 Rudolph Garden Apt. 835\nBoylechester, MO 05524', '2023-03-03 02:25:51', '2023-03-03 02:25:51'),
('623014b5-5a07-3e39-a10d-eb2c766021ee', 'Smitham-Emard', '644 Kariane Forks\nAgustinaton, CA 61364-9787', '2023-03-03 02:25:52', '2023-03-03 02:25:52'),
('68e4098c-3923-3641-82fa-203ad9ee862d', 'SMK Indonesia', '698 Gleason Viaduct\nWest Sedrick, NV 39467-3857', '2023-03-03 02:25:44', '2023-03-03 02:25:44'),
('70d016f7-f4e5-31b1-8e65-705158e839f2', 'Erdman-Flatley', '41698 McCullough Greens\nNew Filomena, FL 98246', '2023-03-03 02:25:55', '2023-03-03 02:25:55'),
('75c8a95e-faa0-3aeb-a560-2b84dbfb1e38', 'Lang-Schuster', '45219 Bogisich Manor\nTimmothyhaven, CT 49606', '2023-03-03 02:25:51', '2023-03-03 02:25:51'),
('8d245d85-bd10-3d4d-8987-aa3aa6c64cad', 'Gusikowski Group', '678 Roberts Gateway\nAndreanneland, CA 57830', '2023-03-03 02:25:45', '2023-03-03 02:25:45'),
('920a3409-5f15-34a3-a360-32ffb34a64a6', 'Towne-Stiedemann', '2002 Reyes Expressway Apt. 370\nEast Nicholaus, ID 80769-0047', '2023-03-03 02:25:53', '2023-03-03 02:25:53'),
('96351e22-fb69-37e7-9a01-bba1131ec29f', 'Wolff LLC', '88129 Quitzon Squares Suite 659\nFeestton, OR 35770', '2023-03-03 02:25:52', '2023-03-03 02:25:52'),
('c6411c6e-cf93-3225-8515-17c58249b652', 'Cronin Group', '89932 Feeney Road Apt. 085\nJakubowskifurt, MO 69423-1573', '2023-03-03 02:25:46', '2023-03-03 02:25:46'),
('c9cd7eb4-0f4a-3f2d-a849-35330caa9c0c', 'Sauer-Kilback', '799 Lang Tunnel\nStehrbury, OH 67348-8210', '2023-03-03 02:25:54', '2023-03-03 02:25:54'),
('cb0d11f8-e4af-3367-b32f-46fb712f10e9', 'Goyette, Schmidt and Weimann', '275 Mann Roads\nSouth Alfview, PA 18605', '2023-03-03 02:25:49', '2023-03-03 02:25:49'),
('d6f8db15-d684-33dd-a964-3884815e0687', 'Terry-Runolfsson', '105 Janice Trail Suite 105\nVenaburgh, NM 50090', '2023-03-03 02:25:48', '2023-03-03 02:25:48'),
('e1328f8e-d762-34e8-8c58-987152597d49', 'Kozey-Kihn', '372 Nolan Inlet Apt. 298\nElisabethstad, AL 30973-4598', '2023-03-03 02:25:55', '2023-03-03 02:25:55'),
('e26a4733-2b25-331b-a4ab-398a3eda30e9', 'Kulas-Crona', '64544 Simonis Parkway\nRolfsonmouth, MA 50811-6042', '2023-03-03 02:25:45', '2023-03-03 02:25:45'),
('e7344746-1091-3fb9-a460-5a9c38b07715', 'Lindgren LLC', '4883 Cassin Prairie\nLake Carlee, FL 85068-0220', '2023-03-03 02:25:48', '2023-03-03 02:25:48'),
('f3b1a8ba-1791-3c39-a33f-41d913b3fae7', 'Littel-Halvorson', '630 Cordia Pass Apt. 991\nSouth Milofurt, MA 71437', '2023-03-03 02:25:54', '2023-03-03 02:25:54'),
('f64bde5a-3ce0-38e7-b6df-9b7d68d5baf1', 'Berge-Tremblay', '455 Douglas Route\nEast Joeyfurt, WA 69166', '2023-03-03 02:25:53', '2023-03-03 02:25:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subjects`
--

CREATE TABLE `subjects` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `subjects`
--

INSERT INTO `subjects` (`id`, `school_id`, `name`, `created_at`, `updated_at`) VALUES
('233f8430-283f-38ec-853c-11b8304ae95d', '68e4098c-3923-3641-82fa-203ad9ee862d', 'Bahasa Indonesia', '2023-03-03 02:25:48', '2023-03-03 02:25:48'),
('5139cdc5-e258-3b5b-98d3-5a07b015fb3e', '68e4098c-3923-3641-82fa-203ad9ee862d', 'Bahasa Sunda', '2023-03-03 02:25:54', '2023-03-03 02:25:54'),
('6b7d241d-2349-3abf-90cb-07e71e2bb043', '68e4098c-3923-3641-82fa-203ad9ee862d', 'Matematika', '2023-03-03 02:25:51', '2023-03-03 02:25:51'),
('7adde7b1-9334-3442-834b-271952fec153', 'c9cd7eb4-0f4a-3f2d-a849-35330caa9c0c', 'Aqua', '2023-03-03 02:25:54', '2023-03-03 02:25:54'),
('cf54ec8f-706e-3bad-aa8c-78ffeb107b76', '60cf332d-e701-3405-901e-34280bb43462', 'MediumBlue', '2023-03-03 02:25:51', '2023-03-03 02:25:51'),
('fd0c6703-091f-3e36-830a-7127d9b2782f', '260f95f6-e1d5-3bd9-8e0d-8cab06d2bcab', 'DarkSlateBlue', '2023-03-03 02:25:49', '2023-03-03 02:25:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subject_teachers`
--

CREATE TABLE `subject_teachers` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teachers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`teachers`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `subject_teachers`
--

INSERT INTO `subject_teachers` (`id`, `subject_id`, `teachers`, `created_at`, `updated_at`) VALUES
('4c880dc7-c214-35c4-8b59-8c5284b806ad', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', '[\"b19fbbc5-df47-3e6c-9479-b9843fb0e774\"]', '2023-03-03 02:25:56', '2023-03-03 02:25:56'),
('53c9d648-d403-3e0b-b690-ed582e56c3a1', '6b7d241d-2349-3abf-90cb-07e71e2bb043', '[\"b19fbbc5-df47-3e6c-9479-b9843fb0e774\"]', '2023-03-03 02:25:53', '2023-03-03 02:25:53'),
('8fef9063-4fff-3969-bbff-5929dee74c8b', '233f8430-283f-38ec-853c-11b8304ae95d', '[\"b19fbbc5-df47-3e6c-9479-b9843fb0e774\"]', '2023-03-03 02:25:50', '2023-03-03 02:25:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `topics`
--

CREATE TABLE `topics` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `topics`
--

INSERT INTO `topics` (`id`, `course_id`, `subject_id`, `name`, `order`, `created_at`, `updated_at`) VALUES
('00abeb93-a5f0-3270-8be3-fd9d7b903d6d', '2f0498ec-0ad4-3967-8b14-2ff2df470e49', '233f8430-283f-38ec-853c-11b8304ae95d', 'Destiney Graham DDS', 16, '2023-03-03 02:26:01', '2023-03-03 02:26:01'),
('055dc95a-2e19-3f19-9f75-2dadb97dfd90', 'b2e58a07-330b-37e9-92af-453a66fbe8c0', '233f8430-283f-38ec-853c-11b8304ae95d', 'Torrey McDermott', 17, '2023-03-03 02:26:01', '2023-03-03 02:26:01'),
('061df387-dde2-319d-b5a2-c8a976496636', '1b4fb5b2-75e3-300f-8036-3b6597eff50e', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Jaclyn Prosacco', 9, '2023-03-03 02:26:08', '2023-03-03 02:26:08'),
('1e4ee969-36ac-3127-9783-376c7564b169', '1cd82b75-e3c0-3320-8267-ab3c48f71b24', '233f8430-283f-38ec-853c-11b8304ae95d', 'Julianne Homenick', 16, '2023-03-03 02:26:00', '2023-03-03 02:26:00'),
('1f640e46-ddd0-3582-831d-06ea8a793521', 'd379bfbd-99f7-3d07-a333-6c7ca655872f', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Hermann Will', 14, '2023-03-03 02:26:02', '2023-03-03 02:26:02'),
('2244ab93-1f9a-3086-aaf7-bb26e1b85b95', '1b4fb5b2-75e3-300f-8036-3b6597eff50e', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Jessika Hand', 16, '2023-03-03 02:26:05', '2023-03-03 02:26:05'),
('25704bcf-9dae-3245-80c5-3e0ea3825236', '1cd82b75-e3c0-3320-8267-ab3c48f71b24', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Mr. Joesph Bashirian DDS', 4, '2023-03-03 02:26:04', '2023-03-03 02:26:04'),
('2874c211-94f5-322f-96fa-ccc849a77259', '2f0498ec-0ad4-3967-8b14-2ff2df470e49', '233f8430-283f-38ec-853c-11b8304ae95d', 'Trever Rolfson', 4, '2023-03-03 02:26:01', '2023-03-03 02:26:01'),
('2eae91cf-b793-39cf-8ffc-ab4a2c0c3112', 'b2e58a07-330b-37e9-92af-453a66fbe8c0', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Dr. Jackson Ratke', 15, '2023-03-03 02:26:05', '2023-03-03 02:26:05'),
('37e9e42a-3ce6-371f-bbd5-431516d0dd39', '2f0498ec-0ad4-3967-8b14-2ff2df470e49', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Mrs. Brittany Bartoletti', 11, '2023-03-03 02:26:08', '2023-03-03 02:26:08'),
('3af77271-9541-3fc7-8560-b8695d233938', 'd379bfbd-99f7-3d07-a333-6c7ca655872f', '233f8430-283f-38ec-853c-11b8304ae95d', 'Dion Mann', 9, '2023-03-03 02:25:58', '2023-03-03 02:25:58'),
('43e616a9-cfcd-321b-a4bb-69a1c3cee2ba', 'a457e2a8-2f2f-30f9-8ee5-e8cb48ab09bb', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Shanie Dooley DDS', 7, '2023-03-03 02:26:03', '2023-03-03 02:26:03'),
('44d0aaf4-de1c-35b4-8f5e-5dbd0c270357', 'a457e2a8-2f2f-30f9-8ee5-e8cb48ab09bb', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Isac Kunze', 6, '2023-03-03 02:26:02', '2023-03-03 02:26:02'),
('460190f9-7758-3eea-9af6-4bf5d37d0fcb', 'b2e58a07-330b-37e9-92af-453a66fbe8c0', '233f8430-283f-38ec-853c-11b8304ae95d', 'Adrienne Walter', 20, '2023-03-03 02:26:01', '2023-03-03 02:26:01'),
('475af5ee-15d3-3a9e-96c4-baf5623be853', 'b2e58a07-330b-37e9-92af-453a66fbe8c0', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Mrs. Meredith Mann Jr.', 6, '2023-03-03 02:26:07', '2023-03-03 02:26:07'),
('4f29ade1-e840-3e1d-8fdf-a36b23b56db8', '2f0498ec-0ad4-3967-8b14-2ff2df470e49', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Marge Hermiston', 10, '2023-03-03 02:26:08', '2023-03-03 02:26:08'),
('51c203e5-4732-3194-bbeb-146ad1eaea65', 'a457e2a8-2f2f-30f9-8ee5-e8cb48ab09bb', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Natalia Wilderman', 13, '2023-03-03 02:26:03', '2023-03-03 02:26:03'),
('54f2a2df-724b-3a36-8f1d-1aea29c01afe', 'd379bfbd-99f7-3d07-a333-6c7ca655872f', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Joy Rice Sr.', 6, '2023-03-03 02:26:05', '2023-03-03 02:26:05'),
('58903f7f-1e73-3787-9653-4f531eb75d51', '1b4fb5b2-75e3-300f-8036-3b6597eff50e', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Annabel Kunde', 7, '2023-03-03 02:26:05', '2023-03-03 02:26:05'),
('5cff5f64-3c9f-30bc-804b-874090d26805', 'a457e2a8-2f2f-30f9-8ee5-e8cb48ab09bb', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Kariane Lesch', 10, '2023-03-03 02:26:06', '2023-03-03 02:26:06'),
('5d5d56cc-d455-379c-9bf1-67f7f4b95cb0', 'a457e2a8-2f2f-30f9-8ee5-e8cb48ab09bb', '233f8430-283f-38ec-853c-11b8304ae95d', 'Mr. Chelsey Willms', 5, '2023-03-03 02:25:59', '2023-03-03 02:25:59'),
('613c2b25-e3a7-3454-8754-56c3887cc7b3', '1b4fb5b2-75e3-300f-8036-3b6597eff50e', '233f8430-283f-38ec-853c-11b8304ae95d', 'Roslyn Bosco', 3, '2023-03-03 02:26:02', '2023-03-03 02:26:02'),
('657c2e87-7d3b-3c41-91ec-c3beadfc753f', 'd379bfbd-99f7-3d07-a333-6c7ca655872f', '233f8430-283f-38ec-853c-11b8304ae95d', 'Dr. Nadia Gorczany', 18, '2023-03-03 02:25:59', '2023-03-03 02:25:59'),
('67ef7c88-ed20-380f-a9dc-1d8af14ad3a4', 'b2e58a07-330b-37e9-92af-453a66fbe8c0', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Mrs. Evelyn Schinner', 20, '2023-03-03 02:26:04', '2023-03-03 02:26:04'),
('6806c536-d420-3b27-84ed-3dfad2590860', 'd379bfbd-99f7-3d07-a333-6c7ca655872f', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Laila Graham', 1, '2023-03-03 02:26:02', '2023-03-03 02:26:02'),
('6a8cd650-76d1-3662-bb43-bb29bf512f9f', '1b4fb5b2-75e3-300f-8036-3b6597eff50e', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Dr. Mireya Daniel III', 15, '2023-03-03 02:26:05', '2023-03-03 02:26:05'),
('6fe46997-9fd7-313d-965c-d1e4bb55e599', '1cd82b75-e3c0-3320-8267-ab3c48f71b24', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Dr. Aron Gaylord DDS', 7, '2023-03-03 02:26:03', '2023-03-03 02:26:03'),
('70a5af33-33b1-38d1-8aaa-766dbfd58aec', 'a457e2a8-2f2f-30f9-8ee5-e8cb48ab09bb', '233f8430-283f-38ec-853c-11b8304ae95d', 'Eli Cole DDS', 1, '2023-03-03 02:25:59', '2023-03-03 02:25:59'),
('7507877a-9cd3-3a04-9556-2758f60b005a', '1cd82b75-e3c0-3320-8267-ab3c48f71b24', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Filomena Marquardt', 18, '2023-03-03 02:26:06', '2023-03-03 02:26:06'),
('76d02ff8-385a-3c67-bdaf-00e236c00369', '1cd82b75-e3c0-3320-8267-ab3c48f71b24', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Verna Collier', 2, '2023-03-03 02:26:07', '2023-03-03 02:26:07'),
('79f13939-8ad3-3c24-8e40-4f29ec4163ca', 'a457e2a8-2f2f-30f9-8ee5-e8cb48ab09bb', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Oren Zboncak', 4, '2023-03-03 02:26:06', '2023-03-03 02:26:06'),
('81684e8e-f6d2-3984-8311-b92a10c7aa6a', '2f0498ec-0ad4-3967-8b14-2ff2df470e49', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Virginia Pfeffer', 18, '2023-03-03 02:26:08', '2023-03-03 02:26:08'),
('8ab5be94-b395-35d3-a272-99d3fb9ab76d', 'b2e58a07-330b-37e9-92af-453a66fbe8c0', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Mrs. Kirstin Parker I', 10, '2023-03-03 02:26:07', '2023-03-03 02:26:07'),
('8b932816-e6cc-39cb-b37d-177137d15a38', 'a457e2a8-2f2f-30f9-8ee5-e8cb48ab09bb', '233f8430-283f-38ec-853c-11b8304ae95d', 'Velda Rice', 4, '2023-03-03 02:25:59', '2023-03-03 02:25:59'),
('918217bc-6b69-3e20-862e-3057efca39ee', '1cd82b75-e3c0-3320-8267-ab3c48f71b24', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Chyna Ortiz DVM', 1, '2023-03-03 02:26:06', '2023-03-03 02:26:06'),
('9a723395-6f36-3d9c-a151-95ad1b76a187', 'd379bfbd-99f7-3d07-a333-6c7ca655872f', '233f8430-283f-38ec-853c-11b8304ae95d', 'Joyce Corwin', 4, '2023-03-03 02:25:59', '2023-03-03 02:25:59'),
('9f971e0a-f072-3bca-baf6-e17a874cd595', 'b2e58a07-330b-37e9-92af-453a66fbe8c0', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Bonnie Jakubowski', 20, '2023-03-03 02:26:04', '2023-03-03 02:26:04'),
('a57317ee-df5a-3f34-9b33-71b365ff8110', '2f0498ec-0ad4-3967-8b14-2ff2df470e49', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Dr. Gustave Wuckert II', 13, '2023-03-03 02:26:05', '2023-03-03 02:26:05'),
('a8192acd-3b2d-3600-8bed-2f08d26ea58d', 'd379bfbd-99f7-3d07-a333-6c7ca655872f', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Jayce Jerde', 14, '2023-03-03 02:26:05', '2023-03-03 02:26:05'),
('a8d3bace-a2c6-3ec8-acf4-5b616a6533d5', '1cd82b75-e3c0-3320-8267-ab3c48f71b24', '233f8430-283f-38ec-853c-11b8304ae95d', 'Michel O\'Conner DVM', 15, '2023-03-03 02:26:00', '2023-03-03 02:26:00'),
('afeadbdb-1950-375d-99ab-c3ea7240561c', 'a457e2a8-2f2f-30f9-8ee5-e8cb48ab09bb', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Blanca Kulas DVM', 13, '2023-03-03 02:26:06', '2023-03-03 02:26:06'),
('b06ee0dd-01ce-3ee2-922e-336fd0ada6e5', '1b4fb5b2-75e3-300f-8036-3b6597eff50e', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Arvilla O\'Hara', 19, '2023-03-03 02:26:08', '2023-03-03 02:26:08'),
('bb54665a-09a6-3de0-a637-5bab7489bf5b', '1cd82b75-e3c0-3320-8267-ab3c48f71b24', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Graham Bode', 6, '2023-03-03 02:26:04', '2023-03-03 02:26:04'),
('bebc54af-661e-3acb-9531-cfaf16e6ea87', '1b4fb5b2-75e3-300f-8036-3b6597eff50e', '233f8430-283f-38ec-853c-11b8304ae95d', 'Jared Keebler PhD', 7, '2023-03-03 02:26:02', '2023-03-03 02:26:02'),
('c120ec6f-34db-3512-b463-a90936cb5b5b', '1b4fb5b2-75e3-300f-8036-3b6597eff50e', '233f8430-283f-38ec-853c-11b8304ae95d', 'Jakob Kunze', 5, '2023-03-03 02:26:02', '2023-03-03 02:26:02'),
('c1ff6565-a059-3114-b3d2-412a8cd6db1b', 'b2e58a07-330b-37e9-92af-453a66fbe8c0', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Prof. Karlee Wisoky', 12, '2023-03-03 02:26:07', '2023-03-03 02:26:07'),
('c205d026-68a2-3a88-abd0-1e295a5ddf8e', '1b4fb5b2-75e3-300f-8036-3b6597eff50e', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Alanis Stehr', 19, '2023-03-03 02:26:08', '2023-03-03 02:26:08'),
('ca7ed5b7-2db3-3939-b1d8-15645d7f77d3', '2f0498ec-0ad4-3967-8b14-2ff2df470e49', '233f8430-283f-38ec-853c-11b8304ae95d', 'Silas Grady', 13, '2023-03-03 02:26:01', '2023-03-03 02:26:01'),
('d6bae842-413c-33f1-a8de-1f7fb7040fc6', 'd379bfbd-99f7-3d07-a333-6c7ca655872f', '5139cdc5-e258-3b5b-98d3-5a07b015fb3e', 'Daniella Franecki', 19, '2023-03-03 02:26:05', '2023-03-03 02:26:05'),
('df8137c9-8d76-3adc-9430-eb64461e0626', '2f0498ec-0ad4-3967-8b14-2ff2df470e49', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Simone Zulauf V', 3, '2023-03-03 02:26:05', '2023-03-03 02:26:05'),
('f19dfc03-f8e7-3dc0-87dd-b5aa783c732a', 'd379bfbd-99f7-3d07-a333-6c7ca655872f', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Dr. Valentine Ruecker V', 10, '2023-03-03 02:26:02', '2023-03-03 02:26:02'),
('f5380b2e-7ee4-33be-9df6-82108c2a3154', 'b2e58a07-330b-37e9-92af-453a66fbe8c0', '233f8430-283f-38ec-853c-11b8304ae95d', 'John Zboncak', 11, '2023-03-03 02:26:00', '2023-03-03 02:26:00'),
('fa6a5383-f53c-3820-9472-71711fe5017e', '2f0498ec-0ad4-3967-8b14-2ff2df470e49', '6b7d241d-2349-3abf-90cb-07e71e2bb043', 'Gino Ondricka', 7, '2023-03-03 02:26:05', '2023-03-03 02:26:05'),
('fd1e109f-6e5d-3ea4-8fc1-bec0ab022d45', '1cd82b75-e3c0-3320-8267-ab3c48f71b24', '233f8430-283f-38ec-853c-11b8304ae95d', 'Sigmund Cormier', 20, '2023-03-03 02:26:00', '2023-03-03 02:26:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `grade` tinyint(3) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `school_id`, `name`, `username`, `password`, `role`, `status`, `email`, `nis`, `created_at`, `updated_at`, `grade`, `remember_token`) VALUES
('19cc5be6-cc0a-30a9-9a64-9e51dc64cff6', '75c8a95e-faa0-3aeb-a560-2b84dbfb1e38', 'Bernard', 'Bernard446', '$2y$10$BE7u4hx9alV.QsnY4l8CgOqD/GD7P15Z7ES0oYUhD39g64QwqzCbS', 'TEACHER', 1, 'cartwright.gertrude@schowalter.biz', NULL, '2023-03-03 02:25:52', '2023-03-03 02:25:52', 12, NULL),
('24a663d2-88b2-39fb-9900-d582b8ae3bef', '75c8a95e-faa0-3aeb-a560-2b84dbfb1e38', 'Cheyanne', 'Cheyanne590', '$2y$10$5Nsyc6i./9lHDKAWGh6fq.RzOhQXjaqQg8zX1Yy74KZZQlfHdyPqW', 'STUDENT', 1, 'annette.schamberger@beier.com', NULL, '2023-03-03 02:25:53', '2023-03-03 02:25:53', 12, NULL),
('382c2efb-cbd5-37bc-a21b-d8aa89708650', 'f3b1a8ba-1791-3c39-a33f-41d913b3fae7', 'Mitchel', 'Mitchel713', '$2y$10$QkJOsMQPfSWa/Ytk.ttueuYD1ICxJTwNKg0o2Xy2F05N9DiJ3ADuy', 'TEACHER', 1, 'katrine.smith@mclaughlin.info', NULL, '2023-03-03 02:25:55', '2023-03-03 02:25:55', 12, NULL),
('3a8eb109-1fbe-3a58-a211-31ad484efd5a', 'd6f8db15-d684-33dd-a964-3884815e0687', 'Elisa', 'Elisa765', '$2y$10$xIPeICjX6AuG3eqasavRuOkFYYC6K6oB44hHFSx3//40i0In5gyyi', 'STUDENT', 1, 'kaylee84@heller.com', NULL, '2023-03-03 02:25:50', '2023-03-03 02:25:50', 12, NULL),
('69cbbc9a-75cd-3e4b-a864-bd4a4438a46d', '75c8a95e-faa0-3aeb-a560-2b84dbfb1e38', 'Douglas', 'Douglas996', '$2y$10$T1GdT94Drkt6KoT7uACSZOJ63AK.1vqNBj4U4sGfKUOMkNS6P0t/S', 'STUDENT', 1, 'julius.rippin@gmail.com', NULL, '2023-03-03 02:25:53', '2023-03-03 02:25:53', 12, NULL),
('986e2465-384b-38e4-a9fc-7f9e4645fa0c', 'f3b1a8ba-1791-3c39-a33f-41d913b3fae7', 'Orie', 'Orie774', '$2y$10$VHQq6Ag5kNNYwRvzpKbUQu4qoajMa9zkU4XcueqUD2m2F6kEf7mra', 'STUDENT', 1, 'ndooley@ledner.info', NULL, '2023-03-03 02:25:55', '2023-03-03 02:25:55', 12, NULL),
('a8831554-5e60-3dcc-adf4-b49b65593be1', 'f3b1a8ba-1791-3c39-a33f-41d913b3fae7', 'Astrid', 'Astrid491', '$2y$10$DMNiNsOqtvdwGcJWQcCXRuaJnWDMjrkik2H31GMj3DM/GJ4wkGrWO', 'TEACHER', 1, 'geoffrey.yundt@swaniawski.org', NULL, '2023-03-03 02:25:56', '2023-03-03 02:25:56', 12, NULL),
('b19fbbc5-df47-3e6c-9479-b9843fb0e774', '68e4098c-3923-3641-82fa-203ad9ee862d', 'teacheruser', 'teacherlearnify123', '$2y$10$tmXoG257VjyZhHClJj5jhOmYhlX9eI.sucfhGZSYGQI8QTHZVUdgy', 'TEACHER', 1, 'elizabeth.zulauf@hickle.com', NULL, '2023-03-03 02:25:46', '2023-03-03 02:25:46', 12, NULL),
('cb6e5c69-dd5f-30db-82ad-75071c8901ac', 'd6f8db15-d684-33dd-a964-3884815e0687', 'Francis', 'Francis202', '$2y$10$d1sUK1XFFg9MiwDszF9O4.e288kRhZsM6yNfGPjt.pCF/c1OkeiMa', 'STUDENT', 1, 'evan.klein@hotmail.com', NULL, '2023-03-03 02:25:49', '2023-03-03 02:25:49', 12, NULL),
('cc0b5b7e-4cae-394c-aba3-ea83ba130940', 'd6f8db15-d684-33dd-a964-3884815e0687', 'Lera', 'Lera642', '$2y$10$0Xfnd15kzWlm/nBrtGcfNO5LXIp1fY7Y5p2TQCfqSlqsqxjucl31G', 'TEACHER', 1, 'yadira.bailey@monahan.net', NULL, '2023-03-03 02:25:50', '2023-03-03 02:25:50', 12, NULL),
('f743e94b-3a5c-39ac-8b1d-c2942ac267e7', '68e4098c-3923-3641-82fa-203ad9ee862d', 'studentuser', 'studentlearnify123', '$2y$10$fDhhHbtN2/a3jwgk27AtL.4XqsEYTnz3iPqflsUu7q3pHeUKuS7DW', 'STUDENT', 1, 'sbrown@hotmail.com', NULL, '2023-03-03 02:25:46', '2023-03-03 02:25:46', 12, NULL),
('fe06578f-0ad6-30c1-97b9-4d365a652d36', '68e4098c-3923-3641-82fa-203ad9ee862d', 'adminuser', 'adminlearnify123', '$2y$10$T4phhZuLuaPyUDuZeTqq8u4eMR/0.pP1pOd3KryqnaEJ5Tx6b.Xai', 'ADMIN', 1, 'kaleigh63@bergstrom.com', NULL, '2023-03-03 02:25:45', '2023-03-03 02:25:45', 12, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_topic_id_index` (`topic_id`);

--
-- Indeks untuk tabel `activity_results`
--
ALTER TABLE `activity_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_results_activity_id_index` (`activity_id`),
  ADD KEY `activity_results_student_id_index` (`student_id`);

--
-- Indeks untuk tabel `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contents_topic_id_index` (`topic_id`);

--
-- Indeks untuk tabel `content_result`
--
ALTER TABLE `content_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_result_content_id_index` (`content_id`),
  ADD KEY `content_result_student_id_index` (`student_id`);

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_subject_id_index` (`subject_id`);

--
-- Indeks untuk tabel `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiences_user_id_index` (`user_id`),
  ADD KEY `experiences_school_id_index` (`school_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_activity_id_index` (`activity_id`);

--
-- Indeks untuk tabel `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_school_id_index` (`school_id`);

--
-- Indeks untuk tabel `subject_teachers`
--
ALTER TABLE `subject_teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_teachers_subject_id_index` (`subject_id`);

--
-- Indeks untuk tabel `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topics_course_id_index` (`course_id`),
  ADD KEY `topics_subject_id_index` (`subject_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_school_id_index` (`school_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
