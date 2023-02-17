-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table pos-penjahit.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `account_code` int(11) unsigned NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `uti_account_post_id` int(11) NOT NULL,
  `uti_account_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`account_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.account: ~0 rows (approximately)

-- Dumping structure for table pos-penjahit.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_phone` varchar(15) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` text,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_phone` (`customer_phone`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.customer: ~3 rows (approximately)
INSERT IGNORE INTO `customer` (`customer_id`, `customer_phone`, `customer_name`, `customer_address`) VALUES
	(1, '123', 'Yani', 'Jl. Panjaitan'),
	(2, '12345', 'Yamano', 'Jl. Perintis kemerdekaan'),
	(3, 'dadasda', 'dasdasd', 'asdasdasd');

-- Dumping structure for table pos-penjahit.employee
DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(255) NOT NULL,
  `employee_phone` varchar(15) DEFAULT NULL,
  `employee_status` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 Aktif, 0 Tidak Aktif',
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.employee: ~3 rows (approximately)
INSERT IGNORE INTO `employee` (`employee_id`, `employee_name`, `employee_phone`, `employee_status`) VALUES
	(1, 'Yamin', '123', b'1'),
	(2, 'Suni', '123123', b'1'),
	(3, 'Majur', '0909', b'1');

-- Dumping structure for table pos-penjahit.ledger
DROP TABLE IF EXISTS `ledger`;
CREATE TABLE IF NOT EXISTS `ledger` (
  `ledger_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_code` int(11) unsigned NOT NULL,
  `transaction_code` varchar(20) DEFAULT NULL,
  `spending_id` int(11) DEFAULT NULL,
  `ledger_desc` text NOT NULL,
  `ledger_number` int(11) NOT NULL,
  `ledger_date` date NOT NULL,
  `ledger_score` int(11) NOT NULL,
  PRIMARY KEY (`ledger_id`),
  KEY `account_code` (`account_code`),
  CONSTRAINT `FK_ledger_account` FOREIGN KEY (`account_code`) REFERENCES `account` (`account_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.ledger: ~0 rows (approximately)

-- Dumping structure for table pos-penjahit.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(225) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_link` varchar(225) NOT NULL,
  `menu_sort` int(11) NOT NULL,
  `menu_icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pos-penjahit.menu: ~9 rows (approximately)
INSERT IGNORE INTO `menu` (`menu_id`, `menu_name`, `menu_parent`, `menu_link`, `menu_sort`, `menu_icon`) VALUES
	(1, 'Dashboard', 0, 'dashboard', 1, '<i data-feather="home"></i>'),
	(2, 'Data Master', 0, '#', 3, ''),
	(3, 'Pengguna', 2, 'pengguna', 4, '<i data-feather=\'user-check\'></i>'),
	(4, 'Karyawan', 2, 'karyawan', 1, '<i data-feather=\'briefcase\'></i>'),
	(5, 'Pelanggan', 2, 'pelanggan', 2, '<i data-feather=\'users\'></i>'),
	(6, 'Pemasok', 2, 'pemasok', 3, '<i data-feather=\'database\'></i>'),
	(7, 'Produk', 2, 'produk', 1, '<i data-feather=\'book-open\'></i>'),
	(8, 'Transaksi', 0, '#', 2, ''),
	(20, 'Penjualan', 8, 'transaksi/penjualan', 2, '<i data-feather=\'shopping-cart\'></i>'),
	(21, 'Pengeluaran', 8, 'pengeluaran', 3, '<i data-feather=\'shopping-cart\'></i>');

