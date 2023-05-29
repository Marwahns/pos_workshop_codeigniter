-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 02:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_bengkel`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(371, '2023-05-13-092924', 'App\\Database\\Migrations\\Users', 'default', 'App', 1685244351, 1),
(372, '2023-05-13-111231', 'App\\Database\\Migrations\\StatusRoles', 'default', 'App', 1685244351, 1),
(373, '2023-05-13-111550', 'App\\Database\\Migrations\\Roles', 'default', 'App', 1685244351, 1),
(374, '2023-05-13-123821', 'App\\Database\\Migrations\\FkUsers', 'default', 'App', 1685244351, 1),
(375, '2023-05-14-173553', 'App\\Database\\Migrations\\Supplier', 'default', 'App', 1685244351, 1),
(376, '2023-05-15-052424', 'App\\Database\\Migrations\\Kategori', 'default', 'App', 1685244351, 1),
(377, '2023-05-15-065316', 'App\\Database\\Migrations\\SpareParts', 'default', 'App', 1685244352, 1),
(378, '2023-05-15-120152', 'App\\Database\\Migrations\\Stok', 'default', 'App', 1685244352, 1),
(379, '2023-05-26-063544', 'App\\Database\\Migrations\\Pelanggan', 'default', 'App', 1685244352, 1),
(380, '2023-05-26-084756', 'App\\Database\\Migrations\\Penjualan', 'default', 'App', 1685244352, 1),
(381, '2023-05-26-085518', 'App\\Database\\Migrations\\Transaksi', 'default', 'App', 1685244352, 1),
(382, '2023-05-26-090743', 'App\\Database\\Migrations\\BulanTahun', 'default', 'App', 1685244352, 1),
(383, '2023-05-28-032125', 'App\\Database\\Migrations\\Transaction', 'default', 'App', 1685244352, 1),
(384, '2023-05-28-032144', 'App\\Database\\Migrations\\TransactionItem', 'default', 'App', 1685244352, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bulan_tahun`
--

