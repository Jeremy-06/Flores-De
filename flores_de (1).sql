-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2026 at 10:05 AM
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
-- Database: `flores_de`
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
('flores-de-cache-902ba3cda1883801594b6e1b452790cc53948fda', 'i:2;', 1774235556),
('flores-de-cache-902ba3cda1883801594b6e1b452790cc53948fda:timer', 'i:1774235556;', 1774235556),
('flores-de-cache-admin@admin.com|127.0.0.1', 'i:1;', 1774198955),
('flores-de-cache-admin@admin.com|127.0.0.1:timer', 'i:1774198955;', 1774198955),
('flores-de-cache-admin@shop.com|127.0.0.1', 'i:1;', 1774198938),
('flores-de-cache-admin@shop.com|127.0.0.1:timer', 'i:1774198938;', 1774198938),
('flores-de-cache-c1dfd96eea8cc2b62785275bca38ac261256e278', 'i:1;', 1774235271),
('flores-de-cache-c1dfd96eea8cc2b62785275bca38ac261256e278:timer', 'i:1774235271;', 1774235271),
('flores-de-cache-fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f', 'i:1;', 1774248781),
('flores-de-cache-fe5dbbcea5ce7e2988b8c69bcfdfde8904aabc1f:timer', 'i:1774248781;', 1774248781),
('flores-de-cache-primaveraron@gmail.com|127.0.0.1', 'i:1;', 1774235416),
('flores-de-cache-primaveraron@gmail.com|127.0.0.1:timer', 'i:1774235416;', 1774235416);

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Wedding', 'wedding', 'Beautiful arrangements for your special day', '2026-03-22 09:00:55', '2026-03-22 09:00:55'),
(2, 'Birthday', 'birthday', 'Celebrate with colorful birthday bouquets', '2026-03-22 09:00:55', '2026-03-22 09:00:55'),
(3, 'Anniversary', 'anniversary', 'Express your love with romantic flowers', '2026-03-22 09:00:55', '2026-03-22 09:00:55'),
(4, 'Sympathy', 'sympathy', 'Thoughtful arrangements for difficult times', '2026-03-22 09:00:55', '2026-03-22 09:00:55'),
(5, 'Get Well', 'get-well', 'Brighten someone\'s day with cheerful flowers', '2026-03-22 09:00:55', '2026-03-22 09:00:55'),
(6, 'Just Because', 'just-because', 'No special occasion needed', '2026-03-22 09:00:55', '2026-03-22 09:00:55');

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
-- Table structure for table `flowers`
--

CREATE TABLE `flowers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flowers`
--