-- Dumping structure for table pos-penjahit.menu_role
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE IF NOT EXISTS `menu_role` (
  `menu_role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) unsigned NOT NULL,
  `user_level_id` int(11) unsigned NOT NULL,
  `menu_role_action` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`menu_role_id`) USING BTREE,
  KEY `menu_id` (`menu_id`),
  KEY `level` (`user_level_id`) USING BTREE,
  CONSTRAINT `FK_menu_role_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_menu_role_user_level` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`user_level_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table pos-penjahit.menu_role: ~8 rows (approximately)
INSERT IGNORE INTO `menu_role` (`menu_role_id`, `menu_id`, `user_level_id`, `menu_role_action`) VALUES
	(1, 1, 1, 1),
	(2, 2, 1, 1),
	(3, 3, 1, 1),
	(4, 4, 1, 1),
	(5, 5, 1, 1),
	(6, 6, 1, 1),
	(7, 7, 1, 1),
	(8, 8, 1, 1),
	(9, 20, 1, 1),
	(10, 21, 1, 1);

-- Dumping structure for table pos-penjahit.product
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.product: ~4 rows (approximately)
INSERT IGNORE INTO `product` (`product_id`, `product_name`, `product_unit`, `product_price`, `product_buy`, `uti_product_category_id`, `product_status`) VALUES
	(1, 'Stola Lurus', 'Set', 80000, 0, 1, b'1'),
	(2, 'Stola Lengkung', 'Set', 90000, 0, 1, b'1'),
	(3, 'Jubah Pendeta', 'Set', 625000, 500000, 2, b'1'),
	(4, 'Jubah Pendeta Tanpa Bludru', 'Set', 625000, 500000, 2, b'1');

-- Dumping structure for table pos-penjahit.supplier
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_company` varchar(255) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_phone` varchar(15) NOT NULL,
  `supplier_address` text NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.supplier: ~0 rows (approximately)

-- Dumping structure for table pos-penjahit.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_code` varchar(20) NOT NULL,
  `employee_id` int(11) unsigned NOT NULL,
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

-- Dumping data for table pos-penjahit.transaction: ~4 rows (approximately)
INSERT IGNORE INTO `transaction` (`transaction_code`, `employee_id`, `customer_phone`, `transaction_date`, `transaction_desc`, `is_ledger`, `created_at`, `updated_at`) VALUES
	('1E793FC5043AE8814665', 1, '123', '2022-12-08', 'asda as das dasdasd', b'0', NULL, NULL),
	('2C47F73583940BF83817', 2, 'dadasda', '2022-12-08', 'asdasd as dasdas', b'0', NULL, NULL),
	('53C74BC6EC30FA2FBA85', 1, '12345', '2022-12-08', 'ad adsasd asd asdasd', b'0', NULL, NULL),
	('726056B61633DD9D0E3B', 2, '12345', '2022-12-08', 'asdasd', b'0', NULL, NULL);

-- Dumping structure for table pos-penjahit.transaction_detail
DROP TABLE IF EXISTS `transaction_detail`;
CREATE TABLE IF NOT EXISTS `transaction_detail` (
  `transaction_detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(20) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.transaction_detail: ~5 rows (approximately)
INSERT IGNORE INTO `transaction_detail` (`transaction_detail_id`, `transaction_code`, `product_id`, `product_name`, `category_name`, `product_unit`, `transaction_detail_discount`, `transaction_detail_price`, `transaction_detail_quantity`, `transaction_detail_total`, `created_at`, `updated_at`) VALUES
	(7, '1E793FC5043AE8814665', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 4, 320000, NULL, NULL),
	(8, '53C74BC6EC30FA2FBA85', 2, 'Stola Lengkung', 'Retail', 'Set', 0, 90000, 2, 180000, NULL, NULL),
	(9, '53C74BC6EC30FA2FBA85', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 1, 80000, NULL, NULL),
	(10, '726056B61633DD9D0E3B', 3, 'Jubah Pendeta', 'Jasa', 'Set', 0, 625000, 2, 1250000, NULL, NULL),
	(11, '2C47F73583940BF83817', 1, 'Stola Lurus', 'Retail', 'Set', 0, 80000, 3, 240000, NULL, NULL);

-- Dumping structure for table pos-penjahit.transaction_detail_temp
DROP TABLE IF EXISTS `transaction_detail_temp`;
CREATE TABLE IF NOT EXISTS `transaction_detail_temp` (
  `detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(20) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pos-penjahit.transaction_detail_temp: ~0 rows (approximately)

-- Dumping structure for table pos-penjahit.transaction_spending
DROP TABLE IF EXISTS `transaction_spending`;
CREATE TABLE IF NOT EXISTS `transaction_spending` (
  `spending_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `spending_date` date NOT NULL,
  `spending_desc` text NOT NULL,
  `spending_total` double NOT NULL,
  `is_ledger` bit(1) NOT NULL DEFAULT b'0' COMMENT '0 = Belum BKU, 1 = Sudah BKU',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`spending_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.transaction_spending: ~0 rows (approximately)

-- Dumping structure for table pos-penjahit.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_level_id` int(11) unsigned NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_is_active` int(11) NOT NULL DEFAULT '1',
  `employee_id` int(11) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`) USING BTREE,
  KEY `FK_user_user_level` (`user_level_id`),
  KEY `FK_user_employee` (`employee_id`),
  CONSTRAINT `FK_user_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_user_user_level` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`user_level_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.user: ~0 rows (approximately)
INSERT IGNORE INTO `user` (`user_id`, `user_level_id`, `user_username`, `user_password`, `user_name`, `user_is_active`, `employee_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 'admin', '$2y$10$G6od4Fc03ualqN8lBdLaVeGlrdmtQ8XcXTHnYBgev0qZhQ4vQzQmi', 'Administrator', 1, NULL, '2022-09-19 03:46:57', '2022-09-29 12:25:26');