CREATE TABLE `tb_bulan_tahun` (
  `id` int(11) UNSIGNED NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bulan_tahun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_bulan_tahun`
--

INSERT INTO `tb_bulan_tahun` (`id`, `bulan`, `tahun`, `bulan_tahun`) VALUES
(1, 'Jan', 2022, '01-2022'),
(2, 'Feb', 2022, '02-2022'),
(3, 'Mar', 2022, '03-2022'),
(4, 'Apr', 2022, '04-2022'),
(5, 'Mei', 2022, '05-2022'),
(6, 'Jun', 2022, '06-2022'),
(7, 'Jul', 2022, '07-2022'),
(8, 'Agu', 2022, '08-2022'),
(9, 'Sep', 2022, '09-2022'),
(10, 'Okt', 2022, '10-2022'),
(11, 'Nov', 2022, '11-2022'),
(12, 'Des', 2022, '12-2022'),
(13, 'Jan', 2023, '01-2023'),
(14, 'Feb', 2023, '02-2023'),
(15, 'Mar', 2023, '03-2023'),
(16, 'Apr', 2023, '04-2023'),
(17, 'Mei', 2023, '05-2023'),
(18, 'Jun', 2023, '06-2023'),
(19, 'Jul', 2023, '07-2023'),
(20, 'Agu', 2023, '08-2023'),
(21, 'Sep', 2023, '09-2023'),
(22, 'Okt', 2023, '10-2023'),
(23, 'Nov', 2023, '11-2023'),
(24, 'Des', 2023, '12-2023'),
(25, 'Jan', 2024, '01-2024'),
(26, 'Feb', 2024, '02-2024'),
(27, 'Mar', 2024, '03-2024'),
(28, 'Apr', 2024, '04-2024'),
(29, 'Mei', 2024, '05-2024'),
(30, 'Jun', 2024, '06-2024'),
(31, 'Jul', 2024, '07-2024'),
(32, 'Agu', 2024, '08-2024'),
(33, 'Sep', 2024, '09-2024'),
(34, 'Okt', 2024, '10-2024'),
(35, 'Nov', 2024, '11-2024'),
(36, 'Des', 2024, '12-2024'),
(37, 'Jan', 2025, '01-2025'),
(38, 'Feb', 2025, '02-2025'),
(39, 'Mar', 2025, '03-2025'),
(40, 'Apr', 2025, '04-2025'),
(41, 'Mei', 2025, '05-2025'),
(42, 'Jun', 2025, '06-2025'),
(43, 'Jul', 2025, '07-2025'),
(44, 'Agu', 2025, '08-2025'),
(45, 'Sep', 2025, '09-2025'),
(46, 'Okt', 2025, '10-2025'),
(47, 'Nov', 2025, '11-2025'),
(48, 'Des', 2025, '12-2025'),
(49, 'Jan', 2026, '01-2026'),
(50, 'Feb', 2026, '02-2026'),
(51, 'Mar', 2026, '03-2026'),
(52, 'Apr', 2026, '04-2026'),
(53, 'Mei', 2026, '05-2026'),
(54, 'Jun', 2026, '06-2026'),
(55, 'Jul', 2026, '07-2026'),
(56, 'Agu', 2026, '08-2026'),
(57, 'Sep', 2026, '09-2026'),
(58, 'Okt', 2026, '10-2026'),
(59, 'Nov', 2026, '11-2026'),
(60, 'Des', 2026, '12-2026'),
(61, 'Jan', 2027, '01-2027'),
(62, 'Feb', 2027, '02-2027'),
(63, 'Mar', 2027, '03-2027'),
(64, 'Apr', 2027, '04-2027'),
(65, 'Mei', 2027, '05-2027'),
(66, 'Jun', 2027, '06-2027'),
(67, 'Jul', 2027, '07-2027'),
(68, 'Agu', 2027, '08-2027'),
(69, 'Sep', 2027, '09-2027'),
(70, 'Okt', 2027, '10-2027'),
(71, 'Nov', 2027, '11-2027'),
(72, 'Des', 2027, '12-2027'),
(73, 'Jan', 2028, '01-2028'),
(74, 'Feb', 2028, '02-2028'),
(75, 'Mar', 2028, '03-2028'),
(76, 'Apr', 2028, '04-2028'),
(77, 'Mei', 2028, '05-2028'),
(78, 'Jun', 2028, '06-2028'),
(79, 'Jul', 2028, '07-2028'),
(80, 'Agu', 2028, '08-2028'),
(81, 'Sep', 2028, '09-2028'),
(82, 'Okt', 2028, '10-2028'),
(83, 'Nov', 2028, '11-2028'),
(84, 'Des', 2028, '12-2028'),
(85, 'Jan', 2029, '01-2029'),
(86, 'Feb', 2029, '02-2029'),
(87, 'Mar', 2029, '03-2029'),
(88, 'Apr', 2029, '04-2029'),
(89, 'Mei', 2029, '05-2029'),
(90, 'Jun', 2029, '06-2029'),
(91, 'Jul', 2029, '07-2029'),
(92, 'Agu', 2029, '08-2029'),
(93, 'Sep', 2029, '09-2029'),
(94, 'Okt', 2029, '10-2029'),
(95, 'Nov', 2029, '11-2029'),
(96, 'Des', 2029, '12-2029'),
(97, 'Jan', 2030, '01-2030'),
(98, 'Feb', 2030, '02-2030'),
(99, 'Mar', 2030, '03-2030'),
(100, 'Apr', 2030, '04-2030'),
(101, 'Mei', 2030, '05-2030'),
(102, 'Jun', 2030, '06-2030'),
(103, 'Jul', 2030, '07-2030'),
(104, 'Agu', 2030, '08-2030'),
(105, 'Sep', 2030, '09-2030'),
(106, 'Okt', 2030, '10-2030'),
(107, 'Nov', 2030, '11-2030'),
(108, 'Des', 2030, '12-2030'),
(109, 'Jan', 2031, '01-2031'),
(110, 'Feb', 2031, '02-2031'),
(111, 'Mar', 2031, '03-2031'),
(112, 'Apr', 2031, '04-2031'),
(113, 'Mei', 2031, '05-2031'),
(114, 'Jun', 2031, '06-2031'),
(115, 'Jul', 2031, '07-2031'),
(116, 'Agu', 2031, '08-2031'),
(117, 'Sep', 2031, '09-2031'),
(118, 'Okt', 2031, '10-2031'),
(119, 'Nov', 2031, '11-2031'),
(120, 'Des', 2031, '12-2031'),
(121, 'Jan', 2032, '01-2032'),
(122, 'Feb', 2032, '02-2032'),
(123, 'Mar', 2032, '03-2032'),
(124, 'Apr', 2032, '04-2032'),
(125, 'Mei', 2032, '05-2032'),
(126, 'Jun', 2032, '06-2032'),
(127, 'Jul', 2032, '07-2032'),
(128, 'Agu', 2032, '08-2032'),
(129, 'Sep', 2032, '09-2032'),
(130, 'Okt', 2032, '10-2032'),
(131, 'Nov', 2032, '11-2032'),
(132, 'Des', 2032, '12-2032');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_kategori` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `kode_kategori`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'KTG1', 'Busi', '2023-05-28 10:26:33', NULL),
(2, 'KTG2', 'Kampas Rem', '2023-05-28 10:26:33', NULL),
(3, 'KTG3', 'Kopling', '2023-05-28 10:26:33', NULL),
(4, 'KTG4', 'Ban', '2023-05-28 10:26:33', NULL),
(5, 'KTG5', 'Radiator', '2023-05-28 10:26:33', NULL),
(6, 'KTG6', 'Oli', '2023-05-28 10:26:33', NULL),
(7, 'KTG7', 'Gear', '2023-05-28 10:26:33', NULL),
(8, 'KTG8', 'Rantai Motor', '2023-05-28 10:26:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `tipe` enum('Umum','Membership') NOT NULL DEFAULT 'Umum',
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id`, `nama`, `no_telepon`, `tipe`, `created_at`, `updated_at`) VALUES
(1, 'Umum', '-', 'Umum', '2023-05-28 10:26:37', NULL),
(2, 'Membership', '-', 'Membership', '2023-05-28 10:26:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `pelanggan_id` int(11) UNSIGNED NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `total_harga` int(11) UNSIGNED NOT NULL,
  `diskon` int(11) UNSIGNED NOT NULL,
  `total_akhir` int(11) UNSIGNED NOT NULL,
  `tunai` int(11) UNSIGNED NOT NULL,
  `kembalian` int(11) UNSIGNED NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_roles`
--

CREATE TABLE `tb_roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_roles`
--

INSERT INTO `tb_roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2023-05-28 10:26:45', NULL),
(2, 'Administrator', '2023-05-28 10:26:45', NULL),
(3, 'Kasir', '2023-05-28 10:26:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_spareparts`
--

CREATE TABLE `tb_spareparts` (
  `id` int(11) UNSIGNED NOT NULL,
  `supplier_id` int(11) UNSIGNED NOT NULL,
  `kategori_id` int(11) UNSIGNED NOT NULL,
  `kode_spareparts` varchar(255) NOT NULL,
  `spareparts` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_spareparts`
--

INSERT INTO `tb_spareparts` (`id`, `supplier_id`, `kategori_id`, `kode_spareparts`, `spareparts`, `harga`, `stok`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'SPR01', 'Spareparts 1', 100000, 10, NULL, '2023-05-28 10:27:02', NULL),
(2, 3, 1, 'SPR02', 'Spareparts 2', 90000, 4, NULL, '2023-05-28 10:27:02', NULL),
(3, 1, 2, 'SPR03', 'Spareparts 3', 50000, 7, NULL, '2023-05-28 10:27:02', NULL),
(4, 3, 3, 'SP1', 'Spareparts 4', 10000, 1, NULL, '2023-05-28 12:53:24', NULL),
(5, 4, 4, 'SP2', 'Spareparts 5', 43000, 0, NULL, '2023-05-28 20:46:20', NULL),
(6, 1, 8, 'SP6', 'Spareparts 6', 10000, 1, NULL, '2023-05-28 12:54:42', NULL),
(7, 2, 3, 'SP7', 'Spareparts 7', 10000, 2, NULL, '2023-05-28 20:46:00', NULL),
(8, 3, 2, 'SP8', 'Spareparts 8', 43000, 1, NULL, '2023-05-28 12:55:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_status_roles`
--

CREATE TABLE `tb_status_roles` (
  `id` int(1) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_status_roles`
--

INSERT INTO `tb_status_roles` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Active', '2023-05-28 03:26:48', NULL),
(2, 'InActive', '2023-05-28 03:26:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok`
--

CREATE TABLE `tb_stok` (
  `id` int(11) UNSIGNED NOT NULL,
  `spareparts_id` int(11) UNSIGNED NOT NULL,
  `supplier_id` int(11) UNSIGNED NOT NULL,
  `tipe` enum('masuk','keluar') DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_stok`
--

INSERT INTO `tb_stok` (`id`, `spareparts_id`, `supplier_id`, `tipe`, `jumlah`, `keterangan`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 7, 2, 'masuk', 1, 'stok masuk', '', '2023-05-28 13:46:00', '2023-05-28 13:46:00'),
(2, 5, 4, 'keluar', 1, 'barang rusak', '', '2023-05-28 13:46:20', '2023-05-28 13:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_supplier` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id`, `kode_supplier`, `nama`, `alamat`, `no_telepon`, `created_at`, `updated_at`) VALUES
(1, 'SPL1', 'Supplier A', 'Jakarta', '12345', '2023-05-28 10:26:57', NULL),
(2, 'SPL2', 'Supplier B', 'Bogor', '34567', '2023-05-28 10:26:57', NULL),
(3, 'SPL3', 'Supplier C', 'Bekasi', '123453', '2023-05-28 10:26:57', NULL),
(4, 'SPL4', 'Supplier D', 'Medan', '34564', '2023-05-28 10:26:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(11) UNSIGNED NOT NULL,
  `penjualan_id` int(11) UNSIGNED NOT NULL,
  `spareparts_id` int(11) UNSIGNED NOT NULL,
  `harga_produk` int(11) UNSIGNED NOT NULL,
  `jumlah_produk` int(11) UNSIGNED NOT NULL,
  `diskon_produk` int(11) UNSIGNED NOT NULL,
  `subtotal` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_status` int(11) UNSIGNED DEFAULT NULL,
  `id_role` int(11) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `id_status`, `id_role`, `email`, `username`, `password`, `nama`, `alamat`, `token`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'superadmin@gmail.com', 'superadmin', '$2y$10$wYeJeDulD9D/nL9soD/LeuQ6zdFf1uz4EFyulfmeMOj0eqKwE.iO2', 'Super Admin', 'Depok', NULL, '0.0.0.0', '2023-05-28 10:27:08', NULL),
(2, 1, 2, 'admin@gmail.com', 'admin', '$2y$10$ycMLHUiKqwN3A3xM9gjMxuRF8dexDf77qvtKuyEFZriMZ4nn5AeQu', 'Admin', 'Depok', NULL, '0.0.0.0', '2023-05-28 10:27:08', NULL),
(3, 1, 3, 'kasir@gmail.com', 'kasir', '$2y$10$8MLa/KHqc1brcUHCXj2yM.QhOWhaGH4c/WSyJCNlYQb0KsslNOnbe', 'Kasir', 'Depok', NULL, '0.0.0.0', '2023-05-28 10:27:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(30) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `customer` varchar(250) NOT NULL,
  `total_amount` float(12,2) NOT NULL DEFAULT 0.00,
  `tendered` float(12,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `transaction_id` int(30) UNSIGNED NOT NULL,
  `product_id` int(30) UNSIGNED NOT NULL,
  `price` float(12,2) NOT NULL DEFAULT 0.00,
  `quantity` int(30) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bulan_tahun`
--
ALTER TABLE `tb_bulan_tahun`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bulan` (`bulan`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_kategori` (`kode_kategori`),
  ADD UNIQUE KEY `kategori` (`kategori`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_telepon` (`no_telepon`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `invoice` (`invoice`);

--
-- Indexes for table `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indexes for table `tb_spareparts`
--
ALTER TABLE `tb_spareparts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_supplier_id` (`supplier_id`),
  ADD KEY `fk_kategori_id` (`kategori_id`);

--
-- Indexes for table `tb_status_roles`
--
ALTER TABLE `tb_status_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indexes for table `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_stok_supplier_id_foreign` (`supplier_id`),
  ADD KEY `spareparts_id_supplier_id` (`spareparts_id`,`supplier_id`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_supplier` (`kode_supplier`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD UNIQUE KEY `no_telepon` (`no_telepon`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`),
  ADD KEY `spareparts_id` (`spareparts_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_username` (`email`,`username`),
  ADD KEY `fk_id_status_role` (`id_status`),
  ADD KEY `fk_id_role` (`id_role`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD KEY `transaction_items_product_id_foreign` (`product_id`),
  ADD KEY `transaction_items_transaction_id_foreign` (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `tb_bulan_tahun`
--
ALTER TABLE `tb_bulan_tahun`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_roles`
--
ALTER TABLE `tb_roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_spareparts`
--
ALTER TABLE `tb_spareparts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_status_roles`
--
ALTER TABLE `tb_status_roles`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_stok`
--
ALTER TABLE `tb_stok`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `tb_penjualan_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `tb_pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_spareparts`
--
ALTER TABLE `tb_spareparts`
  ADD CONSTRAINT `fk_kategori_id` FOREIGN KEY (`kategori_id`) REFERENCES `tb_kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `tb_supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_stok`
--
ALTER TABLE `tb_stok`
  ADD CONSTRAINT `tb_stok_spareparts_id_foreign` FOREIGN KEY (`spareparts_id`) REFERENCES `tb_spareparts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_stok_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `tb_supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `tb_penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_spareparts_id_foreign` FOREIGN KEY (`spareparts_id`) REFERENCES `tb_spareparts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `fk_id_role` FOREIGN KEY (`id_role`) REFERENCES `tb_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_status_role` FOREIGN KEY (`id_status`) REFERENCES `tb_status_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `tb_spareparts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
