-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2026 at 11:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pas`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-miguelito@hotmail.com|127.0.0.1', 'i:3;', 1769291823),
('laravel-cache-miguelito@hotmail.com|127.0.0.1:timer', 'i:1769291823;', 1769291823);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
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
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tarefas', '2026-01-24 20:01:03', '2026-01-24 20:01:03'),
(2, 1, 'Propinas', '2026-01-24 20:03:11', '2026-01-24 20:03:11'),
(3, 1, 'Hytale', '2026-01-24 21:53:07', '2026-01-24 21:53:07'),
(4, 1, 'Miguelito', '2026-01-24 22:03:25', '2026-01-24 22:03:25'),
(5, 1, 'dsadsad', '2026-01-25 00:48:24', '2026-01-25 00:48:24'),
(6, 1, 'boas', '2026-01-28 19:56:42', '2026-01-28 19:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_05_150739_create_personal_access_tokens_table', 1),
(5, '2025_11_05_151205_create_notes_table', 1),
(6, '2025_12_27_183233_add_is_admin_to_users_table', 1),
(7, '2026_01_24_191320_create_folders_table', 2),
(8, '2026_01_24_191853_add_folder_id_to_notes_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_pinned` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `folder_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `content`, `is_pinned`, `user_id`, `folder_id`, `created_at`, `updated_at`) VALUES
(1, 'ideias', 'Escrevi aqui a minha ideia', 1, 1, 1, '2026-01-15 17:14:40', '2026-01-24 21:52:04'),
(2, 'ideias', 'bazar f1', 0, 1, NULL, '2026-01-15 18:46:07', '2026-01-15 18:46:07'),
(3, 'Bora bora', 'nengue', 0, 2, NULL, '2026-01-15 19:01:15', '2026-01-15 19:01:15'),
(4, 'dsadsadsa', 'dsadsadsasda', 0, 1, NULL, '2026-01-15 20:49:10', '2026-01-15 20:49:10'),
(5, 'dasdsasadsad', 'sadsdasadads', 0, 1, NULL, '2026-01-15 20:49:13', '2026-01-15 20:49:13'),
(6, 'dfadaf', 'dfaafdsdafsadf', 0, 1, NULL, '2026-01-15 20:49:16', '2026-01-15 20:49:16'),
(7, 'dsasaddsa', 'sdadsaasddasdsa', 0, 1, NULL, '2026-01-15 20:49:20', '2026-01-15 20:49:20'),
(8, 'dsadsasadsda', 'sadsadsadasd', 0, 1, NULL, '2026-01-15 20:49:27', '2026-01-15 20:49:27'),
(9, 'fdasfdsafdsafads', 'afdsdafsadfsadfs', 0, 1, NULL, '2026-01-15 20:49:31', '2026-01-15 20:49:31'),
(10, 'sdfasadfsfdsafdas', 'dfsaafdsadfsfdas', 0, 1, NULL, '2026-01-15 20:49:37', '2026-01-15 20:49:37'),
(11, 'dfsadfasfdasadfsadfs', 'dfasadfsafdsfadsdafs', 0, 1, NULL, '2026-01-15 20:49:41', '2026-01-15 20:49:41'),
(12, 'fd', 'fd', 0, 1, NULL, '2026-01-15 20:49:44', '2026-01-15 20:49:44'),
(13, 'dsaxdx', 'adxsadxasjhjh', 1, 1, NULL, '2026-01-15 20:49:47', '2026-01-24 14:39:54'),
(14, 'dxsadxasdxas', 'xdsadxsaadsx', 0, 1, NULL, '2026-01-15 20:49:50', '2026-01-15 20:49:50'),
(15, 'xdsadxasdxas', 'dxasdxasdxasd', 0, 1, NULL, '2026-01-15 20:49:55', '2026-01-15 20:49:55'),
(16, 'gfbhgfghfhg', 'hgfghfgfhgfhhgf', 0, 1, NULL, '2026-01-15 20:49:59', '2026-01-15 20:49:59'),
(17, 'gfdfgfg', 'gffgfgfg', 0, 1, NULL, '2026-01-15 20:50:03', '2026-01-15 20:50:03'),
(18, 'abc', 'abc', 0, 1, NULL, '2026-01-15 20:50:14', '2026-01-15 20:50:14'),
(19, 'GFAAG', 'FAAG', 0, 1, NULL, '2026-01-15 20:51:07', '2026-01-15 20:51:07'),
(21, 'dsadsad', 'gdfsgfdg', 0, 1, NULL, '2026-01-15 21:12:20', '2026-01-15 21:12:20'),
(22, 'fdasfdsaf', 'fdasfdsafdsakkkkk', 1, 1, NULL, '2026-01-15 21:12:24', '2026-01-24 14:39:47'),
(23, 'dred', 'dededede', 0, 1, NULL, '2026-01-15 21:12:32', '2026-01-15 21:12:32'),
(24, 'Compras', 'Bolachas\r\nLeite\r\nChocolate', 0, 3, NULL, '2026-01-15 21:44:01', '2026-01-15 21:44:01'),
(25, 'Estudar', 'Matematica', 1, 3, NULL, '2026-01-15 21:44:26', '2026-01-15 21:44:26'),
(26, 'Compras', 'Pneusmmm', 0, 3, NULL, '2026-01-15 21:44:44', '2026-01-17 22:58:14'),
(27, 'Primeira nota via API', 'Esta nota foi criada através do Postman', 1, 7, NULL, '2026-01-15 23:57:09', '2026-01-15 23:57:09'),
(29, 'dfsafdsaasdfr', 'dsadsadsa', 0, 1, NULL, '2026-01-17 19:18:06', '2026-01-24 00:24:47'),
(30, 'Tarefas (To-Do List):', 'Ligar para o Dr. Silva (Manhã)\r\nFinalizar Relatório X\r\nComprar pão e leite\r\nReunião com Equipa (14h00)\r\nbambam\r\nbambam-\r\n#ratio\r\ntamos todos\r\nbacanos\r\naqui\r\ne voces', 1, 1, 2, '2026-01-17 22:19:55', '2026-01-28 19:19:26'),
(33, 'Nota via Postman', 'Teste', 0, 7, NULL, '2026-01-18 04:31:27', '2026-01-18 04:31:27'),
(34, 'Nota via Postman', 'Teste', 1, 7, NULL, '2026-01-18 04:33:48', '2026-01-18 04:33:48'),
(35, 'boas', 'Nova', 0, 1, NULL, '2026-01-19 19:45:59', '2026-01-19 23:13:11'),
(36, 'ola a todos', 'todos', 0, 1, NULL, '2026-01-19 19:47:19', '2026-01-19 19:47:19'),
(37, 'entao mekie', 'ta fixeee', 0, 1, NULL, '2026-01-19 19:52:45', '2026-01-19 21:54:33'),
(38, 'ffdsf', 'fdsfdfds', 0, 1, NULL, '2026-01-19 21:54:54', '2026-01-19 21:54:54'),
(39, 'boasboas', '123', 0, 1, 1, '2026-01-19 22:05:46', '2026-01-24 21:52:32'),
(40, 'boasboas', '321', 0, 1, 1, '2026-01-19 23:19:47', '2026-01-19 23:19:47'),
(44, 'eu sei qual ea  tua', 'a tua', 0, 1, NULL, '2026-01-23 18:30:08', '2026-01-23 18:30:08'),
(45, 'yepj', 'yepfdsfsdf', 0, 1, NULL, '2026-01-23 18:32:13', '2026-01-28 19:01:24'),
(50, 'golias', '1', 1, 1, 5, '2026-01-23 20:13:15', '2026-01-28 18:25:56'),
(54, 'bambam', '1234', 1, 1, 1, '2026-01-24 21:37:24', '2026-01-28 19:01:02'),
(55, '123', '1234', 1, 1, 1, '2026-01-24 21:41:10', '2026-01-28 19:01:34'),
(56, 'dsadsadsa', '123', 1, 1, 6, '2026-01-28 19:56:59', '2026-01-28 19:56:59');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
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
(1, 'App\\Models\\User', 7, 'android', '812795fd91affd9066cf2ec5c29cc6bc890189eb251b0255670ca45f5678d4f3', '[\"*\"]', NULL, NULL, '2026-01-15 23:23:19', '2026-01-15 23:23:19'),
(2, 'App\\Models\\User', 7, 'android', '579768465d366544ecae4c7a77379c1caa5dd823d9774458285e1cbcf1e42bc5', '[\"*\"]', '2026-01-15 23:57:09', NULL, '2026-01-15 23:53:46', '2026-01-15 23:57:09'),
(3, 'App\\Models\\User', 7, 'android', '64f77685fb4831f90664b201e13cc4ee612d65d6ce5f0a3ad6dbfe58af756d90', '[\"*\"]', NULL, NULL, '2026-01-18 03:31:45', '2026-01-18 03:31:45'),
(4, 'App\\Models\\User', 7, 'android', 'b183029d14dda42b7a4a182c7a1573c5c971908e15108703aa90c585673bdaee', '[\"*\"]', NULL, NULL, '2026-01-18 03:35:59', '2026-01-18 03:35:59'),
(5, 'App\\Models\\User', 7, 'android', '35c59ddb90945583fdabe0ebe4a92292621a90f23cc958262a46a827760de11a', '[\"*\"]', NULL, NULL, '2026-01-18 03:36:40', '2026-01-18 03:36:40'),
(6, 'App\\Models\\User', 7, 'android', '61376729b85a85bedc1792f0a87b8c6342ec4665c7ef0b0a1f2e2d6ab7688a43', '[\"*\"]', '2026-01-18 03:37:31', NULL, '2026-01-18 03:37:22', '2026-01-18 03:37:31'),
(7, 'App\\Models\\User', 7, 'android', 'c4d090fca251239e4755765fcb28af2de63c88275fd406bd0d209b0e2bbce854', '[\"*\"]', '2026-01-18 04:42:23', NULL, '2026-01-18 04:30:00', '2026-01-18 04:42:23'),
(8, 'App\\Models\\User', 7, 'android', '08668a95707386ba8ae2008689f57d7a4cffd19413c7ac910d45a0a31dd377b8', '[\"*\"]', '2026-01-19 18:48:51', NULL, '2026-01-19 00:49:43', '2026-01-19 18:48:51'),
(9, 'App\\Models\\User', 1, 'android', 'edc9632df5594a9bb8eaa28a20fa8b589513b1cc33bfb5941cc47b6adbb20045', '[\"*\"]', NULL, NULL, '2026-01-19 18:48:50', '2026-01-19 18:48:50'),
(10, 'App\\Models\\User', 1, 'android', 'a0dbd3266040a152edb2845393e791d54e1a813cfab97fbb547bfbc807c41c33', '[\"*\"]', '2026-01-19 18:53:19', NULL, '2026-01-19 18:53:18', '2026-01-19 18:53:19'),
(11, 'App\\Models\\User', 1, 'android', 'a2fb4865e47684346fea5f8f4cf6be37d222c652b94b798384a7d60cef408ce4', '[\"*\"]', '2026-01-19 19:22:13', NULL, '2026-01-19 19:22:12', '2026-01-19 19:22:13'),
(12, 'App\\Models\\User', 1, 'android', '2ff17810648dee0d2f06d397c1b0bfc3fdfa9ebd36ce7e3ea1eefa26c1a7a2bc', '[\"*\"]', '2026-01-19 19:42:03', NULL, '2026-01-19 19:42:03', '2026-01-19 19:42:03'),
(13, 'App\\Models\\User', 1, 'android', '8c9449344b90bc1872899e950579fc4fb477eed76bac8cde6212bb1d64ca47a1', '[\"*\"]', '2026-01-19 19:42:46', NULL, '2026-01-19 19:42:45', '2026-01-19 19:42:46'),
(14, 'App\\Models\\User', 1, 'android', 'e0133f7891ae45217139603204069037be97fc7f667aa0f58171d0d92791129b', '[\"*\"]', '2026-01-19 19:47:19', NULL, '2026-01-19 19:43:52', '2026-01-19 19:47:19'),
(15, 'App\\Models\\User', 1, 'android', '00ddcbd82f8f6c864b6dd2a195b280efd3705ace77895bf7f96e8ac128ff7496', '[\"*\"]', '2026-01-19 19:52:45', NULL, '2026-01-19 19:52:34', '2026-01-19 19:52:45'),
(16, 'App\\Models\\User', 1, 'android', '2170b2aca8941a5262aef85617bfd791f5a9df9499564eb7d7b6692f0a7c4230', '[\"*\"]', '2026-01-19 20:05:21', NULL, '2026-01-19 20:05:21', '2026-01-19 20:05:21'),
(17, 'App\\Models\\User', 1, 'android', '456c2046847341cb3e0ed8813ac595ee54d8da402a07efc14c5ab3bac7dad801', '[\"*\"]', '2026-01-19 20:44:37', NULL, '2026-01-19 20:44:34', '2026-01-19 20:44:37'),
(18, 'App\\Models\\User', 1, 'android', 'bd8955bf64feab126940d5e548fb36b96eb63784f9465e760ff6e7f1949b0654', '[\"*\"]', '2026-01-19 20:44:37', NULL, '2026-01-19 20:44:36', '2026-01-19 20:44:37'),
(19, 'App\\Models\\User', 1, 'android', 'bccb0437ac26b823523897495404f944d2bef4213749dd5ae629f666ee3419d6', '[\"*\"]', '2026-01-19 20:44:38', NULL, '2026-01-19 20:44:36', '2026-01-19 20:44:38'),
(20, 'App\\Models\\User', 1, 'android', 'fa36bdf6cbe8209acd17cf4803da4e4e3f5eac348e4ccd82149d21fd5daba6b3', '[\"*\"]', '2026-01-19 20:44:38', NULL, '2026-01-19 20:44:36', '2026-01-19 20:44:38'),
(21, 'App\\Models\\User', 1, 'android', '2590d832795f09a435f8e8a9977dc5115b8167442d5750646a91e5403caf53a8', '[\"*\"]', '2026-01-19 20:44:38', NULL, '2026-01-19 20:44:37', '2026-01-19 20:44:38'),
(22, 'App\\Models\\User', 1, 'android', 'd0871c6a64bf44d2f3d3f071e26a79e9770bcffb65d6974d313802416a3907f8', '[\"*\"]', '2026-01-19 20:46:09', NULL, '2026-01-19 20:46:09', '2026-01-19 20:46:09'),
(23, 'App\\Models\\User', 1, 'android', '8018f3d1697009d083f5148868d4e98eb602c5fed612f7b40218a1657dfbd9f1', '[\"*\"]', '2026-01-19 20:47:15', NULL, '2026-01-19 20:47:15', '2026-01-19 20:47:15'),
(24, 'App\\Models\\User', 1, 'android', '94a689b11752fe9f1e8c06fbdc69e9ddd226a6f355126793d1f99d67ecf86cea', '[\"*\"]', '2026-01-19 20:51:41', NULL, '2026-01-19 20:51:41', '2026-01-19 20:51:41'),
(25, 'App\\Models\\User', 1, 'android', '79850514da1502885171c765bf384a566fb48a5cbe8cf4865d8df237b0814d1f', '[\"*\"]', '2026-01-19 20:55:59', NULL, '2026-01-19 20:55:58', '2026-01-19 20:55:59'),
(26, 'App\\Models\\User', 1, 'android', '05cd86eff9e6bee5cea735f1e6ebced182bff289d57c9bb7be31748811033ffd', '[\"*\"]', '2026-01-19 20:57:26', NULL, '2026-01-19 20:57:26', '2026-01-19 20:57:26'),
(27, 'App\\Models\\User', 1, 'android', '210f175e0d82104d4ce66ee2fba5af275d1d1782ff382ae873f9a9df4bd08af9', '[\"*\"]', '2026-01-19 21:32:37', NULL, '2026-01-19 21:32:37', '2026-01-19 21:32:37'),
(28, 'App\\Models\\User', 1, 'android', '5ee26eed4c8b1b155947c6f9f36359d2ccc204982d8699b66d5e7632610a4461', '[\"*\"]', '2026-01-19 21:54:54', NULL, '2026-01-19 21:54:20', '2026-01-19 21:54:54'),
(29, 'App\\Models\\User', 1, 'android', 'a19dd080014ceb40cb3a1ae78ae55c37a0c33ca5dcc2e056f3051aa2a50541ea', '[\"*\"]', '2026-01-19 22:03:30', NULL, '2026-01-19 22:03:29', '2026-01-19 22:03:30'),
(30, 'App\\Models\\User', 1, 'android', '9dbf5e5c82872e075ad7d15fa0ff5f3fb142ce170b107bcfb36131fc8c8baf13', '[\"*\"]', NULL, NULL, '2026-01-19 22:05:20', '2026-01-19 22:05:20'),
(31, 'App\\Models\\User', 1, 'android', 'd09c92df4af41fd6c07046516f31bb3987267f0dcd6aef70f49069b79e42657d', '[\"*\"]', '2026-01-19 22:05:46', NULL, '2026-01-19 22:05:25', '2026-01-19 22:05:46'),
(32, 'App\\Models\\User', 1, 'android', '286eca750794a825348dcdf7dc90d34cf48abe66bc751a1aa449b74ac7bf2e34', '[\"*\"]', '2026-01-19 22:10:39', NULL, '2026-01-19 22:10:39', '2026-01-19 22:10:39'),
(33, 'App\\Models\\User', 1, 'android', 'b8ad7a105b04a99c02593b4c5d2cdf65df23a5a6b1e3ea24c165187747bee6c2', '[\"*\"]', '2026-01-19 22:11:41', NULL, '2026-01-19 22:11:41', '2026-01-19 22:11:41'),
(34, 'App\\Models\\User', 1, 'android', '3a20e014a30ef3107be9a0a4f95ab276309baab1e530a23956c4b5ffd3379d1b', '[\"*\"]', '2026-01-19 22:15:46', NULL, '2026-01-19 22:15:46', '2026-01-19 22:15:46'),
(35, 'App\\Models\\User', 1, 'android', '38df6bdaba511491f8d6d33c9c4ea3ef697bdaddbded79dd550c5f2ad78b960d', '[\"*\"]', '2026-01-19 22:18:38', NULL, '2026-01-19 22:18:06', '2026-01-19 22:18:38'),
(36, 'App\\Models\\User', 1, 'android', '277f7113024096c3a71908a57329c259a2c5c5d21529b5aa9653c49bfae62407', '[\"*\"]', '2026-01-19 22:29:45', NULL, '2026-01-19 22:29:44', '2026-01-19 22:29:45'),
(37, 'App\\Models\\User', 1, 'android', '93ca33fc226586bf84f5b779f7957d7b67524da83eb8526148564b40e0e346f2', '[\"*\"]', '2026-01-19 22:42:21', NULL, '2026-01-19 22:42:20', '2026-01-19 22:42:21'),
(38, 'App\\Models\\User', 1, 'android', '5a61ba6afdc5797b3a38dae1a22a9e3a2dd905099c07ad94b320abe21a4d4a59', '[\"*\"]', '2026-01-19 22:42:52', NULL, '2026-01-19 22:42:51', '2026-01-19 22:42:52'),
(39, 'App\\Models\\User', 1, 'android', '5039f018a4ff6809c3c888060e00d72cc6b4064fcebad11e19f7cd53943cb044', '[\"*\"]', '2026-01-19 22:43:18', NULL, '2026-01-19 22:43:17', '2026-01-19 22:43:18'),
(40, 'App\\Models\\User', 1, 'android', '4b54831764a50354886e1307c0b101a19f782f3c6971f55ec1f20636269319ad', '[\"*\"]', '2026-01-19 22:43:52', NULL, '2026-01-19 22:43:52', '2026-01-19 22:43:52'),
(41, 'App\\Models\\User', 1, 'android', '9430af1d291a5b33644a13651305fc0a20477710dda24c287e1eb7c8f64fe100', '[\"*\"]', '2026-01-19 22:59:31', NULL, '2026-01-19 22:59:30', '2026-01-19 22:59:31'),
(42, 'App\\Models\\User', 1, 'android', '8736301d63d6fba2db14d42af936648d1c9a593a7dd4caef375aeac6cd71ad80', '[\"*\"]', '2026-01-19 23:00:49', NULL, '2026-01-19 23:00:48', '2026-01-19 23:00:49'),
(43, 'App\\Models\\User', 1, 'android', '8d59b057df2ffc016bea7142f221547603dd03dc7fd704d5d893c67e1c0bbf6a', '[\"*\"]', '2026-01-19 23:06:45', NULL, '2026-01-19 23:06:45', '2026-01-19 23:06:45'),
(44, 'App\\Models\\User', 1, 'android', '5d94ae08a01f3fca343981fb1c0fd23cb6aaf800444eb5988c95c08b465618be', '[\"*\"]', '2026-01-19 23:07:57', NULL, '2026-01-19 23:07:57', '2026-01-19 23:07:57'),
(45, 'App\\Models\\User', 1, 'android', '82d7d9267d32b348a52301c739e3c52fa0ea9cd057157307001502d90d1058c5', '[\"*\"]', '2026-01-19 23:13:11', NULL, '2026-01-19 23:12:56', '2026-01-19 23:13:11'),
(46, 'App\\Models\\User', 1, 'android', '823b1ab0838da4c05ca15836d58c47de5f3efb5a739a5a375207f2a128ad4243', '[\"*\"]', '2026-01-19 23:22:12', NULL, '2026-01-19 23:19:08', '2026-01-19 23:22:12'),
(47, 'App\\Models\\User', 9, 'android', '727de54dff6d4f40da08d1b59f93f2bc0aafcb76e750dc41ed5eb94b21b717c7', '[\"*\"]', NULL, NULL, '2026-01-20 00:07:58', '2026-01-20 00:07:58'),
(48, 'App\\Models\\User', 9, 'android', '47c43abc1c22b143bedfbffb5a3988ae3b330a30cf4f4b2f3d70a85b1c2df403', '[\"*\"]', '2026-01-20 00:08:07', NULL, '2026-01-20 00:08:06', '2026-01-20 00:08:07'),
(49, 'App\\Models\\User', 1, 'android', 'ae403b9ecae4033640183fb548197ff9212a3965bf3e25595ca438d35c6da518', '[\"*\"]', '2026-01-23 17:40:45', NULL, '2026-01-23 17:40:44', '2026-01-23 17:40:45'),
(50, 'App\\Models\\User', 1, 'android', '0615479bbaa89d9bcb9758665b2b3c06636d46a8c615f47b45127c2df2cfd2cc', '[\"*\"]', '2026-01-23 21:52:48', NULL, '2026-01-23 21:52:47', '2026-01-23 21:52:48'),
(51, 'App\\Models\\User', 7, 'android', '47aef5141500f76360fd874a695668a0b211c0f7f6e20b1c0986314dc69b885d', '[\"*\"]', '2026-01-23 21:53:17', NULL, '2026-01-23 21:53:17', '2026-01-23 21:53:17'),
(52, 'App\\Models\\User', 1, 'android', 'd7092357c164f93cac30cea32224673dff11ae8cbaa550854d0430d2cecbf29d', '[\"*\"]', '2026-01-23 21:58:55', NULL, '2026-01-23 21:58:55', '2026-01-23 21:58:55'),
(53, 'App\\Models\\User', 1, 'android', 'f49207ac721c060e13373df787c40e049431b927cb98d3f39b4f053b8040bb8b', '[\"*\"]', '2026-01-23 22:02:22', NULL, '2026-01-23 22:02:22', '2026-01-23 22:02:22'),
(54, 'App\\Models\\User', 1, 'android', 'f5d523ecbb61e5ee7ed575510c9e65a6c75c345d64522ec9ab3d1f1dae9f6596', '[\"*\"]', '2026-01-23 22:09:32', NULL, '2026-01-23 22:06:56', '2026-01-23 22:09:32'),
(55, 'App\\Models\\User', 1, 'android', '8b401fd40cc0747437d1359bf9a4cfd9d1d4f7253f9859abaf9d9ea99f0ccf14', '[\"*\"]', '2026-01-23 22:12:50', NULL, '2026-01-23 22:12:49', '2026-01-23 22:12:50'),
(56, 'App\\Models\\User', 1, 'android', '43a2c8c4203cc4f2b7e43dff24e08350dc655ad1facf6f8b05fc3bbd1a6560a8', '[\"*\"]', '2026-01-23 22:32:31', NULL, '2026-01-23 22:32:31', '2026-01-23 22:32:31'),
(57, 'App\\Models\\User', 1, 'android', '085f4b4493d8a3a49ce5056810332aa6371816c7ae946e4ef74e6c849a447546', '[\"*\"]', '2026-01-23 22:34:51', NULL, '2026-01-23 22:34:51', '2026-01-23 22:34:51'),
(58, 'App\\Models\\User', 1, 'android', 'ee8d23e94def0fd0ec2d5f62489ee32740908f2d75a4972af904cccc4f29e773', '[\"*\"]', '2026-01-23 22:41:18', NULL, '2026-01-23 22:41:18', '2026-01-23 22:41:18'),
(59, 'App\\Models\\User', 1, 'android', '2c9e5cfc0afa1498c434859c9ea5959c840a6b2fbe46f19b7d20c5252dcafef2', '[\"*\"]', '2026-01-23 22:48:18', NULL, '2026-01-23 22:48:18', '2026-01-23 22:48:18'),
(60, 'App\\Models\\User', 1, 'android', 'fb18662e284eb56d3bf4724ca93112275907a35b2fd5457e0b51906591df0da4', '[\"*\"]', '2026-01-23 23:50:36', NULL, '2026-01-23 23:50:35', '2026-01-23 23:50:36'),
(61, 'App\\Models\\User', 1, 'android', 'ca705c28a00a451a4983e9c8aa9caae03ebd64af76c262b13cc5970c1b70c2bf', '[\"*\"]', '2026-01-23 23:54:18', NULL, '2026-01-23 23:54:17', '2026-01-23 23:54:18'),
(62, 'App\\Models\\User', 1, 'android', '20a83c63d5d60c473ee4fda651d0766b3331164be1be9e138082f6702b6ece74', '[\"*\"]', '2026-01-23 23:58:16', NULL, '2026-01-23 23:58:16', '2026-01-23 23:58:16'),
(63, 'App\\Models\\User', 1, 'android', '3e8d53d16b96c63424813ef529036ac43593d95b06ee99f13ef0c6cd06f147df', '[\"*\"]', '2026-01-24 00:01:39', NULL, '2026-01-24 00:01:39', '2026-01-24 00:01:39'),
(64, 'App\\Models\\User', 1, 'android', '05b56d4a66bfc66b23c04699811b459814915d9b307d0c8128b49fbfbb5e4115', '[\"*\"]', '2026-01-24 00:03:36', NULL, '2026-01-24 00:03:36', '2026-01-24 00:03:36'),
(65, 'App\\Models\\User', 1, 'android', '973a54c0045e90cb091d899059ecb8ad5d0ee9a9476509edf446148f73e90397', '[\"*\"]', '2026-01-24 00:05:07', NULL, '2026-01-24 00:05:07', '2026-01-24 00:05:07'),
(66, 'App\\Models\\User', 1, 'android', '6c287fad5971216416dc53d58904ce2c0017f8f1af343a65b17a783736b9c56a', '[\"*\"]', '2026-01-24 00:05:58', NULL, '2026-01-24 00:05:57', '2026-01-24 00:05:58'),
(67, 'App\\Models\\User', 1, 'android', '92ae3e2966c9007e0e4c24b74d94eed0ce759c4410bcdf1c4535fa23da959b66', '[\"*\"]', '2026-01-24 00:07:37', NULL, '2026-01-24 00:07:35', '2026-01-24 00:07:37'),
(68, 'App\\Models\\User', 1, 'android', '0854db19b90278b43dad7f84031bb6a00de61b949fa17f2ae27fb008c92e2089', '[\"*\"]', '2026-01-24 00:09:06', NULL, '2026-01-24 00:09:01', '2026-01-24 00:09:06'),
(69, 'App\\Models\\User', 1, 'android', 'fb85767e6dfcbe83b28d87adad4a4a3b2fb5bd5de335ea4f241084049e7d16eb', '[\"*\"]', '2026-01-24 00:14:25', NULL, '2026-01-24 00:14:24', '2026-01-24 00:14:25'),
(70, 'App\\Models\\User', 1, 'android', 'a7920c9635dbc947c4151ea3a2a59aacb997c6fa75097c40416c64de1405fad1', '[\"*\"]', '2026-01-24 00:19:52', NULL, '2026-01-24 00:19:51', '2026-01-24 00:19:52'),
(71, 'App\\Models\\User', 1, 'android', '0219b5823a628983f91f3a61f6d1e6795695916d236fc30b88cf1102e0eec6df', '[\"*\"]', '2026-01-24 00:22:18', NULL, '2026-01-24 00:21:54', '2026-01-24 00:22:18'),
(72, 'App\\Models\\User', 1, 'android', '773c4a943a817d8838f064ac282c263d3eec1c9ca5170c0d6b0f9a228973d807', '[\"*\"]', '2026-01-24 00:30:31', NULL, '2026-01-24 00:24:36', '2026-01-24 00:30:31'),
(73, 'App\\Models\\User', 1, 'android', 'ca9846d097f767fda87c87d0491c5a9de6eac4e521958ef9d654dd94cd4bb6a4', '[\"*\"]', '2026-01-24 00:32:26', NULL, '2026-01-24 00:32:25', '2026-01-24 00:32:26'),
(75, 'App\\Models\\User', 1, 'android', '263eedd2164a049b7260a4faac91d128de9c8d343656af8f85b70d5b5cf4a1c2', '[\"*\"]', '2026-01-24 00:36:07', NULL, '2026-01-24 00:36:00', '2026-01-24 00:36:07'),
(76, 'App\\Models\\User', 1, 'android', '383eb24f2862121e56e2b55f10c4b097d2b885b27e098639de5bd4fa1aa93690', '[\"*\"]', '2026-01-24 00:38:03', NULL, '2026-01-24 00:37:50', '2026-01-24 00:38:03'),
(77, 'App\\Models\\User', 1, 'android', 'b79aff3ad7eb0a93dbe851887e7c16992ba73c3a3dea9c96ec6eb2eecd5a2ef8', '[\"*\"]', '2026-01-24 16:16:32', NULL, '2026-01-24 16:16:25', '2026-01-24 16:16:32'),
(78, 'App\\Models\\User', 1, 'android', '983db545be0a7deba63df94abe71968c36a0b01b1a736450f6be1af8cda66d05', '[\"*\"]', '2026-01-24 21:41:11', NULL, '2026-01-24 21:41:03', '2026-01-24 21:41:11'),
(79, 'App\\Models\\User', 1, 'android', '2c5386799007a7c9abc1826bae652b506269120eb6c872a5358304ed5bce651e', '[\"*\"]', '2026-01-24 22:37:15', NULL, '2026-01-24 22:35:53', '2026-01-24 22:37:15'),
(80, 'App\\Models\\User', 1, 'android', '9a5ab7121e1cf267e2de812273e061e7075fc287c6cecc67ee8365e84c2caf57', '[\"*\"]', '2026-01-24 22:40:42', NULL, '2026-01-24 22:40:40', '2026-01-24 22:40:42'),
(81, 'App\\Models\\User', 1, 'android', 'e3eeda69f0811ceca071567736fde18a2fcca3d1649b4d6b58a42bc335e8562a', '[\"*\"]', '2026-01-24 23:00:46', NULL, '2026-01-24 23:00:42', '2026-01-24 23:00:46'),
(82, 'App\\Models\\User', 1, 'android', '467063900c794933146ff6d2b5b7db1cb3dfaff8989fa1f8e8e4d09a4d998b87', '[\"*\"]', '2026-01-24 23:14:40', NULL, '2026-01-24 23:14:27', '2026-01-24 23:14:40'),
(83, 'App\\Models\\User', 1, 'android', '1cc3efb95284d04c7943e092c4349a92edf74eb82adcc232186a6960980cf0e4', '[\"*\"]', '2026-01-24 23:24:45', NULL, '2026-01-24 23:23:36', '2026-01-24 23:24:45'),
(84, 'App\\Models\\User', 1, 'android', '55f544fdcf558722b27804e106fe132c0c972dfc4b7a4298c0b6240019219db3', '[\"*\"]', '2026-01-24 23:46:27', NULL, '2026-01-24 23:46:27', '2026-01-24 23:46:27'),
(85, 'App\\Models\\User', 1, 'android', '87bdddefe0f56b2a9fc6c2717dcd45e4050e29be884fc78de10454064ddd0144', '[\"*\"]', '2026-01-24 23:47:09', NULL, '2026-01-24 23:47:09', '2026-01-24 23:47:09'),
(86, 'App\\Models\\User', 1, 'android', '1211a15dd839ac6bdd4753d9769009cecaf1d845af6dbb4ab139101b3541805c', '[\"*\"]', '2026-01-24 23:47:23', NULL, '2026-01-24 23:47:23', '2026-01-24 23:47:23'),
(87, 'App\\Models\\User', 1, 'android', '56fdda4cf2183f5767d6a17cf749ef16a524f83435245d8b2f05f239caf64066', '[\"*\"]', '2026-01-25 00:02:52', NULL, '2026-01-25 00:02:36', '2026-01-25 00:02:52'),
(88, 'App\\Models\\User', 1, 'android', '26cca65ddb5cd22ee1b2182da0c698eaf48728365729d06e73c65d87e1c90199', '[\"*\"]', '2026-01-25 00:12:46', NULL, '2026-01-25 00:12:40', '2026-01-25 00:12:46'),
(89, 'App\\Models\\User', 1, 'android', 'ed9c94b57e4b4bc9ab997efc3f7dfb2431c66628e2716460b0d5600a4d886cd9', '[\"*\"]', '2026-01-25 00:16:18', NULL, '2026-01-25 00:15:26', '2026-01-25 00:16:18'),
(90, 'App\\Models\\User', 1, 'android', '273d053cff539970dd28cc357266fb1d8b2e37c2b77f4815c647ff0b5d595436', '[\"*\"]', '2026-01-25 00:36:10', NULL, '2026-01-25 00:36:08', '2026-01-25 00:36:10'),
(91, 'App\\Models\\User', 1, 'android', '4c27bd554407cc8fed0df5f1ad9c20681afa2df2532b07d8ec82d821063d85f6', '[\"*\"]', '2026-01-25 00:39:06', NULL, '2026-01-25 00:39:01', '2026-01-25 00:39:06'),
(92, 'App\\Models\\User', 1, 'android', '8c900d267047de64bea71422f78c25f508e46ebb8e54b12bd546bf3ec4c92eee', '[\"*\"]', '2026-01-25 00:40:39', NULL, '2026-01-25 00:40:20', '2026-01-25 00:40:39'),
(93, 'App\\Models\\User', 1, 'android', '812e183764d3bc8d071448b95e743e1581bd71fb34fd1016a3b0fa57d52bb8f7', '[\"*\"]', '2026-01-25 00:42:11', NULL, '2026-01-25 00:42:06', '2026-01-25 00:42:11'),
(94, 'App\\Models\\User', 1, 'android', '2748251652481d6de08e9453b7f77f1c7a4fdb50cb860d7e5215b12aa7a8f4d0', '[\"*\"]', '2026-01-25 00:45:58', NULL, '2026-01-25 00:45:51', '2026-01-25 00:45:58'),
(95, 'App\\Models\\User', 1, 'android', '339f9c8ce24891a761b977111069679bc432902d4d47ccf7e3090e0b5eea9f66', '[\"*\"]', '2026-01-25 00:48:28', NULL, '2026-01-25 00:48:16', '2026-01-25 00:48:28'),
(96, 'App\\Models\\User', 1, 'android', '1b3cb1b9380f79e4e3cf326c86f66b9a7ae0b1db619931119c7b1dd3107ff1d7', '[\"*\"]', '2026-01-28 17:49:41', NULL, '2026-01-28 17:49:17', '2026-01-28 17:49:41'),
(97, 'App\\Models\\User', 1, 'android', '493986ad458ee36357dedaafc4c6ddb3e55d7ca712b1630bb9426237d272ca5a', '[\"*\"]', '2026-01-28 17:53:09', NULL, '2026-01-28 17:52:50', '2026-01-28 17:53:09'),
(98, 'App\\Models\\User', 1, 'android', '7402a905d8470a152999d871b7d760105ed5cdfb1966b89f42c82f932112d810', '[\"*\"]', '2026-01-28 18:16:35', NULL, '2026-01-28 18:16:14', '2026-01-28 18:16:35'),
(99, 'App\\Models\\User', 1, 'android', 'c2c49bca849bde5e6dcec67ff9e196d113f9c9159088bbb9418aaf4d67fa14c9', '[\"*\"]', '2026-01-28 18:21:53', NULL, '2026-01-28 18:21:03', '2026-01-28 18:21:53'),
(100, 'App\\Models\\User', 1, 'android', 'f08867ee7a0b547e32e1c65eb23efaa23d759491c5aee4cc3f65b2056004db36', '[\"*\"]', '2026-01-28 18:23:09', NULL, '2026-01-28 18:23:01', '2026-01-28 18:23:09'),
(101, 'App\\Models\\User', 1, 'android', 'bdf1ef49d575de7141c6811dbeb7cbb1dbbbacf5db81c7c064fcd43d8c54e218', '[\"*\"]', '2026-01-28 18:29:33', NULL, '2026-01-28 18:25:38', '2026-01-28 18:29:33'),
(102, 'App\\Models\\User', 1, 'android', '1e7948a01f4420e76461d3d650d76f104ddbcb9fcdc94a0dcf7fe0afa790e6e0', '[\"*\"]', '2026-01-28 18:32:36', NULL, '2026-01-28 18:31:22', '2026-01-28 18:32:36'),
(103, 'App\\Models\\User', 1, 'android', '6a5b26ae4c4366411f3a959d7ff4e831f1227d0029d9a2d969aec467ca0f90bb', '[\"*\"]', '2026-01-28 18:36:14', NULL, '2026-01-28 18:36:14', '2026-01-28 18:36:14'),
(104, 'App\\Models\\User', 1, 'android', '1f4c23672c8fa0e870eaf984be839ab44d3a96e7e6f93a6c450754c2e43dfbb5', '[\"*\"]', '2026-01-28 18:37:57', NULL, '2026-01-28 18:37:52', '2026-01-28 18:37:57'),
(105, 'App\\Models\\User', 1, 'android', '18e824781327f19e25970ee3193ee634fa0778dc57a69b9dcac908ea5d7ebfb0', '[\"*\"]', '2026-01-28 18:40:25', NULL, '2026-01-28 18:40:15', '2026-01-28 18:40:25'),
(106, 'App\\Models\\User', 1, 'android', '7f3a2b9b2e6b1a1bfba5e0fc37174c4d9a90ed292496a5bd026e9b219dbc2934', '[\"*\"]', '2026-01-28 18:42:08', NULL, '2026-01-28 18:42:07', '2026-01-28 18:42:08'),
(107, 'App\\Models\\User', 1, 'android', 'ddd37b90e93d9fd4747bbd4322a1820992d0b7c7add46cedd1da01e727336128', '[\"*\"]', '2026-01-28 18:43:13', NULL, '2026-01-28 18:42:54', '2026-01-28 18:43:13'),
(108, 'App\\Models\\User', 1, 'android', 'a262ddccf5295cfc77ec4bc3abb57f23923604484588b74425d5eef579102b79', '[\"*\"]', '2026-01-28 19:01:40', NULL, '2026-01-28 19:00:48', '2026-01-28 19:01:40'),
(109, 'App\\Models\\User', 1, 'android', '214e2940dab6e73797b25278ca96e8ed23469f08e5d6d62b32ffd780a928f17f', '[\"*\"]', '2026-01-28 19:03:07', NULL, '2026-01-28 19:03:06', '2026-01-28 19:03:07'),
(110, 'App\\Models\\User', 1, 'android', '40e759e65e632defd5323b19c998e414647c8da57f4e38952e8f91c95829e1d7', '[\"*\"]', '2026-01-28 19:08:23', NULL, '2026-01-28 19:08:14', '2026-01-28 19:08:23'),
(111, 'App\\Models\\User', 1, 'android', 'f87b812ad71cb95c4447c020b61b43dea0b3186afc07489910c15f4e90169ba0', '[\"*\"]', '2026-01-28 19:10:05', NULL, '2026-01-28 19:09:43', '2026-01-28 19:10:05'),
(112, 'App\\Models\\User', 1, 'android', 'e7e7edc497b1a8ce78de361de392cfd5822c15df10f8e7fc3c41100c8cda0a9e', '[\"*\"]', '2026-01-28 19:11:41', NULL, '2026-01-28 19:11:33', '2026-01-28 19:11:41'),
(113, 'App\\Models\\User', 1, 'android', '4ef09fa1e08291a1ebc64b810b9f2279b30219c22aacb2bfc66bf2cc51805595', '[\"*\"]', '2026-01-28 19:13:33', NULL, '2026-01-28 19:13:33', '2026-01-28 19:13:33'),
(114, 'App\\Models\\User', 1, 'android', 'a2b6b8250c7a51f12007dce748676b4545dee6811a9156b2c5bea926017636e0', '[\"*\"]', '2026-01-28 19:15:13', NULL, '2026-01-28 19:15:08', '2026-01-28 19:15:13'),
(115, 'App\\Models\\User', 1, 'android', '22d5ba26adf9024917e27f584a63bfcf93e53a5f249ce875e3b44da9b6fafb34', '[\"*\"]', '2026-01-28 19:17:10', NULL, '2026-01-28 19:16:18', '2026-01-28 19:17:10'),
(116, 'App\\Models\\User', 1, 'android', '472c3e82d7cfcfa9f2541bbb01f7177bf8d6de42bd5ecda6bea98cf43fea596e', '[\"*\"]', '2026-01-28 19:21:34', NULL, '2026-01-28 19:19:07', '2026-01-28 19:21:34'),
(117, 'App\\Models\\User', 1, 'android', 'c71d6506d6011af2251adf30c79686baa252b59057d9a2d23fc31360e52e175a', '[\"*\"]', '2026-01-28 19:25:32', NULL, '2026-01-28 19:25:32', '2026-01-28 19:25:32'),
(118, 'App\\Models\\User', 1, 'android', '352c838f1011d130b6fed6aab34ef9e6a7654e704df32105ccb1380c90f76c66', '[\"*\"]', '2026-01-28 20:01:56', NULL, '2026-01-28 19:58:45', '2026-01-28 20:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9UjFVht8ahmwZcvqZ9UgRaCnQsMZ6yIgCD1CwJOE', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVmx3VFhWUWFtekxtTEpsN2pjaFJlZk14d0ZRZ0xzTEdhUGdrazVUaCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vdXNlcnMvY3JlYXRlIjtzOjU6InJvdXRlIjtzOjE4OiJhZG1pbi51c2Vycy5jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1769631506),
('yFvpjm6y5w8K5LPmYL6ibkniyH0CPF1A52i9dwq3', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMVBiMFd5N0VzNlBEVVNWZDl0RldpbjRac3ZCdVVwQjZtblFLdUVoUiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbm90ZXMiO3M6NToicm91dGUiO3M6MTE6Im5vdGVzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1769639833);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Joao Bosta123', 'joao@hotmail.com', 1, NULL, '$2y$12$AnXaaK.hHAcDQGzL1FERFeTYLv4tI3CrrY/mfrxS95uv7f5xHfwPi', NULL, '2026-01-15 17:13:44', '2026-01-24 00:22:19'),
(2, 'Miguel', 'miguel@hotmail.com', 0, NULL, '$2y$12$p.b8LM7QGuOAxlZ.nNQoJuj5nK9/OPP9905VJ8IRx4PO9xiitEYXe', NULL, '2026-01-15 19:01:05', '2026-01-15 19:01:05'),
(3, 'Margarida', 'margarida@hotmail.com', 0, NULL, '$2y$12$cI0rNS8hseMDRwIXO933AOdGpOJZ/b4cNjWG54KlY/xoA1m4EAoEm', NULL, '2026-01-15 21:43:17', '2026-01-15 21:43:17'),
(4, 'Teste', 'teste@hotmail.com', 0, NULL, '$2y$12$d/npzQkdU3pvWAdXK/h4IuEXxh5KJS4C8nZAoUQL6qlMqaTEgDEfC', NULL, '2026-01-15 23:17:31', '2026-01-15 23:17:31'),
(6, 'Catarina', 'catarina@hotmail.com', 0, NULL, '$2y$12$bGqA0E1nNAVcnTkohcdQSejYPaFypgGj.tB7/i5jaPL8Cg8FwI0X6', NULL, '2026-01-15 23:19:34', '2026-01-15 23:19:34'),
(7, 'jose', 'jose@hotmail.com', 0, NULL, '$2y$12$LfCJgKebsmZ6KuNEuJDEmu5iy397t8wtahu5M0Z.OGGL3A.RvNNa.', NULL, '2026-01-15 23:23:19', '2026-01-15 23:23:19'),
(8, 'Bem Jogadao', 'wp@hotmail.com', 1, NULL, '$2y$12$ROVlLmaLsCepHFavJl1Wf.DJDh9BumvuUVtb.c9UKcA6cmC1iOh4y', NULL, '2026-01-17 22:07:45', '2026-01-17 22:10:25'),
(9, 'maria', 'maria@hotmail.com', 0, NULL, '$2y$12$5fMzMmdPpv9LIVkd2MvAO.klwkDv4Zb3dPbDEA40TOcT5z90JiKNq', NULL, '2026-01-20 00:07:58', '2026-01-20 00:07:58'),
(10, 'Miguelito', 'miguelito@hotmail.com', 0, NULL, '$2y$12$k83PuXpUfjqD5RnKXmBZKuSHwxJiV7hdzqRAXUwNrJOjz7Y32OjbW', NULL, '2026-01-23 20:52:56', '2026-01-23 20:55:42'),
(11, 'daniel', 'daniel@hotmail.com', 0, NULL, '$2y$12$W8wnJLWCJf9ZMlTbBltIauROwoIhbwMFDr8t0NaOkLaSpO3Y4z.Ka', NULL, '2026-01-23 20:56:15', '2026-01-23 20:56:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folders_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_user_id_foreign` (`user_id`),
  ADD KEY `notes_folder_id_foreign` (`folder_id`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