INSERT INTO `flowers` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `stock`, `image`, `available`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'Red Rose Bouquet', 'red-rose-bouquet-2', 'Classic red roses symbolizing love and passion. Perfect for anniversaries and romantic occasions.', 349.99, 34, 'flowers/mSixLqDT70VrKzeWbBBFh9HB999yMfpT3XrIKpWY.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 22:45:02', NULL),
(2, 4, 'White Lily Arrangement', 'white-lily-arrangement-2', 'Elegant white lilies representing peace and purity.', 265.00, 31, 'flowers/o3dRARsgcV3WOsE7H7mAgfBDCKAJidf9bVY9C2pd.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 18:54:34', NULL),
(3, 2, 'Sunflower Delight', 'sunflower-delight-2', 'Bright and cheerful sunflowers to bring joy to any birthday.', 235.99, 23, 'flowers/xk9iRu8A0F7s139paB4MavfvRhonUkgVfSZbU1Sl.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 22:45:24', NULL),
(4, 6, 'Mixed Tulip Bunch', 'mixed-tulip-bunch-2', 'Colorful tulips in various shades to brighten any day.', 229.99, 30, 'flowers/FPJCgYwxssgAKEmHiIpLygsJLYRA0a2gx7eo2whj.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 22:47:16', NULL),
(5, 1, 'Bridal White Roses', 'bridal-white-roses-2', 'Stunning white roses for the perfect wedding bouquet.', 89.99, 34, 'flowers/JgdRXvGEn8ZQOY333rgCGPxtYF5b97crFOxVRUTk.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 18:56:53', NULL),
(6, 3, 'Orchid Elegance', 'orchid-elegance-2', 'Exotic orchids representing luxury and beauty.', 75.00, 48, 'flowers/bxZen94t5IfNzOPanS7FaPGykiUmbzdav5c7DAPb.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 18:57:26', NULL),
(7, 5, 'Daisy Sunshine Basket', 'daisy-sunshine-basket-2', 'Happy daisies to wish someone a speedy recovery.', 320.99, 40, 'flowers/hMjsA45nyWhjtROwQ3c7k42VJ2YKdO526oWS0vxE.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 18:44:01', NULL),
(8, 2, 'Pink Carnation Love', 'pink-carnation-love-2', 'Sweet pink carnations perfect for birthday celebrations.', 280.99, 31, 'flowers/bRPsy2aXMmCkKm2fpuKzrJZS4zUWbeJUQInfffSZ.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 18:44:45', NULL),
(9, 6, 'Lavender Dreams', 'lavender-dreams-2', 'Calming lavender arrangement for relaxation.', 42.99, 48, 'flowers/PHpvczbl13ABPgu3wPCTOmFyCgj6qKTDfWCizj6a.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 18:45:33', NULL),
(10, 2, 'Tropical Paradise', 'tropical-paradise-2', 'Exotic tropical flowers for a vibrant celebration.', 55.99, 44, 'flowers/PJu06upklXW5OAujWO12B3GlIpLMxDdLCygogDiv.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 18:46:46', NULL),
(11, 6, 'Garden Mix Bouquet', 'garden-mix-bouquet-2', 'A beautiful mix of seasonal garden flowers.', 380.99, 37, 'flowers/ghg1uQyMu63LSwGeFSusEiLE7zNcn2Y8XWxwpA5u.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 18:48:08', NULL),
(12, 1, 'Romantic Peony', 'romantic-peony-2', 'Luxurious peonies for the most romantic occasions.', 499.00, 14, 'flowers/zRTPQJkIUaTkPoEe3ZEVRKXk6U6nFiW5jzEMPAJP.jpg', 1, '2026-03-22 09:00:55', '2026-03-22 18:49:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `flower_images`
--

CREATE TABLE `flower_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flower_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2026_02_20_000000_create_users_table', 1),
(2, '2026_02_20_000001_create_cache_table', 1),
(3, '2026_02_22_000002_create_jobs_table', 1),
(4, '2026_02_23_132740_create_categories_table', 1),
(14, '2026_02_23_132838_create_products_table', 2),
(15, '2026_02_23_132848_create_orders_table', 2),
(16, '2026_02_23_132914_create_order_items_table', 2),
(17, '2026_02_23_132934_add_role_to_users_table', 2),
(18, '2026_03_03_002809_add_message_to_orders_table', 2),
(19, '2026_03_06_001504_add_soft_deletes_to_products_table', 2),
(20, '2026_03_12_051000_create_flower_images_table', 2),
(21, '2026_03_12_105259_add_photo_status_to_users_table', 2),
(22, '2026_03_22_142803_create_reviews_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `delivery_address` text NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `total`, `status`, `customer_name`, `customer_phone`, `delivery_address`, `delivery_date`, `message`, `created_at`, `updated_at`) VALUES
(1, 7, 'FLW-20260323-69C0FEAE9F7B2', 349.99, 'delivered', 'Ron Jeremy Primavera', '09943327537', 'North Daang Hari', '2026-03-28', NULL, '2026-03-23 00:49:50', '2026-03-23 01:00:44'),
(2, 4, 'FLW-20260323-69C100BED0966', 225.00, 'pending', 'Juan Dela Cruz', '09762720809', '570 Cara Terrace Apt. 516\nWest Altheabury, MS 79362', '2025-12-18', 'Blanditiis cupiditate repellendus id exercitationem esse et.', '2025-12-13 00:58:38', '2026-03-23 00:58:41'),
(3, 6, 'FLW-20260323-69C100C193F3D', 75.00, 'processing', 'Julianne S. Tumpap', '09333164488', '1562 Trantow Brook\nKrajcikbury, CT 19895-1497', '2026-03-04', NULL, '2026-02-27 00:58:41', '2026-03-23 00:58:41'),
(4, 2, 'FLW-20260323-69C100C197039', 75.00, 'pending', 'Customer', '09601404518', '38101 Hettinger Haven\nAufderharfort, ME 55250-0955', '2025-12-27', 'Iste eos et fugit cumque cupiditate.', '2025-12-22 00:58:41', '2026-03-23 00:58:41'),
(5, 6, 'FLW-20260323-69C100C19A357', 1430.96, 'processing', 'Julianne S. Tumpap', '09185389328', '81617 Quigley Divide Suite 320\nEast Mireilleland, HI 55036-1086', '2026-01-16', NULL, '2026-01-14 00:58:41', '2026-03-23 00:58:41'),
(6, 7, 'FLW-20260323-69C100C19DD8F', 2067.95, 'processing', 'Ron Jeremy Primavera', '09287005619', '4575 Waelchi Drive Suite 922\nHoppebury, MO 49955-4391', '2026-01-19', NULL, '2026-01-15 00:58:41', '2026-03-23 00:58:41'),
(7, 8, 'FLW-20260323-69C100C1A2BE0', 1625.97, 'cancelled', 'John Luis Pilar', '09932065496', '38412 Walsh Oval Apt. 811\nSouth Jaylin, ND 34078-8928', '2025-11-25', 'Quidem dignissimos consequatur est ipsa.', '2025-11-23 00:58:41', '2026-03-23 00:58:41'),
(8, 3, 'FLW-20260323-69C100C1A6B5D', 1087.99, 'cancelled', 'Maria Santos', '09240209241', '9363 Bartoletti Crossroad\nNew Ludwigchester, NY 60038-3464', '2025-12-11', NULL, '2025-12-07 00:58:41', '2026-03-23 00:58:41'),
(9, 6, 'FLW-20260323-69C100C1AABCC', 797.97, 'cancelled', 'Julianne S. Tumpap', '09809462478', '679 Larson Lakes\nLake Evan, NY 80396-9700', '2026-03-02', 'Quo minus aut porro qui incidunt.', '2026-02-27 00:58:41', '2026-03-23 00:58:41'),
(10, 7, 'FLW-20260323-69C100C1AEA7B', 689.97, 'pending', 'Ron Jeremy Primavera', '09787488650', '887 Rebeka Circle\nPort Oswaldo, TN 68648-2021', '2026-03-15', 'Mollitia excepturi dolorem fuga incidunt sit eveniet est.', '2026-03-12 00:58:41', '2026-03-23 00:58:41'),
(11, 7, 'FLW-20260323-69C100C1B1A2F', 2192.94, 'pending', 'Ron Jeremy Primavera', '09880547986', '76559 Jacobson Viaduct\nCamillabury, VT 71141', '2025-10-30', NULL, '2025-10-25 00:58:41', '2026-03-23 00:58:41'),
(12, 8, 'FLW-20260323-69C100C1B5DA8', 950.94, 'pending', 'John Luis Pilar', '09189273613', '400 Jammie Run Suite 060\nBlandashire, MA 10784', '2026-03-15', NULL, '2026-03-14 00:58:41', '2026-03-23 00:58:41'),
(13, 7, 'FLW-20260323-69C100C1BA56C', 2696.97, 'pending', 'Ron Jeremy Primavera', '09257984270', '582 Schulist Neck\nNorth Jeramie, PA 49290', '2025-10-03', NULL, '2025-09-28 00:58:41', '2026-03-23 00:58:41'),
(14, 5, 'FLW-20260323-69C100C1BE804', 649.00, 'processing', 'Ana Reyes', '09516285489', '668 Robel Circles Apt. 024\nSouth Sammy, NM 20724-4785', '2025-10-13', 'Hic et vitae consequatur omnis omnis et et.', '2025-10-12 00:58:41', '2026-03-23 00:58:41'),
(15, 3, 'FLW-20260323-69C100C1C29A6', 179.98, 'delivered', 'Maria Santos', '09719294594', '534 Audie Corner\nNorth Jessy, MN 14239-6433', '2026-01-19', 'Earum repellat quod totam sed autem.', '2026-01-16 00:58:41', '2026-03-23 00:58:41'),
(16, 8, 'FLW-20260323-69C100C1C6784', 42.99, 'cancelled', 'John Luis Pilar', '09123948437', '97604 Smith Trail\nEast Kamrynstad, NJ 47880', '2025-12-06', 'Esse laboriosam sed aut incidunt excepturi expedita.', '2025-12-02 00:58:41', '2026-03-23 00:58:41'),
(17, 3, 'FLW-20260323-69C100C1C9768', 1057.96, 'cancelled', 'Maria Santos', '09133978157', '307 Kenneth Common Apt. 682\nHilpertshire, OH 67909', '2025-12-19', 'Nemo dolorum beatae iusto aut consequuntur voluptatum amet fuga.', '2025-12-15 00:58:41', '2026-03-23 00:58:41'),
(18, 8, 'FLW-20260323-69C100C1CD106', 882.97, 'delivered', 'John Luis Pilar', '09130641056', '4074 Hallie Turnpike\nLake Roslyn, WA 71320', '2026-01-25', 'Qui doloremque blanditiis id beatae temporibus.', '2026-01-24 00:58:41', '2026-03-23 01:01:11'),
(19, 5, 'FLW-20260323-69C100C1D1B87', 75.00, 'cancelled', 'Ana Reyes', '09214690709', '664 Durgan Station Suite 411\nGoodwinport, AL 17485-5993', '2025-10-27', NULL, '2025-10-22 00:58:41', '2026-03-23 00:58:41'),
(20, 6, 'FLW-20260323-69C100C1D5BE2', 554.99, 'pending', 'Julianne S. Tumpap', '09520251409', '124 Hammes Turnpike\nSouth Jeraldchester, MS 62633-5131', '2026-03-17', NULL, '2026-03-16 00:58:41', '2026-03-23 00:58:41'),
(21, 6, 'FLW-20260323-69C100C1D96ED', 1960.97, 'pending', 'Julianne S. Tumpap', '09551286640', '90888 Denesik Club\nWest Chelsiehaven, CA 97955-3708', '2026-02-08', NULL, '2026-02-05 00:58:41', '2026-03-23 00:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `flower_id` bigint(20) UNSIGNED NOT NULL,
  `flower_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `flower_id`, `flower_name`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Red Rose Bouquet', 349.99, 1, '2026-03-23 00:49:50', '2026-03-23 00:49:50'),
(2, 2, 6, 'Orchid Elegance', 75.00, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(3, 3, 6, 'Orchid Elegance', 75.00, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(4, 4, 6, 'Orchid Elegance', 75.00, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(5, 5, 1, 'Red Rose Bouquet', 349.99, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(6, 5, 11, 'Garden Mix Bouquet', 380.99, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(7, 6, 1, 'Red Rose Bouquet', 349.99, 2, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(8, 6, 6, 'Orchid Elegance', 75.00, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(9, 6, 11, 'Garden Mix Bouquet', 380.99, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(10, 7, 9, 'Lavender Dreams', 42.99, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(11, 7, 12, 'Romantic Peony', 499.00, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(12, 8, 5, 'Bridal White Roses', 89.99, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(13, 8, 12, 'Romantic Peony', 499.00, 2, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(14, 9, 3, 'Sunflower Delight', 235.99, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(15, 9, 8, 'Pink Carnation Love', 280.99, 2, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(16, 10, 4, 'Mixed Tulip Bunch', 229.99, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(17, 11, 1, 'Red Rose Bouquet', 349.99, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(18, 11, 11, 'Garden Mix Bouquet', 380.99, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(19, 12, 1, 'Red Rose Bouquet', 349.99, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(20, 12, 3, 'Sunflower Delight', 235.99, 2, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(21, 12, 9, 'Lavender Dreams', 42.99, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(22, 13, 1, 'Red Rose Bouquet', 349.99, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(23, 13, 6, 'Orchid Elegance', 75.00, 2, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(24, 13, 12, 'Romantic Peony', 499.00, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(25, 14, 6, 'Orchid Elegance', 75.00, 2, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(26, 14, 12, 'Romantic Peony', 499.00, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(27, 15, 5, 'Bridal White Roses', 89.99, 2, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(28, 16, 9, 'Lavender Dreams', 42.99, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(29, 17, 1, 'Red Rose Bouquet', 349.99, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(30, 17, 3, 'Sunflower Delight', 235.99, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(31, 18, 7, 'Daisy Sunshine Basket', 320.99, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(32, 18, 8, 'Pink Carnation Love', 280.99, 2, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(33, 19, 6, 'Orchid Elegance', 75.00, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(34, 20, 10, 'Tropical Paradise', 55.99, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(35, 20, 12, 'Romantic Peony', 499.00, 1, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(36, 21, 7, 'Daisy Sunshine Basket', 320.99, 3, '2026-03-23 00:58:41', '2026-03-23 00:58:41'),
(37, 21, 12, 'Romantic Peony', 499.00, 2, '2026-03-23 00:58:41', '2026-03-23 00:58:41');

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
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `flower_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('2qwuGvkhAGslfLqBMyVlzDNjw0IfC5NCHwPoScOy', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ2xGblR5WEQ5d2hrTXk3SnRjdzJSU1VFZkhUSlNuNzlVV2lvVVBlTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjI2OiI0eVRsVERLdTNvSk9mekRfY2FydF9pdGVtcyI7YTowOnt9fQ==', 1774256518),
('K2uii1iSkvJGYTTGdXXmzSgYvxltskDXLjE7IfiB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRlZDaXdXT1VmS0RHYkQwY3JIRzV5YTBUdGQ0NlRvbmh1TVlUVzVoRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1774256551);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL DEFAULT 'customer',
  `phone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `phone`, `photo`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@flowershop.com', 'admin', NULL, NULL, 'active', '2026-03-22 09:00:55', '$2y$12$ZSDlCLjBNosvyPlUwX5Zf.cjzFHhJdkWH64TPpauzQ8eU0c0ywofe', 'D5CtW0ybObwLN4eymNWOGoZkbw6tQlQIcXwksthgNc83Cq1SjmkLrYJGO47v', '2026-03-22 09:00:55', '2026-03-23 00:55:47'),
(2, 'Customer', 'customer@flowershop.com', 'customer', NULL, NULL, 'active', '2026-03-22 09:00:55', '$2y$12$Ij5tlsB2..nYmcivTL/FqeBqQDxgOgmy0oLDN3LQWEkWO.PTs8WPi', NULL, '2026-03-22 09:00:55', '2026-03-22 09:00:55'),
(3, 'Maria Santos', 'maria@test.com', 'customer', NULL, NULL, 'active', '2026-03-22 09:00:55', '$2y$12$W7yWvfRnRruSq33MeBbRYeAH30AORJqalYQw0AzbpS1Kgip/2ory.', NULL, '2026-03-22 09:00:55', '2026-03-22 09:00:55'),
(4, 'Juan Dela Cruz', 'juan@test.com', 'customer', NULL, NULL, 'active', '2026-03-22 09:00:55', '$2y$12$I4yyrqIGC4FN/ATZAAoKkeN2nXqfGj7omyCBq1hBzK.kKESCfGDde', NULL, '2026-03-22 09:00:55', '2026-03-22 09:00:55'),
(5, 'Ana Reyes', 'ana@test.com', 'customer', NULL, NULL, 'active', '2026-03-22 09:00:55', '$2y$12$upWWwljCA5bnaGu4vyNNRONDBU8eYnHhj0q1wT2d7JXi/nn4k/rDO', NULL, '2026-03-22 09:00:55', '2026-03-22 09:00:55'),
(6, 'Julianne S. Tumpap', 'juliannetumpap08@gmail.com', 'customer', NULL, NULL, 'active', '2026-03-22 19:06:52', '$2y$12$aIrgGftixjtlILQocFBMfu23he1a4ZdWN5ajKSt/j/jBESO3UluAG', NULL, '2026-03-22 19:02:46', '2026-03-22 19:15:43'),
(7, 'Ron Jeremy Primavera', 'primaverajeremy17@gmail.com', 'customer', NULL, NULL, 'active', '2026-03-22 19:11:55', '$2y$12$MqozyTO1Of26ggqNCnQxNuK5/TgyXdw3XioAvSbfHjy7LKvpioKoW', NULL, '2026-03-22 19:11:25', '2026-03-22 19:11:55'),
(8, 'John Luis Pilar', 'jluispilar@gmail.com', 'customer', NULL, NULL, 'active', '2026-03-22 22:52:01', '$2y$12$nLoH/jPoreCWT5APPq0hCuoEalE/LPh.r0/iJFOAOw1M3YmRt2dN6', NULL, '2026-03-22 22:51:30', '2026-03-22 22:52:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `flowers_slug_unique` (`slug`),
  ADD KEY `flowers_category_id_foreign` (`category_id`);

--
-- Indexes for table `flower_images`
--
ALTER TABLE `flower_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flower_images_flower_id_foreign` (`flower_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_flower_id_foreign` (`flower_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_user_id_flower_id_unique` (`user_id`,`flower_id`),
  ADD KEY `reviews_flower_id_foreign` (`flower_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flowers`
--
ALTER TABLE `flowers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `flower_images`
--
ALTER TABLE `flower_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flowers`
--
ALTER TABLE `flowers`
  ADD CONSTRAINT `flowers_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `flower_images`
--
ALTER TABLE `flower_images`
  ADD CONSTRAINT `flower_images_flower_id_foreign` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_flower_id_foreign` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_flower_id_foreign` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
