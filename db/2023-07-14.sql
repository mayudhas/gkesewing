-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for gkesewing
DROP DATABASE IF EXISTS `gkesewing`;
CREATE DATABASE IF NOT EXISTS `gkesewing` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gkesewing`;

-- Dumping structure for table gkesewing.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `account_code` int unsigned NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `uti_account_post_id` int NOT NULL,
  `uti_account_group_id` int DEFAULT NULL,
  PRIMARY KEY (`account_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.account: ~19 rows (approximately)
DELETE FROM `account`;
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

-- Dumping structure for table gkesewing.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int unsigned NOT NULL AUTO_INCREMENT,
  `customer_phone` varchar(15) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` text,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_phone` (`customer_phone`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.customer: ~20 rows (approximately)
DELETE FROM `customer`;
INSERT INTO `customer` (`customer_id`, `customer_phone`, `customer_name`, `customer_address`) VALUES
	(1, '123', 'Yani', 'Jl. Panjaitan'),
	(2, '12345', 'Yamano', 'Jl. Perintis kemerdekaan'),
	(3, 'dadasda', 'dasdasd', 'asdasdasd'),
	(5, '-', 'Pdt. Herlina', '-'),
	(15, '05113354856', 'Resort GKE Marikit', 'Jl. Jend. Sudirman No 4 Banjarmasin'),
	(16, '=', 'Indah', 'P. Pisau'),
	(17, '5', 'Pdt. Arianutiasi', 'Kapuas'),
	(18, '6', 'Tirta', 'Buntok'),
	(19, '7', 'Apri', 'Palangkaraya'),
	(20, '8', 'Pdt. Mezi', 'Banjarmasin'),
	(21, '9', 'Emide Sawali', 'Kapuas'),
	(22, '10', 'Jhonna', 'Banjarmasin'),
	(23, '11', 'Dany', 'Banjarmasin'),
	(24, '12', 'Selpi', 'Kapuas'),
	(25, '13', 'Cita', 'Kapuas'),
	(26, '14', 'Mariati', 'Banjarmasin'),
	(27, '083141411862', 'Harry', 'Sinode GKE'),
	(28, '123456789', 'Operator', 'Jl.'),
	(29, '085348824545', 'Yusda', '-'),
	(30, '082255945588', 'enrico frigia', 'Rawasari 23 komp punama no 11 e');

-- Dumping structure for table gkesewing.employee
DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int unsigned NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(255) NOT NULL,
  `employee_phone` varchar(15) DEFAULT NULL,
  `employee_type` enum('Tetap','Freelance') NOT NULL,
  `employee_status` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 Aktif, 0 Tidak Aktif',
  `employee_photo_path` text,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.employee: ~3 rows (approximately)
DELETE FROM `employee`;
INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_phone`, `employee_type`, `employee_status`, `employee_photo_path`) VALUES
	(11, 'Endang', '083141411862', 'Tetap', b'1', NULL),
	(12, 'Sherlyana T', '081250710290', 'Tetap', b'1', NULL),
	(13, 'Yuanita', '081349606908', 'Tetap', b'1', NULL);

-- Dumping structure for table gkesewing.ledger
DROP TABLE IF EXISTS `ledger`;
CREATE TABLE IF NOT EXISTS `ledger` (
  `ledger_code` char(20) NOT NULL,
  `ledger_number` int NOT NULL,
  `ledger_name` varchar(255) DEFAULT NULL,
  `ledger_desc` text NOT NULL,
  `ledger_date` date NOT NULL,
  `transaction_code` varchar(20) DEFAULT NULL,
  `spending_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ledger_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.ledger: ~8 rows (approximately)
DELETE FROM `ledger`;
INSERT INTO `ledger` (`ledger_code`, `ledger_number`, `ledger_name`, `ledger_desc`, `ledger_date`, `transaction_code`, `spending_id`, `created_at`, `updated_at`) VALUES
	('243988E9FE5088D4EDE0', 3, 'Cita', 'Pembelian stola lurus dan pin', '2023-03-22', NULL, 0, NULL, NULL),
	('506B4E0F331147E0328F', 2, 'Yani', 'Penjualan Stola Lurus', '2022-12-29', NULL, 9, NULL, NULL),
	('57BB5F3187B260CAC69B', 1, '', 'Pembayaran Honor Penjahit', '2022-12-29', '4', NULL, NULL, NULL),
	('944A7BE36E4848BF9689', 4, 'Selpi', 'Pembelian stola lengkung', '2023-03-22', NULL, 0, NULL, NULL),
	('9CF7F7EF0C96F4DE5AB6', 1, 'Indah', 'Pembelian Pin', '2023-03-22', NULL, 244, NULL, NULL),
	('D72E76D212F89D51D1AC', 3, 'Yani', 'Penjualan Stola Lurus', '2022-12-29', NULL, 9, NULL, NULL),
	('E0D0E17DDBC2FB913BAD', 4, 'Selpi', 'Pembelian stola lengkung', '2023-03-22', NULL, 0, NULL, NULL),
	('EE4E9A539F14F70CD0A9', 2, 'Pdt. Mezi', 'Pembelian White collar dan Dasi Jubah', '2023-03-22', NULL, 0, NULL, NULL);

-- Dumping structure for table gkesewing.ledger_detail
DROP TABLE IF EXISTS `ledger_detail`;
CREATE TABLE IF NOT EXISTS `ledger_detail` (
  `ledger_detail_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ledger_code` char(20) NOT NULL,
  `account_code` int unsigned NOT NULL,
  `uti_account_post_id` int unsigned NOT NULL,
  `ledger_detail_score` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ledger_detail_id`) USING BTREE,
  KEY `account_code` (`account_code`) USING BTREE,
  KEY `ledger_id` (`ledger_code`) USING BTREE,
  KEY `uti_account_post_id` (`uti_account_post_id`),
  CONSTRAINT `ledger_detail_ibfk_1` FOREIGN KEY (`account_code`) REFERENCES `account` (`account_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gkesewing.ledger_detail: ~17 rows (approximately)
DELETE FROM `ledger_detail`;
INSERT INTO `ledger_detail` (`ledger_detail_id`, `ledger_code`, `account_code`, `uti_account_post_id`, `ledger_detail_score`, `created_at`, `updated_at`) VALUES
	(3, '57BB5F3187B260CAC69B', 112, 1, 100000, NULL, NULL),
	(4, '57BB5F3187B260CAC69B', 311, 2, 100000, NULL, NULL),
	(11, '506B4E0F331147E0328F', 112, 1, 160000, NULL, NULL),
	(12, '506B4E0F331147E0328F', 311, 2, 160000, NULL, NULL),
	(13, 'D72E76D212F89D51D1AC', 112, 1, 160000, NULL, NULL),
	(14, 'D72E76D212F89D51D1AC', 311, 2, 60000, NULL, NULL),
	(15, 'D72E76D212F89D51D1AC', 211, 2, 100000, NULL, NULL),
	(16, '9CF7F7EF0C96F4DE5AB6', 112, 1, 50000, NULL, NULL),
	(17, '9CF7F7EF0C96F4DE5AB6', 311, 2, 50000, NULL, NULL),
	(18, 'EE4E9A539F14F70CD0A9', 112, 1, 500000, NULL, NULL),
	(19, 'EE4E9A539F14F70CD0A9', 311, 2, 945000, NULL, NULL),
	(20, 'EE4E9A539F14F70CD0A9', 211, 1, 445000, NULL, NULL),
	(21, '243988E9FE5088D4EDE0', 112, 1, 100000, NULL, NULL),
	(22, '243988E9FE5088D4EDE0', 311, 2, 100000, NULL, NULL),
	(23, 'E0D0E17DDBC2FB913BAD', 112, 1, 100000, NULL, NULL),
	(24, 'E0D0E17DDBC2FB913BAD', 211, 2, 80000, NULL, NULL),
	(25, '944A7BE36E4848BF9689', 112, 1, 20000, NULL, NULL);

-- Dumping structure for table gkesewing.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(225) NOT NULL,
  `menu_parent` int NOT NULL,
  `menu_link` varchar(225) NOT NULL,
  `menu_sort` int NOT NULL,
  `menu_icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gkesewing.menu: ~17 rows (approximately)
DELETE FROM `menu`;
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
	(23, 'Buku Jurnal', 22, 'bku/buku-jurnal', 1, '<i data-feather=\'book-open\'></i>'),
	(25, 'Pembatalan', 0, '#', 5, NULL),
	(26, 'Penjualan', 25, 'pembatalan/penjualan', 1, '<i data-feather=\'x\'></i>'),
	(27, 'Laporan', 0, '#', 6, NULL),
	(28, 'Buku Besar', 27, 'laporan/buku-besar', 1, '<i data-feather=\'book-open\'></i>'),
	(29, 'Jurnal', 27, 'laporan/jurnal', 2, '<i data-feather=\'dollar-sign\'></i>');

-- Dumping structure for table gkesewing.menu_role
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE IF NOT EXISTS `menu_role` (
  `menu_role_id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int unsigned NOT NULL,
  `user_level_id` int unsigned NOT NULL,
  `menu_role_action` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`menu_role_id`) USING BTREE,
  KEY `menu_id` (`menu_id`),
  KEY `level` (`user_level_id`) USING BTREE,
  CONSTRAINT `FK_menu_role_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_menu_role_user_level` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`user_level_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table gkesewing.menu_role: ~17 rows (approximately)
DELETE FROM `menu_role`;
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
	(12, 23, 1, 1),
	(14, 25, 1, 1),
	(15, 26, 1, 1),
	(16, 27, 1, 1),
	(17, 28, 1, 1),
	(18, 29, 1, 1);

-- Dumping structure for table gkesewing.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `product_price` int NOT NULL,
  `product_buy` int NOT NULL,
  `uti_product_category_id` int unsigned NOT NULL,
  `product_status` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 Aktif, 0 Tidak Aktif',
  PRIMARY KEY (`product_id`),
  KEY `FK_product_uti_product_category` (`uti_product_category_id`),
  CONSTRAINT `FK_product_uti_product_category` FOREIGN KEY (`uti_product_category_id`) REFERENCES `uti_product_category` (`uti_product_category_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.product: ~73 rows (approximately)
DELETE FROM `product`;
INSERT INTO `product` (`product_id`, `product_name`, `product_unit`, `product_price`, `product_buy`, `uti_product_category_id`, `product_status`) VALUES
	(1, 'Stola Lurus', 'Lembar', 80000, 0, 1, b'1'),
	(2, 'Stola Lengkung', 'Lembar', 90000, 0, 1, b'1'),
	(3, 'Jubah Pendeta', 'Set', 625000, 500000, 2, b'1'),
	(4, 'Jubah Pendeta Tanpa Bludru', 'Set', 625000, 500000, 2, b'1'),
	(6, 'Jubah Putih Liturgos (L/P)', '1', 400000, 0, 1, b'1'),
	(7, 'Bendera Organisasi GKE', '1', 900000, 0, 1, b'1'),
	(8, 'Bendera Ouikumene Small', '1', 250000, 0, 1, b'1'),
	(9, 'Bendera Ouikumene Large', '1', 275000, 0, 1, b'1'),
	(10, 'Bendera Mimbar Small', '1', 250000, 0, 1, b'1'),
	(11, 'Bendera Mimbar Large', '1', 350000, 0, 1, b'1'),
	(12, 'Bendera Kematian', '1', 175000, 0, 1, b'1'),
	(13, 'Kantong Kolekte Bludru G1', '1', 100000, 0, 1, b'1'),
	(14, 'Kantong Kolekte Bludru G2', '1', 120000, 0, 1, b'1'),
	(15, 'Kantong Kolekte Tessa G1', '1', 80000, 0, 2, b'1'),
	(16, 'Kantong Kolekte Tessa G2', '1', 100000, 0, 1, b'1'),
	(17, 'Blus Collar Katun Tangan Pendek', '1', 350000, 0, 1, b'1'),
	(18, 'Blus Collar Katun Tangan Panjang', '1', 375000, 0, 1, b'1'),
	(19, 'Blus Collar Sintetis Tangan Pendek', '1', 325000, 0, 1, b'1'),
	(20, 'Blus Collar Sintetis Tangan Panjang', '1', 350000, 0, 1, b'1'),
	(21, 'Hem Collar Katun Tangan Pendek', '1', 350000, 0, 1, b'1'),
	(22, 'Hem Collar Katun Tangan Panjang', '1', 375000, 0, 1, b'1'),
	(23, 'Hem Collar Sintetis Tangan Pendek', '1', 325000, 0, 1, b'1'),
	(24, 'Hem Collar Sintetis Tangan Panjang', '1', 350000, 0, 1, b'1'),
	(25, 'Dress Collar', '1', 400000, 0, 1, b'1'),
	(26, 'Celemek Collar', '1', 175000, 0, 1, b'1'),
	(27, 'Collar Tanpa Lengan', '1', 300000, 0, 1, b'1'),
	(28, 'Hiasan Mimbar', '1', 150000, 0, 1, b'1'),
	(29, 'Pin GKE Small', '1', 10000, 0, 1, b'1'),
	(30, 'Pin GKE Large', '1', 15000, 0, 1, b'1'),
	(31, 'White Collar', '1', 35000, 0, 1, b'1'),
	(32, 'Logo GKE (Bular)', '1', 25000, 0, 1, b'1'),
	(33, 'Logo Tulisan', '1', 10000, 0, 1, b'1'),
	(34, 'Logo Stola / Set', '1', 35000, 0, 1, b'1'),
	(35, 'Collar Manik', '1', 150000, 0, 1, b'1'),
	(36, 'Dasi Jubah Pdt', '1', 50000, 0, 1, b'1'),
	(37, 'Jahit Jubah Pdt', '1', 700000, 0, 2, b'1'),
	(38, 'Jahit Jubah Pdt Tanpa Bludru', '1', 400000, 0, 2, b'1'),
	(39, 'Jahit Jubah Liturgos', '1', 200000, 0, 2, b'1'),
	(40, 'Jahit Blus Lengan Panjang', '1', 125000, 0, 2, b'1'),
	(41, 'Jahit Blus Lengan Pendek', '1', 100000, 0, 2, b'1'),
	(42, 'Jahit Dress', '1', 165000, 0, 2, b'1'),
	(43, 'Jahit Dress Panjang', '1', 185000, 0, 2, b'1'),
	(44, 'Jahit Rok', '1', 100000, 0, 2, b'1'),
	(45, 'Jahit Rok Panjang', '1', 150000, 0, 2, b'1'),
	(46, 'Jahit Kulot', '1', 100000, 0, 2, b'1'),
	(47, 'Jahit Hem Lengan Panjang', '1', 150000, 0, 2, b'1'),
	(48, 'Jahit Hem Lengan Pendek', '1', 125000, 0, 2, b'1'),
	(49, 'Jahit Bendera Mimbar', '1', 75000, 0, 2, b'1'),
	(50, 'Jahit Taplak Meja Mimbar Large', '1', 300000, 0, 2, b'1'),
	(51, 'Jahit Taplak Meja Mimbar Medium', '1', 225000, 0, 2, b'1'),
	(52, 'Jahit Taplak Meja Mimbar Small', '1', 175000, 0, 2, b'1'),
	(53, 'Benang Jahit', 'Kotak', 23000, 0, 1, b'1'),
	(54, 'Puring Ashi', 'm', 15000, 0, 1, b'1'),
	(55, 'Purring Arrow', 'm', 16000, 0, 1, b'1'),
	(56, 'Lpias Gula', 'm', 22000, 0, 1, b'1'),
	(57, 'Visilin', 'm', 8000, 0, 1, b'1'),
	(58, 'Benang Obras', 'pcs', 16000, 0, 1, b'1'),
	(59, 'Ritz biasa 50 cm', 'pcs', 5000, 0, 1, b'1'),
	(60, 'Ritz Jepang 50 cm', 'pcs', 11000, 0, 1, b'1'),
	(61, 'Satin Jeruk', 'm', 30000, 0, 1, b'1'),
	(62, 'Dedel Kayu', 'pcs', 10000, 0, 1, b'1'),
	(63, 'Gunting kain', 'pcs', 40000, 0, 1, b'1'),
	(64, 'Meteran Tebal', 'pcs', 10000, 0, 1, b'1'),
	(65, 'Meteran Biasa', 'pcs', 2000, 0, 1, b'1'),
	(66, 'Mata Nenek', 'pcs', 2000, 0, 1, b'1'),
	(67, 'Jarum Tangan Premium', 'bks', 15000, 0, 1, b'1'),
	(68, 'Kapur Jahit', 'pcs', 2000, 0, 1, b'1'),
	(69, 'Minyak Mesin', 'botol', 10000, 0, 1, b'1'),
	(70, 'Sekoci Luar', 'bh', 12000, 0, 1, b'1'),
	(71, 'Seocki Dalam / Spul', 'bh', 7000, 0, 1, b'1'),
	(72, 'Tali mesin', 'bh', 6000, 0, 1, b'1'),
	(73, 'Rumbai', 'rol', 40000, 0, 1, b'1'),
	(74, 'Kacing Putih / HItam', 'gross', 20000, 0, 1, b'1');

-- Dumping structure for table gkesewing.supplier
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int unsigned NOT NULL AUTO_INCREMENT,
  `supplier_company` varchar(255) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_phone` varchar(15) NOT NULL,
  `supplier_address` text NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.supplier: ~0 rows (approximately)
DELETE FROM `supplier`;

-- Dumping structure for table gkesewing.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_code` varchar(20) NOT NULL,
  `employee_id` int unsigned NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_desc` text NOT NULL,
  `is_ledger` bit(1) NOT NULL DEFAULT b'0' COMMENT '0 = Belum BKU, 1 = Sudah BKU',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_code`) USING BTREE,
  KEY `employee_id` (`employee_id`),
  KEY `customer_phone` (`customer_phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.transaction: ~36 rows (approximately)
DELETE FROM `transaction`;
INSERT INTO `transaction` (`transaction_code`, `employee_id`, `customer_phone`, `transaction_date`, `transaction_desc`, `is_ledger`, `created_at`, `updated_at`) VALUES
	('0244BEE31ADD2AA0006E', 11, '=', '2023-01-04', 'Pembelian Pin', b'0', NULL, NULL),
	('031D2269CF0DF64C3AF7', 11, '123456789', '2023-01-10', '2 Jubah Putih @ 400.000, 1 st lkng putih @ 90.000', b'0', NULL, NULL),
	('07140756593C30AE1CDC', 11, '123456789', '2023-01-09', '3 ktg kolekte tessa gg1', b'0', NULL, NULL),
	('09D4BF3C6042FC13D241', 1, '123', '2022-12-20', 'Penjualan Stola Lurus', b'0', NULL, '2022-12-20 11:49:16'),
	('0E1F82AF0B7EF1F24A95', 11, '5', '2023-02-11', 'Pembelian stola lurus', b'0', NULL, NULL),
	('13347844A6DC73A6B66C', 11, '123456789', '2023-01-30', '1 st lurus, 2 pin @ 10.000', b'0', NULL, NULL),
	('155BAC33671674CE3453', 11, '123456789', '2023-01-20', '2 st lkng @ 90.000', b'0', NULL, NULL),
	('161DDBC737C603C7281B', 11, '-', '2023-01-05', '-', b'0', NULL, NULL),
	('212DE09D5A74D73DFD2C', 11, '11', '2023-01-20', 'Pembelian stola lengkung', b'0', NULL, NULL),
	('2484A63DEE90A58DA1F0', 11, '085348824545', '2023-03-22', 'Penjualan Stola', b'0', NULL, NULL),
	('27E969C61AEDABA59F8F', 11, '13', '2023-01-23', 'Pembelian stola lurus', b'0', NULL, NULL),
	('308AD062E27C5B02D46D', 12, '6', '2023-01-14', 'Pembelian stola lengkung', b'0', NULL, NULL),
	('382E72AE25795AE497B5', 11, '=', '2023-02-05', 'cash st lkng', b'0', NULL, NULL),
	('3971817D263D1B9DE4A0', 11, '123456789', '2023-01-18', '17 white collar @ 35.000, 3 dasi jubah pr, 4 dasi jubah lk', b'0', NULL, NULL),
	('44B7A8A2ADB29C439A51', 11, '-', '2023-01-05', 'Penjualan stola lengkung', b'0', NULL, NULL),
	('538243964C5513D1683C', 11, '10', '2023-01-20', 'Pembelian ktg kolekte tessa gg2', b'0', NULL, NULL),
	('62D236C89071D6748430', 11, '123456789', '2023-01-20', '2 st lkng @ 90.000', b'0', NULL, NULL),
	('653C8489AC47C2D9530E', 1, '087815004679', '2023-01-29', 'ewkjnkwenf', b'0', NULL, NULL),
	('6545566274A28BC704FE', 11, '083141411862', '2023-03-15', '4 st lkng @ 90.000, 2 pin kecil @ 10.000', b'0', NULL, NULL),
	('6AC9B87E9A2D37A00EE9', 12, '7', '2023-01-16', 'Pembelian cash st lurus', b'0', NULL, NULL),
	('792541EB21F76F02DC8E', 11, '123456789', '2023-01-10', '2 st lkng', b'0', NULL, NULL),
	('7D52DBE82247FAA61E99', 11, '123456789', '2023-01-14', '3 lbr st lkng', b'0', NULL, NULL),
	('86670E89F7F7D3677979', 11, '123456789', '2023-01-11', '5 lbr st lurus @ 80.000', b'0', NULL, NULL),
	('8953B451F63BCBF113FD', 11, '123456', '2023-01-10', 'cash', b'0', NULL, NULL),
	('8D4FC70911AA4DAF6DC7', 11, '123456789', '2023-01-23', '7 lbr st lurus @ 80.000', b'0', NULL, NULL),
	('8FE7A79C8F3471E2ECF1', 11, '123456789', '2023-01-09', 'St. Lurus 15 lbr @ 80.000', b'0', NULL, NULL),
	('90B85C165E2FD5185DF2', 11, '9', '2023-01-18', 'Cash', b'0', NULL, NULL),
	('9296A8589C768B820274', 11, '123456789', '2023-01-18', '11 lbr st lkng @ 90.000', b'0', NULL, NULL),
	('ADEE1EA920B768024BEE', 9, '087815004679', '2023-01-29', 'wejnekrng', b'0', NULL, NULL),
	('B5D515390C00737CACED', 11, '8', '2023-01-18', 'Pembelian White collar dan Dasi Jubah', b'0', NULL, NULL),
	('B6DC2B9D4BB877CEBE18', 11, '12', '2023-01-20', 'Pembelian stola lengkung', b'0', NULL, NULL),
	('BCE96717A304CA011CC6', 11, '123456789', '2023-01-16', '3 lbr st lurus @ 80.000', b'0', NULL, NULL),
	('E98E02785CBBEA624496', 11, '=', '2023-01-10', 'cash', b'0', NULL, NULL),
	('F162145327A1106FE08C', 11, '123456789', '2023-01-20', '1 ktg kolekte gg2', b'0', NULL, NULL),
	('F51F295A1C239873CEAA', 12, '14', '2023-01-06', 'cash', b'0', NULL, NULL),
	('F9F0C64790B1D6A45330', 11, '13', '2023-01-30', 'Pembelian stola lurus dan pin', b'0', NULL, NULL);

-- Dumping structure for table gkesewing.transaction_detail
DROP TABLE IF EXISTS `transaction_detail`;
CREATE TABLE IF NOT EXISTS `transaction_detail` (
  `transaction_detail_id` int unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(20) NOT NULL,
  `product_id` int unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `transaction_detail_discount` float NOT NULL DEFAULT '0',
  `transaction_detail_price` double NOT NULL DEFAULT '0',
  `transaction_detail_quantity` double NOT NULL DEFAULT '0',
  `transaction_detail_total` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_detail_id`),
  KEY `transaction_code` (`transaction_code`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `FK_transaction_detail_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_transaction_detail_transaction` FOREIGN KEY (`transaction_code`) REFERENCES `transaction` (`transaction_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.transaction_detail: ~46 rows (approximately)
DELETE FROM `transaction_detail`;
INSERT INTO `transaction_detail` (`transaction_detail_id`, `transaction_code`, `product_id`, `product_name`, `category_name`, `product_unit`, `transaction_detail_discount`, `transaction_detail_price`, `transaction_detail_quantity`, `transaction_detail_total`, `created_at`, `updated_at`) VALUES
	(15, '09D4BF3C6042FC13D241', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 2, 160000, NULL, NULL),
	(16, 'ADEE1EA920B768024BEE', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 1, 80000, NULL, NULL),
	(17, '653C8489AC47C2D9530E', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 1, 80000, NULL, NULL),
	(18, '0244BEE31ADD2AA0006E', 29, 'Pin GKE Small', 'Retail', '1', 0, 10000, 5, 50000, NULL, NULL),
	(19, '161DDBC737C603C7281B', 2, 'Stola Lengkung', 'Retail', 'Set', 0, 90000, 2, 180000, NULL, NULL),
	(21, '8953B451F63BCBF113FD', 2, 'Stola Lengkung', 'Retail', 'Set', 0, 90000, 2, 180000, NULL, NULL),
	(22, 'E98E02785CBBEA624496', 6, 'Jubah Putih Liturgos (L/P)', 'Retail', '1', 0, 400000, 2, 800000, NULL, NULL),
	(23, 'E98E02785CBBEA624496', 2, 'Stola Lengkung', 'Retail', 'Set', 0, 90000, 1, 90000, NULL, NULL),
	(24, '44B7A8A2ADB29C439A51', 2, 'Stola Lengkung', 'Retail', 'Set', 0, 90000, 2, 180000, NULL, NULL),
	(25, '0E1F82AF0B7EF1F24A95', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 5, 400000, NULL, NULL),
	(26, '308AD062E27C5B02D46D', 2, 'Stola Lengkung', 'Retail', 'Set', 0, 90000, 3, 270000, NULL, NULL),
	(27, '6AC9B87E9A2D37A00EE9', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 3, 240000, NULL, NULL),
	(28, 'B5D515390C00737CACED', 31, 'White Collar', 'Retail', '1', 0, 35000, 17, 595000, NULL, NULL),
	(29, 'B5D515390C00737CACED', 36, 'Dasi Jubah Pdt', 'Retail', '1', 0, 50000, 7, 350000, NULL, NULL),
	(30, '90B85C165E2FD5185DF2', 2, 'Stola Lengkung', 'Retail', 'Set', 0, 90000, 11, 990000, NULL, NULL),
	(31, '538243964C5513D1683C', 16, 'Kantong Kolekte Tessa G2', 'Retail', '1', 0, 100000, 1, 100000, NULL, NULL),
	(32, '212DE09D5A74D73DFD2C', 2, 'Stola Lengkung', 'Retail', 'Set', 0, 90000, 2, 180000, NULL, NULL),
	(33, 'B6DC2B9D4BB877CEBE18', 2, 'Stola Lengkung', 'Retail', 'Set', 0, 90000, 2, 180000, NULL, NULL),
	(34, '27E969C61AEDABA59F8F', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 7, 560000, NULL, NULL),
	(35, 'F9F0C64790B1D6A45330', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 1, 80000, NULL, NULL),
	(36, 'F9F0C64790B1D6A45330', 29, 'Pin GKE Small', 'Retail', '1', 0, 10000, 2, 20000, NULL, NULL),
	(37, '382E72AE25795AE497B5', 2, 'Stola Lengkung', 'Retail', 'Set', 0, 90000, 7, 630000, NULL, NULL),
	(38, 'F51F295A1C239873CEAA', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 4, 320000, NULL, NULL),
	(39, '6545566274A28BC704FE', 2, 'Stola Lengkung', 'Retail', 'Set', 0, 90000, 4, 360000, NULL, NULL),
	(40, '6545566274A28BC704FE', 29, 'Pin GKE Small', 'Retail', '1', 0, 10000, 2, 20000, NULL, NULL),
	(41, '2484A63DEE90A58DA1F0', 1, 'Stola Lurus', 'Retail', 'Lembar', 10000, 80000, 10, 790000, NULL, NULL),
	(42, '2484A63DEE90A58DA1F0', 2, 'Stola Lengkung', 'Retail', 'Lembar', 0, 90000, 1, 90000, NULL, NULL),
	(43, '8FE7A79C8F3471E2ECF1', 29, 'Pin GKE Small', 'Retail', '1', 0, 10000, 5, 50000, NULL, NULL),
	(44, '8FE7A79C8F3471E2ECF1', 2, 'Stola Lengkung', 'Retail', 'Lembar', 0, 90000, 9, 810000, NULL, NULL),
	(45, '8FE7A79C8F3471E2ECF1', 1, 'Stola Lurus', 'Retail', 'Lembar', 0, 80000, 19, 1520000, NULL, NULL),
	(46, '07140756593C30AE1CDC', 15, 'Kantong Kolekte Tessa G1', 'Jasa', '1', 0, 80000, 3, 240000, NULL, NULL),
	(47, '792541EB21F76F02DC8E', 2, 'Stola Lengkung', 'Retail', 'Lembar', 0, 90000, 2, 180000, NULL, NULL),
	(48, '031D2269CF0DF64C3AF7', 6, 'Jubah Putih Liturgos (L/P)', 'Retail', '1', 0, 400000, 2, 800000, NULL, NULL),
	(49, '031D2269CF0DF64C3AF7', 2, 'Stola Lengkung', 'Retail', 'Lembar', 0, 90000, 1, 90000, NULL, NULL),
	(50, '86670E89F7F7D3677979', 1, 'Stola Lurus', 'Retail', 'Lembar', 0, 80000, 5, 400000, NULL, NULL),
	(51, '7D52DBE82247FAA61E99', 2, 'Stola Lengkung', 'Retail', 'Lembar', 0, 90000, 3, 270000, NULL, NULL),
	(52, 'BCE96717A304CA011CC6', 1, 'Stola Lurus', 'Retail', 'Lembar', 0, 80000, 3, 240000, NULL, NULL),
	(53, '3971817D263D1B9DE4A0', 31, 'White Collar', 'Retail', '1', 0, 35000, 17, 595000, NULL, NULL),
	(54, '3971817D263D1B9DE4A0', 36, 'Dasi Jubah Pdt', 'Retail', '1', 0, 50000, 7, 350000, NULL, NULL),
	(55, '9296A8589C768B820274', 2, 'Stola Lengkung', 'Retail', 'Lembar', 0, 90000, 11, 990000, NULL, NULL),
	(56, 'F162145327A1106FE08C', 16, 'Kantong Kolekte Tessa G2', 'Retail', '1', 0, 100000, 1, 100000, NULL, NULL),
	(57, '62D236C89071D6748430', 2, 'Stola Lengkung', 'Retail', 'Lembar', 0, 90000, 2, 180000, NULL, NULL),
	(58, '155BAC33671674CE3453', 2, 'Stola Lengkung', 'Retail', 'Lembar', 0, 90000, 2, 180000, NULL, NULL),
	(59, '8D4FC70911AA4DAF6DC7', 1, 'Stola Lurus', 'Retail', 'Lembar', 0, 80000, 7, 560000, NULL, NULL),
	(60, '13347844A6DC73A6B66C', 1, 'Stola Lurus', 'Retail', 'Lembar', 0, 80000, 1, 80000, NULL, NULL),
	(61, '13347844A6DC73A6B66C', 29, 'Pin GKE Small', 'Retail', '1', 0, 10000, 2, 20000, NULL, NULL);

-- Dumping structure for table gkesewing.transaction_detail_temp
DROP TABLE IF EXISTS `transaction_detail_temp`;
CREATE TABLE IF NOT EXISTS `transaction_detail_temp` (
  `detail_id` int unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(20) NOT NULL,
  `product_id` int unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `transaction_detail_discount` float NOT NULL DEFAULT '0',
  `transaction_detail_price` double NOT NULL DEFAULT '0',
  `transaction_detail_quantity` double NOT NULL DEFAULT '0',
  `transaction_detail_total` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`detail_id`) USING BTREE,
  KEY `transaction_code` (`transaction_code`) USING BTREE,
  KEY `product_id` (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gkesewing.transaction_detail_temp: ~0 rows (approximately)
DELETE FROM `transaction_detail_temp`;

-- Dumping structure for table gkesewing.transaction_spending
DROP TABLE IF EXISTS `transaction_spending`;
CREATE TABLE IF NOT EXISTS `transaction_spending` (
  `spending_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `supplier_id` int DEFAULT NULL,
  `spending_date` date NOT NULL,
  `spending_desc` text NOT NULL,
  `spending_total` double NOT NULL,
  `spending_photo_path` text NOT NULL,
  `is_ledger` bit(1) NOT NULL DEFAULT b'0' COMMENT '0 = Belum BKU, 1 = Sudah BKU',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`spending_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.transaction_spending: ~0 rows (approximately)
DELETE FROM `transaction_spending`;
INSERT INTO `transaction_spending` (`spending_id`, `employee_id`, `supplier_id`, `spending_date`, `spending_desc`, `spending_total`, `spending_photo_path`, `is_ledger`, `created_at`, `updated_at`) VALUES
	(9, 11, 0, '2023-07-02', 'dqwdqwd', 100000, 'data/img/pengeluaran/1688275294_8312dca109a374e7339d.png', b'0', '2023-07-02 05:21:34', '2023-07-02 05:21:34');

-- Dumping structure for table gkesewing.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_level_id` int unsigned NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_is_active` int NOT NULL DEFAULT '1',
  `employee_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`) USING BTREE,
  KEY `FK_user_user_level` (`user_level_id`),
  KEY `FK_user_employee` (`employee_id`),
  CONSTRAINT `FK_user_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_user_user_level` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`user_level_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.user: ~5 rows (approximately)
DELETE FROM `user`;
INSERT INTO `user` (`user_id`, `user_level_id`, `user_username`, `user_password`, `user_name`, `user_is_active`, `employee_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 'admin', '$2y$10$G6od4Fc03ualqN8lBdLaVeGlrdmtQ8XcXTHnYBgev0qZhQ4vQzQmi', 'Administrator', 1, NULL, '2022-09-19 03:46:57', '2022-09-29 12:25:26'),
	(3, 1, 'yudhayudha', '$2y$10$.N45I5e52rkHZSi.czhde.7RMEkik2nHrQLSn6x29hRKQbKgcDBaa', 'yudhayudha', 1, NULL, '2023-01-29 04:27:48', '2023-01-29 04:27:48'),
	(4, 1, 'efrig20', '$2y$10$q97wC.YMzlg9.L77r8CGau.lX5fplrJXaBrcuCqcLMzRGMyZ7kiPm', 'Enrico Frigia', 1, NULL, '2023-02-18 11:19:45', '2023-02-18 11:19:45'),
	(5, 2, 'yusda', '$2y$10$NsuH7YtGWow1eofAVSH3jeHAom7bLmHvlWS9h/WfAO5xqGy4OxoEO', 'Endang', 1, 11, '2023-03-22 02:53:42', '2023-03-22 02:53:42'),
	(6, 2, 'pegawai1', '$2y$10$cw4xZkRx9fG5vyz30xac.eTyvGYwaQ1pIuEeHqD0bFJP/j/Aqi/6m', 'Yuanita', 1, 13, '2023-06-12 03:38:08', '2023-06-12 03:38:08');

-- Dumping structure for table gkesewing.user_level
DROP TABLE IF EXISTS `user_level`;
CREATE TABLE IF NOT EXISTS `user_level` (
  `user_level_id` int unsigned NOT NULL,
  `user_level_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_level_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.user_level: ~2 rows (approximately)
DELETE FROM `user_level`;
INSERT INTO `user_level` (`user_level_id`, `user_level_name`) VALUES
	(1, 'Administrator'),
	(2, 'Pegawai');

-- Dumping structure for table gkesewing.uti_account_group
DROP TABLE IF EXISTS `uti_account_group`;
CREATE TABLE IF NOT EXISTS `uti_account_group` (
  `uti_account_group_id` int unsigned NOT NULL AUTO_INCREMENT,
  `uti_account_group_name` varchar(50) NOT NULL,
  `uti_account_group_alias` char(5) NOT NULL,
  PRIMARY KEY (`uti_account_group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.uti_account_group: ~2 rows (approximately)
DELETE FROM `uti_account_group`;
INSERT INTO `uti_account_group` (`uti_account_group_id`, `uti_account_group_name`, `uti_account_group_alias`) VALUES
	(1, 'Neraca', 'NRC'),
	(2, 'Laba Rugi', 'L/R');

-- Dumping structure for table gkesewing.uti_account_post
DROP TABLE IF EXISTS `uti_account_post`;
CREATE TABLE IF NOT EXISTS `uti_account_post` (
  `uti_account_post_id` int unsigned NOT NULL AUTO_INCREMENT,
  `uti_account_post_name` varchar(50) NOT NULL,
  `uti_account_post_alias` char(5) NOT NULL,
  PRIMARY KEY (`uti_account_post_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.uti_account_post: ~2 rows (approximately)
DELETE FROM `uti_account_post`;
INSERT INTO `uti_account_post` (`uti_account_post_id`, `uti_account_post_name`, `uti_account_post_alias`) VALUES
	(1, 'Debit', 'DB'),
	(2, 'Kredit', 'KR');

-- Dumping structure for table gkesewing.uti_product_category
DROP TABLE IF EXISTS `uti_product_category`;
CREATE TABLE IF NOT EXISTS `uti_product_category` (
  `uti_product_category_id` int unsigned NOT NULL AUTO_INCREMENT,
  `uti_product_category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`uti_product_category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table gkesewing.uti_product_category: ~2 rows (approximately)
DELETE FROM `uti_product_category`;
INSERT INTO `uti_product_category` (`uti_product_category_id`, `uti_product_category_name`) VALUES
	(1, 'Retail'),
	(2, 'Jasa');

-- Dumping structure for trigger gkesewing.menus_after_insert
DROP TRIGGER IF EXISTS `menus_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `menus_after_insert` AFTER INSERT ON `menu` FOR EACH ROW BEGIN
insert menu_role (menu_id, user_level_id, menu_role_action) values (new.menu_id, 1, 1);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
