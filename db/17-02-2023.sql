-- --------------------------------------------------------
-- Host:                         172.17.10.10
-- Server version:               10.5.16-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for gkesewing
DROP DATABASE IF EXISTS `gkesewing`;
CREATE DATABASE IF NOT EXISTS `gkesewing` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gkesewing`;

-- Dumping structure for table gkesewing.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `account_code` int(11) unsigned NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `uti_account_post_id` int(11) NOT NULL,
  `uti_account_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`account_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.account: ~19 rows (approximately)
DELETE FROM `account`;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`account_code`, `account_name`, `uti_account_post_id`, `uti_account_group_id`) VALUES
	(112, 'BRI', 1, 1),
	(113, 'Bunga Bank', 1, 1),
	(211, 'Hutang', 2, 1),
	(311, 'Modal', 2, 1),
	(312, 'Piutang Usaha', 1, 1),
	(313, 'Laba ditahan', 2, 1),
	(411, 'Pendapatan', 2, 2),
	(511, 'Biaya Bahan', 1, 2),
	(512, 'Biaya Honor Bulanan', 1, 2),
	(513, 'Biaya Jasa Menjahit/Memotong', 1, 2),
	(514, 'Biaya Listrik', 1, 2),
	(515, 'Biaya Transportasi Pegawai', 1, 2),
	(516, 'Biaya Transportasi Barang', 1, 2),
	(517, 'Biaya Pemeliharaan', 1, 2),
	(518, 'Biaya Pulsa', 1, 2),
	(519, 'Biaya Bank', 1, 2),
	(520, 'Biaya ATK', 1, 2),
	(521, 'Biaya Rumah Tangga', 1, 2),
	(522, 'Biaya Kegiatan', 1, 2);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

-- Dumping structure for table gkesewing.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_phone` varchar(15) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` text DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_phone` (`customer_phone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.customer: ~4 rows (approximately)
DELETE FROM `customer`;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`customer_id`, `customer_phone`, `customer_name`, `customer_address`) VALUES
	(1, '123', 'Yani', 'Jl. Panjaitan'),
	(2, '12345', 'Yamano', 'Jl. Perintis kemerdekaan'),
	(3, 'dadasda', 'dasdasd', 'asdasdasd'),
	(4, '087815004679', 'efrnkwejnfwef', 'skdjfksdhf');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table gkesewing.employee
DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(255) NOT NULL,
  `employee_phone` varchar(15) DEFAULT NULL,
  `employee_type` enum('Tetap','Freelance') NOT NULL,
  `employee_status` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 Aktif, 0 Tidak Aktif',
  `employee_photo_path` text DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.employee: ~4 rows (approximately)
DELETE FROM `employee`;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_phone`, `employee_type`, `employee_status`, `employee_photo_path`) VALUES
	(1, 'Yamin', '123', 'Tetap', b'1', NULL),
	(2, 'Suni', '123123', 'Tetap', b'1', NULL),
	(3, 'Majur', '0909', 'Freelance', b'1', NULL),
	(9, 'Utuh', '089532037565', 'Tetap', b'1', 'data/employee-img/1674962182_563a6f3b4aecbbe69fa6.jpg');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;