-- Dumping structure for table pos-penjahit.user_level
DROP TABLE IF EXISTS `user_level`;
CREATE TABLE IF NOT EXISTS `user_level` (
  `user_level_id` int(11) unsigned NOT NULL,
  `user_level_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_level_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.user_level: ~2 rows (approximately)
INSERT IGNORE INTO `user_level` (`user_level_id`, `user_level_name`) VALUES
	(1, 'Administrator'),
	(2, 'Pegawai');

-- Dumping structure for table pos-penjahit.uti_account_group
DROP TABLE IF EXISTS `uti_account_group`;
CREATE TABLE IF NOT EXISTS `uti_account_group` (
  `uti_account_group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uti_account_group_name` varchar(50) NOT NULL,
  `uti_account_group_alias` char(5) NOT NULL,
  PRIMARY KEY (`uti_account_group_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.uti_account_group: ~0 rows (approximately)

-- Dumping structure for table pos-penjahit.uti_account_post
DROP TABLE IF EXISTS `uti_account_post`;
CREATE TABLE IF NOT EXISTS `uti_account_post` (
  `uti_account_post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uti_account_post_name` varchar(50) NOT NULL,
  `uti_account_post_alias` char(5) NOT NULL,
  PRIMARY KEY (`uti_account_post_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.uti_account_post: ~2 rows (approximately)
INSERT IGNORE INTO `uti_account_post` (`uti_account_post_id`, `uti_account_post_name`, `uti_account_post_alias`) VALUES
	(1, 'Debit', 'DB'),
	(2, 'Kredit', 'KR');

-- Dumping structure for table pos-penjahit.uti_product_category
DROP TABLE IF EXISTS `uti_product_category`;
CREATE TABLE IF NOT EXISTS `uti_product_category` (
  `uti_product_category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uti_product_category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`uti_product_category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table pos-penjahit.uti_product_category: ~2 rows (approximately)
INSERT IGNORE INTO `uti_product_category` (`uti_product_category_id`, `uti_product_category_name`) VALUES
	(1, 'Retail'),
	(2, 'Jasa');

-- Dumping structure for trigger pos-penjahit.menus_after_insert
DROP TRIGGER IF EXISTS `menus_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
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
