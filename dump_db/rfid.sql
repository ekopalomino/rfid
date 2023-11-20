-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Nov 20, 2023 at 08:59 AM
-- Server version: 8.1.0
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rfid`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Information System', 'bb536994-ada3-4caa-b97b-e412dc2cc882', NULL, NULL, '2023-11-20 14:51:14', '2023-11-20 14:51:14'),
(2, 'Human Capital', 'bb536994-ada3-4caa-b97b-e412dc2cc882', NULL, NULL, '2023-11-20 14:51:22', '2023-11-20 14:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint UNSIGNED NOT NULL,
  `warehouse_id` int NOT NULL,
  `location_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_detail` text COLLATE utf8mb4_unicode_ci,
  `created_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `warehouse_id`, `location_name`, `location_detail`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Office Lantai 2 Ruang Mancom', 'Ruang Mancom', 'bb536994-ada3-4caa-b97b-e412dc2cc882', 'eko', '2023-11-20 14:51:00', '2023-11-20 15:16:02', NULL),
(2, 1, 'Office Lantai 2 Ruang Manager', 'Ruang Manager', 'bb536994-ada3-4caa-b97b-e412dc2cc882', NULL, '2023-11-20 15:16:22', '2023-11-20 15:16:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_activities`
--

CREATE TABLE `log_activities` (
  `id` bigint UNSIGNED NOT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_activities`
--

INSERT INTO `log_activities` (`id`, `subject`, `url`, `method`, `ip`, `agent`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Branch Bogor Successfully Created', 'http://localhost:8082/apps/settings/branch/create', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:50:16', '2023-11-20 14:50:16'),
(2, 'Branch Bandung Successfully Created', 'http://localhost:8082/apps/settings/branch/create', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:50:21', '2023-11-20 14:50:21'),
(3, 'Branch Yogyakarta Successfully Created', 'http://localhost:8082/apps/settings/branch/create', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:50:27', '2023-11-20 14:50:27'),
(4, 'Branch Sidoarjo Successfully Created', 'http://localhost:8082/apps/settings/branch/create', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:50:33', '2023-11-20 14:50:33'),
(5, 'Branch Malang Successfully Created', 'http://localhost:8082/apps/settings/branch/create', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:50:38', '2023-11-20 14:50:38'),
(6, 'Branch Medan Successfully Created', 'http://localhost:8082/apps/settings/branch/create', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:50:43', '2023-11-20 14:50:43'),
(7, 'Lokasi Office Lantai 2 Berhasil Disimpan', 'http://localhost:8082/apps/settings/location/create', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:51:00', '2023-11-20 14:51:00'),
(8, 'Unit Kerja Information System Berhasil Disimpan', 'http://localhost:8082/apps/settings/department/create', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:51:14', '2023-11-20 14:51:14'),
(9, 'Unit Kerja Human Capital Berhasil Disimpan', 'http://localhost:8082/apps/settings/department/create', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:51:22', '2023-11-20 14:51:22'),
(10, 'Asset Macbook Air Successfully Created', 'http://localhost:8082/apps/products/store', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:52:55', '2023-11-20 14:52:55'),
(11, 'Produk Macbook Air Berhasil Diubah', 'http://localhost:8082/apps/products/update/3f1a3aa2-769d-4c96-bbb2-1f2a644fb871', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:59:36', '2023-11-20 14:59:36'),
(12, 'Produk Macbook Air Berhasil Diubah', 'http://localhost:8082/apps/products/update/3f1a3aa2-769d-4c96-bbb2-1f2a644fb871', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 14:59:46', '2023-11-20 14:59:46'),
(13, 'Lokasi Office Lantai 2 Ruang Manager Berhasil Disimpan', 'http://localhost:8082/apps/settings/location/create', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 15:16:22', '2023-11-20 15:16:22'),
(14, 'Produk Macbook Air Berhasil Diubah', 'http://localhost:8082/apps/products/update/3f1a3aa2-769d-4c96-bbb2-1f2a644fb871', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 15:16:35', '2023-11-20 15:16:35'),
(15, 'Produk Macbook Air Berhasil Diubah', 'http://localhost:8082/apps/products/update/3f1a3aa2-769d-4c96-bbb2-1f2a644fb871', 'POST', '192.168.65.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 15:42:06', '2023-11-20 15:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_09_04_083916_create_statuses_table', 1),
(6, '2019_09_04_211618_create_log_activities_table', 2),
(7, '2019_09_04_211848_create_permission_tables', 2),
(8, '2019_09_05_225910_create_payment_methods_table', 3),
(9, '2019_09_05_230100_create_payment_terms_table', 3),
(10, '2019_09_05_230914_create_uom_categories_table', 4),
(11, '2019_09_05_230930_create_uom_values_table', 4),
(12, '2019_09_06_074801_create_contacts_table', 5),
(13, '2019_09_07_083416_create_product_categories_table', 6),
(15, '2019_09_07_084554_create_products_table', 7),
(19, '2019_09_08_215819_create_internal_transfers_table', 10),
(20, '2019_09_09_223056_create_sales_table', 11),
(21, '2019_09_09_232534_create_sale_items_table', 11),
(22, '2019_09_10_200022_create_purchases_table', 12),
(23, '2019_09_10_200121_create_purchase_items_table', 12),
(24, '2019_09_11_223042_create_deliveries_table', 13),
(29, '2019_09_19_231526_create_manufacture_calculates_table', 16),
(30, '2019_09_22_225704_create_internal_items_table', 17),
(31, '2019_09_11_232813_create_manufactures_table', 18),
(32, '2019_09_11_233120_create_manufacture_items_table', 18),
(37, '2019_09_24_102135_create_work_items_table', 19),
(41, '2019_10_11_000017_create_delivery_services_table', 21),
(48, '2014_10_00_000001_add_group_column_on_settings_table', 24),
(54, '2020_01_06_235627_create_user_warehouses_table', 27),
(58, '2019_09_07_211518_create_inventories_table', 29),
(64, '2019_09_30_225904_create_invoices_table', 32),
(65, '2020_01_15_235803_create_delivery_items_table', 32),
(66, '2020_01_17_200048_create_references_table', 33),
(67, '2020_01_17_230338_create_receive_purchases_table', 34),
(68, '2020_01_17_230354_create_receive_purchase_items_table', 34),
(70, '2020_01_18_111930_create_invoices_table', 36),
(74, '2020_01_23_012028_create_returs_table', 37),
(75, '2020_01_23_012035_create_retur_items_table', 37),
(76, '2020_01_23_022055_create_retur_reasons_table', 38),
(81, '2020_01_13_041442_create_payments_table', 41),
(82, '2020_01_18_103842_create_payment_items_table', 41),
(84, '2020_09_22_041722_create_payment_cicilans_table', 42),
(85, '2020_11_09_141358_create_models_payment_installments_table', 42),
(90, '2019_09_07_212548_create_product_boms_table', 43),
(91, '2019_09_07_211754_create_inventory_movements_table', 44),
(92, '2023_09_25_135452_create_coa_accounts_table', 45),
(93, '2023_10_30_211849_create_locations_table', 46),
(94, '2023_11_20_133113_create_product_movements_table', 47),
(95, '2023_11_20_143718_create_warranties_table', 48),
(96, '2019_09_04_083904_create_divisions_table', 49),
(97, '2019_09_04_083928_create_warehouses_table', 50);

-- --------------------------------------------------------

--
-- Table structure for table `models_retur_items`
--

CREATE TABLE `models_retur_items` (
  `id` bigint UNSIGNED NOT NULL,
  `retur_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_qty` decimal(50,2) NOT NULL,
  `retur_qty` decimal(50,2) NOT NULL,
  `uom_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason_retur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(8, 'iteos\\Models\\User', '071ea324-a8d2-4f79-8f8a-23c90bc191ff'),
(1, 'iteos\\Models\\User', '24d21373-b462-4888-8d27-d365c33fbf6a'),
(11, 'iteos\\Models\\User', '25b76385-8f8d-4422-a62e-21c671bfcaec'),
(1, 'iteos\\Models\\User', '45e3cf2e-1b27-43ff-b3e8-32d3695b6434'),
(1, 'iteos\\Models\\User', '589f13c5-f185-4bb2-95d8-c62b12c8271d'),
(4, 'iteos\\Models\\User', '74718047-dc5d-4f47-87fc-8db9e4fdb527'),
(1, 'iteos\\Models\\User', '820cbe25-baf5-4d2b-b877-9ce7fdffdc21'),
(12, 'iteos\\Models\\User', '994a52f5-285e-4401-95b2-166cc353bb65'),
(7, 'iteos\\Models\\User', 'a7acf627-9108-44c0-a028-2d9bf7829108'),
(1, 'iteos\\Models\\User', 'bb536994-ada3-4caa-b97b-e412dc2cc882'),
(1, 'iteos\\Models\\User', 'c7e50632-3efc-4cff-99fd-2a39dee275b2'),
(5, 'iteos\\Models\\User', 'cb512697-44d9-4683-9bae-0a8e28a3252b'),
(1, 'iteos\\Models\\User', 'eaeed9cc-a8a7-4843-84ca-67936aa1f889'),
(12, 'iteos\\Models\\User', 'f68f2a18-623f-4c1a-bfde-7f029c603a17');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sysadmin@local.com', '$2y$10$UmeGPdwccixnCl4pwOAA0ep.Mt3yEX5zi94hR/KQRSaioyc7nmcsm', '2020-10-18 14:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Can Access Settings', 'web', '2019-09-04 14:23:14', '2019-09-04 14:23:14'),
(2, 'Can Access Users', 'web', '2019-09-04 14:23:14', '2019-09-04 14:23:14'),
(3, 'Can Access Sales', 'web', '2019-09-04 14:23:14', '2019-09-04 14:23:14'),
(4, 'Can Access Purchasing', 'web', '2019-09-04 14:23:14', '2019-09-04 14:23:14'),
(5, 'Can Access Products', 'web', '2019-09-04 14:23:14', '2019-09-04 14:23:14'),
(6, 'Can Access Inventories', 'web', '2019-09-04 14:23:14', '2019-09-04 14:23:14'),
(7, 'Can Access Manufactures', 'web', '2019-09-04 14:23:14', '2019-09-04 14:23:14'),
(8, 'Can Access Finances', 'web', '2019-09-04 14:23:14', '2019-09-04 14:23:14'),
(9, 'Can Create Data', 'web', '2019-09-04 14:23:14', '2019-09-04 14:23:14'),
(10, 'Can Edit Data', 'web', '2019-09-04 14:23:15', '2019-09-04 14:23:15'),
(11, 'Can Delete Data', 'web', '2019-09-04 14:23:15', '2019-09-04 14:23:15'),
(12, 'Can Change Status', 'web', '2019-09-04 14:23:15', '2019-09-04 14:23:15'),
(13, 'Can View Data', 'web', '2019-09-04 14:23:15', '2019-09-04 14:23:15'),
(14, 'Can Create Adjustment', 'web', '2019-09-04 14:23:15', '2019-09-04 14:23:15'),
(15, 'Can Access Contact', 'web', '2019-09-06 01:24:11', '2019-09-06 01:24:11'),
(16, 'Can Accept Request', 'web', '2019-09-10 12:56:37', '2019-09-10 12:56:37'),
(17, 'Can Create Setting', 'web', '2019-12-26 18:31:39', '2019-12-26 18:31:39'),
(18, 'Can Edit Setting', 'web', '2019-12-26 18:31:39', '2019-12-26 18:31:39'),
(19, 'Can Delete Setting', 'web', '2019-12-26 18:31:39', '2019-12-26 18:31:39'),
(20, 'Can Create User', 'web', '2019-12-26 18:31:39', '2019-12-26 18:31:39'),
(21, 'Can Edit User', 'web', '2019-12-26 18:31:39', '2019-12-26 18:31:39'),
(22, 'Can Delete User', 'web', '2019-12-26 18:31:39', '2019-12-26 18:31:39'),
(23, 'Can Create Sales', 'web', '2019-12-26 18:31:40', '2019-12-26 18:31:40'),
(24, 'Can Edit Sales', 'web', '2019-12-26 18:31:40', '2019-12-26 18:31:40'),
(25, 'Can Delete Sales', 'web', '2019-12-26 18:31:40', '2019-12-26 18:31:40'),
(26, 'Can Accept Sales', 'web', '2019-12-26 18:31:40', '2019-12-26 18:31:40'),
(27, 'Can Create Purchase', 'web', '2019-12-26 18:31:40', '2019-12-26 18:31:40'),
(28, 'Can Edit Purchase', 'web', '2019-12-26 18:31:40', '2019-12-26 18:31:40'),
(29, 'Can Delete Purchase', 'web', '2019-12-26 18:31:40', '2019-12-26 18:31:40'),
(30, 'Can Approve Purchase', 'web', '2019-12-26 18:31:40', '2019-12-26 18:31:40'),
(31, 'Can Create Product', 'web', '2019-12-26 18:31:40', '2019-12-26 18:31:40'),
(32, 'Can Edit Product', 'web', '2019-12-26 18:31:40', '2019-12-26 18:31:40'),
(33, 'Can Delete Product', 'web', '2019-12-26 18:31:40', '2019-12-26 18:31:40'),
(34, 'Can Create Inventory', 'web', '2019-12-26 18:31:41', '2019-12-26 18:31:41'),
(35, 'Can Edit Inventory', 'web', '2019-12-26 18:31:41', '2019-12-26 18:31:41'),
(36, 'Can Delete Inventory', 'web', '2019-12-26 18:31:41', '2019-12-26 18:31:41'),
(37, 'Can Approve Inventory', 'web', '2019-12-26 18:31:41', '2019-12-26 18:31:41'),
(38, 'Can Create Manufacture', 'web', '2019-12-26 18:31:41', '2019-12-26 18:31:41'),
(39, 'Can Edit Manufacture', 'web', '2019-12-26 18:31:41', '2019-12-26 18:31:41'),
(40, 'Can Delete Manufacture', 'web', '2019-12-26 18:31:41', '2019-12-26 18:31:41'),
(41, 'Can Approve Manufacture', 'web', '2019-12-26 18:31:41', '2019-12-26 18:31:41'),
(42, 'Can Create Finance', 'web', '2019-12-26 18:31:41', '2019-12-26 18:31:41'),
(43, 'Can Edit Finance', 'web', '2019-12-26 18:31:41', '2019-12-26 18:31:41'),
(44, 'Can Delete Finance', 'web', '2019-12-26 18:31:41', '2019-12-26 18:31:41'),
(45, 'Can Create Contact', 'web', '2019-12-30 17:43:08', '2019-12-30 17:43:08'),
(46, 'Can Edit Contact', 'web', '2019-12-30 17:44:01', '2019-12-30 17:44:01'),
(47, 'Can Delete Contact', 'web', '2019-12-30 17:44:01', '2019-12-30 17:44:01'),
(48, 'Can Access Report', 'web', '2019-12-30 17:47:18', '2019-12-30 17:47:18'),
(49, 'Can Create Report', 'web', '2019-12-30 17:47:18', '2019-12-30 17:47:18'),
(50, 'Can Create Receipt', 'web', '2020-01-17 00:02:47', '2020-01-17 00:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfid_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sap_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `branch_id` int NOT NULL,
  `location_id` int NOT NULL,
  `department_id` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(50,2) DEFAULT NULL,
  `specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `purchase_date` date DEFAULT NULL,
  `warranty_period` int DEFAULT NULL,
  `created_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `rfid_code`, `sap_code`, `name`, `category_id`, `branch_id`, `location_id`, `department_id`, `image`, `price`, `specification`, `purchase_date`, `warranty_period`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
('3f1a3aa2-769d-4c96-bbb2-1f2a644fb871', '129801298421240281241', 'AST001', 'Macbook Air', 1, 1, 1, 1, NULL, 14500000.00, 'Macbook Air', '2021-07-20', 5, 'bb536994-ada3-4caa-b97b-e412dc2cc882', NULL, '2023-11-20 14:52:55', '2023-11-20 15:42:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Notebook', 'bb536994-ada3-4caa-b97b-e412dc2cc882', 'bb536994-ada3-4caa-b97b-e412dc2cc882', '2023-11-20 10:01:16', '2023-11-20 10:06:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_movements`
--

CREATE TABLE `product_movements` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origin_location` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `origin_branch` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_location` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_branch` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_movements`
--

INSERT INTO `product_movements` (`id`, `product_id`, `origin_location`, `origin_branch`, `destination_location`, `destination_branch`, `created_at`, `updated_at`) VALUES
(1, '3f1a3aa2-769d-4c96-bbb2-1f2a644fb871', '2', '1', '1', '1', '2023-11-20 15:42:06', '2023-11-20 15:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'web', '2019-09-04 14:23:40', '2019-09-04 14:23:40'),
(2, 'Sales', 'web', '2019-09-15 01:07:52', '2019-09-15 01:07:52'),
(3, 'PPIC', 'web', '2020-01-06 17:45:28', '2020-01-06 17:45:28'),
(4, 'Sales-FTI', 'web', '2020-01-08 13:40:45', '2020-01-08 13:40:45'),
(5, 'Pembelian', 'web', '2020-01-08 13:41:30', '2020-01-08 13:41:30'),
(6, 'Finance', 'web', '2020-01-09 13:06:46', '2020-01-09 13:06:46'),
(7, 'Produksi/Manufaktur', 'web', '2020-01-10 14:21:32', '2020-01-10 14:21:32'),
(8, 'Gudang', 'web', '2020-01-10 19:02:59', '2020-01-10 19:02:59'),
(9, 'Sysadmin', 'web', '2020-01-11 19:26:34', '2020-01-11 19:26:34'),
(10, 'Logistik', 'web', '2020-01-13 15:47:06', '2020-01-13 15:47:06'),
(11, 'Finance Approval', 'web', '2020-06-18 12:24:00', '2020-06-18 12:24:00'),
(12, 'Admin Sales-Invoice', 'web', '2020-10-10 14:51:53', '2020-10-10 14:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(15, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
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
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(3, 2),
(6, 2),
(9, 2),
(10, 2),
(11, 2),
(13, 2),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(15, 4),
(23, 4),
(24, 4),
(27, 4),
(38, 4),
(45, 4),
(46, 4),
(1, 5),
(3, 5),
(4, 5),
(5, 5),
(6, 5),
(7, 5),
(8, 5),
(15, 5),
(17, 5),
(18, 5),
(27, 5),
(28, 5),
(29, 5),
(30, 5),
(34, 5),
(42, 5),
(43, 5),
(45, 5),
(46, 5),
(3, 6),
(4, 6),
(5, 6),
(6, 6),
(7, 6),
(8, 6),
(15, 6),
(42, 6),
(43, 6),
(44, 6),
(45, 6),
(46, 6),
(48, 6),
(49, 6),
(3, 7),
(4, 7),
(5, 7),
(6, 7),
(7, 7),
(15, 7),
(27, 7),
(31, 7),
(32, 7),
(34, 7),
(35, 7),
(36, 7),
(37, 7),
(38, 7),
(39, 7),
(40, 7),
(41, 7),
(45, 7),
(46, 7),
(48, 7),
(3, 8),
(4, 8),
(5, 8),
(6, 8),
(7, 8),
(15, 8),
(27, 8),
(28, 8),
(31, 8),
(32, 8),
(34, 8),
(35, 8),
(36, 8),
(37, 8),
(45, 8),
(46, 8),
(50, 8),
(1, 9),
(2, 9),
(3, 9),
(4, 9),
(5, 9),
(6, 9),
(7, 9),
(8, 9),
(15, 9),
(17, 9),
(18, 9),
(19, 9),
(20, 9),
(21, 9),
(22, 9),
(23, 9),
(24, 9),
(25, 9),
(26, 9),
(27, 9),
(28, 9),
(29, 9),
(30, 9),
(31, 9),
(32, 9),
(33, 9),
(34, 9),
(35, 9),
(36, 9),
(37, 9),
(38, 9),
(39, 9),
(40, 9),
(41, 9),
(42, 9),
(43, 9),
(44, 9),
(45, 9),
(46, 9),
(47, 9),
(48, 9),
(49, 9),
(50, 9),
(3, 10),
(4, 10),
(5, 10),
(6, 10),
(7, 10),
(15, 10),
(27, 10),
(30, 10),
(34, 10),
(37, 10),
(38, 10),
(45, 10),
(46, 10),
(3, 11),
(4, 11),
(5, 11),
(6, 11),
(7, 11),
(8, 11),
(15, 11),
(23, 11),
(24, 11),
(25, 11),
(26, 11),
(42, 11),
(43, 11),
(44, 11),
(45, 11),
(46, 11),
(48, 11),
(49, 11),
(3, 12),
(4, 12),
(5, 12),
(6, 12),
(7, 12),
(8, 12),
(15, 12),
(23, 12),
(24, 12),
(25, 12),
(26, 12),
(31, 12),
(32, 12),
(34, 12),
(35, 12),
(36, 12),
(37, 12),
(42, 12),
(43, 12),
(44, 12),
(45, 12),
(46, 12),
(47, 12),
(48, 12),
(50, 12);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
('00c4df56-a91b-45c6-a59c-e02577442072', 'Full Payment', '2020-01-18 04:37:05', '2020-01-18 04:37:05'),
('0fb7f4e6-e293-429d-8761-f978dc850a97', 'Complete Process', '2019-09-20 15:37:41', '2019-09-20 15:37:41'),
('106da5a6-2c71-4a08-9342-db3fd8ebf71e', 'Receipt Created', '2020-01-12 22:21:22', '2020-01-12 22:21:22'),
('2b643e21-a94c-4713-93f1-f1cbde6ad633', 'Active', '2019-09-04 07:11:54', '2019-09-04 07:11:54'),
('314f31d1-4e50-4ad9-ae8c-65f0f7ebfc43', 'Received', '2019-09-11 05:20:52', '2019-09-11 05:20:52'),
('3da32f6e-494f-4b61-b010-7ccc0e006fb3', 'Invoice Created', '2019-10-02 16:05:13', '2019-10-02 16:05:13'),
('458410e7-384d-47bc-bdbe-02115adc4449', 'Approve', '2019-09-10 13:07:06', '2019-09-10 13:07:06'),
('45e139a2-a423-46ef-8901-d07b25b461a3', 'Pending Process', '2019-09-20 15:37:41', '2019-09-20 15:37:41'),
('533806c2-19dc-4b24-886f-d783a8b448b7', 'Normal Stock', '2019-09-04 07:11:54', '2019-09-04 07:11:54'),
('596ae55c-c0fb-4880-8e06-56725b21f6dc', 'Purchase Close', '2020-01-17 18:27:39', '2020-01-17 18:27:39'),
('5af2f030-efe0-426e-819d-6df5f6fb8cc5', 'Pending - Transfer Stock', '2020-09-05 16:04:46', '2020-09-05 16:04:46'),
('5bc79891-e396-4792-a0f3-617ece2a00ce', 'Requested', '2019-09-20 16:14:02', '2019-09-20 16:14:02'),
('5f548276-3979-4308-94ec-7b5b59841688', 'Retur Stored', '2020-01-22 18:28:02', '2020-01-22 18:28:02'),
('6d32841b-2606-43a5-8cf7-b77291ddbfbb', 'Sales Close', '2020-01-16 19:59:06', '2020-01-16 19:59:06'),
('72ceba35-758d-4bc2-9295-fd9f9f393c56', 'Empty Stock', '2019-09-04 07:11:54', '2019-09-04 07:11:54'),
('805ec360-ebe1-4872-9798-a69dbac86a29', 'Payment Complete', '2020-09-21 20:25:09', '2020-09-21 20:25:09'),
('8083f49e-f0aa-4094-894f-f64cd2e9e4e9', 'Submit', '2019-09-04 07:11:54', '2019-09-04 07:11:54'),
('82e9ec8c-5a82-4009-ba2f-ab620eeaa71a', 'Suspended', '2019-09-04 07:11:54', '2019-09-04 07:11:54'),
('8447cd63-c7e7-4b26-81fc-d2eb3aceec97', 'Delivery Cancel', '2020-01-16 20:50:42', '2020-01-16 20:50:42'),
('ad5335ed-fc6e-42a1-a0e4-8b802acd6caa', 'Sales Suspend', '2020-01-16 19:59:06', '2020-01-16 19:59:06'),
('af0e1bc3-7acd-41b0-b926-5f54d2b6c8e8', 'Rejected', '2019-09-10 16:28:27', '2019-09-10 16:28:27'),
('c2fdba02-e765-4ee8-8c8c-3073209ddd26', 'On Process', '2019-09-04 07:11:54', '2019-09-04 07:11:54'),
('c51d7be2-7c72-41a8-93ff-03f780ece42a', 'Unpaid', '2019-09-04 07:11:54', '2019-09-04 07:11:54'),
('cc040768-2b4f-48df-867f-7da18b749e61', 'Partial Payment', '2020-01-18 04:37:05', '2020-01-18 04:37:05'),
('d4f7f9f3-4f5f-4063-b6ab-dc03f89ec87e', 'Ready - Stock Transferred', '2020-09-22 19:34:57', '2020-09-22 19:34:57'),
('d6c23804-3b9b-40ca-b050-146af5594f5d', 'Payment Made', '2020-01-12 22:21:22', '2020-01-12 22:21:22'),
('e3f73f52-00f7-47a6-9831-3a81b36f65e8', 'Delivery - Partial', '2020-08-26 20:19:09', '2020-08-26 20:19:09'),
('e7b1f161-fa81-447c-a9bc-f13a220ce534', 'Cancel Delivery', '2020-01-20 19:08:31', '2020-01-20 19:08:31'),
('e9395add-e815-4374-8ed3-c0d5f4481ab8', 'Delivered', '2019-09-04 07:11:54', '2019-09-04 07:11:54'),
('e9f870d8-ebe8-462e-a6b6-c03f4f5bd8eb', 'Retur Received', '2019-10-12 16:26:16', '2019-10-12 16:26:16'),
('eca81b8f-bfb9-48b9-8e8d-86f4517bc129', 'Payment Received', '2019-10-02 16:00:59', '2019-10-02 16:00:59'),
('f8b26119-fb0c-40ff-85c0-8fb85696f220', 'Low on Stock', '2019-09-04 07:11:54', '2019-09-04 07:11:54'),
('ffa20f52-a023-4333-b945-a46d04de961c', 'Transfered', '2019-09-22 15:04:09', '2019-09-22 15:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.jpg',
  `division_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2b643e21-a94c-4713-93f1-f1cbde6ad633',
  `last_login_at` datetime DEFAULT NULL,
  `last_login_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lockout_time` int NOT NULL DEFAULT '30',
  `session_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `division_id`, `status_id`, `last_login_at`, `last_login_from`, `lockout_time`, `session_id`, `remember_token`, `created_at`, `updated_at`) VALUES
('bb536994-ada3-4caa-b97b-e412dc2cc882', 'eko', 'eko@local.com', NULL, '$2y$10$iSHBp.VTgyBazpklQVtU1e.V16Yiwdy6ph7LAJ1Zi8sNdwQbA4r16', 'bb536994-ada3-4caa-b97b-e412dc2cc882_avatar1580087198.png', '413ec199-f1dd-42a7-a346-67a74fb807b0', '2b643e21-a94c-4713-93f1-f1cbde6ad633', '2023-11-20 13:24:38', '192.168.65.1', 30, 'RQfxWa4Ktz8pvY5venRhbpTHRfwU3CG9WrDfx4Df', NULL, '2019-09-04 06:31:44', '2023-11-20 13:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Bogor', 'bb536994-ada3-4caa-b97b-e412dc2cc882', NULL, NULL, '2023-11-20 14:50:16', '2023-11-20 14:50:16'),
(2, 'Bandung', 'bb536994-ada3-4caa-b97b-e412dc2cc882', NULL, NULL, '2023-11-20 14:50:21', '2023-11-20 14:50:21'),
(3, 'Yogyakarta', 'bb536994-ada3-4caa-b97b-e412dc2cc882', NULL, NULL, '2023-11-20 14:50:27', '2023-11-20 14:50:27'),
(4, 'Sidoarjo', 'bb536994-ada3-4caa-b97b-e412dc2cc882', NULL, NULL, '2023-11-20 14:50:33', '2023-11-20 14:50:33'),
(5, 'Malang', 'bb536994-ada3-4caa-b97b-e412dc2cc882', NULL, NULL, '2023-11-20 14:50:38', '2023-11-20 14:50:38'),
(6, 'Medan', 'bb536994-ada3-4caa-b97b-e412dc2cc882', NULL, NULL, '2023-11-20 14:50:43', '2023-11-20 14:50:43');

-- --------------------------------------------------------

--
-- Table structure for table `warranties`
--

CREATE TABLE `warranties` (
  `id` bigint UNSIGNED NOT NULL,
  `warranty_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warranties`
--

INSERT INTO `warranties` (`id`, `warranty_name`, `created_at`, `updated_at`) VALUES
(1, 'No Warranty', '2023-11-20 14:40:47', '2023-11-20 14:40:47'),
(2, '1 Month', '2023-11-20 14:40:47', '2023-11-20 14:40:47'),
(3, '3 Month', '2023-11-20 14:40:47', '2023-11-20 14:40:47'),
(4, '6 Month', '2023-11-20 14:40:47', '2023-11-20 14:40:47'),
(5, '12 Month', '2023-11-20 14:40:47', '2023-11-20 14:40:47'),
(6, '24 Month', '2023-11-20 14:40:47', '2023-11-20 14:40:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models_retur_items`
--
ALTER TABLE `models_retur_items`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_movements`
--
ALTER TABLE `product_movements`
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
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warranties`
--
ALTER TABLE `warranties`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `models_retur_items`
--
ALTER TABLE `models_retur_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_movements`
--
ALTER TABLE `product_movements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `warranties`
--
ALTER TABLE `warranties`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