-- Dumping structure for table gkesewing.ledger
DROP TABLE IF EXISTS `ledger`;
CREATE TABLE IF NOT EXISTS `ledger` (
  `ledger_code` char(20) NOT NULL,
  `ledger_number` int(11) NOT NULL,
  `ledger_name` varchar(255) DEFAULT NULL,
  `ledger_desc` text NOT NULL,
  `ledger_date` date NOT NULL,
  `transaction_code` varchar(20) DEFAULT NULL,
  `spending_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`ledger_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.ledger: ~3 rows (approximately)
DELETE FROM `ledger`;
/*!40000 ALTER TABLE `ledger` DISABLE KEYS */;
INSERT INTO `ledger` (`ledger_code`, `ledger_number`, `ledger_name`, `ledger_desc`, `ledger_date`, `transaction_code`, `spending_id`, `created_at`, `updated_at`) VALUES
	('506B4E0F331147E0328F', 2, 'Yani', 'Penjualan Stola Lurus', '2022-12-29', NULL, 9, NULL, NULL),
	('57BB5F3187B260CAC69B', 1, '', 'Pembayaran Honor Penjahit', '2022-12-29', '4', NULL, NULL, NULL),
	('D72E76D212F89D51D1AC', 3, 'Yani', 'Penjualan Stola Lurus', '2022-12-29', NULL, 9, NULL, NULL);
/*!40000 ALTER TABLE `ledger` ENABLE KEYS */;

-- Dumping structure for table gkesewing.ledger_detail
DROP TABLE IF EXISTS `ledger_detail`;
CREATE TABLE IF NOT EXISTS `ledger_detail` (
  `ledger_detail_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ledger_code` char(20) NOT NULL,
  `account_code` int(11) unsigned NOT NULL,
  `uti_account_post_id` int(11) unsigned NOT NULL,
  `ledger_detail_score` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`ledger_detail_id`) USING BTREE,
  KEY `account_code` (`account_code`) USING BTREE,
  KEY `ledger_id` (`ledger_code`) USING BTREE,
  KEY `uti_account_post_id` (`uti_account_post_id`),
  CONSTRAINT `ledger_detail_ibfk_1` FOREIGN KEY (`account_code`) REFERENCES `account` (`account_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gkesewing.ledger_detail: ~7 rows (approximately)
DELETE FROM `ledger_detail`;
/*!40000 ALTER TABLE `ledger_detail` DISABLE KEYS */;
INSERT INTO `ledger_detail` (`ledger_detail_id`, `ledger_code`, `account_code`, `uti_account_post_id`, `ledger_detail_score`, `created_at`, `updated_at`) VALUES
	(3, '57BB5F3187B260CAC69B', 112, 1, 100000, NULL, NULL),
	(4, '57BB5F3187B260CAC69B', 311, 2, 100000, NULL, NULL),
	(11, '506B4E0F331147E0328F', 112, 1, 160000, NULL, NULL),
	(12, '506B4E0F331147E0328F', 311, 2, 160000, NULL, NULL),
	(13, 'D72E76D212F89D51D1AC', 112, 1, 160000, NULL, NULL),
	(14, 'D72E76D212F89D51D1AC', 311, 2, 60000, NULL, NULL),
	(15, 'D72E76D212F89D51D1AC', 211, 2, 100000, NULL, NULL);
/*!40000 ALTER TABLE `ledger_detail` ENABLE KEYS */;

-- Dumping structure for table gkesewing.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(225) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_link` varchar(225) NOT NULL,
  `menu_sort` int(11) NOT NULL,
  `menu_icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gkesewing.menu: ~12 rows (approximately)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_parent`, `menu_link`, `menu_sort`, `menu_icon`) VALUES
	(1, 'Dashboard', 0, 'dashboard', 1, '<i data-feather="home"></i>'),
	(2, 'Data Master', 0, '#', 4, ''),
	(3, 'Pengguna', 2, 'pengguna', 4, '<i data-feather=\'user-check\'></i>'),
	(4, 'Karyawan', 2, 'karyawan', 1, '<i data-feather=\'briefcase\'></i>'),
	(5, 'Pelanggan', 2, 'pelanggan', 2, '<i data-feather=\'users\'></i>'),
	(6, 'Pemasok', 2, 'pemasok', 3, '<i data-feather=\'database\'></i>'),
	(7, 'Produk', 2, 'produk', 1, '<i data-feather=\'book-open\'></i>'),
	(8, 'Transaksi', 0, '#', 2, ''),
	(20, 'Penjualan', 8, 'transaksi/penjualan', 2, '<i data-feather=\'shopping-cart\'></i>'),
	(21, 'Pengeluaran', 8, 'transaksi/pengeluaran', 3, '<i data-feather=\'shopping-cart\'></i>'),
	(22, 'Buku Kas Umum', 0, '#', 3, ''),
	(23, 'Buku Jurnal', 22, 'bku/buku-jurnal', 1, '<i data-feather=\'book-open\'></i>');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table gkesewing.menu_role
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE IF NOT EXISTS `menu_role` (
  `menu_role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) unsigned NOT NULL,
  `user_level_id` int(11) unsigned NOT NULL,
  `menu_role_action` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`menu_role_id`) USING BTREE,
  KEY `menu_id` (`menu_id`),
  KEY `level` (`user_level_id`) USING BTREE,
  CONSTRAINT `FK_menu_role_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_menu_role_user_level` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`user_level_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table gkesewing.menu_role: ~12 rows (approximately)
DELETE FROM `menu_role`;
/*!40000 ALTER TABLE `menu_role` DISABLE KEYS */;
INSERT INTO `menu_role` (`menu_role_id`, `menu_id`, `user_level_id`, `menu_role_action`) VALUES
	(1, 1, 1, 1),
	(2, 2, 1, 1),
	(3, 3, 1, 1),
	(4, 4, 1, 1),
	(5, 5, 1, 1),
	(6, 6, 1, 1),
	(7, 7, 1, 1),
	(8, 8, 1, 1),
	(9, 20, 1, 1),
	(10, 21, 1, 1),
	(11, 22, 1, 1),
	(12, 23, 1, 1);
/*!40000 ALTER TABLE `menu_role` ENABLE KEYS */;

-- Dumping structure for table gkesewing.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_buy` int(11) NOT NULL,
  `uti_product_category_id` int(11) unsigned NOT NULL,
  `product_status` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 Aktif, 0 Tidak Aktif',
  PRIMARY KEY (`product_id`),
  KEY `FK_product_uti_product_category` (`uti_product_category_id`),
  CONSTRAINT `FK_product_uti_product_category` FOREIGN KEY (`uti_product_category_id`) REFERENCES `uti_product_category` (`uti_product_category_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.product: ~5 rows (approximately)
DELETE FROM `product`;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`product_id`, `product_name`, `product_unit`, `product_price`, `product_buy`, `uti_product_category_id`, `product_status`) VALUES
	(1, 'Stola Lurus', 'Set', 80000, 0, 1, b'1'),
	(2, 'Stola Lengkung', 'Set', 90000, 0, 1, b'1'),
	(3, 'Jubah Pendeta', 'Set', 625000, 500000, 2, b'1'),
	(4, 'Jubah Pendeta Tanpa Bludru', 'Set', 625000, 500000, 2, b'1'),
	(5, 'Sepati', '2', 25000, 20000, 1, b'1');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table gkesewing.supplier
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_company` varchar(255) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_phone` varchar(15) NOT NULL,
  `supplier_address` text NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.supplier: ~1 rows (approximately)
DELETE FROM `supplier`;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`supplier_id`, `supplier_company`, `supplier_name`, `supplier_phone`, `supplier_address`) VALUES
	(1, 'Turatut', 'Turatut@gmail.com', '0824438472', 'Jl.ngarang');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;

-- Dumping structure for table gkesewing.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_code` varchar(20) NOT NULL,
  `employee_id` int(11) unsigned NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_desc` text NOT NULL,
  `is_ledger` bit(1) NOT NULL DEFAULT b'0' COMMENT '0 = Belum BKU, 1 = Sudah BKU',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`transaction_code`) USING BTREE,
  KEY `employee_id` (`employee_id`),
  KEY `customer_phone` (`customer_phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.transaction: ~3 rows (approximately)
DELETE FROM `transaction`;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` (`transaction_code`, `employee_id`, `customer_phone`, `transaction_date`, `transaction_desc`, `is_ledger`, `created_at`, `updated_at`) VALUES
	('09D4BF3C6042FC13D241', 1, '123', '2022-12-20', 'Penjualan Stola Lurus', b'0', NULL, '2022-12-20 19:49:16'),
	('653C8489AC47C2D9530E', 1, '087815004679', '2023-01-29', 'ewkjnkwenf', b'0', NULL, NULL),
	('ADEE1EA920B768024BEE', 9, '087815004679', '2023-01-29', 'wejnekrng', b'0', NULL, NULL);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;

-- Dumping structure for table gkesewing.transaction_detail
DROP TABLE IF EXISTS `transaction_detail`;
CREATE TABLE IF NOT EXISTS `transaction_detail` (
  `transaction_detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(20) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `transaction_detail_discount` float NOT NULL DEFAULT 0,
  `transaction_detail_price` double NOT NULL DEFAULT 0,
  `transaction_detail_quantity` double NOT NULL DEFAULT 0,
  `transaction_detail_total` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`transaction_detail_id`),
  KEY `transaction_code` (`transaction_code`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `FK_transaction_detail_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_transaction_detail_transaction` FOREIGN KEY (`transaction_code`) REFERENCES `transaction` (`transaction_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.transaction_detail: ~3 rows (approximately)
DELETE FROM `transaction_detail`;
/*!40000 ALTER TABLE `transaction_detail` DISABLE KEYS */;
INSERT INTO `transaction_detail` (`transaction_detail_id`, `transaction_code`, `product_id`, `product_name`, `category_name`, `product_unit`, `transaction_detail_discount`, `transaction_detail_price`, `transaction_detail_quantity`, `transaction_detail_total`, `created_at`, `updated_at`) VALUES
	(15, '09D4BF3C6042FC13D241', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 2, 160000, NULL, NULL),
	(16, 'ADEE1EA920B768024BEE', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 1, 80000, NULL, NULL),
	(17, '653C8489AC47C2D9530E', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 1, 80000, NULL, NULL);
/*!40000 ALTER TABLE `transaction_detail` ENABLE KEYS */;

-- Dumping structure for table gkesewing.transaction_detail_temp
DROP TABLE IF EXISTS `transaction_detail_temp`;
CREATE TABLE IF NOT EXISTS `transaction_detail_temp` (
  `detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(20) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `transaction_detail_discount` float NOT NULL DEFAULT 0,
  `transaction_detail_price` double NOT NULL DEFAULT 0,
  `transaction_detail_quantity` double NOT NULL DEFAULT 0,
  `transaction_detail_total` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`detail_id`) USING BTREE,
  KEY `transaction_code` (`transaction_code`) USING BTREE,
  KEY `product_id` (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gkesewing.transaction_detail_temp: ~0 rows (approximately)
DELETE FROM `transaction_detail_temp`;
/*!40000 ALTER TABLE `transaction_detail_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_detail_temp` ENABLE KEYS */;

-- Dumping structure for table gkesewing.transaction_spending
DROP TABLE IF EXISTS `transaction_spending`;
CREATE TABLE IF NOT EXISTS `transaction_spending` (
  `spending_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `spending_date` date NOT NULL,
  `spending_desc` text NOT NULL,
  `spending_total` double NOT NULL,
  `spending_photo_path` text NOT NULL,
  `is_ledger` bit(1) NOT NULL DEFAULT b'0' COMMENT '0 = Belum BKU, 1 = Sudah BKU',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`spending_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.transaction_spending: ~3 rows (approximately)
DELETE FROM `transaction_spending`;
/*!40000 ALTER TABLE `transaction_spending` DISABLE KEYS */;
INSERT INTO `transaction_spending` (`spending_id`, `employee_id`, `supplier_id`, `spending_date`, `spending_desc`, `spending_total`, `spending_photo_path`, `is_ledger`, `created_at`, `updated_at`) VALUES
	(4, 1, 0, '2022-12-20', 'Pembayaran Honor Penjahit', 125000, 'data/img/pengeluaran/1674963267_317a1a147f68fd189619.jpg', b'0', '2022-12-20 09:08:34', '2023-01-29 14:46:54'),
	(7, 9, 0, '2023-01-29', 'kewjfbkebfr', 20000, 'data/img/pengeluaran/1674963267_317a1a147f68fd189619.jpg', b'0', '2023-01-29 11:40:04', '2023-01-29 14:46:54'),
	(8, 9, 0, '2023-01-29', 'ewkfjkewfb', 12000, 'data/img/pengeluaran/1674975084_86e00e268677f9fc2abe.jpeg', b'0', '2023-01-29 14:51:24', '2023-01-29 14:51:24');
/*!40000 ALTER TABLE `transaction_spending` ENABLE KEYS */;

-- Dumping structure for table gkesewing.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_level_id` int(11) unsigned NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_is_active` int(11) NOT NULL DEFAULT 1,
  `employee_id` int(11) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`) USING BTREE,
  KEY `FK_user_user_level` (`user_level_id`),
  KEY `FK_user_employee` (`employee_id`),
  CONSTRAINT `FK_user_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_user_user_level` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`user_level_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.user: ~2 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `user_level_id`, `user_username`, `user_password`, `user_name`, `user_is_active`, `employee_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 'admin', '$2y$10$G6od4Fc03ualqN8lBdLaVeGlrdmtQ8XcXTHnYBgev0qZhQ4vQzQmi', 'Administrator', 1, NULL, '2022-09-19 11:46:57', '2022-09-29 20:25:26'),
	(3, 1, 'yudhayudha', '$2y$10$.N45I5e52rkHZSi.czhde.7RMEkik2nHrQLSn6x29hRKQbKgcDBaa', 'yudhayudha', 1, NULL, '2023-01-29 12:27:48', '2023-01-29 12:27:48');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table gkesewing.user_level
DROP TABLE IF EXISTS `user_level`;
CREATE TABLE IF NOT EXISTS `user_level` (
  `user_level_id` int(11) unsigned NOT NULL,
  `user_level_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_level_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.user_level: ~2 rows (approximately)
DELETE FROM `user_level`;
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` (`user_level_id`, `user_level_name`) VALUES
	(1, 'Administrator'),
	(2, 'Pegawai');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;

-- Dumping structure for table gkesewing.uti_account_group
DROP TABLE IF EXISTS `uti_account_group`;
CREATE TABLE IF NOT EXISTS `uti_account_group` (
  `uti_account_group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uti_account_group_name` varchar(50) NOT NULL,
  `uti_account_group_alias` char(5) NOT NULL,
  PRIMARY KEY (`uti_account_group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.uti_account_group: ~2 rows (approximately)
DELETE FROM `uti_account_group`;
/*!40000 ALTER TABLE `uti_account_group` DISABLE KEYS */;
INSERT INTO `uti_account_group` (`uti_account_group_id`, `uti_account_group_name`, `uti_account_group_alias`) VALUES
	(1, 'Neraca', 'NRC'),
	(2, 'Laba Rugi', 'L/R');
/*!40000 ALTER TABLE `uti_account_group` ENABLE KEYS */;

-- Dumping structure for table gkesewing.uti_account_post
DROP TABLE IF EXISTS `uti_account_post`;
CREATE TABLE IF NOT EXISTS `uti_account_post` (
  `uti_account_post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uti_account_post_name` varchar(50) NOT NULL,
  `uti_account_post_alias` char(5) NOT NULL,
  PRIMARY KEY (`uti_account_post_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.uti_account_post: ~2 rows (approximately)
DELETE FROM `uti_account_post`;
/*!40000 ALTER TABLE `uti_account_post` DISABLE KEYS */;
INSERT INTO `uti_account_post` (`uti_account_post_id`, `uti_account_post_name`, `uti_account_post_alias`) VALUES
	(1, 'Debit', 'DB'),
	(2, 'Kredit', 'KR');
/*!40000 ALTER TABLE `uti_account_post` ENABLE KEYS */;

-- Dumping structure for table gkesewing.uti_product_category
DROP TABLE IF EXISTS `uti_product_category`;
CREATE TABLE IF NOT EXISTS `uti_product_category` (
  `uti_product_category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uti_product_category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`uti_product_category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.uti_product_category: ~2 rows (approximately)
DELETE FROM `uti_product_category`;
/*!40000 ALTER TABLE `uti_product_category` DISABLE KEYS */;
INSERT INTO `uti_product_category` (`uti_product_category_id`, `uti_product_category_name`) VALUES
	(1, 'Retail'),
	(2, 'Jasa');
/*!40000 ALTER TABLE `uti_product_category` ENABLE KEYS */;

-- Dumping structure for trigger gkesewing.menus_after_insert
DROP TRIGGER IF EXISTS `menus_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `menus_after_insert` AFTER INSERT ON `menu` FOR EACH ROW BEGIN
insert menu_role (menu_id, user_level_id, menu_role_action) values (new.menu_id, 1, 1);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
